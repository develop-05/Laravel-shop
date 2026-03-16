@extends('admin.partials.default')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-10">

                <div class="container mt-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4>Add new user</h4>
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

                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    {{-- <label for="name" class="form-label"></label> --}}
                                    <input placeholder="name" type="text" class="form-control" name="name" id="name" value="{{ old('name')}}">
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label"></label>
                                    <input placeholder="email" type="text" class="form-control" name="email" id="email" value="{{ old('email')}}">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label"></label>
                                    <input placeholder="password" type="password" class="form-control" name="password" id="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label"></label>
                                    <input placeholder="confirm password" type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_admin" name="is_admin" @checked(old('is_admin'))>
                                    <label class="form-check-label" for="is_admin">
                                        Is admin
                                    </label>
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
