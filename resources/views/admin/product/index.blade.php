@extends('admin.partials.default')

@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-lg-12 col-12">
                <a href="{{ route('admin.products.create') }}"><button class="btn btn-primary">Add product</button></a>
                <a href="{{ route('admin.admin.products.basket') }}" class="btn btn-danger">Basket <span
                        class="badge text-bg-light rounded-pill">{{ $basket_cnt }}</span></a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 col-10">

                @foreach ($products as $product)
                    <div class="container mt-4">
                        <div class="row justify-content-between">
                            <div class="col-md-8">
                                <div class="card shadow-sm border-0">

                                    <div class="card-body d-flex flex-column p-4">
                                        <h5 class="card-title mb-2">
                                            {{ $product->name }}
                                        </h5>

                                        <p class="card-text text-muted">
                                            {{ $product->description }}
                                        </p>
                                        <p class="card-text text-muted">Category: {{ $product->category->name }}</p>

                                        <p class="card-text">$<span>{{ $product->price }}</span></p>
                                    </div>

                                    <div class="mb-3">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="125">
                                        @endif
                                    </div>

                                    <div class="d-flex mb-3 ms-4">
                                        <div>
                                            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"><button
                                                    class="btn btn-warning">Edit</button></a>
                                        </div>
                                        <div class="ms-3">
                                            <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('confirm action')">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
@endsection
