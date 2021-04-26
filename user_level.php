<?php

////// Il nome dell'utente è dichiarato con la variabile $welcome_user_new

// imposto l'user loggato per la query
	$curr_user = strtolower($welcome_user_new);

// Controllo se i dati di login sono nel database
	$user_sel = mysql_select_db($db_database)or die(mysql_error());
	$user_query = "SELECT * FROM login WHERE username = '".$curr_user."'"; 
	$user_action = mysql_query($user_query)or die(mysql_error()); 
	$user_number = mysql_num_rows($user_action);
		
	$us=0;	
		
	while ($user_number > $us) {
		$curr_user_level = mysql_result($user_action,$us,"livello");
		
		$us++;
	}
				
?>