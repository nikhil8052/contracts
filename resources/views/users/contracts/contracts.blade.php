@extends('users_layout.master') @section('content')

<style>
    .question-div{
        display: none;
    }

    .question-div.active{
        display: block;
    }

    .hide{
        display: none;
    }

    @keyframes colorHighlight {
        0% {
            background-color: rgb(128, 128, 128); /* Highlight background color */
            color: #002655; /* Text color during highlight */
        }
        100% {
            background-color: transparent; /* Fade out to transparent */
            color: #002655; /* Final text color */
        }
    }

    .active_sec {
        animation: colorHighlight 4s forwards; /* 4s animation, forwards keeps final state */
        transition: all 0.3s ease-in-out; /* Smooth transitions for other properties */
    }

    .answered_spns.active {
        background: #002655;
        color: #fff;
    }

</style>

<section class="privacy-sec questions_page_main_div">
    @if($questions->isNotEmpty() || $documentContents->isNotEmpty())
    <div class="container">
        <div class="contract-header">
            <div class="row document_align">
                <div class="col-md-8">
                    <div class="contract_heading_div">
                        <h1>{{ $document->title ?? '' }}</h1>	
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
                </div>
                <div class="col-md-4">
                    <div class="contract-progress">
                        <div class="progressLabel">
                            <span class="progressCount">0%</span>	
                            <input type="hidden" id="percent_count" value="0">	
                        </div>	
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" aria-label="progress-bar"></div>
                        </div>	
                    </div>	
                </div>	
                <div class="col-md-12">
                    <div class="valid_in_check tick_img">
                        <img src="{{ asset('assets/img/org_tick.svg') }}" alt=""> 
                        {{ $general->value ?? '' }}
                    </div>
                </div>
            </div>	
        </div>
    </div>
    <!-- This is the main container for the question and the form  -->

    <div class="main_questn">
        <div class="container">
            <div id="main-question-form-controller" class="row outer_main">
                <!-- <div class="col-md-4"> -->
                    <!-- here we show all the steps of the questions, this is the section where we show all the questions  -->
                    <div class="left-box left-question-box col-md-4">
                        <div class="left_heding">
                            <h3 class="contarct_top_left_heading">{{ $left_heading->value ?? 'Introduce los datos aquí:' }}</h3>
                        </div>
                        <form id="contractForm">
                            <input type="hidden" id="document_id" name="document_id" value="{{ $id ?? '' }}">
                            <input type="hidden" id="total_step" value="{{ $total_questions ?? ''}}">
                            <input type="hidden" id="all_attempted" value="0">
                            <input type="hidden" id="reverse_attempt" value="0">
                            <input type="hidden" id="user_id" value="{{ Auth::user()->id ?? '' }}">
                            @if(Auth::check())
                                @php 
                                    $is_login = true;
                                @endphp
                                <input type="hidden" id="is_login" value="{{ $is_login ?? '' }}">
                            @endif
                            @php 
                                $count = 1;
                                $num = 1;
                                $total_steps = count($questions);
                            @endphp      
                                @foreach($questions as $index => $question)
                                    <div class="question-div step{{ $count ?? '' }} step-{{ $question->id }} mb-4 p-4" que_id="{{ $question->id ?? '' }}" data-type="{{ $question->type ?? '' }}" is_condition="{{ $question->is_condition }}" swtchtyp="{{ $question->condition_type }}" data-count="{{ $count ?? '' }}" is_last="{{ $loop->last ? 'true' : ''}}">
                                        <div class="save_document_button">

                                        @if(Auth::check())
                                            <span ><img src="{{ asset('assets/img/download_icon.svg') }}">Guardar</span>  
                                        @else
                                            <span class="guardar_btn"><img src="{{ asset('assets/img/download_icon.svg') }}">Guardar</span>  
                                        @endif
                
                                        </div>
                                        @endforeach
                                    @elseif($question_type == "date-field")
                                        @php 
                                            $next_qid = $question->questionData->next_question_id ?? '';
                                        @endphp 
                                        
                                        <input type="date" class="contract_date" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                            onchange="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}')" />
                                    @elseif($question_type == "pricebox")
                                        @php 
                                            $next_qid = $question->questionData->next_question_id ?? '';
                                        @endphp 
                                        <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}" 
                                            onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>

                                    @elseif($question_type == "number-field")
                                        @php 
                                            $next_qid = $question->questionData->next_question_id ?? '';
                                        @endphp 
                                        <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                            onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>
                                    @elseif($question_type == "percentage-box")
                                        @php 
                                            $next_qid = $question->questionData->next_question_id ?? '';
                                        @endphp 
                                        <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                            onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>
                                    @elseif($question_type == "dropdown-link")
                                        @php 
                                            $next_qid = $question->questionData->next_question_id ?? '';
                                        @endphp 
                                        <select onchange="updateDropdownLInk(this, '{{ $question->id ?? '' }}'); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}') " target-id="qidtarget-{{ $question->id ?? '' }}"  id="{{ $question->id }}" name="{{ $question->id ?? '' }}">
                                            <option value="{{ $question->questionData->same_contract_link_label ?? '' }}" selected>{{ $question->questionData->same_contract_link_label ?? '' }}</option>
                                            @foreach($question->options as $option)
                                                <option my_ref_nxt=".nxt_btn_{{ $question->id ?? '' }}" que_id="{{ $question->questionData->next_question_id ?? '' }}"
                                                value="{{ $option->contract_link ?? '' }}">{{ $option->option_label ?? '' }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <div class="navigation-btns mt-4"> 
                                
                                        @if($index != 0)
                                            <button type="button" class="pre_btn_{{ $question->id }} pre" que_id="" my_ref="{{ $question->id }}"
                                                onclick="go_pre_step(this)">Previous</button>
                                        @endif
                                        <button type="button" class="nxt_btn_{{ $question->id ?? '' }} nxt" que_id="{{ $next_qid ?? '' }}" data-next_step="{{ $next_qid ?? '' }}"
                                            data-condition_step="{{ $question->questionData->conditional_go_to_step ?? '' }}" my_ref="{{ $question->id ?? '' }}" onclick="go_next_step(this, '{{ $question_type ?? '' }}')" 
                                            data-condition="{{ $question->conditions && count($question->conditions) > 0 ? json_encode($question->conditions) : NULL  }}">
                                            Next
                                        </button>

                                        <button type="button" class="last_step_btn nxt" style="display:none;" onclick="go_to_checkout_page()">
                                            Generar
                                        </button>
                                    </div>
                                </div>
                                @php $count++; @endphp
                            @endforeach
                        </form>
                    </div>
                <!-- </div> -->
                <!-- This is the box where we show the steps or the form -->
                <div class="right-box right-question-box form-div card col-md-8">
                    @foreach($documentContents as $content)
                        @if($content->secure_blur_content == 1)
                            <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="r_div right-sec-div secure_content mb-2" conditional_section="{{ $content->is_condition ? 'true' : NULL }}"
                            data-conditions="{{ $content->conditions && count($content->conditions) > 0 ? json_encode($content->conditions) : NULL  }}">
                                @if($content->type == 'content_heading')
                                <p style="text-align:center; font-size:18px; font-weight:400;">{!! $content->content !!}</p>
                                @else
                                {!! $content->content !!}
                                @endif
                            </div>
                        @elseif($content->is_condition == 0)
                            <span style="text-align:{{ $content->text_align ?? '' }}" class="r_div">
                                @if($content->type == 'content_heading')
                                <p style="text-align:center; font-size:18px; font-weight:400;">{!! $content->content !!}</p>
                                @else
                                {!! $content->content !!}
                                @endif
                            </span>
                        @else
                            <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="r_div right-sec-div mb-2" conditional_section="{{ $content->is_condition ? 'true' : NULL }}"
                            data-conditions="{{ $content->conditions && count($content->conditions) > 0 ? json_encode($content->conditions) : NULL  }}">
                                @if($content->type == 'content_heading')
                                <p style="text-align:center; font-size:18px; font-weight:400;">{!! $content->content !!}</p>
                                @else
                                {!! $content->content !!}
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="container">This Document is empty</div> 
    @endif
</section>

 
<script>
    let total_steps = $('#total_step').val(); 
    let total_attempted = $('#all_attempted').val(); 
    let lastprogress = 0;

    // $(".question-div").hide();
    // $(".step1").show(); 
    
    $(document).ready(function(){
        $(".step1").addClass('active');

        $('form#contractForm select').each(function(){
            var id = $(this).attr('id');
            if(id != null && id != '' && id != undefined){
                var targetvalue = $('#'+id).val();
                if(targetvalue == '' || targetvalue == null || targetvalue == undefined){
                    var defaultvalue = $('#'+id).data('placeholdertext');
                    if(defaultvalue == '' || defaultvalue == null || defaultvalue == undefined){
                        targetvalue = '_________';
                    }else{
                        targetvalue = defaultvalue;
                    }
                }
                $(".qidtarget-"+id).html(targetvalue);
                $(".qidtarget-"+id).each(function(){
                    $(this).html(targetvalue);
                });
            }
        });

        $('.guardar_btn').click(function(){
            let is_login = $('#is_login').val();
            let baseUrl = "{{ url('/') }}";
            let current_page = encodeURIComponent(window.location.href);
            let login_url = baseUrl + "/login?redirect=" + current_page;
            location.href = login_url;
        })

        showLastAttemptedValues();
        rightSecConditions();
        alphabetList();       
    })

    document.addEventListener('DOMContentLoaded', function () {
        let localStorageData = JSON.parse(localStorage.getItem('Localstorage')) || { attempted_question: [] };
        let attemptedQuestions = localStorageData.attempted_question;
        // let finalQuestions = attemptedQuestions.slice(0, attemptedQuestions.length - 1);
        let is_login = $('#is_login').val();

        if(attemptedQuestions.length > 0){
            if(is_login == true){
                console.log(is_login);
                storeAttemptedQuestions(attemptedQuestions);
            }else{
                console.log('huiiuuitu');
            }
        }
    });

    function storeAttemptedQuestions(questions){
        const user_id = $('#user_id').val();
        const data = {
            user_id: user_id,
            attempted_questions: questions,
            _token: "{{ csrf_token() }}"
        }

        $.ajax({
            url: "{{ url('/save/steps') }}",
            type: "post",
            data: data,
            dataType: "json",
            success: function(response){
                console.log(response);
            }
        })
    }

    function alphabetList(){
        let alphabet = {1:"a", 2:"b", 3:"c",4:"d",5:"e",6:"f",7:"g",8:"h",9:"i",10:"j",11:"k",12:"l",13:"m",14:"n",15:"o",16:"p",17:"q",18:"r",19:"s",20:"t",21:"u",22:"v",23:"w",24:"x",25:"y",26:"z"};

        if($('.abclist').length){
            for(var li = 1;li <= 10; li++){
                if($('.abclist'+li).length){
                    var num = 1;
                    $('.abclist'+li).each(function(){
                        if($(this).closest('.right-sec-div').length > 0 && !$(this).closest('.right-sec-div').hasClass('d-none')){
                            $(this).html(alphabet[num]);
                            num++ ;
                        }else if($(this).closest('.right-sec-div').length > 0 && $(this).closest('.right-sec-div').hasClass('d-none')){

                        }else if(!$(this).closest('div').hasClass('d-none')){
                            $(this).html(alphabet[num]);
                            num++ ;
                        }else{
                            $(this).html(alphabet[num]);
                            num++ ;
                        }

                        if(num == 26){
                            num = 1;
                        }
                    });	
                }
            }
        }
    }

    let isScrolling = false;
    function rightSecConditions(){
        $('.right-sec-div').each(function(){
            if($(this).data('conditions') != null && $(this).data('conditions') != '' && $(this).data('conditions') != undefined){
                var conditions = $(this).data('conditions');
                var is_elem_show = true;

                $.each(conditions, function(key,val){
                    var queId = val.conditional_question_id;
                    var queValue = val.conditional_question_value;
                    var conditionalCheck = val.conditional_check;

                    if($('#'+queId).length){
                        if(conditionalCheck == '1'){
                            if($('#'+queId).val() == queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }else if(conditionalCheck == '2'){
                            if($('#'+queId).val() > queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }else if(conditionalCheck == '3'){
                            if($('#'+queId).val() < queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }else if(conditionalCheck == '4'){
                            if($('#'+queId).val() != queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }
                    }else if($('input[type="radio"][name="question_'+queId+'"]').length){
                        if(conditionalCheck == '1'){
                            if($('input[type="radio"][name="question_'+queId+'"]:checked').val() == queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;	
                            }
                        }else if(conditionalCheck == '2'){
                            if($('input[type="radio"][name="question_'+queId+'"]:checked').val() > queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;	
                            }
                        }else if(conditionalCheck == '3'){
                            if($('input[type="radio"][name="question_'+queId+'"]:checked').val() < queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;	
                            }
                        }else if(conditionalCheck == '4'){
                            if($('input[type="radio"][name="question_'+queId+'"]:checked').val() != queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;	
                            } 
                        }
                    }			
                });

                if(is_elem_show == true){ 
                    $(this).removeClass('d-none');
                    $(this).addClass('active_sec');
                    if(!isScrolling){
                        // $(this).find("span:first.answered_spns").addClass('active');
                        smoothScrollToTarget(this, '.right-question-box');
                    }
                }else{
                    $(this).addClass('d-none');
                    $(this).removeClass('active_sec');
                }
            }
        })
    }

    // Function to update the progress bar based on total attempted steps
    function updateProgressBar() {
        var percent = (total_attempted / total_steps) * 100;
        console.log(percent);
        var value = parseInt(percent);
        $('#percent_count').val(value);
        $('.progressCount').text(value + "%");
        $('.progress-bar').css("width", value + "%");
    }

    function progressBarCount(id, next_id, is_last = false){
        
        var current_step = $('.step-' + id);
        var total_hidden_steps = 0;
        var back_step = 0;

        if(id > next_id){
            for(let i = parseInt(id) - 1; i >= parseInt(next_id); i--){ 
                back_step++;
            }
            total_attempted -= back_step;
        }else{
            for(let i = parseInt(id) + 1; i < parseInt(next_id); i++){
                if($('.step-' + i).hasClass('hide')){
                    total_hidden_steps++;
                }
            }

            total_attempted = parseInt(total_attempted);
            total_attempted += total_hidden_steps;

            if($(current_step).hasClass('done')){
                total_attempted++;
            }
        } 
        console.log("Total attempted steps:", total_attempted);

        if(is_last){
            $('#percent_count').val(100);
            $('.progressCount').text("100%");
            $('.progress-bar').css("width", "100%");
        }else{
            updateProgressBar();
        } 

        $('#all_attempted').val(total_attempted);
    }

    // Function to handle progress bar updates as the user moves through the steps

    // function progressBarCount(id, next_id, is_last = false){
    //     var current_step = $('.step-' + id);
    //     var total_hidden_steps = 0;
    //     for(let i = parseInt(id) + 1; i < parseInt(next_id); i++){
    //         if($('.step-' + i).hasClass('hide')){
    //             total_hidden_steps++;
    //         }
    //     }

    //     total_attempted = parseInt(total_attempted);
    //     total_attempted += total_hidden_steps;

    //     if($(current_step).hasClass('done')){
    //         total_attempted++;
    //     }
    //     console.log("Total attempted steps:", total_attempted);

    //     if(is_last){
    //         $('#percent_count').val(100);
    //         $('.progressCount').text("100%");
    //         $('.progress-bar').css("width", "100%");
    //     }else{
    //         updateProgressBar();
    //     }
       
    //     $('#all_attempted').val(total_attempted);
    // }

    function reverseProgressCount(id, next_id) {
        var current_step = $('.step-' + id);
        var total_hidden_steps = 0;

        for(let i = parseInt(id)-1; i >= next_id; i--){
            if($('.step-' + i).hasClass('hide')){
                total_hidden_steps++;
            }
        }

        total_attempted -= total_hidden_steps;
        total_attempted--;

        console.log("Total reverse steps:", total_attempted);

        if(total_attempted >= 0){
            updateProgressBar();
            $('#all_attempted').val(total_attempted);
        }
    }

    function questionConditions(my_ref, next_step_id){
        $('.nxt').each(function(){
            var next_id = $(this).attr("que_id");
            var conditions = $(this).attr("data-condition");
            var conditional_step = $(this).attr("data-condition_step");
            var next_step = $(this).attr("data-next_step");

            if(conditions != null && conditions != '' && conditions != undefined){
                conditions = JSON.parse(conditions);
                var is_matched = true; 
                var is_show = true;

                $.each(conditions, function(key, val){
                    var condition_type = val.condition_type;
                    var queId = val.conditional_question_id;
                    var queValue = val.conditional_question_value;
                    var conditionalCheck = val.conditional_check;
                    var queLabel = val.question_label;

                    if(condition_type == 'go_to_step_condition'){
                        if(conditionalCheck == 1){
                            if($('#' + queId).val() == queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }else if(conditionalCheck == 2){
                            if($('#' + queId).val() > queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }else if(conditionalCheck == 3){
                            if($('#' + queId).val() < queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }else if(conditionalCheck == 4){
                            if($('#' + queId).val() != queValue && is_matched == true) {
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }
                    }else if(condition_type == 'question_label_condition'){
                        if(conditionalCheck == 1){
                            if($('#' + queId).val() == queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }else if(conditionalCheck == 2){
                            if($('#' + queId).val() > queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }else if(conditionalCheck == 3){
                            if($('#' + queId).val() < queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }else if(conditionalCheck == 4){
                            if($('#' + queId).val() != queValue && is_matched == true){
                                is_matched = true;
                            }else{
                                is_matched = false;
                            }
                        }
                    }
                });

                if(is_matched == true){
                    $(this).attr("que_id", conditional_step); 
                }else if(is_matched == false){
                    $(this).attr("que_id", next_step); 
                }
            }
        });
    }

    function go_next_step(e,questionType){
        var next_step_id = $(e).attr("que_id");  
        var my_ref = $(e).attr("my_ref");       
        var is_last = !next_step_id || next_step_id === '';
        var target = `.qidtarget-${next_step_id}`;
        
        if(is_last){
            $('.last_step_btn').show();
            $('.nxt_btn_'+my_ref).hide();

            progressBarCount(my_ref, null, true);
            next_step_id = 'last_step';
            $('.step-'+my_ref).attr('is_last','true');

            updateUrl(next_step_id);
            // saveSteps(my_ref, questionType);
            
        }else{
            for(let i = parseInt(my_ref) + 1; i < next_step_id; i++){
                if(!$('.step-' + i).hasClass('active')){
                    $('.step-' + i).addClass('hide');
                }
            }
            var pre_btn = `.pre_btn_${next_step_id}`;
            $(pre_btn).attr("que_id", my_ref);

            if(my_ref != null && my_ref != '' && my_ref != undefined){
                var current_step = `.step-${my_ref}`;
                // console.log($(current_step).attr('attempted'));
                if($(current_step).hasClass('active')){
                    $(current_step).removeClass('active');
                    $(current_step).addClass('done');
                }
            }
           
            var next_step_div = `.step-${next_step_id}`;

            if($(next_step_div).hasClass('hide')){
                $(next_step_div).addClass('active');
                $(next_step_div).removeClass('hide');
            }else{
                $(next_step_div).addClass('active');
            }

            $(target).css({
                "color": "white",
                "background-color": "#002655",
                "padding": "5px",
                "border-radius": "3px"
            });
            
            // saveSteps(my_ref, questionType);
            progressBarCount(my_ref, next_step_id);
            updateUrl(next_step_id);
        }

        setLocalstorage(my_ref, next_step_id, questionType);        
    }

    function go_pre_step(e){
        var current_step_id = $(e).attr('my_ref');
        var current_step = `.step-${current_step_id}`;
        

        if($(current_step).hasClass('active')){
            $(current_step).removeClass('active');
        }
        var prev_step_id = $(e).attr("que_id");
        var prev_step_div = `.step-${prev_step_id}`;
        var target = `.qidtarget-${current_step_id}`;

        $(target).css({
            "color": "#002655",
            "background-color": "#fff",
            "padding": "0px",
            "border-radius": "0px"
        });
            

        if($(prev_step_div).hasClass('done') || $(prev_step_div).hasClass('hide')){
            $(prev_step_div).removeClass('done hide').addClass('active');
        }else{
            $(prev_step_div).addClass('active');
        }

        var last_step_btn = $(current_step).find('.last_step_btn');
        if(last_step_btn.length){
            $('.last_step_btn').hide();
            $('.nxt_btn_'+current_step_id).show();
        }

        let key = 'Localstorage';
        reverseProgressCount(current_step_id, prev_step_id);
        popLocalstorageValue(current_step_id, key);

        updateUrl(prev_step_id);
    }

    function updateNextButton(selectElement, id){
        // var shouldStepChange = $(`.step-${id}`).attr('onchange');
        // console.log(shouldStepChange);
        // if(shouldStepChange != undefined && shouldStepChange == "false"){
        //     return;
        // }
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const myNextBtn = selectedOption.getAttribute("my_ref_nxt");
        const queId = selectedOption.getAttribute("que_id");
        const selectedValue = selectedOption.value;
        // console.log( selectedValue, " the selected value ")
        // console.log(" This is the ID : ", `.step-${id}`)
        $(`.step-${id}`).attr('attempted', selectedValue); 
        const targetEle = $(selectElement).attr('target-id');
        $(targetEle).text(selectedValue);
        $(myNextBtn).attr("que_id", queId);     
    }

    function updateNextButtonR(radioElement){
        const myNextBtn = radioElement.getAttribute("my_ref_nxt");
        const queId = radioElement.getAttribute("que_id");
        const selectedValue = radioElement.value;
        const targetEle = $(radioElement).attr('target-id');
        $(targetEle).text(selectedValue)
        $(myNextBtn).attr("que_id", queId);
    }

    function updateDropdownLInk(selectLink, id){
        // var shouldStepChange = $(`.step-${id}`).attr('onchange');
        // if(shouldStepChange != undefined && shouldStepChange == "false"){
        //     return;
        // }
        const selectedOption = selectLink.options[selectLink.selectedIndex];
        const myNextBtn = selectedOption.getAttribute("my_ref_nxt");
        const queId = selectedOption.getAttribute("que_id");
        const selectedValue = selectedOption.value;
        // console.log( selectedValue, " the selected value ")
        // console.log(" This is the ID : ", `.step-${id}`)
        $(`.step-${id}`).attr('attempted', selectedValue); 
        const targetEle = $(selectLink).attr('target-id');
        $(targetEle).text(selectedValue)
        $(myNextBtn).attr("que_id", queId);
    }

    // function saveSteps(que_id,qtype){
    //     var document_id = $('#document_id').val();
    //     var user_id = $('#user_id').val();
    //     var attemptedAnswer = $('.step-' + que_id).attr('attempted');
    //     var question_type = qtype;
    //     var question_id = que_id;

    //     var data = {
    //         document_id: document_id,
    //         user_id: user_id,
    //         question_id: question_id,
    //         question_type: question_type,
    //         answer: attemptedAnswer,
    //         _token: "{{ csrf_token() }}"
    //     }

    //     $.ajax({
    //         url: "{{ url('/save/steps') }}",
    //         type: "post",
    //         data: data,
    //         dataType: "json",
    //         success: function(response){
    //             console.log(response);
    //         }
    //     })
    // }

    function storeAnswers(e, question_id = undefined, qtype = undefined, next_id = undefined) {
        let localStorageData = JSON.parse(localStorage.getItem('Localstorage')) || { attempted_question: [] };
        let questionIndex = localStorageData.attempted_question.findIndex(item => item.question_id === question_id);
        let attempted_value = $(e).val();

        if(questionIndex !== -1){
            localStorageData.attempted_question[questionIndex].attempted_answer = attempted_value;
        }

        localStorage.setItem('Localstorage', JSON.stringify(localStorageData));

        let right_part_target = `.qidtarget-${question_id}`;

        if(qtype === "textbox" || qtype === "textarea" || qtype === "pricebox" || qtype === "percentage-box" ||
            qtype === "dropdown" || qtype === "radio-button" || qtype === "dropdown-link" || qtype === "number-field"){
            
            $(`.step-${question_id}`).attr('attempted', attempted_value); 
            $(right_part_target).text(attempted_value).css({
                "color": "white",
                "background-color": "#002655",
                "padding": "5px",
                "border-radius": "3px"
            });

        }else if(qtype === "date-field"){
            let date = new Date(attempted_value);
            let options = { day: "2-digit", month: "long", year: "numeric" };
            let formattedDate = new Intl.DateTimeFormat("en-US", options).format(date);

            $(`.step-${question_id}`).attr('attempted', formattedDate); 
            $(right_part_target).text(formattedDate).css({
                "color": "white",
                "background-color": "#002655",
                "padding": "5px",
                "border-radius": "3px"
            });

            if(questionIndex !== -1) {
                localStorageData.attempted_question[questionIndex].attempted_answer = formattedDate;
                localStorage.setItem('Localstorage', JSON.stringify(localStorageData));
            }
        }
        smoothScrollToTarget(right_part_target, '.right-question-box');
        rightSecConditions();
        alphabetList();
        questionConditions(question_id, next_id);
    }

    // Store the value in Localstorage //
    function setLocalstorage(que_id,next_id,qtype){
        var document_id = $('#document_id').val();
        var user_id = $('#user_id').val();
        var attemptedAnswer = $('.step-' + que_id).attr('attempted');
        var prevId = $('.pre_btn_' + que_id).attr('que_id');
        var pre_btn_id = $('.pre_btn_'+next_id).attr('que_id');
        var next_btn_id = $('.nxt_btn_'+next_id).attr('que_id');
        var nextQuestionType = $('.step-' + next_id).attr('data-type');
        var nextAttemptedAnswer = '';
       
        var now = new Date();
        // var formattedTime = now.toLocaleTimeString();
        var formattedTime = now.getTime();
        var expiryTime = now.getTime() + 2 * 60 * 1000;
        var progressValue = $('#percent_count').val();
        var totalSteps = $('#total_step').val();
        var attemptedSteps = $('#all_attempted').val();
        var is_last = $('.step-' + que_id).attr('is_last');

        // if(nextQuestionType == 'dropdown' || nextQuestionType == 'dropdown-link'){
        //     nextAttemptedAnswer = $('#' +next_id).find(":selected").val();
        // }else if(nextQuestionType == 'radio-button'){
        //     nextAttemptedAnswer = $('input[name="question_' + next_id + '"]:checked').val();
        // }
        
        var firstObj = {
            document_id: document_id,
            user_id: user_id,
            question_id: que_id,
            type: qtype,
            attempted_answer: attemptedAnswer,
            previous_id: prevId,
            next_id: next_id,
            progress: 0,
            total_steps: totalSteps,
            attempted_step: 0,
        }

        var newObj = {
            document_id: document_id,
            user_id: user_id,
            // question_id: que_id,
            question_id: next_id,
            type: nextQuestionType,
            attempted_answer: nextAttemptedAnswer,
            // attempted_time: formattedTime,
            // previous_id: prevId,
            previous_id: pre_btn_id,
            // next_id: next_id,
            next_id: next_btn_id,
            progress: progressValue,
            total_steps: totalSteps,
            attempted_step: attemptedSteps,
        };

        let localStorageData = JSON.parse(localStorage.getItem('Localstorage')) || { attempted_question: [] };
        let attemptedQuestions = localStorageData.attempted_question;

        if(!Array.isArray(attemptedQuestions)) {
            attemptedQuestions = [];
        }

        if(is_last == "true"){
            console.log('yuretyrturiturt');
        }else{
            if(attemptedQuestions.length === 0 || attemptedQuestions.length === undefined){
                attemptedQuestions.push(firstObj);
                console.log("Stored first step:", firstObj);
            }else{
                attemptedQuestions.push(newObj);
                console.log("Stored next step:", newObj);
            }
        
            let objIndex = attemptedQuestions.findIndex(obj => obj.question_id === newObj.question_id);
    
            if(objIndex !== -1){
                attemptedQuestions[objIndex].attempted_answer = newObj.attempted_answer === '' || newObj.attempted_answer === null ? null : newObj.attempted_answer;
                // console.log('Updated existing object');
            }else{
                newObj.attempted_answer = newObj.attempted_answer === '' || newObj.attempted_answer === null ? null : newObj.attempted_answer;
                attemptedQuestions.push(newObj);
                // console.log('Added new object');
            }
        }
    
        localStorageData.attempted_question = attemptedQuestions;
        localStorage.setItem('Localstorage', JSON.stringify(localStorageData));
    }

    // delete the value from localstorage
    function popLocalstorageValue(que_id, key){
        // console.log(que_id);
        let localStorageData = JSON.parse(localStorage.getItem(key));
        if(!localStorageData || !localStorageData.attempted_question){
            return null;
        }

        let attemptedQuestions = localStorageData.attempted_question;
        let questionIndex = attemptedQuestions.findIndex(data => data.question_id === que_id);

        if(questionIndex !== -1){
            let poppedQuestion = attemptedQuestions.splice(questionIndex, 1)[0];
            localStorageData.attempted_question = attemptedQuestions;
            localStorage.setItem(key, JSON.stringify(localStorageData));
            // console.log("Popped Question:", poppedQuestion);
            return poppedQuestion;
        }else{
            // console.log("Question ID not found in attempted questions.");
            return null;
        }
    }

    //get the value of localstorage
    function getLocalstorage(key){
        let localStorageData = JSON.parse(localStorage.getItem(key));
        if(!localStorageData || !localStorageData.attempted_question){
            return null;
        }

        let attemptedQuestions = localStorageData.attempted_question;
        // attemptedQuestions = attemptedQuestions.filter(data => new Date().getTime() < data.Expiry);

        return attemptedQuestions.length > 0 ? attemptedQuestions : null;
    }

    // function showLastAttemptedValues() {
    //     let attemptedQuestions = getLocalstorage('Localstorage');

    //     if(!attemptedQuestions){
    //         console.log("No valid data found");
    //         return;
    //     }

    //     // let lastAttempted = attemptedQuestions.reduce((latest, current) => {
    //     //     return new Date(latest.attempted_time) > new Date(current.attempted_time) ? latest : current;
    //     // });
    //     let lastAttempted = attemptedQuestions[attemptedQuestions.length - 1];

    //     if(lastAttempted){
    //         let step_id = lastAttempted.question_id;
    //         let next_id = lastAttempted.next_id;
    //         let prev_id = lastAttempted.previous_id;
    //         let value = lastAttempted.attempted_answer;
    //         let last_attempted_value = lastAttempted.next_attempted;
    //         let document_id = lastAttempted.document_id;
    //         let current_document_id = $("#document_id").val();

    //         if(document_id == current_document_id){
    //             let pre_btn = `.pre_btn_${step_id}`;
    //             $(pre_btn).attr("que_id", prev_id);

    //             if(next_id == 'last_step'){
    //                 $('.nxt_btn_'+step_id).hide();
    //                 $('.last_step_btn').show();
    //             }

    //             // if(step_id == 'last_step'){
    //             //     $(`.step-45`).addClass('active').removeClass('hide');
    //             //     updateUrl(45);
    //             // }

    //             // if(step_id == 'last_step'){
    //             //     console.log('iutrit');
    //             //     $(".step-" + prev_id).addClass('active');
    //             //     updateUrl(prev_id);
    //             // }

    //             let current_step = $(".step-" + step_id);
    //             let first_step = $(".step-1");
    //             $(current_step).removeClass('hide');
    //             $(current_step).addClass('active');
                
    //             $('#'+step_id).val(); 
    //             $(current_step).attr('attempted',value);

    //             if(step_id === "1"){
    //                 first_step.addClass('active');
    //                 first_step.removeClass('hide');
    //             }else{
    //                 first_step.removeClass('active').addClass('hide');
    //             }

    //             lastProgress = lastAttempted.progress || 0; 
    //             total_steps = lastAttempted.total_steps || 1; 
    //             total_attempted = lastAttempted.attempted_step || 0;

    //             $('#total_step').val(total_steps);
    //             $('#all_attempted').val(total_attempted);
    //             $('#percent_count').val(lastProgress);
    //             $('.progressCount').text(lastProgress + "%");
    //             $('.progress-bar').css("width", lastProgress + "%");

    //             updateUrl(step_id);
    //         }    
    //     }else{
    //         if($(".step1").hasClass('hide')){
    //             $(".step1").addClass('active');
    //             $(".step1").removeClass('hide');
    //         }
    //     }
        
    //     let num = 1;
    //     attemptedQuestions.forEach(data => {
    //         let ques_id = data.question_id;
    //         let prev_id = data.previous_id;
    //         let next_id = data.next_id;
    //         let type = data.type;
    //         let progress = data.progress;

    //         let prev_btn = $('.pre_btn_'+ques_id);
    //         let next_btn = $('.nxt_btn_'+ques_id);

    //         $(prev_btn).attr('que_id',prev_id);
    //         $(next_btn).attr('que_id',next_id);

    //         let prevDiv = $('.step-' + prev_id);
    //         let nextDiv = $('.step-' + next_id);
    //         let quesDiv = $('.step-' + ques_id);

    //         if(!quesDiv.hasClass('active')) {
    //             quesDiv.addClass('done');
    //         }

    //         let value = data.attempted_answer;
    //         // console.log(value);
    //         if(quesDiv.length){
    //             quesDiv.attr('attempted', value);

    //             if(type == 'textbox' || type == 'textarea' || type == 'pricebox' || type == 'number-field' || type == 'percentage-box' || type == 'dropdown-link' || type == 'dropdown'){
    //                 if(value){
    //                     $('#'+ques_id).val(value);
    //                     $('.qidtarget-'+ques_id).text(value);
    //                 }
    //             }else if(type == 'radio-button'){
    //                 // let id = ques_id+num;  
    //                 if(value){
    //                     $('input[name="question_'+ques_id+'"]').each(function () {
    //                         if($(this).val() == value){
    //                             $(this).prop('checked', true);
    //                         }
    //                     });
    //                     num++ ;
    //                 }
    //             }else if(type == 'date-field'){
    //                 if(value){
    //                     const originalDate = value;
    //                     if(originalDate){
    //                         const date = new Date(originalDate);
    //                         date.setDate(date.getDate() - 8);
    //                         const formattedDate = date.toISOString().split('T')[0];
    //                         $('#'+ques_id).val(formattedDate);
    //                         $('.qidtarget-'+ques_id).text(value);
    //                     }
    //                 }
    //             }
    //         }
    //     });
    // }

    // handle the attempted questions and there values 
    function showLastAttemptedValues(){
        let attemptedQuestions = getLocalstorage('Localstorage');

        if(!attemptedQuestions){
            console.log("No valid data found");
            return;
        }

        let lastAttempted = attemptedQuestions[attemptedQuestions.length - 1];

        if(lastAttempted){
            let step_id = lastAttempted.question_id;
            let next_id = lastAttempted.next_id;
            let prev_id = lastAttempted.previous_id;
            let value = lastAttempted.attempted_answer;
            let document_id = lastAttempted.document_id;
            let current_document_id = $("#document_id").val();

            if(document_id == current_document_id){
                let pre_btn = `.pre_btn_${step_id}`;
                $(pre_btn).attr("que_id", prev_id);

                if(next_id == 'last_step'){
                    $('.nxt_btn_' + step_id).hide();
                    $('.last_step_btn').show();
                }

                let current_step = $(".step-" + step_id);
                let first_step = $(".step1");
                // $(current_step).removeClass('hide');
                // $(current_step).addClass('active');
                
                $(".question-div").addClass('hide').removeClass('active done');

                if(step_id === "1"){
                    console.log('if 1');
                    first_step.addClass('active').removeClass('hide');
                }else{
                    console.log('if another');
                    first_step.removeClass('active').addClass('hide');
                    current_step.addClass('active').removeClass('hide done');
                }

                console.log('Current Step for last saved is', current_step);
                $('#' + step_id).val();
                $(current_step).attr('attempted', value);

                lastProgress = lastAttempted.progress || 0;
                total_steps = lastAttempted.total_steps || 1;
                total_attempted = lastAttempted.attempted_step || 0;

                $('#total_step').val(total_steps);
                $('#all_attempted').val(total_attempted);
                $('#percent_count').val(lastProgress);
                $('.progressCount').text(lastProgress + "%");
                $('.progress-bar').css("width", lastProgress + "%");

                updateUrl(step_id);

                // Hide steps marked as hidden in progressBarCount logic
                attemptedQuestions.forEach(data => {
                    let ques_id = data.question_id;
                    let quesDiv = $('.step-' + ques_id);

                    if(quesDiv.length){
                        if(ques_id == step_id){
                            quesDiv.removeClass('hide').addClass('active');
                        }else{
                            quesDiv.addClass('hide').removeClass('active done');
                        }
                    }
                });
            }
        }else{
            if($(".step1").hasClass('hide')){
                $(".step1").addClass('active').removeClass('hide');
            }
        }

        attemptedQuestions.forEach(data => {
            let ques_id = data.question_id;
            let prev_id = data.previous_id;
            let next_id = data.next_id;
            let type = data.type;
            let value = data.attempted_answer;

            let prev_btn = $('.pre_btn_' + ques_id);
            let next_btn = $('.nxt_btn_' + ques_id);

            $(prev_btn).attr('que_id', prev_id);
            $(next_btn).attr('que_id', next_id);

            let quesDiv = $('.step-' + ques_id);

            if(!quesDiv.hasClass('active')){
                quesDiv.addClass('done');
            }
            
            if(quesDiv.length){
                quesDiv.attr('attempted', value);

                if(type === 'textbox' || type === 'textarea' || type === 'pricebox' || type === 'number-field' || type === 'percentage-box' || type === 'dropdown-link' || type === 'dropdown') {
                    if(value){
                        $('#' + ques_id).val(value);
                        $('.qidtarget-' + ques_id).text(value);
                    }
                }else if(type === 'radio-button'){
                    if(value){
                        $('input[name="question_' + ques_id + '"]').each(function () {
                            if($(this).val() == value){
                                $(this).prop('checked', true);
                            }
                        });
                    }
                }else if(type === 'date-field'){
                    if(value){
                        const originalDate = value;
                        if(originalDate){
                            const date = new Date(originalDate);
                            date.setDate(date.getDate() - 8);
                            const formattedDate = date.toISOString().split('T')[0];
                            $('#' + ques_id).val(formattedDate);
                            $('.qidtarget-' + ques_id).text(value);
                        }
                    }
                }
            }
        });
    }


    // function smoothScrollToTarget(targetElement, container, offset = 0) {
    //     var $container = $(container);
    //     var $target = $(targetElement);

    //     if(!$container.length || !$target.length){
    //         return;
    //     }

    //     var containerHeight = $container.height();
    //     var containerScrollHeight = $container[0].scrollHeight;
    //     var containerScrollTop = $container.scrollTop();
    //     var targetOffsetTop = $target.position().top + containerScrollTop - offset;

    //     if(targetOffsetTop < 0) targetOffsetTop = 0;
    //     if(targetOffsetTop > containerScrollHeight - containerHeight){
    //         targetOffsetTop = containerScrollHeight - containerHeight;
    //     }

    //     $container.animate({ scrollTop: targetOffsetTop }, 800, 'swing');
    // }

    function smoothScrollToTarget(targetElement, container, offset = 0) {
        var $container = $(container);
        var $target = $(targetElement);

        if(!$container.length || !$target.length){
            return;
        }

        var containerHeight = $container.height(); 
        var containerScrollHeight = $container[0].scrollHeight;
        var containerScrollTop = $container.scrollTop(); 
        var targetOffsetTop = $target.offset().top - $container.offset().top + containerScrollTop;
        var targetScrollPosition = targetOffsetTop - offset;

        if(targetScrollPosition < 0) targetScrollPosition = 0; 
        if(targetScrollPosition > containerScrollHeight - containerHeight){
            targetScrollPosition = containerScrollHeight - containerHeight; 
        }

        var startScroll = containerScrollTop;
        var distance = targetScrollPosition - startScroll;
        var duration = 800;
        let startTime = null;

        isScrolling = true; // Set scrolling flag

        function smoothStep(timestamp){
            if(!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const currentScrollPosition = easeInOutQuad(progress, startScroll, distance, duration);

            $container.scrollTop(currentScrollPosition);

            if(progress < duration){
                window.requestAnimationFrame(smoothStep);
            }else{
                isScrolling = false; // Reset scrolling flag
            }
        }

        window.requestAnimationFrame(smoothStep);

        function easeInOutQuad(time, start, distance, duration){
            time /= duration / 2;
            if (time < 1) return (distance / 2) * time * time + start;
            time--;
            return (-distance / 2) * (time * (time - 2) - 1) + start;
        }
    }


    // function smoothScrollToTarget(targetElement, container, offset = 0){
    //     var $container = $(container);
    //     var $target = $(targetElement);

    //     if(!$container.length || !$target.length){
    //         return;
    //     }

    //     var targetOffset = $target.offset().top - $container.offset().top + $container.scrollTop() - offset;
    //     var currentScroll = $container.scrollTop();
    //     var distance = targetOffset - currentScroll;
    //     var duration = 800; 
    //     var start = null;

    //     function smoothStep(timestamp) {
    //         if(!start)start = timestamp;
    //         var progress = timestamp - start;
    //         var scrollPosition = easeInQuad(progress, currentScroll, distance, duration);
    //         $container.scrollTop(scrollPosition);

    //         if(progress < duration){
    //             console.log('frgfdgfdg');
    //             window.requestAnimationFrame(smoothStep);
    //         }
    //     }

    //     window.requestAnimationFrame(smoothStep);
    //     function easeInQuad(time, start, distance, duration){
    //         time /= duration;
    //         return distance * time * time + start;
    //     }
    // }

    // update the current url for every step //
    function updateUrl(step) {
        const url = new URL(window.location.href);
        // url.searchParams.set('step', step);
        url.searchParams.set('step', step);

        if(typeof(history.pushState) !== "undefined"){
            const obj = {Title: 'title', Url: url.toString()};
            history.pushState(obj, obj.Title, obj.Url);
        }else{
            alert("Browser does not support HTML5.");
        }
    }

    function go_to_checkout_page(){
        location.href = "{{ url('/checkout') }}";
    }
</script>

@endsection
