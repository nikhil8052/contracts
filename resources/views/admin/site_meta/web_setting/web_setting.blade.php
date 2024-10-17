@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <form action="{{ url('/admin-dashboard/add/web-setting') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label" for="header_logo">Header Logo</label>
                            <input type="file" class="form-control" id="header_logo" name="header_logo">
                        </div>
                        @if(isset($data['header_logo']) && $data['header_logo'] != null)
                        <div class="form-group">
                            <img src="{{ asset('storage/'.$data['header_logo'] ?? '' ) }}">
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label" for="footer_logo">Footer Logo</label>
                            <input type="file" class="form-control" id="footer_logo" name="footer_logo">
                        </div>
                        @if(isset($data['footer_logo']) && $data['footer_logo'] != null)
                        <div class="form-group">
                            <img src="{{ asset('storage/'.$data['footer_logo'] ?? '' ) }}">
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label" for="favicon">Favicon</label>
                            <input type="file" class="form-control" id="favicon" name="favicon">
                        </div>
                        @if(isset($data['favicon']) && $data['favicon'] != null)
                        <div class="form-group">
                            <img src="{{ asset('storage/'.$data['favicon'] ?? '' ) }}">
                        </div>
                        @endif
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