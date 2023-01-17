@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
    <div class="container text-white">
         <div class="text-start mb-4">
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-danger"><i class="fa-solid fa-angles-left"></i></a>
            </div>
        <h1 class="text-center mt-3">Add a new Technology</h1>
         <div class="row justify-content-center">
                <div class="col-7 mb-5">
                    @include('partials.errors')
                    <form class="" action="{{route('admin.technologies.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control bg-dark text-white" id="name" name="name" value="{{ old('title') }}">
                        </div>
                        <button class="btn btn-danger" type="submit">Add</button>
                    </form>
                </div>
            </div>

    </div>
</div>
@endsection