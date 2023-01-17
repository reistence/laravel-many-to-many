@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <h3 class="text-center text-danger fw-bold">Type List</h3>
        <div class="row justify-content-center">
            <div class="col-7">
                 <div class="text-end mb-4">
                <a href="{{ route('admin.types.create') }}" class="btn btn-danger">Add a new Type</a>
            </div>
            @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <table class="table  table-dark table-hover text-white ">
                    <thead>
                        <tr>
                            <th scope="col">Type:</th>
                            <th scope="col">Projects Nr.</th>
                            <th scope="col">Actions: </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider border-top border-danger">
                        @foreach ($types as $type)
                            <tr class="position-relative" >
                                
                                <th scope="row">{{ $type->name }}</th>
                                 <td>{{ count($type->projects) }}</td>                    
                                <td  class="">
                                    
                                    <a class="btn btn-dark" href="{{ route('admin.types.edit', $type->slug) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                     <button type="button" class="del btn btn-dark">
                                        <i class="fa-solid fa-circle-xmark text-danger"></i>
                                    </button>
                                     <form class="mymod"  tabindex="-1"action="{{route('admin.types.destroy', $type->slug)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <h3>Delete: {{$type->name}}</h3>
                                        <p>Are you sure you want to delete this type?</p>
                                        <button class="mybtn btn btn-danger" type="submit">Delete</button>
                                        <button type="button" class="dismissBtn btn btn-light">Dismiss</button>
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
</div>
@endsection