@extends('admin_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <form action="{{url('/admin-dashboard/faq-process')}}" method="POST">
            @csrf
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="col-md-8 pb-2">
                        <div class="form-group">
                            <label  class="form-label" for="title">Title</label>
                            <input class="form-control form-control-lg" type="text" id="title" name="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                    </div>

                     <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label" for="main_title">Main Title</label>
                            <input  class="form-control form-control-lg" id="main_title" name="main_title">
                            @error('main_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-8" id="faq-div">
                        <span>FAQ</span>
                    </div>
                    <div class="col-md-5 offset-md-7 mt-3">
                        <div class="form-group">
                           
                           
                             <button type="button" class="btn btn-sm btn-primary" id="add-faq-sec">Add Faq</button>
                        </div>
                    </div>
                

                    <div  class="col-md-8">
                        <div class="form-group">
                            <label class="form-label" for="second_banner_heading">Second Banner Heading</label>
                            <input class="form-control form-control-lg" id="second_banner_heading" name="second_banner_heading">
                        </div>
                        @error('second_banner_heading')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <div  class="col-md-8">
                        <div class="form-group">
                        <label  class="form-label" for="second_banner_sub_heading">Second Banner Sub Heading</label>
                        <textarea class="form-control" id="second_banner_sub_heading" name="second_banner_sub_heading"></textarea>
                        @error('second_banner_sub_heading')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                       </div>
                    </div>

                    <div class="col-md-8 pb-2">
                        <div class="form-group">
                            <label class="form-label" for="button_label">Button Label</label>
                            <input  class="form-control" type="text" id="button_label" name="button_label">
                            @error('button_label')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div  class="col-md-8">
                        <div class="form-group">
                            <label class="form-label"  for="button_link">Button Link</label>
                            <input  class="form-control form-control-lg" id="button_link" name="button_link">
                            @error('button_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
             </div>        
        </form>
    </div>
</div>
<script>
    $(document).ready(function(e){

  $('#add-faq-sec').click(function(e) {

        let faqHtml = `
        <div class="template-append-sec" id="remove-faq-section">
            <div class="col-md-1 offset-md-11">
                <div class="form-group">
                    <div class="remove-faq-sec"><span><i class="fa fa-times"></i></span></div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="faq">FAQ:</label>
                <input class="form-control form-control-lg" name="faq[]" />
                @error('faq')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
                <div class="form-group">
                    <label class="form-label" for="">Answer</label>
                    <textarea class="form-control answer_editor" id="answer" name="answer[]"></textarea>
                        @error('answer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
        </div>        
        
        `;
        $('#faq-div').append(faqHtml);

        // Initialize the CKEditor for the newly added textarea
        $('.answer_editor').each(function() {
            if (!$(this).data('ckeditor-initialized')) {
                ClassicEditor.create(this).catch(error => {
                        console.error(error);
                    });
                $(this).data('ckeditor-initialized', true); // Mark as initialized
            }
        });
    });

    });
     ClassicEditor.create( document.querySelector('#answer'))
     .catch( error => {
          console.error( error );
     });

      $('body').delegate('.remove-faq-sec','click',function(){
            $(this).closest('#remove-faq-section').hide();
        });
</script>


@endsection