<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ConsentRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ConsentController extends Controller
{
    protected $log;

    public function __construct()
    {
        $this->log = Log::channel('consent');
    }

    public function accept(Request $request)
    {
        try {
            $guid = (string) Str::uuid();
            $now = Carbon::now();

            $record = ConsentRecord::create([
                'guid' => $guid,
                'accepted_at' => $now,
                'version' => 1,
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
        } catch (\Exception $e) {
            $this->log->error($e);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to accept consent: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => 'ok',
            'guid' => $guid,
            'accepted_at' => $now->toIso8601String(),
            'version' => 1,
        ]);
    }

    public function decline(Request $request)
    {
        try {
            $guid = (string) Str::uuid();
            // ConsentRecord::create([
            //     'guid' => $guid,
            //     'accepted_at' => null,
            //     'version' => 1,
            //     'ip' => $request->ip(),
            //     'user_agent' => $request->header('User-Agent'),
            // ]);
        } catch (\Exception $e) {
            $this->log->error($e);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to decline consent: ' . $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => 'declined',
            'timestamp' => Carbon::now()->toIso8601String(),
        ]);
    }

    public function validate(Request $request)
    {
        try {
            $request->validate([
                'guid' => 'required|string',
                'accepted_at' => 'required|string',
                'version' => 'required|integer',
            ]);
    
            $record = ConsentRecord::where('guid', $request->guid)
                ->whereNotNull('accepted_at')
                ->first();
    
            if (!$record) {
                return response()->json([
                    'valid' => false,
                    'reason' => 'Record not found or not accepted'
                ]);
            }
    
            $cookieAcceptedAt = Carbon::parse($request->accepted_at);
            $dbAcceptedAt = Carbon::parse($record->accepted_at);
    
            if (!$cookieAcceptedAt->equalTo($dbAcceptedAt)) {
                return response()->json([
                    'valid' => false,
                    'reason' => 'Timestamp mismatch'
                ]);
            }
    
            if ($record->version !== $request->version) {
                return response()->json([
                    'valid' => false,
                    'reason' => 'Version mismatch'
                ]);
            }
        } catch (\Exception $e) {
            $this->log->error($e);

            return response()->json([
                'valid' => false,
                'reason' => 'Validation failed: ' . $e->getMessage()
            ], 400);
        }

        return response()->json([
            'valid' => true,
            'record' => [
                'guid' => $record->guid,
                'accepted_at' => $record->accepted_at,
                'version' => $record->version,
            ]
        ]);
    }

    public function consents()
    {
        $records = ConsentRecord::latest()->paginate(15);
        return view('admin.consents', compact('records'));
    }

    public function updateConsent(Request $request, $id)
    {
        try {
            $record = ConsentRecord::findOrFail($id);
            
            $request->validate([
                'guid' => 'required|string|max:255',
                'accepted_at' => 'nullable|date',
                'version' => 'required|integer|min:1'
            ]);

            $data = [
                'guid' => $request->guid,
                'version' => $request->version,
            ];

            if ($request->accepted_at !== $record->accepted_at) {
                $data['accepted_at'] = $request->accepted_at;
            }

            $record->update($data);

            return response()->json(['success' => true, 'message' => 'Consent updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update consent: ' . $e->getMessage()]);
        }
    }

    public function deleteConsent($id)
    {
        try {
            $record = ConsentRecord::findOrFail($id);
            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete record: ' . $e->getMessage()
            ], 500);
        }
    }
}
