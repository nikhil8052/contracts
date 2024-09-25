@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">  
        @if(isset($category))
            <div class="container centered-form d-flex justify-content-center align-items-center">
                <div class="card w-50 mt-5"> <!-- Card wrapper -->
                    <div class="card-body">
                        <h5 class="card-title">Update Document Category </h5>
                        <form action="{{route('category.process')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="hidden" name="id" value="{{$category->id}}">
                                <label for="firstName">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}">
                          
                            </div>
                            <div class="form-group mb-3">
                                <label for="lastName">Description:</label>
                                <textarea class="form-control" name="description" id="description">{{$category->description}}</textarea>
                           
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div> 
        @endif
    </div>
</div>
@endsection
