<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsentRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function consents()
    {
        $records = ConsentRecord::latest()->paginate(15);
        return view('admin.consents', compact('records'));
    }

    public function updateConsent(Request $request, $id): JsonResponse
    {
        try {
            $request->validate([
                'guid' => 'required|string|max:255',
                'accepted_at' => 'required|date',
                'version' => 'required|integer|min:1'
            ]);

            $record = ConsentRecord::findOrFail($id);
            
            $record->update([
                'guid' => $request->guid,
                'accepted_at' => $request->accepted_at,
                'version' => $request->version
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully',
                'record' => [
                    'id' => $record->id,
                    'guid' => $record->guid,
                    'accepted_at' => $record->accepted_at,
                    'version' => $record->version
                ]
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update record: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteConsent($id): JsonResponse
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
