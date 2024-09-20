@extends('users_layout.master')
@section('content')

<section class="term-condition-sec p-130">
    <div class="container">
        <div class="term-condition-content">
            <h1>{{ $data['main_heading'] ?? '' }}</h1>
            <div class="shortdesc"></div>
            <div class="row">
                <!-- <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="leftside-wrapper">
                        <h5></h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#"></a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="rightside-wrapper">
                    @if(isset($termsAndCondition) && $termsAndCondition->isNotEmpty())
                        <?php $i=1;?>
                        @foreach($termsAndCondition as $index=>$value)
                        <div class="privacy-cont" id="{{ $i }}">
                            <?php print_r($value->condition ?? '' ); ?>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection            