<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Consents Management - DailyTimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-gray-800">DailyTimes - Admin</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Welcome, {{ session('user_name') }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg min-h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.consents') }}" class="flex items-center p-3 text-gray-700 bg-blue-100 rounded-lg">
                            <i class="fas fa-shield-alt mr-3"></i>
                            Consents
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.articles') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-newspaper mr-3"></i>
                            Articles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="flex items-center p-3 text-gray-700 hover:bg-gray-100 rounded-lg">
                            <i class="fas fa-home mr-3"></i>
                            View Site
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Consents Management</h2>
                <p class="text-gray-600">Manage user consent records</p>
            </div>

            <!-- Consents Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">All Consent Records</h3>
                        <div class="text-sm text-gray-600">
                            Total: {{ $records->total() }} records
                        </div>
                    </div>
                </div>

                @if ($records->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        GUID
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Accepted At
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Version
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        IP Address
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($records as $record)
                                    <tr id="record-{{ $record->id }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $record->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="guid-display text-sm text-gray-900">{{ $record->guid }}</span>
                                            <input type="text" class="guid-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->guid }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="accepted-display text-sm text-gray-900">{{ $record->accepted_at ? Carbon\Carbon::parse($record->accepted_at)->format('h:i A - d M Y') : '' }}</span>
                                            <input type="datetime-local" class="accepted-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->accepted_at ? Carbon\Carbon::parse($record->accepted_at)->format('h:i A - d M Y') : '' }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="version-display text-sm text-gray-900">{{ $record->version }}</span>
                                            <input type="number" class="version-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->version }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $record->ip }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <button onclick="editRecord({{ $record->id }})" class="edit-btn text-indigo-600 hover:text-indigo-900">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button onclick="saveRecord({{ $record->id }})" class="save-btn hidden text-green-600 hover:text-green-900">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                                <button onclick="cancelEdit({{ $record->id }})" class="cancel-btn hidden text-gray-600 hover:text-gray-900">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <button onclick="deleteRecord({{ $record->id }})" class="text-red-600 hover:text-red-900">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $records->links() }}
                    </div>
                @else
                    <div class="p-6 text-center">
                        <i class="fas fa-shield-alt text-gray-400 text-4xl mb-4"></i>
                        <p class="text-gray-500">No consent records found.</p>
                    </div>
                @endif
            </div>
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
            row.querySelector('.save-btn').classList.add('hidden');
            row.querySelector('.cancel-btn').classList.add('hidden');
        }

        function saveRecord(id) {
            const row = document.getElementById(`record-${id}`);
            const guid = row.querySelector('.guid-edit').value;
            const acceptedAt = row.querySelector('.accepted-edit').value;
            const version = row.querySelector('.version-edit').value;

            // Send AJAX request to update the record
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
                        
                        // Format the accepted_at date to "h:i A - d M Y" format
                        if (acceptedAt) {
                            const date = new Date(acceptedAt);
                            const options = {
                                hour: 'numeric',
                                minute: '2-digit',
                                hour12: true,
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            };
                            const time = date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
                            const dateStr = date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
                            const formattedDate = `${time} - ${dateStr}`;
                            row.querySelector('.accepted-display').textContent = formattedDate;
                        } else {
                            row.querySelector('.accepted-display').textContent = 'Not accepted';
                        }
                        
                        row.querySelector('.version-display').textContent = version;

                        // Cancel edit mode
                        cancelEdit(id);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Record updated successfully',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message || 'Failed to update record'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating the record'
                    });
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
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/consents/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById(`record-${id}`).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Record has been deleted.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: data.message || 'Failed to delete record'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while deleting the record'
                            });
                        });
                }
            });
        }
    </script>
</body>

</html>
