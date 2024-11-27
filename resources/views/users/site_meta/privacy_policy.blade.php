@extends('users_layout.master')
@section('content')

<section class="privacy-sec p_110">
    <div class="container">
        <div class="privacy-policy-content">
            <h1>{{ $data['main_heading'] ?? '' }}</h1>
            <div class="shortdesc">
                <?php print_r($data['description']);?>
            </div>
            <div class="row">
            @if(isset($policys) && $policys != null)
            <?php $count=1;?>
            @foreach($policys as $policy)
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="rightside-wrapper">
                        <div class="privacy-cont" id="{{ $count++ ?? '' }}">
                            <h2>{{ $policy->terms ?? '' }}</h2>
                            <?php print_r($policy->condition); ?>
                        </div>
                    </div>
                </div>
                <hr>
            @endforeach
            @endif
            </div>
        </div>
    </div>   
</section>
@endsection