<script>
    $(document).ready(function() {  
        
        $("#tampil").click(function(){
            
            var tahun = $("#tahun").val();
            $(this).attr('disabled','disabled');
            $('#canvas-data').html('<img src="img/ajax-loader.gif"> Loading data...');
            $.ajax({
                type:"POST",
                url: "?pg=laporan&mode=ambil_datalibur",
                data: "tahun="+tahun,
                cache: false,
                success: function(msg){
                    
                    $("#canvas-data").html(msg);
                    $("#tampil").removeAttr('disabled');
                }
            });
        });
        $("#cetak").click(function(){
            
            var tahun = $("#tahun").val();
            url = '&tahun='+tahun
            window.open("?pg=laporan&mode=cetak_libur"+url, "_blank");
        })
    });
</script>
<div class="navclue abu-abu">
	<div class="clue"><a href="#">LAPORAN HARI LIBUR</a></div>
</div>
<form id="periode" method="post" >
<div class="canvas-content">
	<div class="ket">
    	<table class="tabket">
        	<tr><td class="td1">Tahun</td><td>: <?php echo "".$this->optTahun($_POST["tahun"]).""; ?></td></tr>
        </table>
        
    </div>
    <div class="nav-table">
    	<div class="ll">
            <input type="button" class="button biru" value="Tampilkan" id="tampil"/>
            <input type="button" class="button biru" value="Cetak" id="cetak"/>
        </div>
    </div>
	<br /><br />
    <div id="canvas-data">
    
    </div>