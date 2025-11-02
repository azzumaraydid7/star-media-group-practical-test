<div class="px-3 sm:px-6 py-4 border-b border-gray-200 space-y-2">
    <!-- Row 1 -->
    <div class="flex justify-between items-center">
        <div>
            <span class="block text-[10px] uppercase text-gray-400 tracking-wider">ID</span>
            <span class="text-sm font-medium text-gray-900">{{ $record->id }}</span>
        </div>

        <div class="text-right w-full ml-6">
            <span class="block text-[10px] uppercase text-gray-400 tracking-wider">GUID</span>
            <span class="guid-display w-full text-sm text-gray-500">{{ $record->guid }}</span>
            <input type="text" name="guid" class="guid-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->guid }}">
        </div>
    </div>

    <!-- Row 2 -->
    <div class="flex justify-between items-center">
        <div>
            <span class="block text-[10px] uppercase text-gray-400 tracking-wider">Accepted At</span>
            <span class="guid-display text-sm text-gray-900">
                {{ $record->accepted_at ? Carbon\Carbon::parse($record->accepted_at)->format('h:i A - d M Y') : '—' }}
            </span>
            <input type="datetime-local" name="accepted_at" class="accepted-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->accepted_at ? Carbon\Carbon::parse($record->accepted_at)->format('Y-m-d\TH:i') : '' }}">
        </div>

        <div class="text-right">
            <span class="block text-[10px] uppercase text-gray-400 tracking-wider">Version</span>
            <span class="guid-display text-sm text-gray-500">{{ $record->version }}</span>
            <input type="number" name="version" class="version-edit hidden w-10 px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->version }}">
        </div>
    </div>

    <!-- Row 3 -->
    <div class="flex justify-between items-center">
        <div>
            <span class="block text-[10px] uppercase text-gray-400 tracking-wider">IP Address</span>
            <span class="text-sm text-gray-500">{{ $record->ip }}</span>
        </div>

        <div class="flex space-x-2">
            @include('admin.includes.consent-button-actions', ['record' => $record])
        </div>
    </div>
</div>
