@extends('users_layout.master') @section('content')
<style>
    .right-question-box {
        background: white;
        overflow-y: scroll;
        border-radius: 10px;
        height: 70vh;
    }

    .is_active {
        animation: 4s forwards;
    }
/* 
    .answered_spns {
        border: 1px solid #002655;
        min-width: 60px;
        display: inline-block;
        min-height: 18px;
        text-align: center;
    } */
    /* .answered_spns {
        display: inline-block;
        color: #002655; 
        font-size: 18px; 
    } */

    .secure_content {
       word-wrap: break-word;
       color: transparent;
       text-shadow: 0 0 8px #999;
       font-weight: normal;
       -webkit-filter: blur(5px);
    }

</style>
<section class="questions_page_main_div">
    <!-- This is the main container for the question and the form  -->
    <div id="main-question-form-controller" class="row p-5 card" style="display: flex !important ; flex-direction: row !important ; gap: 10px;">
        <!-- here we show all the steps of the questions, this is the section where we show all the questions  -->
        <div class="left-box left-question-box questions-div col-md-4">
            <form id="contractForm">
                <input type="hidden" id="document_id" name="document_id" value="{{ $id ?? '' }}">
                @php 
                    $count = 1;
                    $num = 1;
                @endphp
                @foreach($questions as $index => $question)
                    <?php 
                        // print_r($index);
                    ?>
                    <div class="question-div step{{ $count++ }} step-{{ $question->id }} mb-4 p-4" que_id="{{ $question->id ?? '' }}">
                        <p class="que_heading lbl-{{ $question->id }}">
                            @if($question->is_condition == 1)
                            {{ $question->conditions[0]->question_label ?? '' }}
                            @else
                            {{ $question->questionData->question_label ?? '' }}
                            @endif
                        </p>
                        @php 
                            $question_type = $question->type;
                            $next_qid = NULL;
                        @endphp 
                        
                        @if($question_type == "textbox")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>

                        @elseif($question_type == "textarea")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>
                        
                        @elseif($question_type == "dropdown")
                            @php 
                                $next_qid = $question->options->first()->next_question_id ?? '';
                            @endphp 
                            <select onchange="updateNextButton(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}') " target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}">
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
                                <input type="radio" name="question_{{ $question->id ?? '' }}" target-id="qidtarget-{{ $question->id ?? '' }}" id="radio_{{ $question->id ?? '' }}{{ $num++ ?? '' }}"
                                        onchange="updateNextButtonR(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" my_ref_nxt=".nxt_btn_{{ $question->id ?? '' }}"
                                        que_id="{{ $option->next_question_id ?? '' }}" value="{{ $option->option_value ?? '' }}" {{ $loop->first ? 'checked' : '' }} />
                                <label>{{ $option->option_label }}</label>
                            @endforeach
                        @elseif($question_type == "date-field")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            
                            <input type="date" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                onchange="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" />
                        @elseif($question_type == "pricebox")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}" 
                                onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>

                        @elseif($question_type == "number-field")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>
                        @elseif($question_type == "percentage-box")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            <input type="text" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}" name="{{ $question->id ?? '' }}"
                                onkeyup="storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" placeholder="{{ $question->questionData->text_box_placeholder ?? '' }}" data-placeholdertext="__________"/>
                        @elseif($question_type == "dropdown-link")
                            @php 
                                $next_qid = $question->questionData->next_question_id ?? '';
                            @endphp 
                            <select onchange="updateNextButton(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}') " target-id="qidtarget-{{ $question->id ?? '' }}"  id="{{ $question->id }}" name="{{ $question->id ?? '' }}">
                                <option value="" selected>{{ $question->questionData->same_contract_link_label ?? '' }}</option>
                                @foreach($question->options as $option)
                                    <option my_ref_nxt=".nxt_btn_{{ $question->id ?? '' }}" que_id="{{ $question->questionData->next_question_id ?? '' }}"
                                    value="{{ $option->contract_link ?? '' }}"> {{ $option->option_label ?? '' }} </option>
                                @endforeach
                            </select>
                        @endif

                        <div class="navigation-btns mt-4"> 
                            @if($index != 0)
                                <button type="button" class="pre_btn_{{ $question->id }} pre" que_id="" my_ref="{{ $question->id }}"
                                    onclick="go_pre_step(this)">Previous</button>
                            @endif
                            <button type="button" class="nxt_btn_{{ $question->id }} nxt" que_id="{{ $next_qid ?? '' }}"
                                my_ref="{{ $question->id }}" onclick="go_next_step(this)">Next</button>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
            <!-- This is the box where we show the steps or the form -->
            <div class="right-box right-question-box form-div card col-md-8">
                @foreach($documentContents as $content)
                    @if($content->secure_blur_content == 1)
                        <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="right-sec-div secure_content mb-2" conditional_section="{{ $content->is_condition ? 'true' : NULL }}"
                        data-conditions="{{ $content->conditions && count($content->conditions) > 0 ? json_encode($content->conditions) : NULL  }}">
                            {!! $content->content !!}
                        </div>
                    @elseif($content->is_condition == 0)
                        <span style="text-align:{{ $content->text_align ?? '' }}" class="">
                            {!! $content->content !!}
                        </span>
                    @else
                        <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="right-sec-div mb-2" conditional_section="{{ $content->is_condition ? 'true' : NULL }}"
                        data-conditions="{{ $content->conditions && count($content->conditions) > 0 ? json_encode($content->conditions) : NULL  }}">
                            {!! $content->content !!}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
</section>

<script>
    let attemptedAnswers = {};
    let currentQuestion = 1;
    $(".question-div").hide();
    $(".step1").show();
    
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

        rightSecConditions();
        alphabetList();
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

    function go_next_step(e){
        var next_step_id = $(e).attr("que_id");
        currentQuestion = next_step_id;
        var my_ref = $(e).attr("my_ref");
        if(next_step_id == '' || next_step_id == null || next_step_id == undefined){
            console.log('this is the last step');
            saveSteps(my_ref);
        }else{
            saveSteps();
        }
        var next_step_div = `.step-${next_step_id}`;
        var pre_btn = `.pre_btn_${next_step_id}`;
        $(pre_btn).attr("que_id", my_ref);
        $(".question-div").hide();
        if(my_ref != null && my_ref != '' && my_ref != undefined){
            var current_step = `.step-${my_ref}`;
            if($(current_step).hasClass('active')){
                $(current_step).removeClass('active');
                $(current_step).addClass('done');
            }
        }
        $(next_step_div).show();
        $(next_step_div).addClass('active');
    }

    function go_pre_step(e) {
        $(".question-div").hide();
        var current_step_id = $(e).attr('my_ref');
        var current_step = `.step-${current_step_id}`;
        if($(current_step).hasClass('active')){
            $(current_step).removeClass('active');
        }

        var next_step_id = $(e).attr("que_id");
        var next_step_div = `.step-${next_step_id}`;
        $(next_step_div).show();
        if($(next_step_div).hasClass('done')){
            $(next_step_div).removeClass('done');
            $(next_step_div).addClass('active');
        }
        
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

    function storeAnswers(e, que_id = undefined, qtype = undefined){
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
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);
        }

        rightSecConditions();
        alphabetList();
    }


    function smoothScrollToTarget(targetElement, container, offset = 35) {
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