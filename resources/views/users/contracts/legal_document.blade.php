@extends('users_layout.master')
@section('content')

<section class="tab_sec_ot p_120">
     <div class="container">
          <div class="row">
               <div class="heading_sec_tabs">
                    <h2 class="doc_h">{{ $legal->main_heading ?? 'Elige el Documento Legal que necesitas' }}</h2>
                    <p class="size18 light">{{ $legal->main_sub_heading ?? 'Crea documentos legales personalizados que se adaptan a tus necesidades' }}</p>
               </div>
          </div>
     </div>
     <div class="container">
          <div class="wrapper">
               <div class="tab">
                    <!-- Button to show Todos tab -->
                    <div class="btn active" onclick="showTab('todos')">Todos</div>
                    
                    <!-- Loop through categories and create buttons for each category -->
                    @if(isset($document_category) && $document_category != null)
                         @foreach($document_category as $index => $doc_catg)
                              <div class="btn {{ $index == 0 ? 'active' : '' }}" onclick="showTab('tab{{ $index + 1 }}')">
                              {{ $doc_catg->name ?? '' }}
                              </div>
                         @endforeach
                    @endif
               </div>
               
               <div class="tabContentWrap">
                    <!-- Todos Tab Content -->
                    <div class="tab_box_sec tabContent show" id="todos">
                         <div class="container">
                              <div class="row">
                              @if(isset($alldocuments) && $alldocuments != null)
                                   @foreach($alldocuments as $document)
                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                             <div class="inside_box_tab">
                                                  <div class="img_tab_sec">
                                                       <?php 
                                                            $image_path = str_replace('public/', '', $document->document_file_path ?? null);
                                                       ?>
                                                       <img src="{{ asset('storage/'.$image_path) }}" alt="">
                                                  </div>
                                                  <div class="cont_tab_ot">
                                                       <div class="tab_text">
                                                            <h5 class="size20">
                                                                 {{ $document->title ?? '' }}
                                                            </h5>
                                                            <ul class="tab_ul">
                                                                 <li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
                                                                 <li>4.6</li>
                                                            </ul>
                                                       </div>
                                                       <div class="tab_2text light">
                                                            <?php $short = Str::limit($document->short_description, 70, '...'); 
                                                            print_r($short); ?>
                                                       </div>
                                                  </div>
                                                  <div class="tab_btn">
                                                       <a href="{{ url('document/'.$document->slug) }}" class="cta_org">Crear ahora</a>
                                                  </div>
                                             </div>
                                        </div>
                                   @endforeach
                              @endif
                              </div>
                         </div>
                    </div>

                    <!-- Category Tabs Content -->
                    @if(isset($document_category) && $document_category != null)
                         @foreach($document_category as $index => $catg)
                              <div class="tab_box_sec tabContent {{ $index == 0 ? 'show' : '' }}" id="tab{{ $index + 1 }}">
                              <div class="container">
                                   <div class="row">
                                        @foreach($alldocuments as $catg_document)
                                             @if($catg_document->categories->contains('id', $catg->id))
                                                  <div class="col-lg-3 col-md-6 col-sm-6">
                                                       <div class="inside_box_tab">
                                                            <div class="img_tab_sec">
                                                                 <?php 
                                                                 $document_img = str_replace('public/', '', $catg_document->document_file_path ?? null);
                                                                 ?>
                                                                 <img src="{{ asset('storage/'.$document_img) }}" alt="">
                                                            </div>
                                                            <div class="cont_tab_ot">
                                                                 <div class="tab_text">
                                                                      <h5 class="size20">{{ $catg_document->title ?? '' }}</h5>
                                                                      <ul class="tab_ul">
                                                                           <li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
                                                                           <li>4.8</li>
                                                                      </ul>
                                                                 </div>
                                                                 <div class="tab_2text light">
                                                                      <?php $short = Str::limit($catg_document->short_description, 70, '...'); 
                                                                      print_r($short); ?>
                                                                 </div>
                                                            </div>
                                                            <div class="tab_btn">
                                                                 <a href="{{ url('document/'.$catg_document->slug) }}" class="cta_org">Crear ahora</a>
                                                            </div>
                                                       </div>
                                                  </div>
                                             @endif
                                        @endforeach
                                   </div>
                              </div>
                              </div>
                         @endforeach
                    @endif
                    <!-- Pagination//////////////////////////////////////////////// -->
                    <!-- <nav class="pagination_nav" aria-label="Page navigation example">
                         <div class="container">
                              <ul class="pagination justify-content-center">
                                   <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"><i
                                             class="fa-solid fa-arrow-left"></i></a>
                                   </li>
                                   <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                   <li class="page-item"><a class="page-link" href="#">2</a></li>
                                   <li class="page-item"><a class="page-link" href="#">3</a></li>
                                   <li class="page-item active">
                                        <a class="page-link" href="#"><i class="fa-solid fa-arrow-right"></i></a>
                                   </li>
                              </ul>
                         </div>
                    </nav> -->
               </div>
          </div>
     </div>
</section>


<script>
     function showTab(tabId) {
          document.querySelectorAll('.tabContent').forEach(tab => tab.classList.remove('show'));
          document.querySelectorAll('.btn').forEach(btn => btn.classList.remove('active'));
          document.getElementById(tabId).classList.add('show');
          document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
     }

     document.addEventListener('DOMContentLoaded', function() {
          showTab('todos');
     });
</script>

@endsection