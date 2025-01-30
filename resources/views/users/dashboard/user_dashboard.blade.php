@extends('users_layout.master')
@section('content')

<section class="check_out odr_sec">
     <div class="container">  
          <div class="btn_div">
               <button type="button" class="generate_pdf">Generate Pdf</button>
          </div>
     </div>
     <input type="hidden" id="document_id" value="{{ $document_id ?? '' }}">
</section>

<script>
     $(document).ready(function(){
          $('.generate_pdf').click(function(e){
               e.preventDefault();
               let document_id = $('#document_id').val();
               let baseUrl = "{{ url('/') }}";
               let url = baseUrl + "/generate-pdf?id=" + document_id;
               location.href = url;
          })
     })
</script>

@endsection