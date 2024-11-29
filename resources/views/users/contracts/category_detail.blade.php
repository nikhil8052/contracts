@extends('users_layout.master')
@section('content')

<section class="ot_cate_hed">
    <div class="cate_hed">
        <div class="container">
            <div class="row">
                <div class="cate_pg_hd">
                    <h1 class="cate_heding">
                        {{ $category->name ?? '' }}
                    </h1>
                    <p class="cate_para">
                        Elige el documento legal que necesitas
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="out_cate_sec">
    <div class="container">
        <div class="row">
            <div class="cate_a_list">
                <ul class="cate_ul_list">
                    <li class="cate_li_list">
                        <a href="{{ url('/documentos-legales') }}" class="cate_li_a">
                            Todos
                        </a>
                    </li>
                @if(isset($document_category) && $document_category != null)
                    @foreach($document_category as $catg)
                        @if(isset($category) && $category != null)
                            @if($category->name == $catg->name)
                            <li class="cate_li_list">
                                <a href="{{ url('category_detail/'.$catg->slug ?? '' ) }}" class="cate_li_a stay_cate">
                                    {{ $catg->name ?? '' }}
                                </a>
                            </li>
                            @else
                            <li class="cate_li_list">
                                <a href="{{ url('category_detail/'.$catg->slug ?? '' ) }}" class="cate_li_a">
                                    {{ $catg->name ?? '' }}
                                </a>
                            </li>
                            @endif
                        @endif
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="cate_cont_box">
    <div class="inside_cont_box">
        <div class="container">
            <div class="row">
            @if(isset($alldocuments) && $alldocuments != null)
                @foreach($alldocuments as $document)
                @if($document->categories->contains('id', $category->id))
                <div class="col-lg-3">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <div class="inside_box_tab">
                            <a href="{{ url('document/'.$document->slug) }}"
                                class="contract_link" tabindex="0">
                                <div class="img_tab_sec">
                                    <?php 
                                        $document_img = str_replace('public/', '', $document->document_file_path ?? null);
                                    ?>
                                    <img src="{{ asset('storage/'.$document_img) }}" alt="">
                                </div>
                            </a>
                            <div class="cont_tab_ot">
                                <a href="{{ url('document/'.$document->slug) }}"
                                    class="contract_link" tabindex="0">
                                    <div class="tab_text">
                                        <h5 class="size20">{{ $document->title ?? '' }}</h5>
                                        <div class="tab_ul">
                                            <div class="tab_star_li">
                                                <span class="rating-on rate-1" data-rating="1"></span>
                                                <span class="rating-on rate-2" data-rating="2"></span>
                                                <span class="rating-on rate-3" data-rating="3"></span>
                                                <span class="rating-on rate-4" data-rating="4"></span>
                                                <span class="rating-on rate-5" data-rating="5"></span>

                                            </div>
                                            <div>4.6</div>
                                        </div>
                                    </div>
                                    <div class="tab_2text light">
                                        <?php $short = Str::limit($document->short_description, 70, '...'); 
                                        print_r($short); ?>
                                    </div>
                                </a>
                                <div class="tab_btn">
                                    <a href="{{ url('document/'.$document->slug) }}" class="cta_org">Crear ahora</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            @endif
            </div>
        </div>
    </div>

</section>





@endsection