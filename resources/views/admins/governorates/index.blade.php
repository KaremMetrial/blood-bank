@extends('admins.layouts.master')
@section('header', 'Governorates')
@section('active', 'Governorates')
@section('content')
    <div class="row">
        <div class="card w-100">

            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Governorates</h3>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Create
                </button>
            </div>

            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table" id="governorates-list">
                    <thead>
                        <tr>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th style="width: 80%">Name</th>
                            <th>Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($governorates as $governorate)
                            <tr id="governorate">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $governorate->name }}</td>
                                <td>
                                    <a href="{{ route('governorates.edit', $governorate->id) }}"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ route('governorates.destroy', $governorate->id) }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No Found Data </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-2">
                    <ul class="pagination pagination-sm mb-0">
                        {{ $governorates->links() }}
                    </ul>

                </div>
            </div>
            <!-- /.card-body -->

            <!-- create modal -->
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default-label"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-default-label">Add New Governorates</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="governorate-form">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="create" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#create').on('click', function() {
                        var name = $('#name').val();

                        if (!name) {
                            $('#name-error').removeClass('d-none').text('Name is required.');
                            return;
                        } else {
                            $('#name-error').addClass('d-none');
                        }

                        $.ajax({
                            url: "{{ route('governorates.store') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                name: name
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    $('#modal-default').modal('hide');
                                    $('#name').val('');

                                    var newRow = `<tr id="governorate-${response.data.id}">
                        <td>${response.data.id}</td>
                        <td>${response.data.name}</td>
                        <td>
                            <a href="${response.data.edit_url}" class="btn btn-info btn-sm">Edit</a>
                            <a href="${response.data.delete_url}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>`;
                                    $('#governorates-list tbody').append(newRow);

                                    toastr.success(response.message);
                                }
                            },
                            error: function(response) {
                                toastr.error(response.message);
                            }
                        });
                    });
                });
            </script>
        @endpush
