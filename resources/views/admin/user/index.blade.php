@extends('admin.partials.default')


@section('content')
    <div class="container-fluid mt-3">
        <div class="col-lg-12 col-12 mb-4">
            <a href="{{ route('admin.users.create') }}"><button class="btn btn-primary">Add user</button></a>
        </div>
        <div class="row">
            <table class="table table-bordered" role="table">
                <thead>
                    <tr>
                        <th style="width: 10px" scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Is admin</th>
                        <th style="width: 150px" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="align-middle">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {!! $user->is_admin
                                    ? '<span class="text-success"><i class="bi bi-check-circle"></i></span>'
                                    : '<span class="text-danger"><i class="bi bi-person-fill-check"></i></span>' !!}
                                {{-- {{ $user->name }} --}}
                            </td>

                            <td class=" d-flex gap-2">
                                <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-info">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('confirm action')"><i
                                            class="bi bi-trash"></i></button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
