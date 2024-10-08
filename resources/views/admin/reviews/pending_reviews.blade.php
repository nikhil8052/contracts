@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <div class="nk-content-inner">
               <div class="nk-content-body">
                    <div class="components-preview wide-md mx-auto">
                         <div class="nk-block nk-block-lg">
                         <div class="nk-block-head">
                              <div class="nk-block-head-content">
                                   <h4 class="nk-block-title">Pending Reviews</h4>
                              </div>
                         </div>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <table class="table">
                                   @if(isset($reviews) && $reviews->isNotEmpty())
                                        <thead>
                                             <tr>
                                             <th scope="col">Author</th>
                                             <th scope="col">Rating</th>
                                             <th scope="col">Review</th>
                                             <th scope="col">Review Item</th>
                                             <th scope="col">Action</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @foreach($reviews as $data)
                                             <tr>
                                             <td>{{ $data->first_name ?? '' }} {{ $data->last_name ?? '' }}</td>
                                             <td>
                                             @if(isset($data->rating) && $data->rating != null)
                                                  <div id="full-stars-example-two">
                                                       <div class="ratings">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                 <label for="rating{{ $i }}">
                                                                 <i rate="{{ $i }}" class="star fa fa-star {{ $data->rating >= $i ? 'rating-color' : '' }}"></i>
                                                                 </label>
                                                                 <input name="rating" id="rating{{ $i }}" class="chkbox" style="display:none;" value="{{ $i }}" {{ $data->rating == $i ? 'checked' : '' }}>
                                                            @endfor
                                                       </div>
                                                  </div>
                                             @endif
                                             </td>
                                             <td>{{ $data->description ?? '' }}</td>
                                             <td>{{ $data->document->title ?? '' }}</td>
                                             <td>
                                                  <a class="approve" data-value="approve" data-id="{{ $data->id ?? '' }}"><span class="text text-primary">Approve</span></a><br>
                                                  <a onclick="rejectReview({{ $data->id ?? '' }})"><span class="text text-primary">Reject</span><a><br>
                                                  <a href="{{ url('admin-dashboard/edit-review/'.$data->id) }}"><span class="text text-primary">Edit</span><a>
                                             </td>
                                             </tr>
                                             @endforeach
                                        </tbody>
                                   @else
                                   <p>No reviews yet.</p>
                                   @endif
                                   </table>
                              </div>
                         </div><!-- .card-preview -->
                         </div><!-- .nk-block -->
                    </div><!-- .components-preview -->
               </div>
          </div>
     </div>
</div>

<script>
     $(document).ready(function(){
          $('.approve').click(function(){
               var data={
                    value: $(this).data('value'),
                    id: $(this).data('id'),
                    _token: "{{ csrf_token() }}"
               }

               $.ajax({
                    url: "{{ url('/admin-dashboard/publish-review') }}",
                    type: "post",
                    data: data,
                    dataType: "json",
                    success: function(response){
                         if(response.status == 'approve' && response.code == 200){
                              NioApp.Toast('Review Approved', 'success', {position: 'top-right'});
                              setTimeout(() => {                        
                                   location.reload();  
                              }, 1000);
                         } 
                    }
               })
          })
     })


     function rejectReview(id){
          var data={
               id: id,
               _token:"{{ csrf_token() }}"
          }
          $.ajax({
               url: "{{ url('/admin-dashboard/reject-reviews') }}",
               type: "post",
               data: data,
               dataType: "json",
               success: function(response){
                    if(response.satus == 'success' && response.code == 200){
                         NioApp.Toast('Review Rejected', 'error', {position: 'top-right'});
                         setTimeout(() => {                        
                              location.reload();  
                         }, 1000);    
                    }
               }
          })
     }
</script>

@endsection