@extends('admin_layout.master')
@section('content')

<div class="nk-content">
    <div class="container-fluid">
        <form action="{{ url('/admin-dashboard/add-login') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $login->id ?? '' }}">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="col-md-8 pb-2">
                        <div class="form-group">
                            <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $login->title ?? '' }}">
                        </div>
                    </div>
                    <hr>
                    <h5>Login Page</h5>  
                    <hr>
                    <h6>Login Section</h6>
                    <hr>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label" for="main_heading">Main Heading</label>
                            <input type="text" class="form-control form-control" id="main_heading" name="main_heading" value="{{ $login->main_heading ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
