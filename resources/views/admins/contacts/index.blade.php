@extends('admins.layouts.master')
@section('header', 'Contacts')
@section('active', 'Contacts')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Contacts</h3>
                                <form action="{{ route('contacts.index') }}" method="GET" class="d-flex">
                                    <div class="d-flex">
                                        <!-- Name Filter -->
                                        <div class="form-group me-2">
                                            <input type="text" class="form-control" name="name" placeholder="Search by name"
                                                   value="{{ request('name') }}">
                                        </div>

                                        <!-- Submit Button -->
                                        <div>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
            </div>

            <div class="card-body p-0">
                <table class="table" id="clients-list">
                    <thead>
                    <tr>
                        <th style="width: 100px">#</th>
                        <th>Client</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($contacts as $contact)
                        <tr id="$contact-{{ $contact->id }}">
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $contact->client->name }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this contact?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No Found Data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="p-2">
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
