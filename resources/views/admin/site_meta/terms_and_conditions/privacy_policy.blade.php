@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/privacy-policy-process') }}" method="post">
               @csrf
               @if(isset($privacyPolicys) && $privacyPolicys->isNotEmpty())
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         @foreach($privacyPolicys as $policy)
                              @if($policy->key === 'title')
                                   <div class="col-md-8 pb-2">
                                        <div class="form-group">
                                             <label class="form-label" for="title"><b><h4>Title</b></h4></label>
                                             <input type="text" class="form-control form-control-lg" id="title" name="title[{{ $policy->id }}]" value="{{ $policy->value }}">
                                        </div>
                                   </div>
                              @endif     
                         @endforeach     
                         @foreach($privacyPolicys as $policy)
                              @if($policy->key === 'description')     
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="long-description"></label>
                                             <textarea id="long-description" name="description[{{ $policy->id }}]">{{$policy->value}}</textarea>
                                        </div>
                                   </div>
                              @endif     
                         @endforeach  
                              <hr>
                              <h5>Privacy Policy</h5>  
                              <hr>
                              <h6>Privacy Notice Section</h6>
                        
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   @foreach($privacyPolicys as $policy)
                                        @if($policy->key === 'main_heading') 
                                             <div class="col-md-8">
                                                  <div class="form-group">
                                                       <label class="form-label" for="main_heading">Main Heading</label>
                                                       <input type="text" class="form-control" id="main_heading" name="main_heading[{{ $policy->id }}]" value="{{ $policy->value }}">
                                                  </div>
                                             </div>
                                             @elseif($policy->key === 'sub_heading')
                                             <div class="col-md-8">
                                                  <div class="form-group">
                                                       <label class="form-label" for="sub_heading">Sub Heading</label>
                                                       <input type="text" class="form-control" id="sub_heading" name="sub_heading[{{ $policy->id }}]" value="{{$policy->value}}">
                                                  </div>
                                             </div>
                                        @endif 
                                   @endforeach 
                              </div>     
                         </div>  
                            
                         <div class="col-md-8 mt-2">
                              <div class="form-group" id="terms_section">
                                   <label class="form-label" for="main_heading">Privacy Policy</label>
                              </div>
                         </div>      
                         <div class="card card-bordered card-preview mt-2">     
                              @foreach($privacyPolicys as $policy)
                                   @if($policy->key === 'privacy_policie')
                                        <div class="append-sec">
                                             <div class="row gy-4">
                                                  <div class="col-md-5">
                                                            <div class="form-group">
                                                            <label class="form-label" for="terms">Terms</label>
                                                            <input type="text" class="form-control form-control" id="terms" name="terms[{{ $policy->id }}]" value="{{$policy->terms}}">
                                                       </div>
                                                  </div> 
                                                  <div class="col-md-5">
                                                  <div class="form-group">
                                                       <label class="form-label" for="condition_{{ $loop->index }}">Condition</label>
                                                       <textarea class="form-control add-editor" id="condition_{{ $loop->index }}" name="condition[{{ $policy->id }}]">{{ $policy->condition }}</textarea>
                                                  </div>
                                             </div>
                                             </div>
                                             <div class="col-md-2 offset-md-10">
                                                  <div class="form-group">
                                                       <div class=""><span class="removeTerms" data-id="{{$policy->id}}"><i class="fa fa-times"></i></span></div>
                                                  </div>
                                             </div>
                                        </div>
                                   @endif
                              @endforeach     
                              <br>
                              <div class="col-md-3 offset-md-9 mb-2">
                                   <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-primary" id="addnewrow">Add Row</button>
                                   </div>
                              </div>
                              <div id="termCondition-section">
                              </div>
                         </div>
                    </div>
               </div>
               <div class="mt-3">
                    <button class="btn btn-primary save-and-remove-btn" type="submit">Save</button>
               </div>
               @else
                    <p>No Found data</p>
               @endif     
             
          </form>
     </div>
</div>

<script>
    // Initialize the ClassicEditor for the long description
    ClassicEditor
        .create(document.querySelector('#long-description'))
        .catch(error => console.error(error));

    $(document).ready(function () {
        let rowIndex = {{ count($privacyPolicys) }}; // Start from the existing number of rows

        // Initialize ClassicEditor for existing condition fields
        $('.add-editor').each(function() {
            ClassicEditor
                .create(this)
                .catch(error => console.error(error));
        });

        $('#addnewrow').click(function () {
            rowIndex++;
            const newRowHtml = createRowHtml(rowIndex);
            $('#termCondition-section').append(newRowHtml);

            // Initialize ClassicEditor for the new condition textarea
            ClassicEditor
                .create(document.querySelector(`#new_condition_${rowIndex}`))
                .catch(error => console.error(error));

            // Attach the click event to remove terms
            attachRemoveEvent();
        });

        // Attach click event for existing remove buttons
        attachRemoveEvent();
    });

    // Function to create new row HTML
    function createRowHtml(index) {
        return `
            <div class="append-sec" id="term-row-${index}">
                <hr>
                <div class="row gy-4">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label" for="new_terms_${index}">Terms</label>
                            <input type="text" class="form-control" id="new_terms_${index}" name="terms[]" value="">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="form-label" for="new_condition_${index}">Condition</label>
                            <textarea class="form-control add-editor" id="new_condition_${index}" name="condition[]"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 offset-md-10">
                    <div class="form-group">
                        <span class="removeTerms"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>`;
    }

    // Function to attach click event to remove buttons
    function attachRemoveEvent() {
        $('.removeTerms').off('click').on('click', function () {
            $(this).closest('.append-sec').remove();
        });
    }
let idsToRemove = []; 
$('.removeTerms').click(function(){
     
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
$('.save-and-remove-btn').click(function(e) {
//     e.preventDefault();
    
    if (idsToRemove.length > 0) {
        $.ajax({
            url: "{{url('/admin-dashboard/privacy-policy-remove')}}",  // Replace with your correct route
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
</script>



@endsection