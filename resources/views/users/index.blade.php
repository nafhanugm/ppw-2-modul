@extends('buku.layout.layout')
@php
    use Illuminate\Support\Facades\Session;
@endphp

@section('content')
    <body class="mx-10">
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success') }}
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="py-2 px-4  border-2 bg-teal-500 hover:bg-teal-400 active:bg-teal-600 rounded-lg text-white cursor-pointer font-semibold">
                Logout
            </button>
        </form>
    @endif
    <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah User</a>
    <table class="table table-stripped">
        <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>isVerified</th>
            <th>Created at</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $index => $user)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ isset($user->email_verified_at) ? 'Yes' : 'No' }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau di hapus?')" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
            </tr>
        @endforeach
        </tbody>
    </table>
{{--    <div>{{$data_buku->links()}}</div>--}}
{{--    <div>Jumlah Buku : {{$jumlah_buku}}</div>--}}
@endsection
