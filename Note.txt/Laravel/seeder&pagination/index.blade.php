@extends('layouts.main', ['title' => 'user index'])
@section('head')
@endsection

@section('content')
<h1>welcome to User page</h1>
<table class="table table-striped table-hover table-bordered table-sm text-center mt-5">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Roles</th>
            <th scope="col">Profile</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                @if ($user->profile)
                    <ul>
                        <li>{{ $user->profile->first_name }}</li>
                        <li>{{ $user->profile->last_name }}</li>
                        <li>{{ $user->profile->phone }}</li>
                    </ul>
                @else

                        <span class="text-danger">No Profile available</span>

                @endif
            </td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
        @empty
            <h1>no users found!!</h1>
        @endforelse
    </tbody>
</table>

{{-- {{ $users->links() }} --}}
{{ $users->onEachSide(3)->links() }}
@endsection
