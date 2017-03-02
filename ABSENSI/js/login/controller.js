/*	
 * JController libraries.
 * Created by Eren Alba Kaunang
 * Copyright 2012 Global Intermedia
 *
 **/
 
jQuery.controller = {
	
	ajaxMethod : 'POST',
	ajaxInit : 
		function()
	  	{
			$.ajax({
		  		type:$.controller.ajaxMethod,
		  		url:$.controller.ajaxUrl,
		  		data:$.controller.ajaxData,
		  		cache:false,
		  		async:false,
		  		timeout:7000,
		  
		  		success: function(respon){
			  		$.controller.ajaxResult = respon;
		  		},
		  
		  		error: function(){
			  		$.controller.ajaxInit();
		  		},
			});
		},
	
	
	formData : null,
	formDataReset:
		function()
		{
			$.controller.formData = null;
		},
		
	formRegister :
		function( form )
		{
			var data = null;
			$( form ).each(function(){
				var nama = this.id;
				var value = $('#'+nama).val();
				
				data == null ?
					data = nama+'='+value :
					data = data +'&'+ nama+'='+value;
			});
			
			$.controller.formData != null ?
				$.controller.formData = $.controller.formData + '&' + data:
				$.controller.formData = data;
		},
	
	
	formDisableSubmitButton :
		function( id, time )
		{
			$(id).attr({'disabled' : 'disabled'});
			setTimeout(
				function(){
					$(id).removeAttr('disabled');
				}, time*1000
			);
		},
	
	
	windowHref :
		function( url )
		{
			window.location.href = $.config.baseUrl + url;
		},
		
	/*
	 * Konfigurasi iScroll.
	**/
	hIScroll :
		function(id)
		{
			new iScroll(id, {scrollbarClass: 'myScrollbar'});
		},
	vIScroll :
		function(id)
		{
			new iScroll(id, {snap: true, momentum: true, hScrollbar: false,});
		},
}