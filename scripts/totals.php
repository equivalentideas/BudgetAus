<?php
$total_last_calc = mysql_query("SELECT last,sum(last) FROM budget_table2"); //totals all funding spent in the prior budget year
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(last)').""; //assigns the total of all funding in prior year to the variable $total_last


$total_current_calc = mysql_query("SELECT current,sum(current) FROM budget_table2"); // totals all funding spent in current budget year
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(current)').""; //assigns total of all funding in prior year to variable $total_current

?>