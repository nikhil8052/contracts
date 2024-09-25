@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">  
        <div class="container centered-form d-flex justify-content-center align-items-center">
            <div class="card w-50 mt-5"> <!-- Card wrapper -->
                <div class="card-body">
                    <h5 class="card-title">Add Documents Category </h5>
                    <form action="{{route('category.process')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <!-- <input type="hidden" name="id" value=""> -->
                            <label for="firstName">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" value="">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastName">Description:</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                             @error('description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div> 
        @if(isset($categorys) && $categorys->isNotEmpty())
        <div class="container mt-5">
            <h2 class="mb-4 text-center">Categories</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center action-column">Action</th>
                    </tr>
                </thead>
                @foreach($categorys as $id => $category)
                    <tbody>
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td class="text-center">
                                <a href="{{url('/admin-dashboard/edit-category/'.$category->id)}}" class="btn btn-primary btn-sm mt-2">Edit</a>
                                <!-- <a href="{{url('/admin-dashboard/delete-category/'.$category->id)}}" class="btn btn-danger btn-sm mt-2">Delete</a> -->
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <!-- @else
            <p class="text-center">User Not Found</p> -->
        @endif    
    </div>
</div>

@endsection