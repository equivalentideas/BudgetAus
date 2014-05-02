<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">
 <div class="featured"> 
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="agency_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="health" /></lable>
  
   <lable for="budget_year">
<select name='budget_year'>
<option value='last'>Last</option>
<option value='current'>Current</option>

</select>
   </lable>
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
	</div><!--content div-->
<div id='chart'></div>

 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))

   {
$agency = $_GET['agency']; 
   }

  if($budget_year==current) 
	{
     echo
    "<h3>".$agency."</h3>";
$results = mysql_query("SELECT PORTFOLIO,program,agency,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table2 WHERE MATCH(agency) AGAINST('$agency' IN BOOLEAN MODE) GROUP BY program ORDER BY AGENCY");//this query groups results triggered by user clicking on agency level url and shows all programs within agency and trendline

    $num_rows = mysql_num_rows($results);
echo "<h5>Number of Agencies:".$num_rows."</h5>";
 echo
  "
   <div class='button'>
   <a href='agency_results_excel.php?agency=".$agency."' target='_blank'>
   Excel</a></div> 
<p></p><div class='clear'></div>
 ";
        ($rows = mysql_num_rows($results));

for ($j = 0 ; $j < $rows ; ++$j)

ECHO
  
"<TABLE clas='two'>
<TR>
<TD>
<a href='program_results.php?program=%22".mysql_result($results,$j, 'program')."%22&budget_year=current'' target='_blank' title='Get Programs for this agency in new window'>".mysql_result($results,$j, 'program')."</a>
</TD></TR>
<TD class='money'>
<span class='inlinesparkline'>".mysql_result($results,$j, 'sum(last)')."000,".mysql_result($results,$j, 'sum(current)')."000,".mysql_result($results,$j, 'sum(plus1)')."000,".mysql_result($results,$j, 'sum(plus2)')."000,".mysql_result($results,$j, 'sum(plus3)')."000   </span>
 </td></tr>
</table>";

}
else
	{
     echo
    "<h3>".$agency."</h3>";
$results2 = mysql_query("SELECT PORTFOLIO,agency,program,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table WHERE MATCH(agency) AGAINST('$agency' IN BOOLEAN MODE) GROUP BY program ORDER BY AGENCY");//this query groups results triggered by user clicking on portfolio level url and shows all agencies within that portfolio with funding summed at agency level.

    $num_rows = mysql_num_rows($results2);
echo "<h5>Number of Agencies:".$num_rows."</h5>
   <div class='button'>
   <a href='agency_results_excel.php?agency=".$agency."' target='_blank'>
   Excel</a></div> 
<p></p><div class='clear'></div>
 ";
        ($rows = mysql_num_rows($results2));

for ($j = 0 ; $j < $rows ; ++$j)
          

            ECHO
  
"<TABLE clas='two'>
<TR>
<TD>
<a href='program_results.php?program=%22".mysql_result($results2,$j, 'program')."%22&budget_year=last' target='_blank' title='Get Programs for this agency in new window'>".mysql_result($results2,$j, 'program')."</a>
</TD></TR>
<TD class='money'>
<span class='inlinesparkline'>".mysql_result($results2,$j, 'sum(last)')."000,".mysql_result($results2,$j, 'sum(current)')."000,".mysql_result($results2,$j, 'sum(plus1)')."000,".mysql_result($results2,$j, 'sum(plus2)')."000,".mysql_result($results2,$j, 'sum(plus3)')."000   </span>
 </td></tr>
</table>";
          
}
?>
 
	

      </div>
   
	<div id="accordion" role="main">
	 
	
<div class="three"> 

<?php
include('scripts/db.php');

if (mysql_select_db($db_database))


{
$agency = $_GET['agency']; 
}
{
$budget_year = $_GET['budget_year']; 
}
$agency=mysql_real_escape_string($agency);

   if ($budget_year =='current')
   {
   
$total_current = mysql_query("SELECT CURRENT,SUM(CURRENT) FROM budget_table2 ");
   $num_rows = mysql_num_rows($total_current);
($rows = mysql_num_rows($total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current,$j, 'SUM(current)')."";//assigns this value to a variable.
///////////////////////////////////////////
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
$percent = (($query_total_current_year/$total_current)*100);//$percent variable is used in tax_totals.php and the Flot pie graph
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

   include('scripts/tax_totals.php');
}
   if ($budget_year =='last')
   {
     
$total_current = mysql_query("SELECT CURRENT,SUM(CURRENT) FROM budget_table2 ");
   $num_rows = mysql_num_rows($total_current);
($rows = mysql_num_rows($total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current,$j, 'SUM(current)')."";//assigns this value to a variable.

/////////////////////////////////////////////////////////////////
$query_total_last = mysql_query("SELECT last,sum(last) from budget_table 
WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) group by '$agency' ");//calculates total funding for the prior budget year for agencies where search term forms part of their name
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)')."";//assigns this value to a variable.
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from  budget_table
 WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) group by  '$agency'");//calculates total funding for current year for agencies with search term in name
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";//assign this value to a variable

//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100/1);//$percent variable is used in tax_totals.php and the Flot pie graph
echo "$percent";
//////////////////////////////////////////////////////////////////////////////////////////

$billion_ = mysql_query("SELECT current,sum(current) from budget_table
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
echo

"<table class='top'>
<tr><td width='100px'>Total %</td><td width='100px'>Total Cost </td><td width='100px'>Personal Tax </td>
 <td width='100px'>Other Taxes</td></tr>
<tr><td class='total'><span id='result_percentage'><b>".number_format($percent, 3)."%</b></span></td>
<td class='total'><b>$".number_format($billion, 3)." B</b></td>
<td class='total'><b>$".number_format($actual_PIT, 3)." B</b></td>
<td class='total'><b>$".number_format($acutal_TOS,3)." B</b></td></tr>
</table>";

   }
///////////////////////////////////////////////////////////////////
	   if ($budget_year == 'current')//triggers if budget year is set to current by user form.
	   




	   
	  {
	     $result =  mysql_query("SELECT Portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3),SOURCE,URL
FROM budget_table2  WHERE MATCH(Agency,Acronym) AGAINST('$agency'IN BOOLEAN MODE) GROUP BY Agency ");//selects agency level results matching user input - This is a BOOLEAN search
       

 $num_rows = mysql_num_rows($result);
 
if ($num_rows>0)//triggers if there is a positive result on Boolean query
{
        echo 
      
"<h4>There are ".$num_rows." Agencies matching ".stripslashes($agency)." in current budget year </h4>";
        ($rows = mysql_num_rows($result));
     
          for ($j = 0 ; $j < $rows ; ++$j)
          echo
   "<table class='results'>
<tr><td width='30px'>Portfolio</td>
<td width='300px'>
<a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22&budget_year=current'  target='_blank' title='Find all Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
</td></tr>
<tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22&budget_year=current'   title='Find all Agency results for ".mysql_result($result,$j, 'Agency')." 'target='_blank' '>".mysql_result($result,$j, 'Agency')."</a>
</td></tr>
      
<TR>
<td>Last</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Next</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Next +1</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Next +2</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</a> </TD>

</TR>
</table>";


  
 
$results_current = mysql_query("SELECT portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table2 WHERE MATCH(Agency,acronym) AGAINST('$agency' IN BOOLEAN MODE) GROUP BY PROGRAM order by agency");//This query outputs program level results for the agencies that match the above query. This query tells the user how many programs are administered by the agencies that match their input, the program names and totals for each with all forward years funding.

    $num_rows = mysql_num_rows($results_current);
       ($rows = mysql_num_rows($results_current));
	   echo "<h5>There is a total of ".$num_rows." Programs matching ".stripslashes($agency)."  in their name in the current budget year data.</h5>
</a>";
	   for ($j = 0 ; $j < $rows ; ++$j)


 echo
   "<table class='results'>
   <tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($results_current,$j, 'Agency')."%22&budget_year=current'   title='Find all Agency results for ".mysql_result($results_current,$j, 'Agency')." 'target='_blank' '>".mysql_result($results_current,$j, 'Agency')."</a>
</td></tr>
<tr>
<td width='30px'>Program</td>
<td><a href='program_results.php?program=%22".mysql_result($results_current,$j, 'Program')."%22&budget_year=current'   title='Find all Scheme results for ".mysql_result($results_current,$j, 'Program')." 'target='_blank' '>".mysql_result($results_current,$j, 'Program')."</a>
</td></tr>  
<TR>
<td>Last</td><TD class='money'>$".number_format(mysql_result($results_current,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($results_current,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Next </td><TD class='money'>$".number_format(mysql_result($results_current,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Next +1</td><TD class='money'>$".number_format(mysql_result($results_current,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Next +2</td><TD class='money'>$".number_format(mysql_result($results_current,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($results_current,$j, 'sum(last)')."000,".mysql_result($results_current,$j, 'sum(current)')."000,".mysql_result($results_current,$j, 'sum(plus1)')."000,".mysql_result($results_current,$j, 'sum(plus2)')."000,".mysql_result($results_current,$j, 'sum(plus3)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($results_current,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($results_current,$j, 'Source')."</a> </TD>

</TR>
</table>";



}
//////////////////////////////////////////////////////////////////////////////////////
 
 elseif ($num_rows ==0)//triggers script below if there is no result on Boolean query. NULL result triggers NON BOOLEAN search across all fields 
 {
  echo
  "<p>Sorry there are no Agency names containing the term ".stripslashes($agency)." 
  Check spelling or the results below or try a similar term.</p>";
  



$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE Portfolio LIKE('%$agency%') Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios matching ".stripslashes($agency)."</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td> <a href='portfolio_results.php?portfolio=".mysql_result($portfolio_results,$j, 'Portfolio')."'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Portfolio,program,Agency,Acronym from budget_table2 WHERE Agency || Acronym  LIKE('%".$agency."%') Group by Agency ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies matching ".stripslashes($agency)."  </h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>


<td><a href='agency_results.php?agency=%22".mysql_result($agency_results,$j, 'Agency')."%22&budget_year=current'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')." - 
".mysql_result($agency_results,$j, 'Acronym')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT portfolio,agency,Program from budget_table2 WHERE Agency LIKE('%".$agency."%') Group by Program  ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Programs matching ".stripslashes($agency)."  in the current budget year</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>

<td>
<a href='program_results.php?program=%22".mysql_result($agency_results,$j, 'Program')."%22&budget_year=current'  target='_blank' title='Find Program Results for ".mysql_result($agency_results,$j, 'Program')." - opens in new window'>".mysql_result($agency_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Portfolio,Agency,Program,Component from budget_table2 WHERE Component LIKE('%".$agency."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes matching ".stripslashes($agency) ."</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'agency')."%22&budget_year=current'  target='_blank' title='Agency Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&budget_year=current'  target='_blank' title='Program Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&budget_year=current'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
</p>
</div>";
}
}
//////////////////////////////////////////////////////////////////


  
 elseif ($budget_year = 'last')//triggers if user form is set to retrieve data from LAST BUDGET YEAR DATA
  {

 $result =  mysql_query("SELECT Portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table  WHERE MATCH(Agency,Acronym) AGAINST('$agency'IN BOOLEAN MODE) GROUP BY Agency ");//performs search using BOOLEAN paramaters based on user input. This query gives a total for the agencies matching the search term((s) with all forward funding years for the LAST BUDGT YEAR.

    $num_rows = mysql_num_rows($result);
      echo 
      
"<h4>There are ".$num_rows." Agencies matching ".stripslashes($agency) ."in last budget year </h4>";
    ($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)


 echo
   "<table class='results'>
   <tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22&budget_year=last'   title='Find all Agency results for ".mysql_result($result,$j, 'Agency')." 'target='_blank' '>".mysql_result($result,$j, 'Agency')."</a>
</td></tr>
<tr>
<td width='30px'>Program</td>
<td><a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22&budget_year=last'   title='Find all Scheme results for ".mysql_result($result,$j, 'Program')." 'target='_blank' '>".mysql_result($result,$j, 'Program')."</a>
</td></tr>  
<TR>
<td>Last</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Next</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Next +1</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Next +2</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</a> </TD>

</TR>
</table>";

  
    
 
$results = mysql_query("SELECT portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table WHERE MATCH(Agency,acronym) AGAINST('$agency' IN BOOLEAN MODE) GROUP BY PROGRAM order by agency");//This query outputs program level results for the agencies that match the above query. This query tells the user how many programs are administered by the agencies that match their input, the program names and totals for each with all forward years funding.

    $num_rows = mysql_num_rows($results);
       ($rows = mysql_num_rows($results));
	   echo "<h5>There is a total of ".$num_rows." Programs matching ".stripslashes($agency)." in the last budget year </h5>
</a>";
	   for ($j = 0 ; $j < $rows ; ++$j)


 echo
   "<table class='results'>
   <tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($results,$j, 'Agency')."%22&budget_year=last'   title='Find all Agency results for ".mysql_result($results,$j, 'Agency')." 'target='_blank' '>".mysql_result($results,$j, 'Agency')."</a>
</td></tr>
<tr>
<td width='30px'>Program</td>
<td><a href='program_results.php?program=%22".mysql_result($results,$j, 'Program')."%22&budget_year=last'   title='Find all Scheme results for ".mysql_result($results,$j, 'Program')." 'target='_blank' '>".mysql_result($results,$j, 'Program')."</a>
</td></tr>  
<TR>
<td>Last</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Next</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Next +1</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Next +2</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($results,$j, 'sum(last)')."000,".mysql_result($results,$j, 'sum(current)')."000,".mysql_result($results,$j, 'sum(plus1)')."000,".mysql_result($results,$j, 'sum(plus2)')."000,".mysql_result($results,$j, 'sum(plus3)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($results,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($results,$j, 'Source')."</a> </TD>

</TR>
</table>";

}
?>

</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>