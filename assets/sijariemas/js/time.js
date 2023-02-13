<script language="javascript">
function timeDifference(laterdate,earlierdate) {
    
	var difference = laterdate.getTime() - earlierdate.getTime();
	var daysDifference = Math.floor(difference/1000/60/60/24);
    difference -= daysDifference*1000*60*60*24
 
    var hoursDifference = Math.floor(difference/1000/60/60);
    difference -= hoursDifference*1000*60*60
 
    var minutesDifference = Math.floor(difference/1000/60);
    difference -= minutesDifference*1000*60
 
    var secondsDifference = Math.floor(difference/1000);
	return  daysDifference;
}

	VAR laterdate = NEW Date(2000,0,1);     // 1st January 2000
	VAR earlierdate = NEW Date(1998,2,13);  // 13th March 1998
 
	document.WRITE(timeDifference(laterdate,earlierdate));
</script>