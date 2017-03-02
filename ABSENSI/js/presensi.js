var checksum = 0;
var x = 0;
$(document).ready(function() { 
	$('.numberonly').keypress(function(event) {
			var charCode = (event.which) ? event.which : event.keyCode
			if ((charCode >= 48 && charCode <= 57)
				|| charCode == 46
				|| charCode == 44
				|| charCode == 8
				|| charCode == 9)
				return true;
			return false;
			
	});
	$('.numberonly').keypress(function(event) {
		var rx=  /(\d+)(\d{3})/;
   		return String($(this).val()).replace(/^\d+/, function(w){
        	while(rx.test(w)){
            w= w.replace(rx, '$1,$2');
        	}
        $(this).val(w);
    	});
	});
	$(".navmenu").hover(
        function(){
			$(this).children(".canvas-submenu").show('slow');
		},
		function(){
			$(this).children(".canvas-submenu").hide();
		}
    );
	
	
	$("#checkall").click(function(){
			c = $(".cb");
			x = 0;
			
			checked = $(this).attr('checked');
			stat = (checked == 'checked')?true:false;
			color = (checked == 'checked')?'#FFD5AA':'#FFFFFF';
			
			for(i = 0; i < c.length; i++){
				
					c[i].checked = checked;
					$($(".cb")[i]).closest('tr').css("background-color",color);
					subkeg = $($(".cb")[i]).attr("alt");
					$("."+subkeg).css("background-color",color);
					if(stat){
					x++
					}
				
			}
			checksum = x;
	});
	
	$(".cb").click(function(){
			x = 0;
			checkall = $("#checkall");
			act = false;
			for(i=0;i<$(".cb").length;i++){
				subkeg = $($(".cb")[i]).attr("alt");
				if($(".cb")[i].checked){
					$($(".cb")[i]).closest('tr').css("background-color","#FFD5AA");
					$("."+subkeg).css("background-color","#FFD5AA");
					x++
					act = true;
				}else{
					$("."+subkeg).css("background-color","#FFFFFF");
					$($(".cb")[i]).closest('tr').css("background-color","#FFFFFF");
				}
			}
			stat = ($(".cb").length == x)?true:false;
			checksum = x;
			if(stat){
				$("#checkall").attr('checked','checked');
			}else{
				$("#checkall").removeAttr('checked');
			}
	});
})