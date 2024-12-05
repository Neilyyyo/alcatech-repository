@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Overdue Tenants</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($overdueTenants->isEmpty())
        <p>No overdue tenants found.</p>
    @else
        <form method="POST" action="{{ route('tenants.message') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Room</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overdueTenants as $tenant)
                        <tr>
                            <td>
                                <input type="checkbox" name="tenant_ids[]" value="{{ $tenant->id }}">
                            </td>
                            <td>{{ $tenant->firstName }} {{ $tenant->lastName }}</td>
                            <td>{{ $tenant->email }}</td>
                            <td>{{ $tenant->room->name ?? 'N/A' }}</td>
                            <td>{{ $tenant->due_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Messages</button>
        </form>
    @endif
</div>
@endsection
