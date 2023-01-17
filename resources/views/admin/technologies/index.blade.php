@extends('layouts.admin')
@section('content')
     <div class="container mt-4">
        <h3 class="text-center text-danger fw-bold">Technologies List</h3>
        <div class="row justify-content-center">
            <div class="col-7">
                 <div class="text-end mb-4">
                <a href="{{ route('admin.technologies.create') }}" class="btn btn-danger">Add a new Tech</a>
            </div>
            @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table  table-dark table-hover text-white ">
                    <thead>
                        <tr>
                            <th scope="col">Technology:</th>
                            <th scope="col">Projects Nr.</th>
                            <th scope="col">Actions: </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider border-top border-danger">
                        @foreach ($technologies as $technology)
                            <tr class="position-relative" >
                                
                                <th scope="row">{{ $technology->name }}</th>
                                 <td>{{ count($technology->projects) }}</td>
                               
                                <td  class="">
                                    
                                    <a class="btn btn-dark" href="{{ route('admin.technologies.edit', $technology->slug) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                     <button technology="button" class="del btn btn-dark">
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    </button>
                                     <form class="mymod"  tabindex="-1"action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <h3>Delete: {{$technology->name}}</h3>
                                        <p>Are you sure you want to delete this technology?</p>
                                        <button class="mybtn btn btn-danger" technology="submit">Delete</button>
                                        <button technology="button" class="dismissBtn btn btn-light">Dismiss</button>
                                    </form>
                                <div class="layer"></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection