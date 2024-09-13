$(document).ready(function(){
	//$("#menu-item-149 >a").addClass("start");
	//$("#menu-footer-menu-1 >li >a").removeClass("nav-link");
	//$("#menu-footer-menu-2 >li >a").removeClass("nav-link");
	//$("#menu-item-200 >a").removeClass("nav-link");
    $("#login_form").validate({
      rules: {
         login_email: {
            required: true,
            email: true,//add an email rule that will ensure the value entered is valid email id.
            maxlength: 255,
         },
         login_password: 'required',
      },
	  messages:{
		login_email: {
            required: 'Por favor, introduzca su dirección de correo electrónico',
			email:'Por favor, introduce una dirección de correo electrónico válida.',
			maxlength:'Por favor ingrese no más de 255 caracteres.',
        }, 
		login_password: {
            required: 'Por favor, introduzca su contraseña',
        }, 
	  }
   });
	$('#login_submit').click(function(event){
		event.preventDefault();
		if ($('#login_form').valid()) {
			var login_email=$('#login_email').val();
			var login_pass=$('#login_password').val();
				let formdata=$('#login_form').serialize();
				/*alert(formdata);*/
				$.ajax({
					url:ajaxfile.ajaxurl,
					type:'post',
					data:formdata,
					beforeSend: function(){
						$('.loader').addClass('active');
						$('.woocommerce-notices-wrapper').remove();
					},
					complete: function(){
						$('.loader').removeClass('active');
					},
					success:function(response){
						if(response.type === true){
							window.location.replace(response.url);
						}else{
							$('<div class="woocommerce-notices-wrapper"><ul class="woocommerce-error" role="alert"><li><strong>Error:</strong> '+response.msg+'</li></ul></div>').insertBefore(".login-form");
						}					 						
				}
			});
		}
						
	});
	
   $("#register_form").validate({
		rules: {
		   username: 'required',
		   register_email: {
		   required: true,
		   email: true,//add an email rule that will ensure the value entered is valid email id.
		   maxlength: 255,
		   },
		      register_password: 'required',
		},
   });
   $('#register_submit').click(function(event){
      event.preventDefault();
      if($('#register_form').valid()) {
	        let registerdata=$('#register_form').serialize();
	        /*alert(registerdata);*/
	        $.ajax({
	        	url:ajaxfile.ajaxurl,
	        	type:'post',
	        	data:registerdata,
	        	beforeSend: function(){
					$('.loader').show();
				},
				complete: function(){
					$('.loader').hide();
				},
	        	success:function(response){
	        		if(response.type === true){
	        			window.location.replace(response.url);
					}else{
						alert(response.msg);
				}
        	}
    	 });
     }
   });
   
  
	$(document).on('change','input[name="payment_method"]',function(){
		var payment_method = $(this).val();
		if(payment_method == 'ppcp-gateway'){
			$('#place_order_1').hide();
		}else{
			$('#place_order_1').show();
		}
	});
	
	$(document).on('click','.custom_subscribe_button',function(e){
		e.preventDefault();
		if($(this).hasClass('active_subscription')){
			alert('You already have an active subscription!');
		}else{
			$(this).addClass('subcription_active_button');
			var p_id = $(this).attr('data-id');
			$.ajax({
				url:ajaxfile.ajaxurl,
				type:'post',
				data:{
					action: 'add_subscription_product_to_cart',
					product_id: p_id
				},
				beforeSend: function(){
					$('.subcription_active_button').prop('disabled',true);
				},
				complete: function(){
					$('.subcription_active_button').prop('disabled',false);
				},
				success:function(response){
					if(response.success === true){
						window.location.replace(response.url);
					}else{
						alert(response.msg);
					}
				}
			});
		}
	})
	
	$('button.navbar-toggler.btn-ord').click(function(e){
		e.preventDefault();
		$('.mobile_header_side_bar').addClass('active');
		$('body').addClass('menu-open');
	})
	
	$('._GtzsW._Gv2_B,.__z_48').click(function(){
		$('button.navbar-toggler.btn-ord').removeClass('open');
		$('.mobile_header_side_bar').removeClass('active');
		$('.mobile_header_side_bar_right').removeClass('active');
		$('body').removeClass('menu-open');
	});
	
	$('.col-md-3.mobile_menu_user a').click(function(e){
		e.preventDefault();
		$('.mobile_header_side_bar_right').addClass('active');
		$('body').addClass('menu-open');
	})
	
	$(document).on('click','div.woocommerce-checkout-payment ul.wc_payment_methods li.wc_payment_method',function(){
		if(!$(this).find('input[name="payment_method"]').is(':checked')){
			$(this).find('input[name="payment_method"]').trigger('click');
		}		
	});
	
});


jQuery(window).on('load',function(){
	var payment_method = jQuery('input[name="payment_method"]:checked').val();
	if(payment_method == 'ppcp-gateway'){
		jQuery('#place_order_1').hide();
	}else{
		jQuery('#place_order_1').show();
	}
	setTimeout(function(){
			var payment_method = jQuery('input[name="payment_method"]:checked').val();
			if(payment_method == 'ppcp-gateway'){
				jQuery('#place_order_1').hide();
			}else{
				jQuery('#place_order_1').show();
			}
	},2000);
});


$('.rename-title').click(function(e){
 var show_doc_id = $(this).attr("doc-id"); 
    $('#'+show_doc_id).slideToggle();
})

$('.save-doc-title').click(function(e){
    var inp_doc_id = $(this).attr("inp-doc-id"); 
    var doc_id = $('#'+inp_doc_id).attr('doc-title-id');
    var doc_title = $('#'+inp_doc_id).val();
    jQuery.ajax({
				type: 'POST',
				url: frontendajax.ajaxurl,
				data: {
					saved_doc_id:doc_id,
                    doc_title:doc_title,
					action:'update_document_title',
				},
				dataType: 'json',				
				success: function(response){
					if(response){
						location.reload();
					}
				}
			});
})


$('.completed-rename-title').click(function(e){
 var show_doc_id = $(this).attr("doc-id"); 
    $('#'+show_doc_id).slideToggle();
})

$('.completed-save-doc-title').click(function(e){
    var inp_doc_id = $(this).attr("inp-doc-id"); 
    var doc_id = $('#'+inp_doc_id).attr('doc-title-id');
    var doc_title = $('#'+inp_doc_id).val();
    jQuery.ajax({
				type: 'POST',
				url: frontendajax.ajaxurl,
				data: {
					saved_doc_id:doc_id,
                    doc_title:doc_title,
					action:'update_document_title_completed_orders',
				},
				dataType: 'json',				
				success: function(response){
					if(response){
						location.reload();
					}
				}
			});
})

$('div#saved_document_pop .modal-header button.close ').click(function(){
		$('#saved_document_pop').modal('hide');
	});

$(document).on('click','.show_svdoc_pop',function(e){
	e.preventDefault();
    var first_button_link = $(this).attr('data-saved-url-satrtinit');
    var second_button_link = $(this).attr('data-saved-url-startsaved');	
    $("#saved_document_pop #from_first_sheet").attr("href", first_button_link);
    $("#saved_document_pop #from_saved_sheet").attr("href", second_button_link);
    $('#saved_document_pop').modal('show');    
});
