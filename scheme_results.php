<?php include('scripts/header.php');?>     
 <div id="blog" role="complimentary">  
<div id='chart'></div><!--this div applies the CSS styles to the Flot chart -->
<div class='clear'></div>

<div class="featured">
<h3>Scheme Search</h3>
<h5>Programs are broken down into Program Components (Schemes). This is the smallest financial grain in the Portfolio Budget Statements.</h5>
<form action='scheme_results.php' target='_blank' method="GET">

<div role="form">
   <lable for="scheme"><input type="text"  id="scheme" name="scheme" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div><!--innerform-->
</form>
</div><!--content div-->

<!--form above uses GET method to send user input to search program component field in the database-->

 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 $scheme = $_GET['scheme'];
$result1 = mysql_query("SELECT Portfolio,Agency,Program,Component,last,current,plus1,plus2,plus3,source,URL 
FROM budget_table2 WHERE MATCH(Component) AGAINST('".$scheme."'IN BOOLEAN MODE)   ");
  $num_rows = mysql_num_rows($result1);
 /* echo
  "<div class='button'><a href='scheme_results_doc.php?scheme=%22".$scheme."%22' target='_blank'>Word</a></div>
   <div class='button'>
   <a href='scheme_results_excel.php?scheme=".$scheme."' target='_blank'>
   Excel</a></div> 
<p></p><div class='clear'></div>
 ";*/
($rows = mysql_num_rows($result1));
for ($j = 0 ; $j < $rows ; ++$j)
{
  ECHO
  
"
<table>
<tr>
 <TD>
<a href='scheme_results.php?scheme=%22".mysql_result($result1,$j, 'Component')."%22' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result1,$j, 'Component')."</a></td></tr>
<tr><td class='money'>
 	<span class='inlinesparkline'>".mysql_result($result1,$j, 'last')."000,".mysql_result($result1,$j, 
	'current')."000,".mysql_result($result1,$j, 'plus1')."000,".mysql_result($result1,$j, 'plus2')."000,".mysql_result($result1,$j, 'plus3')."000   
	</span></td></tr></table>";
 	}

?>

      </div>
   
	<div id="accordion" role="main">
	 
	
<div class="three"> 



<?php 
 
include('scripts/db.php');
if (mysql_select_db($db_database))
{
$scheme = $_GET['scheme'];
$portfolio  = $_GET['portfolio'];

}


if (isset($_GET['scheme'])) 


include('scripts/totals.php');//includes script that calculates totals of all spending for last and current budget years.


$query_total_last = mysql_query("SELECT last,sum(last) from `budget_table2` WHERE MATCH(Component) AGAINST('$scheme'IN BOOLEAN MODE)  "); //totals spending for last year based on user search term
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)').""; //assigns total spending for last budget year based on user search term to the variable $query_total_last_year
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_table2` WHERE MATCH(Component) AGAINST('$scheme'IN BOOLEAN MODE)  "); //totals spending for current year based on search term
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";//assigns total of current year spending for search term to variable $query_total_current_year

/////////////////////////////////////////////////////////////////////////////////
include('scripts/percent.php'); //see documentation in included file
//////////////////////////////////////////////////////////////////////////////////////////



$billion_ = mysql_query("SELECT current,sum(current) from `budget_table2` WHERE MATCH(Component) AGAINST('$scheme' IN BOOLEAN MODE)  "); //calculates the funding spent out of current budget year on user search term
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

$result3 = mysql_query("SELECT *
FROM budget_table2 WHERE MATCH(Component) AGAINST('".$scheme."'IN BOOLEAN MODE)   ");//selects results from budget table based on user input

$num_rows = mysql_num_rows($result3);

if ($num_rows <1)//triggers following script if there are no results for user search term in Boolean mode
 {
  echo
  "<p>Sorry there are no Scheme names containing the term ".$scheme.". 
  Check spelling or the results below or try a similar term.</p>";//outputs this message if there are no results on Boolean search 
  


{
$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE Portfolio LIKE('%".$scheme."%') Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$scheme." in their name.</h5>";//searches portfolio field for matches on user input 
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td width='480px'> <a href='portfolio_results.php?portfolio=".mysql_result($portfolio_results,$j, 'Portfolio')."'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_table2 WHERE Agency || Acronym  LIKE('%".$scheme."%') Group by Agency ");//searches on agency and acronym field using user input and groups results by agency

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$scheme." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>


<td width='480px'><a href='agency_results.php?agency=".mysql_result($agency_results,$j, 'Agency')."'  
target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($scheme_results,$j, 'Agency')." - 
".mysql_result($agency_results,$j, 'Acronym')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_table2 WHERE Program LIKE('%".$scheme."%') Group by Program ");//searches component field using non-Boolean search

 $num_rows = mysql_num_rows($program_results);
 ($rows = mysql_num_rows($program_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$scheme." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>

<td width='480px'>
<a href='program_results.php?program=%22".mysql_result($program_results,$j, 'Program')."%22'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." -
 opens in new window'>".mysql_result($program_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Agency,Program,Component from budget_table2 WHERE Component LIKE('%".$scheme."%') ");//

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$scheme." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'Agency')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
</p>
</div>";
//////////////////////////////////////////////////////////////////


}


  exit;
  }
  if ($num_rows>0)//the following script is triggered if there is a positive result for the user input on Boolean search

echo "<h5>Your search matches ".$num_rows." Scheme(s) </h5>";



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
	</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>