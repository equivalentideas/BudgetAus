<?php

{
$agency = $_GET['agency']; 
}

////////////////////////////////////////////////


include('scripts/tax_totals.php');

   
$query_total_last = mysql_query("SELECT last,sum(last) from budget_table2 
WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) group by '$agency' ");//calculates total funding for the prior budget year for agencies where search term forms part of their name
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)')."";//assigns this value to a variable.
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from  budget_table2
 WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) group by  '$agency'");//calculates total funding for current year for agencies with search term in name
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";//assign this value to a variable

//////////////////////////////////////////////////////////////////////////////////////////
include('scripts/percent.php'); //see documentation in included file
//////////////////////////////////////////////////////////////////////////////////////////



$billion_ = mysql_query("SELECT current,sum(current) from budget_table2
 WHERE MATCH(Agency,acronym) AGAINST('$agency' IN BOOLEAN MODE)group by  '$agency' ");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(current)')."";
 $billion = ($value/1000000); //divides this year's value by 1 m
///////////////////////////////////////////////////////////////////////


$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////
?>