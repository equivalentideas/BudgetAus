<?php include('scripts/header.php');?>
 <div id='blog' role='complimentary'>
      <div id='chart'></div>
	  <div class="featured">
<h3>Program Search</h3>

<h5>Get cost of Programs in the Australian Federal budget based on your search term. eg refugee, baby. </h5>
<form action='program_results.php' target='_blank' method="GET">
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

include('scripts/totals.php');//includes script that calculates totals of all spending for last and current budget years.



   {
$program = $_GET['program']; 
   }
    if (isset($_GET['program'])) 
  $result= mysql_query("SELECT id,Portfolio,Program,Agency,Component,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) FROM budget_table2  WHERE MATCH(Program) AGAINST('".$program."'IN BOOLEAN MODE) group by program ");
  $num_rows = mysql_num_rows($result);
 
 /* echo

  
  "<div class='button'><a href='program_results_doc.php?program=$program' target='_blank'>Word</a></div>
   <div class='button'><a href='program_results_excel.php?program=$program' target='_blank'>Excel</a></div><p></p><div class='clear'></div>";
($rows = mysql_num_rows($result));*/
for ($j = 0 ; $j < $rows ; ++$j)
{
  ECHO
  
"
<table>
<tr>
 <TD>
<a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22&submit=Show' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result,$j, 'Program')."</a></td></tr>
<tr><td class='money'>
 	<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span></td></tr></table>";
 	}


$result = mysql_query("SELECT * FROM objectives  WHERE MATCH(Program) AGAINST('".$program."'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($result);
 
($rows = mysql_num_rows($result));
for ($j = 0 ; $j < $rows ; ++$j)



{
  ECHO
  
"
<div class='objectives'>

<p><b>Program:</b> <a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result,$j, 'Program')."</a></p>

<p><b>Linked Programs:</b> ".mysql_result($result,$j, 'linked')."</p>


<p><b>Program Objectives:</b> ".mysql_result($result,$j, 'text')."</p>


<p><b>Deliverables:</b> ".mysql_result($result,$j, 'Deliverables')."</p>

<p><b>Expense Notes:</b> ".mysql_result($result,$j, 'notes')."</p></div>";
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
    

 
$total_last_calc = mysql_query("SELECT last,sum(last) FROM budget_table2");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(last)')."";


$total_current_calc = mysql_query("SELECT last,sum(current) FROM budget_table2");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(current)')."";




$query_total_last = mysql_query("SELECT last,sum(last) from `budget_table2`  WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($program)."'IN BOOLEAN MODE) GROUP BY '$program'    ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)')."";

////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_table2`  WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($program)."'IN BOOLEAN MODE) GROUP BY '$program'  ");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'sum(current)')."";


//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100); 

//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

$dif_percentage = ($query_total_current_year/$query_total_last_year)*100;
///////////////////////////////////////////////////
$billion_ = mysql_query("SELECT current,sum(current) from `budget_table2`  WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($program)."'IN BOOLEAN MODE) GROUP BY '$program'   ");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(current)')."";
 $billion = ($value/1000000); //divides this year's value by 1 million to express valuein billions


$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////

{


include('scripts/tax_totals.php');

} 
{  


  $result= mysql_query("SELECT Portfolio,Program,Agency,Component,url,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3)  from `budget_table2`  WHERE MATCH(Program) 
  AGAINST('$program'IN BOOLEAN MODE) GROUP BY Program ");
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
 <a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result,$j, 'Program')." - opens in new window'>".mysql_result($result,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>
<td class='search'><a href='scheme_results.php?scheme=%22".mysql_result($result,$j, 'Component')."%22' target='_blank' title=' Get totals for ".mysql_result($result,$j, 'Component')." - opens in new window'>".mysql_result($result,$j, 'Component')."</a></TD>
</TR>
<TR>

<td>Last</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Plus 1</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Plus 2</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Plus 3</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</a> </TD>

</TR>
</table>";

}
///////////////////////////////////////////////////////////

 $result_scheme= mysql_query("SELECT Portfolio,Program,Agency,Component,url,last,current,plus1,plus2,plus3  from `budget_table2`  WHERE MATCH(Program) 
  AGAINST('$program'IN BOOLEAN MODE)  ");
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
 <a href='portfolio_results.php?portfolio=%22".mysql_result($result_scheme,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result_scheme,$j, 'Portfolio')." - opens in new window'>".mysql_result($result_scheme,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='agency_results.php?agency=%22".mysql_result($result_scheme,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result_scheme,$j, 'Agency')." - opens in new window'>".mysql_result($result_scheme,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='program_results.php?program=%22".mysql_result($result_scheme,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result_scheme,$j, 'Program')." - opens in new window'>".mysql_result($result_scheme,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>
<td class='search'><a href='scheme_results.php?scheme=%22".mysql_result($result_scheme,$j, 'Objective')."%22' target='_blank' title=' Get totals for ".mysql_result($result_scheme,$j, 'Objective')." - opens in new window'>".mysql_result($result_scheme,$j, 'Objective')."</a></TD>
</TR>
<TR>

<td>Last</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'last')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'current')).",000  </TD></tr><tr>
<td>Plus 1</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'plus1')).",000  </td></tr><tr>
<td>Plus 2</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'plus2')).",000  </td></tr><tr>
<td>Plus 3</td><TD class='money'>$".number_format(mysql_result($result_scheme,$j, 'plus3')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result_scheme,$j, 'last')."000,".mysql_result($result_scheme,$j, 'current')."000,".mysql_result($result_scheme,$j, 'plus1')."000,".mysql_result($result_scheme,$j, 'plus2')."000,".mysql_result($result_scheme,$j, 'plus3')."000   </span>
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
$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE Portfolio LIKE('%".$program."%') Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$program." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td width='480px'> <a href='portfolio_results.php?portfolio=".mysql_result($portfolio_results,$j, 'Portfolio')."'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_table2 WHERE Agency || Acronym  
LIKE('%".$program."%') Group by Agency ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$program." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>


<td width='480px'><a href='agency_results.php?agency=".mysql_result($agency_results,$j, 'Agency')."'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')." - 
".mysql_result($agency_results,$j, 'Acronym')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_table2 WHERE Program LIKE('%".$program."%') 
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

$scheme_results =  mysql_query("SELECT Agency,Program,Component from budget_table2 WHERE Component LIKE('%".$program."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$program." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'agency')."%22&submit=Show'  target='_blank' title='Agency Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Program Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
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
