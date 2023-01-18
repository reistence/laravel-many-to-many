@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="container text-white mb-4">
         <div class="text-start mb-4">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-danger"><i class="fa-solid fa-angles-left"></i></a>
            </div>
        <h1 class="text-center mt-3 text-danger fw-bold">Edit: {{$project->title}}</h1>
         <div class="row justify-content-center">
             <div class="col-10 mb-5">
                    @include('partials.errors')
                    <form class="" action="{{route('admin.projects.update', $project->slug)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="title">Title</label>
                            <input type="text" class="form-control bg-dark text-white" id="title" name="title" value="{{old('title',$project->title)}}">
                        </div>

                        <div class="form-group mt-3 mb-3">
                        <label for="type">Type</label>
                        <select name="type_id" id="type" class="form-select">
                            <option value="">Nessuna categoria</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @selected($project->type?->id == $type->id)>{{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group mb-3">
                        <p>Tech:</p>
                        @foreach ($technologies as $technology)
                            <div class="form-check form-check-inline">
                                <input type="checkbox"  name="technologies[]" id="technology-{{ $technology->id }}" class="btn-check"
                                    value="{{ $technology->id }}" @checked($project->technologies->contains($technology))>
                                <label for="technology-{{ $technology->id }}" class="btn btn-outline-danger">{{ $technology->name }}</label>
                            </div>
                        @endforeach
                        </div>

                        <div class="form-group mb-3">
                        <label for="cover_image">Image</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control bg-dark text-white">

                        {{-- Preview img --}}
                        <div class="mt-3 w-50" style="max-height: 200px">
                            <img class="w-75 rounded-4" id="image_preview" src="{{ asset('storage/' . $project->cover_image) }}"
                                alt="{{ $project->title . ' image' }}">
                        </div>
                    </div>


                        <div class="mb-2">
                            <label for="thumb">Description</label>
                            <textarea class="form-control bg-dark text-white" id="description" name="description"
                            rows="10">{{$project->description}}</textarea>
                        </div>
                        <button class="btn btn-danger" type="submit">Add</button>
                    </form>
                </div>
            </div>

    </div>
</div>
@endsection