<?php
include('scripts/db.php');

if (mysql_select_db($db_database))

$agencies = mysql_result("SELECT agency from budget_table2 GROUP BY Agency ");
 $num_rows = mysql_num_rows($agencies);
 ($rows = mysql_num_rows($agencies));
     
          for ($j = 0 ; $j < $rows ; ++$j)
		  
		  echo
		  "<p><a href='estimated_v_actual.php?agency=".mysql_result($agencies, $j, 'agency')."'>".mysql_result($agencies, $j, 'agency')."</a></p>";
?>
 