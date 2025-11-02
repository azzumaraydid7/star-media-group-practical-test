<button onclick="editRecord({{ $record->id }})" class="edit-btn text-indigo-600 hover:text-indigo-900 p-1" title="Edit">
    <i class="fas fa-edit text-sm"></i>
</button>
<button onclick="saveRecord({{ $record->id }})" class="save-btn hidden text-green-600 hover:text-green-900 p-1" title="Save">
    <i class="fas fa-save text-sm"></i>
</button>
<button onclick="cancelEdit({{ $record->id }})" class="cancel-btn hidden text-gray-600 hover:text-gray-900 p-1" title="Cancel">
    <i class="fas fa-times text-sm"></i>
</button>
<button onclick="deleteRecord({{ $record->id }})" class="text-red-600 hover:text-red-900 p-1" title="Delete">
    <i class="fas fa-trash text-sm"></i>
</button>