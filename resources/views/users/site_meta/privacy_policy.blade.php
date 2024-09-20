@extends('users_layout.master')
@section('content')
<section class="term-condition-sec p-130">
        @if(isset($policys) && $policys->isNotEmpty())
        @foreach($policys as $policy)
            <div class="container">
                <div class="term-condition-content">
                    @if($policy->key === 'title')
                        <h1>{{$policy->value}}</h1>
                    @endif
                    <div class="shortdesc">
                        @if($policy->key === 'description')
                        <p>
                            <?php print_r($policy->value); ?>
                        </p>
                        @endif
                    </div>
                    <div class="row">
                        @if($policy->key === 'privacy_policie')
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="rightside-wrapper">
                                <div class="privacy-cont" id="1">
                                    <p>   <?php print_r($policy->condition); ?></p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach    
    @else
        <p>No Found Data</p>
    @endif    
</section>
@endsection