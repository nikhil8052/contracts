@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <form action="{{ url('/admin-dashboard/faq-process') }}" method="POST">
            @csrf
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    @if(isset($faqs) && $faqs->isNotEmpty())
                        {{-- First Loop for Question and Answer --}}
                        @foreach($faqs as $faq)
                            @if($faq->key === 'title')
                                <div class="col-md-8 pb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="title"><b><h5>Title</b></h5></label>
                                        <input class="form-control form-control-lg" type="text" id="title"  name="title[{{ $faq->id }}]" value="{{ $faq->value }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach($faqs as $faq)
                            @if($faq->key === 'main_title')
                            <hr>
                            <h4>Faq Page</h4>  
                            <hr>
                            <h6>Faq Section</h6>
                            <hr>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label" for="main_title">Main Title</label>
                                    <input class="form-control form-control-lg" id="main_title" name="main_title[{{ $faq->id }}]" value="{{ $faq->value }}">
                                    @error('main_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                            </div>
                            @endif
                        @endforeach
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="form-label" for="">Faq</label>
                            </div>
                        </div>
                        @foreach($faqs as $faq)
                            @if($faq->key === 'faq')
                                <div class="template-append-sec">
                                    <div class="col-md-8 mt-3">
                                        <div class="form-group">
                                            <label class="form-label" for="faq">Question</label>
                                            <input class="form-control form-control-lg" name="faq[{{ $faq->id }}]" value="{{ isset($faq->question) ? htmlspecialchars($faq->question) : '' }}" />
                                            @error('faq')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="">Answer</label>
                                            <textarea class="form-control answer_editor" name="answer[{{ $faq->id }}]">{{ $faq->answer }}</textarea>
                                            @error('answer')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-1 offset-md-11">
                                        <div class="form-group">
                                            <div class="remove-faq-sec" data-id="{{$faq->id}}"><span><i class="fa fa-times"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        <div class="col-md-5 offset-md-7 mt-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-sm btn-primary" id="add-faq-sec">Add FAQ</button>
                            </div>
                        </div>

                        {{-- New FAQ Input Section --}}
                        <div id="new-faq-container"></div>

                        {{-- Second Loop for Other Content --}}
                        @foreach($faqs as $faq)
                            @if($faq->key === 'second_banner_heading')
                                <div class="col-md-8 mt-3">
                                    <div class="form-group">
                                        <label class="form-label" for="second_banner_heading"><b><h5>Second Banner Heading</b></h5></label>
                                        <input class="form-control form-control-lg" id="second_banner_heading" name="second_banner_heading[{{ $faq->id }}]" value="{{ $faq->value }}">
                                    </div>
                                    @error('second_banner_heading')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>
                            @elseif($faq->key === 'second_banner_sub_heading')
                                <div class="col-md-8 mt-3">
                                    <div class="form-group">
                                        <label class="form-label" for="second_banner_sub_heading"><b><h5>Second Banner Sub Heading</b></h5></label>
                                        <textarea class="form-control" id="second_banner_sub_heading" name=" second_banner_sub_heading[{{ $faq->id }}]">{{ $faq->value }}</textarea>
                                        @error('second_banner_sub_heading')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    
                                    </div>
                                </div>
                            @elseif($faq->key === 'button_label')
                                <div class="col-md-8 pb-2 mt-3">
                                    <div class="form-group">
                                        <label class="form-label" for="button_label"><b><h5>Button Label</b></h5></label>
                                        <input class="form-control" type="text" id="button_label" name="button_label[{{ $faq->id }}]" value="{{ $faq->value }}">
                                        @error('button_label')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                
                                </div>
                            @elseif($faq->key === 'button_link')
                                <div class="col-md-8 mt-3">
                                    <div class="form-group">
                                        <label class="form-label" for="button_link"><b><h5>Button Link</b></h5></label>
                                        <input class="form-control form-control-lg" id="button_link" name=" button_link[{{ $faq->id }}]" value="{{ $faq->value }}">
                                        @error('button_link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="mt-3">
                            <button class="btn btn-primary save_and_remove_btn" type="submit">Save</button>
                        </div>
                    @endif
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
    // Initialize CKEditor on existing fields
    $('.answer_editor').each(function() {
        initializeCKEditor(this);
    });

    // Handle the click event for adding a new FAQ section
    $('#add-faq-sec').click(function() {
        // HTML for the new FAQ section
        let faqHtml = `
        <div class="template-append-sec">
            <div class="col-md-8 mt-3">
                <div class="form-group">
                    <label class="form-label" for="faq">Question</label>
                    <input class="form-control form-control-lg" name="faq[]" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="">Answer</label>
                    <textarea class="form-control answer_editor" name="answer[]"></textarea>
                </div>
            </div>
            <div class="col-md-1 offset-md-11">
                <div class="form-group">
                    <div class="remove-faq-sec"><span><i class="fa fa-times"></i></span></div>
                </div>
            </div>
        </div>`;

        // Append the new FAQ section to the bottom of the FAQ list
        document.getElementById('new-faq-container').insertAdjacentHTML('beforeend', faqHtml);

        // Initialize CKEditor for the newly added textarea
        const newTextarea = $('.answer_editor').last()[0];
        if (newTextarea && !$(newTextarea).data('ckeditor-initialized')) {
            initializeCKEditor(newTextarea);
            $(newTextarea).data('ckeditor-initialized', true);
        }
    });

    // Remove FAQ section
    $('body').on('click', '.remove-faq-sec', function() {
        $(this).closest('.template-append-sec').remove();
    });

let idsToRemove = []; // Array to store IDs for removal

// Toggle the selected ID to remove
$('.remove-faq-sec').click(function() {
    let hideId = $(this).data('id');
    
    // Toggle the ID in the array
    if (idsToRemove.includes(hideId)) {
        idsToRemove = idsToRemove.filter(id => id !== hideId);
    } else {
        idsToRemove.push(hideId);
    }

    // Provide feedback (optional)
    console.log('IDs to remove:', idsToRemove);
});

// Save and remove button click handler
$('.save_and_remove_btn').click(function(e) {
    // e.preventDefault();
    
    if (idsToRemove.length > 0) {
        $.ajax({
            url: "{{url('/admin-dashboard/faq-remove')}}",  // Replace with your correct route
            method: 'POST',
            data: {
                ids: idsToRemove,
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            },
            success: function(response) {
                if (response.success) {
                    // Feedback (e.g., refresh the page or update the DOM)
                    console.log('Selected FAQs have been removed successfully!')
                    // Optionally, remove the items from the DOM
                    idsToRemove.forEach(function(id) {
                        $(`[data-id="${id}"]`).remove();
                    });
                } else {
                    console.log('Error occurred while removing FAQs')
                }
            },
            error: function() {
                console.log('An error occurred during the request.')
            }
        });
    }
    /* 
    else {
        
        alert('No IDs selected for removal.');
    }*/
});


     
});

</script>


@endsection