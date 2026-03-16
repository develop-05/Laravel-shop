@extends('admin.partials.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-10">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4>Edit category</h4>
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

                            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="mb-3">
                                    {{-- <label for="name" class="form-label"></label> --}}
                                    <input placeholder="name" type="text" class="form-control" name="name" id="name" value="{{old('name', $category->name)}}">
                                </div>

                                <div class="mb-3">
                                    <label for="meta_desc" class="form-label"></label>
                                    <input placeholder="meta desc" type="text" class="form-control" name="meta_desc" id="meta_desc" value="{{old('meta_desc', $category->pmeta_desce)}}">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
