<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consent Records</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-xl font-bold">Consent Records</h1>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-600 hover:underline">Logout</button>
            </form>
        </div>

        <table class="w-full border text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">GUID</th>
                    <th class="border px-2 py-1">Accepted At</th>
                    <th class="border px-2 py-1">Version</th>
                    <th class="border px-2 py-1">IP</th>
                    <th class="border px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                    <tr class="border-b hover:bg-gray-50" id="record-{{ $record->id }}">
                        <td class="border px-2 py-1">{{ $record->id }}</td>
                        <td class="border px-2 py-1">
                            <span class="guid-display">{{ $record->guid }}</span>
                            <input type="text" class="guid-edit hidden w-full border rounded px-1 py-0.5" value="{{ $record->guid }}">
                        </td>
                        <td class="border px-2 py-1">
                            <span class="accepted-display">{{ $record->accepted_at }}</span>
                            <input type="datetime-local" class="accepted-edit hidden w-full border rounded px-1 py-0.5" value="{{ $record->accepted_at ? $record->accepted_at : '' }}">
                        </td>
                        <td class="border px-2 py-1">
                            <span class="version-display">{{ $record->version }}</span>
                            <input type="number" class="version-edit hidden w-full border rounded px-1 py-0.5" value="{{ $record->version }}">
                        </td>
                        <td class="border px-2 py-1">{{ $record->ip }}</td>
                        <td class="border px-2 py-1">
                            <div class="flex space-x-1">
                                <button onclick="editRecord({{ $record->id }})" class="edit-btn bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600">
                                    Edit
                                </button>
                                <button onclick="saveRecord({{ $record->id }})" class="save-btn hidden bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">
                                    Save
                                </button>
                                <button onclick="cancelEdit({{ $record->id }})" class="cancel-btn hidden bg-gray-500 text-white px-2 py-1 rounded text-xs hover:bg-gray-600">
                                    Cancel
                                </button>
                                <button onclick="deleteRecord({{ $record->id }})" class="delete-btn bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-3 text-gray-500">No consent records yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $records->links() }}
        </div>
    </div>

    <script>
        function editRecord(id) {
            const row = document.getElementById(`record-${id}`);
            
            // Hide display elements and show edit inputs
            row.querySelectorAll('.guid-display, .accepted-display, .version-display').forEach(el => el.classList.add('hidden'));
            row.querySelectorAll('.guid-edit, .accepted-edit, .version-edit').forEach(el => el.classList.remove('hidden'));
            
            // Toggle buttons
            row.querySelector('.edit-btn').classList.add('hidden');
            row.querySelector('.delete-btn').classList.add('hidden');
            row.querySelector('.save-btn').classList.remove('hidden');
            row.querySelector('.cancel-btn').classList.remove('hidden');
        }

        function cancelEdit(id) {
            const row = document.getElementById(`record-${id}`);
            
            // Show display elements and hide edit inputs
            row.querySelectorAll('.guid-display, .accepted-display, .version-display').forEach(el => el.classList.remove('hidden'));
            row.querySelectorAll('.guid-edit, .accepted-edit, .version-edit').forEach(el => el.classList.add('hidden'));
            
            // Toggle buttons
            row.querySelector('.edit-btn').classList.remove('hidden');
            row.querySelector('.delete-btn').classList.remove('hidden');
            row.querySelector('.save-btn').classList.add('hidden');
            row.querySelector('.cancel-btn').classList.add('hidden');
        }

        function saveRecord(id) {
            const row = document.getElementById(`record-${id}`);
            const guid = row.querySelector('.guid-edit').value;
            const acceptedAt = row.querySelector('.accepted-edit').value;
            const version = row.querySelector('.version-edit').value;

            // Create CSRF token meta tag if it doesn't exist
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const meta = document.createElement('meta');
                meta.name = 'csrf-token';
                meta.content = '{{ csrf_token() }}';
                document.head.appendChild(meta);
            }

            fetch(`/admin/consents/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    guid: guid,
                    accepted_at: acceptedAt,
                    version: parseInt(version)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display values
                    row.querySelector('.guid-display').textContent = guid;
                    row.querySelector('.accepted-display').textContent = data.record.accepted_at;
                    row.querySelector('.version-display').textContent = version;
                    
                    cancelEdit(id);
                    
                    // Show success message
                    showMessage('Record updated successfully!', 'success');
                } else {
                    showMessage('Error updating record: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Error updating record', 'error');
            });
        }

        function deleteRecord(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create CSRF token meta tag if it doesn't exist
                    if (!document.querySelector('meta[name="csrf-token"]')) {
                        const meta = document.createElement('meta');
                        meta.name = 'csrf-token';
                        meta.content = '{{ csrf_token() }}';
                        document.head.appendChild(meta);
                    }

                    fetch(`/admin/consents/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`record-${id}`).remove();
                        } else {
                            Swal.fire(
                                'Error!',
                                'Error deleting record: ' + (data.message || 'Unknown error'),
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'Error deleting record',
                            'error'
                        );
                    });
                }
            });
        }

        function showMessage(message, type) {
            // Remove existing messages
            const existingMessage = document.querySelector('.flash-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            // Create new message
            const messageDiv = document.createElement('div');
            messageDiv.className = `flash-message fixed top-4 right-4 px-4 py-2 rounded shadow-lg z-50 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            messageDiv.textContent = message;
            
            document.body.appendChild(messageDiv);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                messageDiv.remove();
            }, 3000);
        }
    </script>

</body>
</html>