<!--  jquery core -->
<script src="serverscheck_js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>
<div id='ports_status' align='left'>Loading.....</div>
<script>
function getPortStatus(){
	$.post('ajax.php', {action: "getPortStatus"}, function (data){
		$("#ports_status").html(data);
		time = 5*1000;
	    setTimeout(function(){getPortStatus()}, time);
	});
}
getPortStatus();
</script>