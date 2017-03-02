var dt;
var i = 0;
function loadData () {
	perpage = 15;
	if(i>Math.ceil(dt.length/perpage)-1){ i = 0; }
    $('.dataTable').fadeOut(50);
    var stable = "<tr> \
                    <th style='vertical-align: middle;' rowspan=\"2\" class=\"text-center\" >Nomor Urut</th> \
                    <th style='vertical-align: middle;' rowspan=\"2\" class=\"text-center\" >Uraian</th> \
                    <th colspan=\"2\" class=\"text-center\" >Jumlah(Rp)</th> \
                    <th colspan=\"2\" class=\"text-center perubahan\" >Bertambah/Berkurang</tr> \
                </tr> \
                <tr> \
                    <th class=\"text-center perubahan\" >Sebelum<br />Perubahan</th> \
                    <th class=\"text-center perubahan\" >Sesudah<br />Perubahan</th> \
                    <th class=\"text-center perubahan\" >(Rp)</th> \
                    <th class=\"text-center perubahan\" >%</th> \
                </tr>";
    $('.dataTable').html(stable).fadeIn(1000);
    if(kodeakun = 5){
      	stable = "<tr style='font-weight:bold;'> \
                   	<td></td> \
                   	<td align='right'>Jumlah Pendapatan</td> \
                   	<td align='right' data-koderek='4' data-val='0' class='apbd'></td> \
                   	<td align='right' data-koderek='4' data-val='0' class='apbdp perubahan'></td> \
                   	<td align='right' data-koderek='4' data-val='0' class='selisih perubahan'></td> \
                   	<td align='center' data-koderek='4' data-val='0' class='persen perubahan'></td> \
                </tr>";
    } else if(kodeakun = 6){
      	stable = "<tr style='font-weight:bold;'> \
				   <td></td> \
				   <td align='right'>Jumlah Belanja</td> \
				   <td align='right' data-koderek='5' data-val='0' class='apbd'></td> \
				   <td align='right' data-koderek='5' data-val='0' class='apbdp perubahan'></td> \
				   <td align='right' data-koderek='5' data-val='0' class='selisih perubahan'></td> \
				   <td align='center' data-koderek='5' data-val='0' class='persen perubahan'></td> \
				   </tr>";
		stable = "<tr style='font-weight:bold;'>\
				   <td></td>\
				   <td align='right'>Surplus/(Defisit)</td>\
				   <td align='right' data-koderek='SD' data-val='0' class='apbd'></td>\
				   <td align='right' data-koderek='SD' data-val='0' class='apbdp perubahan'></td>\
				   <td align='right' data-koderek='SD' data-val='0' class='selisih perubahan'></td>\
				   <td align='center' data-koderek='SD' data-val='0' class='persen perubahan'></td>\
				   </tr>";
    } else if(kodeakun = 6.2){
    	stable = "<tr style='font-weight:bold;'>\
				   <td></td>\
				   <td align='right'>Jumlah Penerimaan Pembiayaan</td>\
				   <td align='right' data-koderek='6.1' data-val='0' class='apbd'></td>\
				   <td align='right' data-koderek='6.1' data-val='0' class='apbdp perubahan'></td>\
				   <td align='right' data-koderek='6.1' data-val='0' class='selisih perubahan'></td>\
				   <td align='center' data-koderek='6.1' data-val='0' class='persen perubahan'></td>\
				   </tr>";
    }

    var j = i*perpage;
    var end = j+perpage;
    var fn = function(){
      if(j<dt.length){
        no = j+1;
        var row = dt[j];
        var selisih = row.nilaianggaran - row.nilaianggaran_p;
        if(selisih < 0){
        	var nilaiselisih = "("+selisih+")";
        } else {
        	var nilaiselisih = selisih;
        }
          	stable = "<tr> \
				   		<td class='text-center'>"+row.kodeakun+"</td> \
				   		<td>"+row.namaakun+"</td> \
				   		<td align='right' data-koderek='"+row.kodeakun+"' data-val='"+row.nilaianggaran+"' class='apbd'>"+row.nilaianggaran+"</td> \
				   		<td align='right' data-koderek='"+row.kodeakun+"' data-val='"+row.nilaianggaran_p+"' class='apbdp perubahan'>"+row.nilaianggaran_p+"</td> \
				   		<td align='right' data-koderek='"+row.kodeakun+"' data-val='0' class='selisih perubahan'>"+nilaiselisih+"</td> \
				  		<td align='center' data-koderek='"+row.kodeakun+"' data-val='0' class='persen perubahan'></td> \
				   	</tr>";
              	$(stable).hide().appendTo(".dataTable").fadeIn(150).queue(function(){
                	$(this).dequeue();
                		if( ++j < end ){
                     	fn();
                	}
            	}); 
      		}        
    	};
    fn();
    i++;
}
$.getJSON("data/table.php", function( data ) { 
    dt = data;

    loadData();
    setInterval(function() {
      	loadData();
    }, 10000);   

});