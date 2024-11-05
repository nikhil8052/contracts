@extends('users_layout.master')
@section('content')



<div class="mobile_header_side_bar">
     <div class="header_sidebar_inner">
          <div class="sidebar_empty_space"></div>
          <div class="sidebar_header_content">
               <div class="sidebar_header_nav">
                    <div class="header_search_form">
                         <form id="header_search_form" method="POST" action="" autocomplete="off">
                         <input type="text" class="form-control" name="search" placeholder="Buscar" />
                         <button class="mobilesearch-btn" type="submit">
                              <i class="fa-solid fa-magnifying-glass"></i>
                         </button>
                         </form>
                    </div>
                    <ul class="_Ty8L2" data-qa="SidebarMenuList">
                         <li><a href="">Arrendamiento</a></li>
                         <li><a href="">Comercio</a></li>
                         <li><a href="">Consumo</a></li>
                         <li><a href="">Familia</a></li>
                         <li><a href="">Internet</a></li>
                         <li><a href="">Laboral</a></li>
                         <li><a href="">Vida diaria</a></li>
                    </ul>

                  

                    <div class="mobile_header_buuton">
                         <a class="cta" href="">Crear documento</a>
                    </div>
               </div>
          </div>
     </div>
     <div role="button" class="_GtzsW _Gv2_B"><div class="_NRBhu"></div></div>
     <div class="__z_48"></div>
</div>


<div> 


   <h1> Below we load the questions...</h1>
</div>





<div id="questionsContainer" class="p-5 card">



 <div class="questions_div"> 

      
 </div>
</div>
<script src="{{ asset('assets/js/questions.js') }}"></script>


@endsection