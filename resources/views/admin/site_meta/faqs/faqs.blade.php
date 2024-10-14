@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <form action="{{ url('/admin-dashboard/faq-process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="removefaq" id="removefaq" value="">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="col-md-12 pb-2">
                        <div class="form-group">
                            <label class="form-label" for="title"><b><h5>Title</b></h5></label>
                            <input class="form-control form-control-lg" type="text" id="title"  name="title" value="{{ $data['title'] ?? '' }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>        
                    <hr>
                    <h5>Banner Section</h5>
                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="background_image">Background Image</label>
                            <input type="file" class="form-control" id="background_image" name="background_image">
                        </div>
                        <div class="form-group">
                            @if(isset($data['background_image']) && $data['background_image'] != null)
                            <img src="{{ asset('storage/'.$data['background_image']) }}" alt="background_img" height="180px" width="180px">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_title">Banner Title</label>
                            <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ $data['banner_title'] ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_description">Banner Description</label>
                            <textarea class="form-control" id="banner_description" name="banner_description">{{ $data['banner_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="banner_image">Banner Image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image">
                        </div>
                        <div class="form-group">
                            @if(isset($data['banner_image']) && $data['banner_image'] != null)
                            <img src="{{ asset('storage/'.$data['banner_image']) }}" alt="banner_img" height="200px" width="280px">
                            @endif
                        </div>
                    </div>
                    <hr>
                    <h6>Faq Section</h6>
                    <hr>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="">Faq</label>
                        </div>
                    </div>
                    @if(isset($faqs) && $faqs != null)
                    @foreach($faqs as $value)
                    <div class="faq-append-sec{{ $value->id ?? '' }}">
                        <hr>
                        <div class="text-end">
                            <div class="form-group">
                                <div><span class="remove-faq-sec" data-id="{{ $value->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                            </div>
                        </div>
                        <div class="row gy-12">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="form-label" for="category">Category</label>
                                    <div class="form-control-wrap"> 
                                        <select class="form-select js-select2" name="category[{{ $value->id ?? '' }}]" id="category">
                                            <option value="" selected disabled>Select</option>
                                            @if(isset($faqCategory) && count($faqCategory) > 0)
                                                @foreach($faqCategory as $catg)
                                                    @php
                                                        $isSelected = isset($value->category_id) && $value->category_id == $catg->id;
                                                    @endphp
                                                    <option value="{{ $catg->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                    {{ $catg->category_name ?? '' }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label" for="question">Question</label>
                                    <input class="form-control" name="question[{{ $value->id ?? '' }}]" id="question" value="{{ $value->question ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label" for="answer">Answer</label>
                                    <textarea class="form-control answer_editor" name="answer[{{ $value->id ?? '' }}]" id="answer">{{ $value->answer ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div id="new-faq-container"></div>
                    <br>
                    <div class="text-end">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-primary" id="add-faq-sec">Add</button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary save_and_remove_btn" type="submit">Save</button>
                    </div>
                </div>
            </div>       
        </form>
    </div>
</div>
<script> 
function initializeCKEditor(element) {
    ClassicEditor.create(element).catch(error => {
        console.error(error);
    });
}

$(document).ready(function() {
    var faq_category = {!! json_encode($faqCategory) !!};
  
    $('.answer_editor').each(function() {
        initializeCKEditor(this);
    });

    $('#add-faq-sec').click(function() {
        var category_option = [];
        $.each(faq_category, function(key, val){
            var category_html = `<option value="${val.id}">${val.category_name}</option>`;
            category_option.push(category_html);
        });
        var category_options_html = category_option.join('');
        let faqHtml = `
        <div class="faq-append-sec">
        <hr>
        <div class="row gy-12">
            <div class="text-end">
                <div class="form-group">
                    <div><span class="remove-faq-sec" value="appended"><i class="fa fa-times"></i></span></div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="form-label" for="new_category">Category</label>
                    <div class="form-control-wrap"> 
                        <select class="form-select js-select2" name="new_category[]" id="new_category">
                            <option value="" selected disabled>Select</option>
                            ${category_options_html}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label class="form-label" for="new_question">Question</label>
                    <input class="form-control" name="new_question[]" id="new_question" value="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label class="form-label" for="new_answer">Answer</label>
                    <textarea class="form-control answer_editor" name="new_answer[]" id="new_answer"></textarea>
                </div>
            </div>
        </div>
        </div>`;

        document.getElementById('new-faq-container').insertAdjacentHTML('beforeend', faqHtml);

        const newTextarea = $('.answer_editor').last()[0];
        if (newTextarea && !$(newTextarea).data('ckeditor-initialized')) {
            initializeCKEditor(newTextarea);
            $(newTextarea).data('ckeditor-initialized', true);
        }

    });

    $('body').delegate('.remove-faq-sec', 'click', function(){
        var id = $(this).data('id');
        if($(this).attr('value') === 'appended'){
            $(this).closest('.faq-append-sec').remove();
            return false;
        }

        let deleteIds = $('#removefaq').val();
        
        if(deleteIds) {
            deleteIds += ',' + id;
        }else{
            deleteIds = id;
        }
        $('#removefaq').val(deleteIds);

        $('.faq-append-sec'+id).hide();
    });   
});


</script>


@endsection