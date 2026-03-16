@extends('admin.partials.default')


@section('content')
    <div class="container-fluid mt-3">
        <div class="col-lg-12 col-12 mb-4">
            <a href="{{ route('admin.categories.create') }}"><button class="btn btn-primary">Add category</button></a>
        </div>
        <div class="row">
            <table class="table table-bordered" role="table">
                <thead>
                    <tr>
                        <th style="width: 10px" scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th style="width: 150px" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="align-middle">
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td class=" d-flex gap-2">
                                <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                    class="btn btn-info">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
                                    method="post">
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
