@extends('admin_layout.master')
@section('content')

<div class="nk-content">
    <div class="container-fluid">
        <form action="{{ url('/admin-dashboard/add-register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $register->id ?? '' }}">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="col-md-8 pb-2">
                        <div class="form-group">
                            <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                            <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $register->title ?? '' }}">
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
