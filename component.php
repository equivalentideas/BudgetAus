<?php include('scripts/header.php');?>     
 <div id="blog" role="complimentary">  


<?php 
 
include('scripts/db.php');
if (mysql_select_db($db_database))

$portfolio2='agriculture';



include('scripts/totals.php');//includes script that calculates totals of all spending for last and current budget years.


$query_total_last = mysql_query("SELECT last,sum(last) from `budget_table2` where portfolio=$portfolio2"); //totals spending for last year based on user search term
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)').""; //assigns total spending for last budget year based on user search term to the variable $query_total_last_year
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_table2` where portfolio=$portfolio2  "); //totals spending for current year based on search term
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";//assigns total of current year spending for search term to variable $query_total_current_year

/////////////////////////////////////////////////////////////////////////////////
include('scripts/percent.php'); //see documentation in included file
//////////////////////////////////////////////////////////////////////////////////////////



$billion_ = mysql_query("SELECT current,sum(current) from `budget_table2` where portfolio=$portfolio "); //calculates the funding spent out of current budget year on user search term
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
$value = "".mysql_result($billion_,$j, 'sum(current)')."";
$billion = ($value/1000000); //divides this value by 1 million to express value in billions

///////////////////////////////////////////////////////////////////////



$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company and other taxes
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////

{


include('scripts/tax_totals.php');//includes table with variables that output values for personal income tax and corporate and other taxes based on user input. Also contains the variable for percentage which triggers flot pie graph value.

} 
/*$result3 = mysql_query("SELECT *
FROM budget_table JOIN budget_table2 on budget_table2.last = budget_table.current WHERE MATCH(Component) AGAINST('".$scheme."'IN BOOLEAN MODE)   ");//selects results from budget table based on user input
*/
$result3 = mysql_query("SELECT *
FROM budget_table2 where portfolio like('%agriculture%') ");

$num_rows = mysql_num_rows($result3);

echo "<h5>Your search of the 2013-14 budget data matches ".$num_rows." Scheme(s) </h5>";



($rows = mysql_num_rows($result3));

for ($j = 0 ; $j < $rows ; ++$j)



  {
  
  echo 
"<TABLE class='results'>
<TR>
<td>Portfolio</td>
<td class='search'>
 <a href='portfolio_results.php?portfolio=%22".mysql_result($result3,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result3,$j, 'Portfolio')." - opens in new window'>".mysql_result($result3,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='agency_results.php?agency=%22".mysql_result($result3,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result3,$j, 'Agency')." - opens in new window'>".mysql_result($result3,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='program_results.php?program=%22".mysql_result($result3,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result3,$j, 'Program')." - opens in new window'>".mysql_result($result3,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>


<td class='id'><a href='scheme_results.php?scheme=%22".mysql_result($result3,$j, 'Component')."%22' target='_blank' title=' Get totals for ".mysql_result($result3,$j, 'Component')." - opens in new window'>".mysql_result($result3,$j, 'Component')."</a></TD>

</TR>




<TR>

<td>Last</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'last')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'current')).",000  </TD></tr><tr>
<td>Plus 1</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'plus1')).",000  </td></tr><tr>
<td>Plus 2</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'plus2')).",000  </td></tr><tr>
<td>Plus 3</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'plus3')).",000  </td></tr>
<tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result3,$j, 'last')."000,".mysql_result($result3,$j, 'current')."000,".mysql_result($result3,$j, 'plus1')."000,".mysql_result($result3,$j, 'plus2')."000,".mysql_result($result3,$j, 'plus3')."000   </span>
 </td></tr>
<TR>
<TD> Source</td> 

<td class='source'><a href=" .mysql_result($result3,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result3,$j, 'Source')."</a> </TD>


</TR>
</TABLE><p></p>";

	
}
  

	?>




      </div>
   
	<div id="accordion" role="main">
	 
	
<div class="three"> 



<?php 
 
include('scripts/db.php');
if (mysql_select_db($db_database))



include('scripts/totals.php');//includes script that calculates totals of all spending for last and current budget years.


$query_total_last = mysql_query("SELECT last,sum(last) from `budget_table1` where portfolio='agriculture'   "); //totals spending for last year based on user search term
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)').""; //assigns total spending for last budget year based on user search term to the variable $query_total_last_year
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_table1`  where portfolio='agriculture' "); //totals spending for current year based on search term
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";//assigns total of current year spending for search term to variable $query_total_current_year

/////////////////////////////////////////////////////////////////////////////////
include('scripts/percent.php'); //see documentation in included file
//////////////////////////////////////////////////////////////////////////////////////////



$billion_ = mysql_query("SELECT current,sum(current) from `budget_table1`  where portfolio='agriculture' "); //calculates the funding spent out of current budget year on user search term
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
$value = "".mysql_result($billion_,$j, 'sum(current)')."";
$billion = ($value/1000000); //divides this value by 1 million to express value in billions

///////////////////////////////////////////////////////////////////////



$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company and other taxes
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////

{


include('scripts/tax_totals.php');//includes table with variables that output values for personal income tax and corporate and other taxes based on user input. Also contains the variable for percentage which triggers flot pie graph value.

} 
/*$result3 = mysql_query("SELECT *
FROM budget_table JOIN budget_table2 on budget_table2.last = budget_table.current WHERE MATCH(Component) AGAINST('".$scheme."'IN BOOLEAN MODE)   ");//selects results from budget table based on user input
*/
$result = mysql_query("SELECT *
FROM budget_table1 where portfolio like('%agriculture%') ");

$num_rows = mysql_num_rows($result);

echo "<h5>Your search of the 2012-13 budget data matches ".$num_rows." Scheme(s) </h5>";



($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)



  {
  
  echo 
"<TABLE class='results'>
<TR>
<td>Portfolio</td>
<td class='search'>
 <a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result3,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result,$j, 'Program')." - opens in new window'>".mysql_result($result,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>


<td class='id'><a href='scheme_results.php?scheme=%22".mysql_result($result,$j, 'Component')."%22' target='_blank' title=' Get totals for ".mysql_result($result,$j, 'Component')." - opens in new window'>".mysql_result($result,$j, 'Component')."</a></TD>

</TR>




<TR>

<td>Last</td><TD class='money'>$".number_format(mysql_result($result,$j, 'last')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result,$j, 'current')).",000  </TD></tr><tr>
<td>Plus 1</td><TD class='money'>$".number_format(mysql_result($result,$j, 'plus1')).",000  </td></tr><tr>
<td>Plus 2</td><TD class='money'>$".number_format(mysql_result($result,$j, 'plus2')).",000  </td></tr><tr>
<td>Plus 3</td><TD class='money'>$".number_format(mysql_result($result,$j, 'plus3')).",000  </td></tr>
<tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'last')."000,".mysql_result($result,$j, 'current')."000,".mysql_result($result,$j, 'plus1')."000,".mysql_result($result,$j, 'plus2')."000,".mysql_result($result,$j, 'plus3')."000   </span>
 </td></tr>
<TR>
<TD> Source</td> 

<td class='source'><a href=" .mysql_result($result3,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result3,$j, 'Source')."</a> </TD>


</TR>
</TABLE><p></p>";

	
}
  

	?>
		
	</div>
	</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>