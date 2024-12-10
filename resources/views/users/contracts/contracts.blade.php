@extends('users_layout.master') @section('content')
<style>
    .answered_spns {
        /* background: #002655; */
        /* color: white; */
    }

    .right-question-box {
        background: white;
        overflow-y: scroll;
        border-radius: 10px;
        height: 70vh;
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
    <form id="contractForm" method="post">
        <div id="main-question-form-controller" class="p-5 card"
            style="display: flex !important ; flex-direction: row !important ; gap: 10px;">
            <!-- here we show all the steps of the questions, this is the section where we show all the questions  -->
            <div class="left-box left-question-box questions-div">
                @php 
                    $count = 1;
                @endphp
                @foreach($questions as $index => $question)
                    <?php 
                        // print_r($index);
                    ?>

                    <div class="question-div step{{ $count++ }} step-{{ $question->id }} mb-4 p-4" que_id="{{ $question->id }}" id="{{ $question->qid }}" is_condition="{{ $question->is_condition }}" swtchtyp="{{ $question->condition_type }}">
                        <p class="que_heading lbl-{{ $question->id }}"
                            json-data="{{  $question->conditions && count($question->conditions) > 0 ? json_encode($question->conditions) : NULL  }}">
                            {{ $question->questionData->question_label ?? '' }}
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
                                    value="{{ $option->option_value ?? '' }}"> {{ $option->option_label }} </option>
                                @endforeach
                            </select>
                        @elseif($question_type == "radio-button")
                            @php 
                                $next_qid = $question->options->first()->next_question_id ?? '';
                            @endphp 
                            @foreach($question->options as $option)
                                <input type="radio" name="question_{{ $question->id ?? '' }}" target-id="qidtarget-{{ $question->id ?? '' }}" id="{{ $question->id ?? '' }}"
                                        onchange="updateNextButtonR(this); storeAnswers(this, '{{ $question->id ?? '' }}','{{ $question_type ?? '' }}')" my_ref_nxt=".nxt_btn_{{ $question->id ?? '' }}"
                                        que_id="{{ $option->next_question_id ?? '' }}" value="{{ $option->option_value ?? '' }}" />
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
                                <button type="button" class="pre_btn_{{ $question->id }} nxt" que_id=""
                                    onclick="go_pre_step(this)">Previous</button>
                            @endif
                            <button type="button" class="nxt_btn_{{ $question->id }} pre" que_id="{{ $next_qid ?? '' }}"
                                my_ref="{{ $question->id }}" onclick="go_next_step(this)">Next</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- This is the box where we show the steps or the form -->
            <div class="right-box right-question-box form-div card">
                @foreach($documentContents as $content)
                    @if($content->secure_blur_content == 1)
                    <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="right-sec-div secure_content mb-2" conditional_section="{{ $content->is_condition ? 'true' : NULL }}"
                    data-conditions="{{ $content->conditions && count($content->conditions) > 0 ? json_encode($content->conditions) : NULL  }}">
                        {!! $content->content !!}
                    </div>
                    @elseif($content->is_condition == 0)
                    <div style="text-align:{{ $content->text_align ?? '' }}" class="mb-2">
                        {!! $content->content !!}
                    </div>
                    @else
                    <div id="right_content_div_{{ $content->id ?? '' }}" style="text-align:{{ $content->text_align ?? '' }}" class="right-sec-div mb-2" conditional_section="{{ $content->is_condition ? 'true' : NULL }}"
                    data-conditions="{{ $content->conditions && count($content->conditions) > 0 ? json_encode($content->conditions) : NULL  }}">
                        {!! $content->content !!}
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </form>
</section>

<!-- JS for getting the questions  -->
<!-- <script src="{{ asset('assets/js/questions.js') }}"></script> -->

<script>
    let attemptedAnswers = {};
    let currentQuestion = 1;
    $(".question-div").hide();
    $(".step1").show();


    $(document).ready(function(){
        $('form#contractForm select').each(function(){
            var id = $(this).attr('id');
            if(id != null && id != '' && id != undefined){
                var targetvalue = $('#'+id).val();
                if(targetvalue == '' || targetvalue == null || targetvalue == undefined){
                    var defaultvalue = $('#'+id).data('placeholdertext');
                    if(defaultvalue == '' || defaultvalue == null || targetvalue == undefined){
                        targetvalue = '_________';
                    }else{
                        targetvalue = defaultvalue;
                    }
                }
                $(".qidtarget-"+id).html(targetvalue);
                // $(".qidtarget-"+id).each(function(){
                //     $(this).html(targetvalue);
                // });
            }
        })

        // $('.right-sec-div').each(function(){
        //     if($(this).data('conditions') != null && $(this).data('conditions') != ''){
        //         var conditions = $(this).data('conditions');
        //         // var cond_arr = $.parseJSON(conditions);
        //         var is_elem_show = true;

        //         $.each(conditions, function(key,val){
        //             var queId = val.conditional_question_id;
        //             var queValue = val.conditional_question_value;
        //             var conditionalCheck = val.conditional_check;

        //             if($('#'+queId).length){
        //                 if(conditionalCheck == '1'){
        //                     // console.log($('#'+queId).val());
        //                     // console.log(queValue);
        //                     if($('#'+queId).val() == queValue && is_elem_show == true){
        //                         is_elem_show = true;
        //                     }else{
        //                         is_elem_show = false;
        //                     }
        //                 }else if(conditionalCheck == '2'){
        //                     // console.log($('#'+queId).val());
        //                     // console.log(queValue);
        //                     if($('#'+queId).val() > queValue && is_elem_show == true){
        //                         is_elem_show = true;
        //                     }else{
        //                         is_elem_show = false;
        //                     }
        //                 }else if(conditionalCheck == '3'){
        //                     // console.log($('#'+queId).val());
        //                     // console.log(queValue);
        //                     if($('#'+queId).val() < queValue && is_elem_show == true){
        //                         is_elem_show = true;
        //                     }else{
        //                         is_elem_show = false;
        //                     }
        //                 }else if(conditionalCheck == '4'){
        //                     // console.log($('#'+queId).val());
        //                     // console.log(queValue);
        //                     if($('#'+queId).val() != queValue && is_elem_show == true){
        //                         is_elem_show = true;
        //                     }else{
        //                         is_elem_show = false;
        //                     }
        //                 }
        //             }else if($('input[type="radio"][name="question_'+qus_id+'"]').length){
        //                 console.log('abcd');
        //                 if(condition == '1'){
        //                     if($('input[type="radio"][name="question_'+qus_id+'"]:checked').val() == qus_val && show_element == 'yes'){
        //                         show_element = 'yes';
        //                     }else{
        //                         show_element = 'no';	
        //                     }
        //                 }else if(condition == '2'){
        //                     if($('input[type="radio"][name="question_'+qus_id+'"]:checked').val() > qus_val && show_element == 'yes'){
        //                         show_element = 'yes';
        //                     }else{
        //                         show_element = 'no';	
        //                     }
        //                 }else if(condition == '3'){
        //                     if($('input[type="radio"][name="question_'+qus_id+'"]:checked').val() < qus_val && show_element == 'yes'){
        //                         show_element = 'yes';
        //                     }else{
        //                         show_element = 'no';	
        //                     }
        //                 }else if(condition == '4'){
        //                     if($('input[type="radio"][name="question_'+qus_id+'"]:checked').val() != qus_val && show_element == 'yes'){
        //                         show_element = 'yes';
        //                     }else{
        //                         show_element = 'no';	
        //                     } 
        //                 }
        //             }			
        //         });

        //         if(is_elem_show == true){ 
        //             $(this).removeClass('d-none');
        //         }else{
        //             $(this).addClass('d-none');
        //         }
        //     }
        // })
    })

   

    function go_next_step(e){
        // This is the next question ID 
        var next_step_id = $(e).attr("que_id");
        // console.log(next_step_id);

        // Update the current question ID to the global counter 
        currentQuestion = next_step_id;
        // This is the current div id 
        var my_ref = $(e).attr("my_ref");
        // This is the next Main Div 
        var next_step_div = `.step-${next_step_id}`;

        /**
         * Before going to the next questions check all the conditions attached to the current question 
           This parameter makes sure that the condtion is attached to the next question   
           if it is 1 condition is attached else not 
        */
        var is_condition = $(next_step_div).attr('is_condition');
        $('.right-sec-div').each(function(){
            if($(this).data('conditions') != null && $(this).data('conditions') != ''){
                var conditions = $(this).data('conditions');
                // var cond_arr = $.parseJSON(conditions);
                var is_elem_show = true;

                $.each(conditions, function(key,val){
                    var queId = val.conditional_question_id;
                    var queValue = val.conditional_question_value;
                    var conditionalCheck = val.conditional_check;

                    if($('#'+queId).length){
                        if(conditionalCheck == '1'){
                            // console.log($('#'+queId).val());
                            // console.log(queValue);
                            if($('#'+queId).val() == queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }else if(conditionalCheck == '2'){
                            // console.log($('#'+queId).val());
                            // console.log(queValue);
                            if($('#'+queId).val() > queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }else if(conditionalCheck == '3'){
                            // console.log($('#'+queId).val());
                            // console.log(queValue);
                            if($('#'+queId).val() < queValue && is_elem_show == true){
                                is_elem_show = true;
                            }else{
                                is_elem_show = false;
                            }
                        }else if(conditionalCheck == '4'){
                            // console.log($('#'+queId).val());
                            // console.log(queValue);
                            if($('#'+queId).val() != queValue && is_elem_show == true){
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

        // if(is_condition != undefined && is_condition == 1){
        //     var lbl = `.lbl-${next_step_id}`;
        //     console.log(lbl);
        //     // It tells which condition is set Go to step or the Lable condition 
        //     var conditionType = $(next_step_div).attr('swtchtyp')
        //     var conditions = $(lbl).attr('json-data');  // Get the conditions data from the Label 
        //     // console.log(conditions);
        //     if(conditions != undefined){
        //         conditions = JSON.parse(conditions)
        //         conditions.forEach(function (condition){
        //             // first check the Condition Type
        //             var conditional_que_div = `.step-${condition.conditional_question_id}`; // this is the div for which we need to check the conditon 
        //             var value = $(conditional_que_div).attr('attempted')  // we get the value attempted for the conditional question 
        //             var conditionType = $(next_step_div).attr('swtchtyp') 
                
        //             if(conditionType == 1){
        //                 if(value == condition.conditional_question_value){
        //                     var changed_label = condition.question_label;
        //                     $(lbl).text(changed_label);
        //                 }
        //             }else if(conditionType == 2){
        //                 if(value == condition.conditional_question_value){
        //                     var current_question_next_btn = `.nxt_btn_${next_step_id}`
        //                     $(current_question_next_btn).attr('que_id', condition.go_to_step);
        //                     $(`.step-${next_step_id}`).attr('onchange', false);
        //                 }
        //                 console.log(condition, " This is the step 2 condition ");

        //             }else if(conditionType == 3){
        //                 location.reload();
        //             }
        //         });
        //     }

        // }
        // get the current div previsous button refrence
        var pre_btn = `.pre_btn_${next_step_id}`;
        $(pre_btn).attr("que_id", my_ref);
        $(".question-div").hide();
        $(next_step_div).show();
    }

    function go_pre_step(e) {
        $(".question-div").hide();
        var next_step_id = $(e).attr("que_id");
        var next_step_div = `.step-${next_step_id}`;
        $(next_step_div).show();
    }

    function updateNextButton(selectElement) {
        // Get the main div 
        var shouldStepChange = $(`.step-${currentQuestion}`).attr('onchange');
        if(shouldStepChange != undefined && shouldStepChange == "false"){
            return;
        }
        // Get the currently selected option
        const selectedOption = selectElement.options[selectElement.selectedIndex];

        // Retrieve the attributes from the selected option
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

    // This is for the Radio Buttons 
    function updateNextButtonR(radioElement) {
        // Get the attributes from the selected radio button
        const myNextBtn = radioElement.getAttribute("my_ref_nxt");
        const queId = radioElement.getAttribute("que_id");
        const selectedValue = radioElement.value;
        const targetEle = $(radioElement).attr('target-id');
        $(targetEle).text(selectedValue)
        $(myNextBtn).attr("que_id", queId);
    }

    function storeAnswers(e, que_id = undefined, qtype = undefined){
        if(qtype === "textbox"){
            // Get the div and inject the attempted value, filling the object
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": $(e).val() // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });


            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');
            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans); // Fixed attribute reference here

        }else if(qtype === "date-field"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            var value = $(e).val();
            var date = new Date(value);
            var options = { day: "2-digit", month: "long", year: "numeric" };
            var formattedDate = new Intl.DateTimeFormat("en-US", options).format(date);
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": formattedDate // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');

            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "number-field"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": $(e).val() // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');

            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if(qtype === "textarea"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": $(e).val() // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');

            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);
        }else if (qtype === "pricebox"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": $(e).val() // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');

            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if (qtype === "percentage-box"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": $(e).val() // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');

            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);

        }else if( qtype === "dropdown" || qtype === "radio-button"){
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;
            // Define an object to store the question ID and answer
            var obj = {
                "qid": qid,
                "ans": $(e).val() // Fixed syntax error here
            };
            // $(right_part_target).text(obj.ans)
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            // Store the object in attemptedAnswers using qid as the key
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');

            // Update the main question div with the attempted answer attribute
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans); // Fixed attribute reference here

        }else if(qtype === "dropdown-link"){
            var dropdown = $(e);
            var qid = `que${que_id}`;
            var main_q_div = `.step-${que_id}`;
            var right_part_target = `.qidtarget-${que_id}`;

            var selectedValue = dropdown.val(); // Get the selected value
            if (!selectedValue && dropdown.children('option').length === 1) {
                // Automatically select the single option
                selectedValue = dropdown.children('option:first').val();
                dropdown.val(selectedValue).trigger('change'); // Set and trigger the change event
            }

            var obj = {
                "qid": qid,
                "ans": selectedValue
            };
            // $(right_part_target).text(obj.ans);
            $(right_part_target).text(obj.ans).css({
                "color": "white",      // Set text color
                "background-color": "#002655", // Set background color
                "padding": "5px",      // Add padding for better visibility
                "border-radius": "3px" // Optional: Add rounded corners
            });
            attemptedAnswers[qid] = obj;

            smoothScrollToTarget(right_part_target, '.right-question-box');
            $(main_q_div).attr('attempted', attemptedAnswers[qid].ans);
        }
    }


    function smoothScrollToTarget(targetElement, container, offset = 35) {
        var $container = $(container);
        var $target = $(targetElement);

        if(!$container.length || !$target.length){
            // console.error('Container or target element not found:', { container, targetElement });
            return;
        }

        var targetOffset = $target.offset().top - $container.offset().top + $container.scrollTop() - offset;
        var currentScroll = $container.scrollTop();
        var distance = targetOffset - currentScroll;
        var duration = 800; // Total duration in ms
        var start = null;

        // Smooth scrolling using requestAnimationFrame
        function smoothStep(timestamp) {
            if (!start) start = timestamp;
            var progress = timestamp - start;

            // Calculate current position with ease-in function
            var scrollPosition = easeInQuad(progress, currentScroll, distance, duration);

            $container.scrollTop(scrollPosition);

            if(progress < duration){
                window.requestAnimationFrame(smoothStep);
            }
        }

        window.requestAnimationFrame(smoothStep);

        // Ease-in quadratic function
        function easeInQuad(time, start, distance, duration){
            time /= duration;
            return distance * time * time + start;
        }
    }

</script>

@endsection