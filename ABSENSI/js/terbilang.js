/*
 * FUNGSI NUMERIK KE TERHITUNG (JAVASCRIPT)
 * (c) 2008-2010 by amarullz@yahoo.com
 * modified 2013 by culis
 */
 
function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
function terbilang_get_valid(str,from,to,min,max){
		if (!min) min=1;
		if (!max) max=9;
    val=false;
    from=(from<0)?0:from;
    for (i=from;i<to;i++){
        if ((Number(str[i])>=min)&&(Number(str[i])<=max)) val=true;
    }
    return val;
}
function terbilang_get_str(i,str,len){
    numA=new Array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
    numB=new Array("","se","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
    numC=new Array("","satu ","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
    numD=new Array();
    numD[0]="puluh";
    numD[1]="belas";
    numD[2]="ratus";
    numD[4]="ribu";
    numD[7]="juta";
    numD[10]="milyar";
    numD[13]="triliun";
    
    buf="";
    pos=len-i;
    switch(pos){
        case 1:
                if (!terbilang_get_valid(str,i-1,i,1,1))
                    buf=numA[Number(str[i])];
            break;
        case 2: case 5: case 8: case 11: case 14:
                if (Number(str[i])==1){
                    if (Number(str[i+1])==0)
                        buf=(numB[Number(str[i])])+(numD[0]);
                    else
                        buf=(numB[Number(str[i+1])])+(numD[1]);
                }
                else if (Number(str[i])>1){
                        buf=(numB[Number(str[i])])+(numD[0]);
                }
            break;
        case 3: case 6: case 9: case 12: case 15:
                if (Number(str[i])>0){
                        buf=(numB[Number(str[i])])+(numD[2]);
                }
            break;
        case 4: case 7: case 10: case 13:
                if (terbilang_get_valid(str,i-2,i,1,9)){
                    if (!terbilang_get_valid(str,i-1,i,1,1))
                        buf=numC[Number(str[i])]+(numD[pos]);
                    else
                        buf=numD[pos];
                }
                else if(Number(str[i])>0){
                    if (pos==4)
                        buf=(numB[Number(str[i])])+(numD[pos]);
                    else
                        buf=(numC[Number(str[i])])+(numD[pos]);
                }
            break;
    }
    return buf;
}
function toTerbilang(nominal){
    buf="";
    str=nominal+"";
    len=str.length;
	if (nominal!=0) {
		for (i=0;i<len;i++){
			buf=trim(buf)+" "+terbilang_get_str(i,str,len);
		}
		return trim(buf)+" rupiah";
	} else return "nol";
    
}