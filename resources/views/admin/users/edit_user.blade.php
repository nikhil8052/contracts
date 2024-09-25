@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">  
        @if(isset($user))
        <div class="container centered-form d-flex justify-content-center align-items-center">
            <div class="card w-50"> <!-- Card wrapper -->
                <div class="card-body">
                    <h5 class="card-title">User Information</h5>
                    <form action="{{route('update.user')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <label for="firstName">First name:</label>
                            <input type="text" class="form-control" name="first_name" id="firstName" value="{{$user->first_name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="lastName">Last name:</label>
                            <input type="text" class="form-control" name="last_name" id="lastName"  value="{{$user->last_name}}">
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}">
                        </div> -->
                       <div class="form-group mb-3">
                            <label for="role">Role:</label>
                            <select class="form-select" name="is_admin" id="role">
                                <option value="3" {{ $user->is_admin == 3 ? 'selected' : '' }}>User</option>
                                <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $user->is_admin == 2 ? 'selected' : '' }}>abogada</option>
                                <!-- Add more roles as needed -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        @else
            <p class="text-center">User Not Found</p>
        @endif    
    </div>
</div>

@endsection