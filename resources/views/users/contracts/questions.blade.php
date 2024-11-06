@extends('users_layout.master') @section('content')

<!-- <div class="mobile_header_side_bar">
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
    <h1>Below we load the questions...</h1>
</div> -->

<style>
    .main-question-form-controller {
        display: flex !important ;
        flex-direction: row !important   ;
        width: 100%;
        gap: 10px;
    }

    /* Ensures both boxes take up equal width */
    .left-box,
    .right-box {
        flex: 1;
        padding: 20px;
    }

    /* Optional: Add some styling to each box */
    .left-question-box {
        background-color: #edeef1; /* Example color */
        border-radius: 10px;
    }

    .right-question-box {
        background-color: #e0e0e0; /* Example color */
    }
    .question-div .que_heading {
        color: #002655;
        font-weight: 600;
        font-size: 20px;
    }

    .nxt,
    .pre {
        background: #002655;
        color: white;
        padding: 7px;
        border-radius: 10px;
    }
</style>
<section class="questions_page_main_div">

<!-- This is the main container for the question and the form  -->
<div id="main-question-form-controller" class="p-5 card" style="display: flex !important ; flex-direction: row !important ; gap: 10px;">
    <!-- here we show all the steps of the questions, this is the section where we show all the questions  -->
    <div class="left-box left-question-box questions-div">
        @foreach($questions as $index => $question )
          <div class="question-div step step-{{ $question->id }} mb-4 p-4" que_id="{{ $question->id }}" lbl_cond="{{ $question->is_question_label_condition }}">
               <p class="que_heading lbl-{{ $question->id }}" json-data="{{  $question->conditions && count($question->conditions) > 0 ? json_encode($question->conditions) : NULL  }}" >{{ $question->questionData->question_label ?? '' }}</p>
               @php 
                    $question_type= $question->type;
               @endphp 

               @if($question_type=="textbox")
                  <input type="text" />
               @elseif($question_type=="dropdown")
                    <select onchange="updateNextButton(this)">
                         @foreach( $question->options as $option )
                           <option my_ref_nxt=".nxt_btn_{{ $question->id }}" que_id="{{ $option->next_question_id }}" value="{{ $option->option_value }}"> {{ $option->option_label }} </option>
                         @endforeach
                    </select>
               @elseif($question_type=="radio")
                    @foreach($question->options as $option)
                         <input type="radio" name="question_{{ $question->id }}" onchange="updateNextButtonR(this)" my_ref_nxt=".nxt_btn_{{ $question->id }}" que_id="{{ $option->next_question_id }}" value="{{ $option->option_value }}" />
                         <label>{{ $option->option_label }}</label>
                    @endforeach 
               @elseif($question_type=="datefield")
                  <input type="date" />
               @endif

               <div class="navigation-btns mt-4">
                    @if($index!=0)
                         <button type="button " class="pre_btn_{{ $question->id }} nxt" que_id="" onclick="go_pre_step(this)">Previous</button>
                    @endif
                         <button type="button" class="nxt_btn_{{ $question->id }} pre " que_id="{{ $question->questionData->next_question_id ?? '' }}" my_ref="{{ $question->id }}" onclick="go_next_step(this)">Next</button>
               </div>
          </div>
        @endforeach
    </div>

    <!-- This is the box where we show the steps or the form -->
    <div class="right-box right-question-box form-div"></div>
</div>



</section>

<!-- JS for getting the questions  -->
<!-- <script src="{{ asset('assets/js/questions.js') }}"></script> -->

<script>
    let stack = [];
    $(".question-div").hide();
    $(".step-1").show();

    let stackObject = {
        type: "pre",
        div_id: ".step-1",
    };

    stack.push(stackObject);

    function go_next_step(e) {
        var next_step_id = $(e).attr("que_id");
        var my_ref = $(e).attr("my_ref");
        var next_step_div = `.step-${next_step_id}`;

        //Before change the div just check the label condition here 
        var is_label_condition=$(next_step_div).attr('lbl_cond');
        console.log(is_label_condition , " Condition is ok or not " )
        if(is_label_condition!=undefined &&  is_label_condition==1 ){
          var lbl = `.lbl-${next_step_id}`;
          var condition_data = $(lbl).attr('json-data')
          console.log(condition_data )
 
        }



        // get the current div previsous button refrence
        var pre_btn = `.pre_btn_${next_step_id}`;
        $(pre_btn).attr("que_id", my_ref);
        console.log(pre_btn);
        $(".question-div").hide();
        $(next_step_div).show();
        console.log(stack, " This is the button ");
    }

    function go_pre_step(e) {
        $(".question-div").hide();
        var next_step_id = $(e).attr("que_id");
        var next_step_div = `.step-${next_step_id}`;
        $(next_step_div).show();
    }

    function updateNextButton(selectElement) {
        // Get the currently selected option
        const selectedOption = selectElement.options[selectElement.selectedIndex];

        // Retrieve the attributes from the selected option
        const myNextBtn = selectedOption.getAttribute("my_ref_nxt");
        const queId = selectedOption.getAttribute("que_id");

        // console.log( myNextBtn , queId , " these are the ids man ")
        $(myNextBtn).attr("que_id", queId);
    }

    function updateNextButtonR(radioElement) {
        // Get the attributes from the selected radio button
        const myNextBtn = radioElement.getAttribute("my_ref_nxt");
        const queId = radioElement.getAttribute("que_id");
        const optionValue = radioElement.value;
        $(myNextBtn).attr("que_id", queId);
    }
</script>

@endsection
