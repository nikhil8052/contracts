@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/save/messages') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="page_type">Select Page</label>
                                   <select class="form-select page_type" id="page_type" name="page_type" tabindex="-1" aria-hidden="true">
                                        <option value="" disabled selected>Select</option>
                                        <option value="login">Login</option>
                                        <option value="register">Register</option>
                                        <option value="contact">Contact us</option>
                                   </select>
                                   @error('document')
                                   <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <br>
                         <div class="login_message_fields" style="display:none;">
                              <div class="card card-bordered card-preview">
                                   <div class="card-inner">
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="incorrect_username">Incorrect username</label>
                                                  <input type="text" class="form-control" id="incorrect_username" name="incorrect_username" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="incorrect_password">Incorrect password</label>
                                                  <input type="text" class="form-control" id="incorrect_password" name="incorrect_password" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="google_login_error">Login with Google error</label>
                                                  <input type="text" class="form-control" id="google_login_error" name="google_login_error" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="fb_login_error">Login with Facebook error</label>
                                                  <input type="text" class="form-control" id="fb_login_error" name="fb_login_error" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="success_message">Success message</label>
                                                  <input type="text" class="form-control" id="success_message" name="success_message" value="">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="register_message_fields" style="display:none;">
                              <div class="card card-bordered card-preview">
                                   <div class="card-inner">
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="required_field_msg">Required fields</label>
                                                  <input type="text" class="form-control" id="required_field_msg" name="required_field_msg" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="invalid_email_error">Invalid email error</label>
                                                  <input type="text" class="form-control" id="invalid_email_error" name="invalid_email_error" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="unique_email">Unique email</label>
                                                  <input type="text" class="form-control" id="unique_email" name="unique_email" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="register_success_msg">Success message</label>
                                                  <input type="text" class="form-control" id="register_success_msg" name="register_success_msg" value="">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="contact_message_fields" style="display:none;">
                              <div class="card card-bordered card-preview">
                                   <div class="card-inner">
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="required_field">Required fields</label>
                                                  <input type="text" class="form-control" id="required_field" name="required_field" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="image_field_error">Image field error</label>
                                                  <input type="text" class="form-control" id="image_field_error" name="image_field_error" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="recaptcha_error">Recaptcha error</label>
                                                  <input type="text" class="form-control" id="recaptcha_error" name="recaptcha_error" value="">
                                             </div>
                                             <div class="form-group">
                                                  <label class="form-label" for="contact_success_msg">Success Message</label>
                                                  <input type="text" class="form-control" id="contact_success_msg" name="contact_success_msg" value="">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Save</button>
               </div>
          </form>
     </div>
</div>

<script>

     $(document).ready(function(){
          $('.page_type').on('change',function(){
               if($(this).val() === 'login'){
                    $('.login_message_fields').show();
                    $('.register_message_fields').hide();
                    $('.contact_message_fields').hide();
               }else if($(this).val() === 'register'){
                    $('.login_message_fields').hide();
                    $('.contact_message_fields').hide();
                    $('.register_message_fields').show();
               }else if($(this).val() === 'contact'){
                    $('.register_message_fields').hide();
                    $('.login_message_fields').hide();
                    $('.contact_message_fields').show();
               }
          })
     })

</script>

@endsection

