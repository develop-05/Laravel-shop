@extends('admin.partials.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-10">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4>Edit product</h4>
                        </div>
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label"></label>
                                    <input placeholder="name" type="text" class="form-control" name="name"
                                        id="name" value="{{ old('name', $product->name) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label"></label>
                                    <input placeholder="description" type="text" class="form-control" name="description"
                                        id="description" value="{{ old('description', $product->description) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label"></label>
                                    <input placeholder="price" type="number" class="form-control" name="price"
                                        id="price" value="{{ old('price', $product->price) }}">
                                </div>

                                <div class="mb-3">
                                    <select name="category_id" id="category_id" class="form-select">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach


                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="imageUpload" class="form-label"></label>
                                    <input class="form-control" type="file" id="imageUpload" name="image">
                                </div>

                                <a href="{{ route('admin.products.index') }}">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
