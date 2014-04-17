<?php include('scripts/header.php');?>
 <div id='blog' role='complimentary'>
      <div id='chart'></div>
	  <div class="content">
<h3>Program Search</h3>

<h5>Get cost of Programs in the Australian Federal budget based on your search term. eg refugee, baby. </h5>
<form action='us_program_results.php' target='_blank' method="GET">
<div role="form">
   <lable for="program_search"><input type="text"  id="program" name="program" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div><!--innerform-->
</form>
</div><!--content div-->
	<div class='clear'></div>
	<?php
 include('scripts/db.php');
 if (mysql_select_db($db_database))
 
   $program = $_GET['program'];

   
   if (isset($_GET['program'])) 
   {
   $program = $_GET['program'];

   }
   if (isset($_GET['program']))
 $result4 = mysql_query("SELECT  Portfolio,Agency,Program,Objective FROM budget_us 
 WHERE MATCH(program) AGAINST('".$program."'IN BOOLEAN MODE) group by program  ");

 $num_rows = mysql_num_rows($result4);


 ($rows = mysql_num_rows($result4));

for ($j = 0 ; $j < $rows ; ++$j)


   {

   echo 
 "<div class='featured'>  <p>
 <a href='http://google.com/search?q=".mysql_result($result4,$j, 'Portfolio')."' target='_blank' title='Click here to search Google ".mysql_result($result4,$j, 'Portfolio')."- opens in new window'>Google search for ".mysql_result($result4,$j, 'Portfolio')."</a>
 </p><p>
 
 <a href='http://google.com/search?q=".mysql_result($result4,$j, 'Agency')."' target='_blank' title='Click here to search Google ".mysql_result($result4,$j, 'Agency')."- opens in new window'>Google search for ".mysql_result($result4,$j, 'Agency')."</a>
   </p><p>
  <a href='http://google.com/search?q=".mysql_result($result4,$j, 'program')."' target='_blank' title='Click here to Google ".mysql_result($result4,$j, 'program')."- opens in new window'>Google search for ".mysql_result($result4,$j, 'program')."</a>
   </p><p>
 
 
 
</div>";
}
?>

 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 $total_last_calc = mysql_query("SELECT value12_13,sum(value12_13) FROM budget_us");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(value12_13)')."";


$total_current_calc = mysql_query("SELECT value13_14,sum(value13_14) FROM budget_us");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(value13_14)')."";



   {
$program = $_GET['program']; 
   }
    if (isset($_GET['program'])) 
  $result= mysql_query("SELECT id,Portfolio,Program,Agency,Objective,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17)
  FROM budget_us  WHERE MATCH(Program) AGAINST('".$program."'IN BOOLEAN MODE) group by program ");
  $num_rows = mysql_num_rows($result);
 
  echo

  
  "<BR><div class='button'><a href='http://infoaus.net/budget/2013-14/program_results_doc.php?program=$program' target='_blank'>Word</a></div>
   <div class='button'><a href='http://infoaus.net/budget/2013-14/program_results_excel.php?program=$program' target='_blank'>Excel</a></div><p></p><div class='clear'></div>";
($rows = mysql_num_rows($result));
for ($j = 0 ; $j < $rows ; ++$j)
{
  ECHO
  
"
<table>
<tr>
 <TD>
<a href='http://infoaus.net/budget/2013-14/us_program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22&submit=Show' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result,$j, 'Program')."</a></td></tr>
<tr><td class='money'>
 	<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(value12_13)')."000,".mysql_result($result,$j, 'sum(value13_14)')."000,".mysql_result($result,$j, 'sum(value14_15)')."000,".mysql_result($result,$j, 'sum(value15_16)')."000,".mysql_result($result,$j, 'sum(value16_17)')."000   </span></td></tr></table>";
 	



 	}
?>

      </div>
     
   
	<div id="accordion" role="main">
	 
	


<div class='three'>




<?php 
 
 
 
include('scripts/db.php');

 if (mysql_select_db($db_database))

   {
$program = $_GET['program']; 
   }
    if (isset($_GET['program'])) 
    {
 
  
echo "<h3>$program</h3>";
    }
    

 
$total_last_calc = mysql_query("SELECT value12_13,sum(value12_13) FROM budget_us");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(value12_13)')."";


$total_current_calc = mysql_query("SELECT value12_13,sum(value13_14) FROM budget_us");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(value13_14)')."";
//echo
//"$total_current,000";



$query_total_last = mysql_query("SELECT value12_13,sum(value12_13) from `budget_us` 
 WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($program)."'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";

////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us`  
WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($program)."'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'sum(value13_14)')."";


//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100); 

//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

$dif_percentage = ($query_total_current_year/$query_total_last_year)*100;
///////////////////////////////////////////////////
$billion_ = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` 
 WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($program)."'IN BOOLEAN MODE)   ");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(value13_14)')."";
 $billion = ($value/1000000); //divides this year's value by 1 million to express value in billions


$actual_PIT = $query_total_current_year * 0.00000046;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.00000011;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
$payroll = $query_total_current_year * 0.00000034;
$payroll_percent = ($payroll/$total_current) * 100/1; // divides current year value into proportion that comes from payroll tax
$misc = $query_total_current_year * 0.00000009;
$misc_percent = ($misc/$total_current) * 100/1;//miscellaneous taxes by query result as percentage of whole
///////////////////////////////////////////////////////////////////

{


include('scripts/us_tax_totals.php');

} 
  


  $result= mysql_query("SELECT *
FROM  budget_us WHERE  MATCH(program) AGAINST('$program' in BOOLEAN MODE) ");
  $num_rows = mysql_num_rows($result);
  if ($num_rows >0)
   echo 
"
<h4>".$num_rows." Programs containing the term $program</h4>";
  ($rows = mysql_num_rows($result));
  
  for ($j = 0 ; $j < $rows ; ++$j)

  {
  
  echo 
"
<TABLE class='results'>
<TR>
<td>Portfolio</td>
<td class='search'>
 <a href='us_portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='us_agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='us_program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result,$j, 'Program')." - opens in new window'>".mysql_result($result,$j, 'Program')."</a>
  </TD></tr><tr>

<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value12_13')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value13_14')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value14_15')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value15_16')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value16_17')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(value12_13)')."000,".mysql_result($result,$j, 'sum(value13_14)')."000,".mysql_result($result,$j, 'sum(value14_15)')."000,".mysql_result($result,$j, 'sum(value15_16)')."000,".mysql_result($result,$j, 'sum(value16_17)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</a> </TD>

</TR>
</table>";




 $result_scheme= mysql_query("SELECT * from `budget_us`  WHERE   MATCH(program) AGAINST('$program' in BOOLEAN MODE)
 ");
  $num_rows = mysql_num_rows($result_scheme);
  
   echo 
"
<h4>".$num_rows." Schemes for $program</h4>";
  ($rows = mysql_num_rows($result_scheme));
  for ($j = 0 ; $j < $rows ; ++$j)
  
  {
  
  echo 
"
<TABLE class='results'>
<TR>
<td>Portfolio</td>
<td class='search'>
 <a href='us_portfolio_results.php?portfolio=%22".mysql_result($result_scheme,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result_scheme,$j, 'Portfolio')." - opens in new window'>".mysql_result($result_scheme,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='us_agency_results.php?agency=%22".mysql_result($result_scheme,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result_scheme,$j, 'Agency')." - opens in new window'>".mysql_result($result_scheme,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='us_program_results.php?program=%22".mysql_result($result_scheme,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result_scheme,$j, 'Program')." - opens in new window'>".mysql_result($result_scheme,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>
<td class='search'><a href='us_scheme_results.php?scheme=%22".mysql_result($result_scheme,$j, 'Objective')."%22' target='_blank' title=' Get totals for ".mysql_result($result_scheme,$j, 'Objective')." - opens in new window'>".mysql_result($result_scheme,$j, 'Objective')."</a></TD>
</TR>
<TR>

<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'value12_13')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'value13_14')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'value14_15')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'value15_16')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'value16_17')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result_scheme,$j, 'value12_13')."000,".mysql_result($result_scheme,$j, 'value13_14')."000,".mysql_result($result_scheme,$j, 'value14_15')."000,".mysql_result($result_scheme,$j, 'value15_16')."000,".mysql_result($result_scheme,$j, 'value16_17')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($result_scheme,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result_scheme,$j, 'Source')."</a> </TD>

</TR>
</table>";
}
exit;
}
  
   if ($num_rows ==0)
   {
  echo
  "<p>Sorry there are no Program names containing the term ".$program.". 
  Check spelling or the results below or try a similar term.</p>";
  


{
$portfolio_results =  mysql_query("SELECT Portfolio from budget_us WHERE Portfolio LIKE('%".$program."%') Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$program." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td width='480px'> <a href='us_portfolio_results.php?portfolio=".mysql_result($portfolio_results,$j, 'Portfolio')."'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency from budget_us WHERE  MATCH(AGENCY) AGAINST('$program' in BOOLEAN MODE) GROUP BY AGENCY ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$program." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>


<td width='480px'><a href='agency_results.php?agency=".mysql_result($agency_results,$j, 'Agency')."'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_us WHERE Program LIKE('%".$program."%') 
Group by Program ");

 $num_rows = mysql_num_rows($program_results);
 ($rows = mysql_num_rows($program_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$program." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>

<td width='480px'>
<a href='program_results.php?program=%22".mysql_result($program_results,$j, 'Program')."%22'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." - opens in new window'>".mysql_result($program_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Agency,Program,Objective from budget_us WHERE objective LIKE('%".$program."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$program." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'agency')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Objective')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Objective')."'>".mysql_result($scheme_results,$j, 'Objective')."</a>
</p>
</div>";
//////////////////////////////////////////////////////////////////




}
  
  }

?>



</div>
</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>
