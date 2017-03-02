/*	
 * Javascript Config.
 * Created by Eren Alba Kaunang
 * Copyright 2012 Global Intermedia
 *
 **/
 
window.onload = function(){
	$.config.animation();
	$.config.changeColor();
	$.config.authFormLogin();
}
jQuery.config = {
	
	activeColor : 'merah',
	changeColor :
		function(){
			$($.object.buttonChangeColor).each(function(){
				$(this).click(function(){
					$('.'+$.config.activeColor).removeClass($.config.activeColor).addClass(this.name);
					$('.bor-bot-'+$.config.activeColor).removeClass('bor-bot-'+$.config.activeColor).addClass('bor-bot-'+this.name);
					$('.bor-top-'+$.config.activeColor).removeClass('bor-top-'+$.config.activeColor).addClass('bor-top-'+this.name);
					$('.f'+$.config.activeColor).removeClass('f'+$.config.activeColor).addClass('f'+this.name);
					$.config.activeColor = this.name;
				});
			});
		},
	
	animation : 
		function(){
			$($.object.wrapper).fadeIn(500);
			
			setTimeout(function(){
				$($.object.header).animate({marginTop:0},1000);
				$($.object.middle).animate({marginTop:100},1000);
			}, 1000);
		},
	
	setAuthPosition :
		function(){
			
		},
	
	authHideNotifications :
		function(){
			$($.object.authBoxChild).hide();
			$($.object.formUsername).css('background-color','#EBEBEB');
			$($.object.formPassword).css('background-color','#EBEBEB');
		},
	
	authShowError :
		function(type){
			
			$.config.authHideNotifications();
			
			var errorText = '<img src="'+JBase+'img/error.png" alt="Icon" />';
			switch(type){
				case'name':
					errorText = errorText + 'Username masih kosong.';
					break;
				case'password':
					errorText = errorText + 'Password masih kosong.';
					break;
				case'ajax':
					errorText = errorText + $.controller.ajaxResult;
				break;
			}
			
			$($.object.authError).fadeIn('slow').html(errorText);
		},
	
	authShowSuccess :
		function(){
			$.config.authHideNotifications();
			
			var successText = 'Login sukses. Redirecting...';
			$($.object.authSuccess).fadeIn('slow').html(successText);
		},
	encryptPass :
		function(){
			$($.object.formHash).val(MD5($($.object.formPassword).val()));
			$($.object.formPassword).val('*******');
		},
	authFormLogin :
		function(){
			$($.object.formLogin).submit(function(){
				$($.object.authBox).show();
				$.config.authHideNotifications();
				$($.object.authLoading).show();
				
				
				if($($.object.formUsername).val() == ''){
					$.config.authShowError('name');
					$($.object.formUsername).css('background-color','#FFCECE');
					$($.object.formUsername).focus();
				}
				else if($($.object.formPassword).val() == ''){
					$.config.authShowError('password');
					$($.object.formPassword).css('background-color','#FFCECE');
					$($.object.formPassword).focus();
				}
				else{
					
					$.config.encryptPass();
					
					/* 
					 * Check username and password
					 * using Ajax method
					*/
					$.controller.formRegister($.object.formLoginInput);
					$.controller.ajaxUrl = '?pg=login&mode=login';
					$.controller.ajaxData = $.controller.formData + '&ajax=cek';
					$.controller.ajaxInit();
					
					if($.controller.ajaxResult != '100'){
						$.config.authShowError('ajax');
					}
					else{
						$.config.authShowSuccess();
						setTimeout(function(){
							window.location.replace("?pg=home");
						},2000);
					}
					$.controller.formDataReset();
				}
				
				return(false);
			});
		},
		
}