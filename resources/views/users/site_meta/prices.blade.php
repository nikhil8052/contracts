@extends('users_layout.master')
@section('content')

 <!-- ********(banner-sec)*********** -->

<section class="banner_sec dark inner-banner" style="background-image: url('{{ asset('storage/'.$data['background_image'] ?? '' ) }}');">
     <div class="container banner-col-width">
          <div class="row align-items-center">
               <div class="col-md-6 banner-col">
               <div class="banner_content">
                    <h1>{{ $data['banner_title'] ?? 'Precios' }}</h1>
                    <p>
                         {{ $data['banner_description'] ?? 'Creemos en ofrecer precios claros y asequibles para soluciones legales de alta calidad. Ya
                         sea que sea un individuo, una pequeña empresa o una empresa más grande, tenemos un plan
                         diseñado para satisfacer sus necesidades específicas.' }}
                    </p>
               </div>
               </div>
               <div class="col-md-6 banner-col">
               <img src="{{ asset('storage/'.$data['banner_image']) }}" alt="Así funciona">
               </div>
          </div>
     </div>
</section>

    <!-- table section start //////////////////////////////////////// -->


<section class="table_ot_precio p_120 light">
     <div class="table-container">
          <table>
               <thead>
                    <tr>
                         <th class="docom">{{ $data['document_heading'] ?? 'Documento' }}</th>
                         <th>{{ $data['description_heading'] ?? 'Descripción' }}</th>
                         <th class="prec">{{ $data['price_heading'] ?? 'Precio' }}</th>
                    </tr>
               </thead>
               <tbody>
               @if(isset($document_price_description) && $document_price_description != null)
               @foreach($document_price_description as $content)
                    <tr>
                         <td class="tb_dt1">
                              <h6 class="table_in_h">{{ $content->documentname->title ?? '' }}</h6><br>
                              <div class="tab_btn">
                                   <a href="" class="cta_blue" tabindex="-1">{{ $content->button_text ?? '' }}</a>
                              </div>
                         </td>
                         <td class="tb_dt2">{{ $content->description ?? '' }} </td>
                         <td class="tb_dt3 "> <a href="" class="span1"> ${{ $content->price ?? '' }}</a></td>
                    </tr>
               @endforeach
               @endif
               </tbody>
          </table>
     </div>
</section>

@endsection