@extends('admin.layouts.app')

@section('title', 'Consents Management')

@section('header')
    <div class="pt-16">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Consents Management</h2>
        <p class="text-gray-600 text-sm sm:text-base">Manage user consent records</p>
    </div>
@endsection

@section('content')
    <!-- Consents Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 sm:gap-0">
                <h3 class="text-lg font-semibold text-gray-800">All Consent Records</h3>
                <div class="text-sm text-gray-600">
                    Total: {{ $records->total() }} records
                </div>
            </div>
        </div>

        @if ($records->count() > 0)
            <div class="overflow-x-auto">
                @foreach ($records as $record)
                    <div id="record-{{ $record->id }}">

                        <!-- DESKTOP TABLE ROW -->
                        <table class="min-w-full divide-y divide-gray-200 hidden sm:table">
                            <tbody>
                                <tr>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $record->id }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="guid-display text-sm text-gray-900 break-all">{{ $record->guid }}</span>
                                        <input type="text" name="guid" class="guid-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->guid }}">
                                    </td>
                                    <td class="px-3 sm:px-6 py-4">
                                        <span class="accepted-display text-sm text-gray-900">{{ $record->accepted_at ? Carbon\Carbon::parse($record->accepted_at)->format('h:i A - d M Y') : '' }}</span>
                                        <input type="datetime-local" name="accepted_at" class="accepted-edit hidden w-full px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->accepted_at ? Carbon\Carbon::parse($record->accepted_at)->format('Y-m-d\TH:i') : '' }}">
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                        <span class="version-display text-sm text-gray-900">{{ $record->version }}</span>
                                        <input type="number" name="version" class="version-edit hidden w-10 px-2 py-1 text-sm border border-gray-300 rounded" value="{{ $record->version }}">
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                                        {{ $record->ip }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        @include('admin.includes.consent-button-actions', ['record' => $record])
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- MOBILE CARD VIEW -->
                        <div class="sm:hidden px-3 sm:px-6 py-4 border-b border-gray-200 space-y-2">
                            @include('admin.mobile.consent-record', ['record' => $record])
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-4 sm:px-6 py-4 border-t border-gray-200">
                {{ $records->links() }}
            </div>
        @else
            <div class="p-6 text-center">
                <i class="fas fa-shield-alt text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">No consent records found.</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function editRecord(id) {
            const row = document.getElementById(`record-${id}`);

            row.querySelectorAll('.guid-display, .accepted-display, .version-display').forEach(el => el.classList.add('hidden'));
            row.querySelectorAll('.guid-edit, .accepted-edit, .version-edit').forEach(el => el.classList.remove('hidden'));

            row.querySelectorAll('.edit-btn').forEach(el => el.classList.add('hidden'));
            row.querySelectorAll('.save-btn').forEach(el => el.classList.remove('hidden'));
            row.querySelectorAll('.cancel-btn').forEach(el => el.classList.remove('hidden'));
        }

        function cancelEdit(id) {
            const row = document.getElementById(`record-${id}`);

            row.querySelectorAll('.guid-display, .accepted-display, .version-display').forEach(el => el.classList.remove('hidden'));
            row.querySelectorAll('.guid-edit, .accepted-edit, .version-edit').forEach(el => el.classList.add('hidden'));

            row.querySelectorAll('.edit-btn').forEach(el => el.classList.remove('hidden'));
            row.querySelectorAll('.save-btn').forEach(el => el.classList.add('hidden'));
            row.querySelectorAll('.cancel-btn').forEach(el => el.classList.add('hidden'));
        }

        // Helper to get the visible element among potentially duplicated inputs (desktop/mobile views)
        function getVisibleElement(root, selector) {
            const elements = root.querySelectorAll(selector);
            for (const el of elements) {
                const style = window.getComputedStyle(el);
                const isVisible = style.visibility !== 'hidden' && style.display !== 'none' && el.offsetWidth > 0 && el.offsetHeight > 0 && el.offsetParent !== null;
                if (isVisible) {
                    return el;
                }
            }
            return elements[0] || null;
        }

        function saveRecord(id) {
            const row = document.getElementById(`record-${id}`);

            const guidInput = getVisibleElement(row, '.guid-edit');
            const acceptedInput = getVisibleElement(row, '.accepted-edit');
            const versionInput = getVisibleElement(row, '.version-edit');

            const guid = guidInput ? guidInput.value : '';
            const acceptedAt = acceptedInput ? acceptedInput.value : '';
            const versionValue = versionInput ? versionInput.value : '';
            const version = versionValue !== '' ? parseInt(versionValue, 10) : null;

            fetch(`/admin/consents/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        guid: guid,
                        accepted_at: acceptedAt,
                        version: version
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.querySelectorAll('.guid-display').forEach(el => el.textContent = guid);

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
                            const time = date.toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });
                            const dateStr = date.toLocaleDateString('en-GB', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            });
                            const formattedDate = `${time} - ${dateStr}`;
                            row.querySelectorAll('.accepted-display').forEach(el => el.textContent = formattedDate);
                        } else {
                            row.querySelectorAll('.accepted-display').forEach(el => el.textContent = 'Not accepted');
                        }

                        row.querySelectorAll('.version-display').forEach(el => el.textContent = version);

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
@endpush
