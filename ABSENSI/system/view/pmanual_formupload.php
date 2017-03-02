<style type="text/css">
#upload{
    font-family:Arial;
    width:100px;
    color:#C30;
    cursor:pointer !important;
# edit
}
</style>
<script type="text/javascript" src="js/jquery.chained.js"></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script  type="text/javascript" language="javascript">
$(function(){
        var btnUpload=$('#upload');
        var status=$('#status'); 
        new AjaxUpload(btnUpload, {
            action: '?pg=upload&mode=upload_file',
            name: 'uploadfile',
            onSubmit: function(file, ext){
                 if (! (ext && /^(dat)$/.test(ext))){ 
                    status.text('Hanya File Ekstensi dat yang di ijinkan');
                    return false;
                } 
                status.html('<img src="img/ajax-loader.gif" />');
            }, 
            onComplete: function(file, response){
                status.text(''); 
                $("#file").val('');
                if(response=="success"){
                    $("#file").val('<?php echo $this->user['id_user'].'-';?>'+file);
                    status.html('<img src="img/attach-icon.png"/> <label for="file_name">'+file+'</label>');
                } else{ 
                    status.html('Data gagal diupload : '+response);
                }
            }
        });
        
});
$(document).ready(function(){
    $("#proses").click(function(){
            var kodeskpd = $("#optskpd").val();
            var noalat = $("#noalat").val();
            var file = $("#file").val();
            var txt = '';
            $(this).attr('disabled','disabled');
            $('.auth').hide();
            $('.auth-warning').html('<img src="img/ajax-loader.gif"> Sedang memproses data...');
            $('.auth-warning').fadeIn('fast');
            
            if(file == ''){
                txt = 'File Masih Kosong'
            }
            if(noalat == null){
                txt = 'Alat Masih Kosong';
            }
            if(kodeskpd == ''){
                txt = 'Kode SKPD Masih Kosong';
            }

            if(txt != ''){
                $('.auth').hide();
                $('.auth-error').html(txt);
                $('.auth-error').fadeIn('slow');
                $("#proses").removeAttr('disabled');
                return false;
            }
            $.ajax({
                type:"POST",
                url: "?pg=upload&mode=prosesdata",
                data: "idMesin="+noalat+"&kodeskpd="+kodeskpd+"&file="+file,
                cache: false,
                success: function(msg){
                    $('.auth').hide();

                    switch(msg){
                        case 'success':
                            $('.auth-success').html('Upload Data Presensi Berhasil');
                            $('.auth-success').fadeIn('slow');
                        break;
                        case 'error':   
                            $('.auth-error').html('Upload Data Presensi Gagal');
                            $('.auth-error').fadeIn('slow'); 
                        break;
                        case 'fail':
                            $('.auth-error').html('Data tidak sesuai dengan SKPD');
                            $('.auth-error').fadeIn('slow');
                        break;
                        default:
                            $('.auth-error').html('Anomali :'+msg);
                            $('.auth-error').fadeIn('slow');
                        break;    

                    }
                    
                    /*
                    if(msg == 'success'){
                        $('.auth-success').html('Upload Data Presensi Berhasil');
                        $('.auth-success').fadeIn('slow');
                    }
                    if(msg == 'error'){
                        $('.auth-error').html('Upload Data Presensi Gagal');
                        $('.auth-error').fadeIn('slow');
                    }
                    if(msg == 'fail'){
                        
                        $('.auth-error').html('Data tidak sesuai dengan SKPD');
                        $('.auth-error').fadeIn('slow');
                    }
                    */
                    
                    $("#proses").removeAttr('disabled');
                    $('#status').html(''); 
                    $("#file").val('');
                }
            });
        });
	$("#noalat").chained("#optskpd");
});
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">UPLOAD FILE DARI MESIN</a></div>
</div>
<div class="canvas-content">
	<form method="post" id="formapp" enctype="multipart/form-data" action="?pg=upload&mode=datausb">
    <table class="form" width="100%" cellpadding="0" cellspacing="0">
    <tr><td width="150px">SKPD</td><td><?php echo "".$this->optSKPD($this->user['kodeskpd']).""; ?></td></tr>
    <tr><td width="150px">No. Alat</td><td><select name="idMesin" id="noalat"><?php echo "".$this->optMesin().""; ?></select></td></tr>
    <tr><td width="150px">File</td><td><div id="upload" ><img src="img/bt_upload_file.png" /></div></td></tr>
    <tr><td height="20px"></td><td><div id="status"></div></td></tr>
    <tr><td colspan="2">
        <input type="hidden" id="file" value=""/>
    	<input type="button" id="proses" class="button biru" value="Upload"/>
        
    </td></tr>
    
    </table>
    </form>
    <div class="auth auth-success"></div>
    <div class="auth auth-warning"></div>
    <div class="auth auth-error"></div>
</div>