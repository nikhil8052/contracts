@extends('admin_layout.master')
@section('content')

<div class="nk-content">
    <div class="container-fluid">
        <form action="{{ url('/admin-dashboard/add-register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $register->id ?? '' }}">
            <div class="row main_section">
                <div class="col-md-8 left_content">
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
                </div>
                <div class="col-md-4 right-content">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="50" value="">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" maxlength="155"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="view_btn col-md-6 mt-3">
                                    <a href="{{ url('/register') }}" class="btn view_page" target="_blank">View Page</a>
                                </div>
                                <div class="up-btn col-md-6 mt-3">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
