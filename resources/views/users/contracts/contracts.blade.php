@extends('users_layout.master') @section('content')

<style>
    .question-div{
        display: none;
    }

    .active{
        display: block;
    }

    .hide{
        display: none;
    }
</style>

<section class="privacy-sec questions_page_main_div">
    <div class="container">
        <div class="contract-header">
            <div class="row align-items-center">
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
                            <input type="hidden" id="percent_count" value="">	
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
    <div id="main-question-form-controller" class="row outer_main">
        <!-- <div class="col-md-4"> -->
            <!-- here we show all the steps of the questions, this is the section where we show all the questions  -->
            <div class="left-box left-question-box col-md-4">
                <div class="left_heding">
                    <h3 class="contarct_top_left_heading">Introduce los datos aquí:</h3>
                </div>
                <form id="contractForm">
                    <input type="hidden" id="document_id" name="document_id" value="{{ $id ?? '' }}">
                    <input type="hidden" id="total_step" value="{{ $total_questions ?? ''}}">
                    <input type="hidden" id="all_attempted" value="0">
                    <input type="hidden" id="reverse_attempt" value="0">
                    @php 
                        $count = 1;
                        $num = 1;
                        $total_steps = count($questions);
                    @endphp
                    @foreach($questions as $index => $question)
                        <div class="question-div step{{ $count ?? '' }} step-{{ $question->id }} mb-4 p-4" que_id="{{ $question->id ?? '' }}" is_condition="{{ $question->is_condition }}" swtchtyp="{{ $question->condition_type }}" data-count="{{ $count ?? '' }}">
                            <div class="save_document_button">
                                <span><img src="{{ asset('assets/img/download_icon.svg') }}"> Guardar</span>
                            </div>
                            <label class="que_heading lbl-{{ $question->id }}">
                                @if($question->is_condition == 1)
                                {{ $question->conditions[0]->question_label ?? $question->questionData->question_label }}
                                @else
                                {{ $question->questionData->question_label ?? '' }}
                                @endif
                            </label>
                            <br>
                            @php 
                                $question_type = $question->type;
                                $next_qid = NULL;
                            @endphp 
                            
                            @if($question_type == "textbox")
                                @php 
                                    $next_qid = $question->questionData->next_question_id ?? '';
                                @endphp 
                                <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                    onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}', '{{ $next_qid ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>

                            @elseif($question_type == "textarea")
                                @php 
                                    $next_qid = $question->questionData->next_question_id ?? '';
                                @endphp 
                                <textarea class="contract_textarea" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                    onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}', '{{ $next_qid ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"></textarea>
                            
                            @elseif($question_type == "dropdown")
                                @php 
                                    $next_qid = $question->options->first()->next_question_id ?? '';
                                @endphp 
                                <select onchange="updateNextButton(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}') " target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}">
                                    @foreach($question->options as $option)
                                        <option my_ref_nxt=".nxt_btn_{{ $question->id ?? '' }}" que_id="{{ $option->next_question_id ?? '' }}"
                                        value="{{ $option->option_value ?? '' }}" {{ $loop->first ? 'selected' : '' }}> {{ $option->option_label }} </option>
                                    @endforeach
                                </select>
                            @elseif($question_type == "radio-button")
                                @php 
                                    $next_qid = $question->options->first()->next_question_id ?? '';
                                @endphp 
                                @foreach($question->options as $option)
                                <div class="radio_div">
                                    <input type="radio" name="question_{{ $question->id ?? '' }}" target-id="qidtarget-{{ $question->id ?? '' }}" id="radio_{{ $question->id ?? '' }}{{ $num++ ?? '' }}"
                                            onchange="updateNextButtonR(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}')" my_ref_nxt=".nxt_btn_{{ $question->id ?? '' }}"
                                            que_id="{{ $option->next_question_id ?? '' }}" value="{{ $option->option_value ?? '' }}" {{ $loop->first ? 'checked' : '' }} />
                                    <label>{{ $option->option_label }}</label>
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
                                <select onchange="updateNextButton(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}','{{ $next_qid ?? '' }}') " target-id="qidtarget-{{ $question->id ?? '' }}"  id="{{ $question->id }}" name="{{ $question->id ?? '' }}">
                                    <option value="" selected>{{ $question->questionData->same_contract_link_label ?? '' }}</option>
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
                                    data-condition_step="{{ $question->questionData->conditional_go_to_step ?? '' }}" my_ref="{{ $question->id ?? '' }}" onclick="go_next_step(this)" 
                                    data-condition="{{ $question->conditions && count($question->conditions) > 0 ? json_encode($question->conditions) : NULL  }}">
                                    Next
                                </button>

                                <button type="button" class="last_step_btn nxt" style="display:none;">
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
</section>

<script>
    let attemptedAnswers = {};
    let currentQuestion = 1;
    var total_steps = $('#total_step').val(); 
    var total_attempted = $('#all_attempted').val(); 


    // $(".question-div").hide();
    // $(".step1").show();
    
    $(document).ready(function(){
        let key = "last_saved_step";
        // var last_step = getWithExpiry(key);

        // if(last_step){
        //     $(".step-"+last_step).addClass('active');
        // }else{
        //     $(".step1").addClass('active');
        // }
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

        rightSecConditions();
        alphabetList();
        // questionConditions();
    })

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
                }else{
                    $(this).addClass('d-none');
                }
            }
        })
    }

    // Function to update the progress bar based on total attempted steps
    function updateProgressBar() {
        var percent = (total_attempted / total_steps) * 100;
        var value = parseInt(percent);
        $('#percent_count').val(value);
        $('.progressCount').text(value + "%");
        $('.progress-bar').css("width", value + "%");
    }

    // Function to handle progress bar updates as the user moves through the steps
    function progressBarCount(id, next_id, is_last = false) {
        var current_step = $('.step-' + id);
        var total_hidden_steps = 0;

        // Loop through skipped steps and count them
        for(let i = parseInt(id) + 1; i < next_id; i++){
            if($('.step-' + i).hasClass('hide')){
                total_hidden_steps++;
            }
        }

        total_attempted += total_hidden_steps;

        if($(current_step).hasClass('done')) {
            total_attempted++;
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

        console.log("Total reverse attempted steps:", total_attempted);

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

    function go_next_step(e){
        var next_step_id = $(e).attr("que_id");  
        var my_ref = $(e).attr("my_ref");       
        var is_last = !next_step_id || next_step_id === '';

        if(is_last){
            $('.last_step_btn').show();
            $('.nxt_btn_'+my_ref).hide();

            progressBarCount(my_ref, null, true);
            saveSteps(my_ref);
            
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

            saveSteps();
            progressBarCount(my_ref, next_step_id);
        }


        // var now = new Date();
        // var time = now.getTime();
        // time += 3600 * 100;

        // setWithExpiry("last_saved_step", my_ref, time);
        // localStorage.setItem("last_saved_step", my_ref);
    }

    function go_pre_step(e) {
        var current_step_id = $(e).attr('my_ref');
        var current_step = `.step-${current_step_id}`;
        if($(current_step).hasClass('active')){
            $(current_step).removeClass('active');
        }
        var prev_step_id = $(e).attr("que_id");
        var prev_step_div = `.step-${prev_step_id}`;
        
        if($(prev_step_div).hasClass('done')){
            $(prev_step_div).addClass('active');
            $(prev_step_div).removeClass('done');
        }

        var last_step_btn = $(current_step).find('.last_step_btn');
        if(last_step_btn.length){
            $('.last_step_btn').hide();
            $('.nxt_btn_'+current_step_id).show();
        }

        reverseProgressCount(current_step_id, prev_step_id);
    }

    function setWithExpiry(key, value, ttl) {
        const now = new Date();
        const item = {
            value: value,
            expiry: ttl,
        }
        localStorage.setItem(key, JSON.stringify(item))
    }

    function getWithExpiry(key) {
        const itemStr = localStorage.getItem(key)
        if (!itemStr) {
            return null;
        }
        const item = JSON.parse(itemStr)
        const now = new Date();

        if(now.getTime() > item.expiry){
            localStorage.removeItem(key)
            return null
        }
        return item.value
    }

    function updateNextButton(selectElement) {
        var shouldStepChange = $(`.step-${currentQuestion}`).attr('onchange');
        if(shouldStepChange != undefined && shouldStepChange == "false"){
            return;
        }
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const myNextBtn = selectedOption.getAttribute("my_ref_nxt");
        const queId = selectedOption.getAttribute("que_id");
        const selectedValue = selectedOption.value;
        console.log( selectedValue, " the selected value ")
        console.log(" This is the ID : ", `.step-${currentQuestion}`)
        $(`.step-${currentQuestion}`).attr('attempted', selectedValue); 
        const targetEle = $(selectElement).attr('target-id');
        $(targetEle).text(selectedValue)
        $(myNextBtn).attr("que_id", queId);
    }

    function updateNextButtonR(radioElement) {
        const myNextBtn = radioElement.getAttribute("my_ref_nxt");
        const queId = radioElement.getAttribute("que_id");
        const selectedValue = radioElement.value;
        const targetEle = $(radioElement).attr('target-id');
        $(targetEle).text(selectedValue)
        $(myNextBtn).attr("que_id", queId);
    }

    function saveSteps(id = undefined){
        var last_question = id;
        var document_id = $('#document_id').val();
        if(document_id != null && document_id != '' && document_id != undefined){
            if(last_question != null && last_question != undefined && last_question != ''){
                var step = last_question;
                var value = $('form#contractForm .question-div.active').attr('attempted');
            }else{
                var questionId = $('form#contractForm .question-div.active').attr('que_id');
                var answer = $('form#contractForm .question-div.active').attr('attempted');
                var step = questionId;
                var value = answer;

                console.log(value);
            }

            var data = {
                id: document_id,
                step: step,
                value: value,
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
    }

    function storeAnswers(e, que_id = undefined, qtype = undefined, next_id = undefined){
        if(qtype === "textbox"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            var obj = {
                "qid": qid,
                "ans": $(e).val()
            };

            $(right_part_target).text(obj.ans).css({
                "color": "white",     
                "background-color": "#002655",
                "padding": "5px",      
                "border-radius": "3px" 
            });

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "date-field"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            var value = $(e).val();
            var date = new Date(value);
            var options = { day: "2-digit", month: "long", year: "numeric" };
            var formattedDate = new Intl.DateTimeFormat("en-US", options).format(date);
            var obj = {
                "qid": qid,
                "ans": formattedDate 
            };

            $(right_part_target).text(obj.ans).css({
                "color": "white",     
                "background-color": "#002655", 
                "padding": "5px",      
                "border-radius": "3px" 
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "number-field"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            var obj = {
                "qid": qid,
                "ans": $(e).val() 
            };
           
            $(right_part_target).text(obj.ans).css({
                "color": "white",     
                "background-color": "#002655", 
                "padding": "5px",      
                "border-radius": "3px" 
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "textarea"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;

            var obj = {
                "qid": qid,
                "ans": $(e).val() 
            };
           
            $(right_part_target).text(obj.ans).css({
                "color": "white",      
                "background-color": "#002655", 
                "padding": "5px",      
                "border-radius": "3px" 
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "pricebox"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            
            var obj = {
                "qid": qid,
                "ans": $(e).val() 
            };
            
            $(right_part_target).text(obj.ans).css({
                "color": "white",      
                "background-color": "#002655", 
                "padding": "5px",      
                "border-radius": "3px"
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "percentage-box"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            
            var obj = {
                "qid": qid,
                "ans": $(e).val() 
            };
          
            $(right_part_target).text(obj.ans).css({
                "color": "white",      
                "background-color": "#002655", 
                "padding": "5px",   
                "border-radius": "3px"
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "dropdown" || qtype === "radio-button"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
           
            var obj = {
                "qid": qid,
                "ans": $(e).val() 
            };
            
            $(right_part_target).text(obj.ans).css({
                "color": "white",     
                "background-color": "#002655",
                "padding": "5px",      
                "border-radius": "3px" 
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans); 

        }else if(qtype === "dropdown-link"){
            var dropdown = $(e);
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;

            var selectedValue = dropdown.val(); 
            if(!selectedValue && dropdown.children('option').length === 1){
                selectedValue = dropdown.children('option:first').val();
                dropdown.val(selectedValue).trigger('change'); 
            }

            var obj = {
                "qid": qid,
                "ans": selectedValue
            };
          
            $(right_part_target).text(obj.ans).css({
                "color": "white",      
                "background-color": "#002655", 
                "padding": "5px",      
                "border-radius": "3px" 
            });
            // $(right_part_target).attr("tabindex", "0");

            attemptedAnswers[qid] = obj;
            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);
        }

        rightSecConditions();
        alphabetList();
        questionConditions(que_id, next_id);
    }   

    function smoothScrollToTarget(targetElement, container, offset = 0) {
        var $container = $(container);
        var $target = $(targetElement);

        if(!$container.length || !$target.length){
            return;
        }

        var targetOffset = $target.offset().top - $container.offset().top + $container.scrollTop() - offset;
        var currentScroll = $container.scrollTop();
        var distance = targetOffset - currentScroll;
        var duration = 800; 
        var start = null;

        function smoothStep(timestamp) {
            if(!start)start = timestamp;
            var progress = timestamp - start;
            var scrollPosition = easeInQuad(progress, currentScroll, distance, duration);
            $container.scrollTop(scrollPosition);

            if(progress < duration){
                window.requestAnimationFrame(smoothStep);
            }
        }

        window.requestAnimationFrame(smoothStep);
        function easeInQuad(time, start, distance, duration){
            time /= duration;
            return distance * time * time + start;
        }
    }

</script>

@endsection