@extends('admin.partials.default')

@section('content')

<div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Basket</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered" role="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px" scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Deleted At</th>
                                            <th style="width: 150px" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="align-middle">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->deleted_at }}</td>

                                                <td class=" d-flex gap-2">
                                                    <a href="{{ route('admin.admin.products.basket.restore', ['product' => $product->id]) }}"
                                                        class="btn btn-warning">
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                    </a>

                                                    <form action="{{ route('admin.admin.products.basket.remove', ['product' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger"
                                                            onclick="return confirm('confirm action')"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection

