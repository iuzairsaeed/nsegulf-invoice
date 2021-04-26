<?PHP
if($_GET['cardid']==true){
	    include_once('adminCheck.php');
		require("db_config.php");
		require("db.php");
		$sel="delete from cards where ID ='".$_GET['cardid']."';";
		$selr=mysql_query($sel);
		$sel2="delete from delivery where cardid ='".$_GET['cardid']."';";
		$sel2r=mysql_query($sel2);
		$sel3="delete from invoice where card_id ='".$_GET['cardid']."';";
		$sel3r=mysql_query($sel3);
		$sel4="delete from services where cardid ='".$_GET['cardid']."';";
		$sel4r=mysql_query($sel4);
		
		header("Location:del_card1.php");
}else{
	echo "You did not specify any job card";
}

?>
