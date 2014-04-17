<?php include('scripts/header.php');?>     
 <div id="blog" role="complimentary">  
<div id='chart'></div>
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



 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 $scheme = $_GET['scheme'];
$result1 = mysql_query("SELECT Portfolio,Agency,Program,Objective,value12_13,value13_14,value14_15,value15_16,value16_17,source,URL 
FROM budget_us WHERE MATCH(Objective) AGAINST('".$scheme."'IN BOOLEAN MODE)   ");
  $num_rows = mysql_num_rows($result1);
  echo
  "<div class='button'><a href='http://infoaus.net/budget/2013-14/scheme_results_doc.php?scheme=%22".$scheme."%22' target='_blank'>Word</a></div>
   <div class='button'>
   <a href='http://infoaus.net/budget/2013-14/scheme_results_excel.php?scheme=".$scheme."' target='_blank'>
   Excel</a></div> 
<p></p><div class='clear'></div>
 ";
($rows = mysql_num_rows($result1));
for ($j = 0 ; $j < $rows ; ++$j)
{
  ECHO
  
"
<table>
<tr>
 <TD>
<a href='http://infoaus.net/budget/2013-14/scheme_results.php?scheme=%22".mysql_result($result1,$j, 'objective')."%22' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result1,$j, 'objective')."</a></td></tr>
<tr><td class='money'>
 	<span class='inlinesparkline'>".mysql_result($result1,$j, 'value12_13')."000,".mysql_result($result1,$j, 
	'value13_14')."000,".mysql_result($result1,$j, 'value14_15')."000,".mysql_result($result1,$j, 'value15_16')."000,".mysql_result($result1,$j, 'value16_17')."000   
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


$query_total_last = mysql_query("SELECT value12_13,sum(value12_13) from `budget_us` WHERE MATCH(Objective) AGAINST('$scheme'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` WHERE MATCH(Objective) AGAINST('$scheme'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(value13_14)')."";

//////////////////////////////////////////////////////////////////////////////////////////
$proportion1 = (($query_total_last_year/$total_last)*100);

$percent = (($query_total_current_year/$total_current)*100);

//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

 $dif_percent = ($query_total_current_year/$query_total_last_year)*100;



$diff_percent = ($percent - $proportion1);
///////////////////////////////////////////////////


$billion_ = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` WHERE MATCH(Objective) AGAINST('$scheme' IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'sum(value13_14)')."";
 $billion = ($value/1000000); //divides this year's value by 1 million to express value in billions

///////////////////////////////////////////////////////////////////////



$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////



{


include('scripts/tax_totals.php');

} 



 

$result3 = mysql_query("SELECT *
FROM budget_us WHERE MATCH(Objective) AGAINST('".$scheme."'IN BOOLEAN MODE)    ");

$num_rows = mysql_num_rows($result3);

if ($num_rows <1)
 {
  echo
  "<p>Sorry there are no Scheme names containing the term ".$scheme.". 
  Check spelling or the results below or try a similar term.</p>";
  


{
$portfolio_results =  mysql_query("SELECT Portfolio from budget_us WHERE Portfolio LIKE('%".$scheme."%') Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$scheme." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td width='480px'> <a href='portfolio_results.php?portfolio=".mysql_result($portfolio_results,$j, 'Portfolio')."'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_us WHERE Agency || Acronym  LIKE('%".$scheme."%') Group by Agency ");

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

$scheme_results =  mysql_query("SELECT Program from budget_us WHERE Program LIKE('%".$scheme."%') Group by Program ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$scheme." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>

<td width='480px'>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22'  target='_blank' title='Find Program Results for ".mysql_result($scheme_results,$j, 'Program')." - opens in new window'>".mysql_result($scheme_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Agency,Program,Objective from budget_us WHERE objective LIKE('%".$scheme."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$scheme." in their name.</h5>
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

$objective_results =  mysql_query("SELECT * from objectives WHERE text LIKE('%".$scheme."%') ");

 $num_rows = mysql_num_rows($objective_results);
 ($rows = mysql_num_rows($objective_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$scheme." mentioned in their Program Objectives</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class-'results'>
<tr>
<td class='objective'>Program: 
<a href='program_results.php?program=%22".mysql_result($objective_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Program Results for ".mysql_result($objective_results,$j, 'Program')."'>".mysql_result($objective_results,$j, 'Program')."</a>
</td></tr>
<tr>
<td>Linked Programs: ".mysql_result($objective_results,$j, 'Linked')."</td></tr>
<tr>
<td>Objectives: ".mysql_result($objective_results,$j, 'text')."</td></tr>




</tr></table><p><hr></p>";

}


  exit;
  }
  if ($num_rows>0)

echo "<h5>Your search matches ".$num_rows." Scheme(s) </h5>";



($rows = mysql_num_rows($result3));

for ($j = 0 ; $j < $rows ; ++$j)



  {
  
  echo 
"<TABLE class='results'>
<TR>
<td>Portfolio</td>
<td class='search'>
 <a href='http://infoaus.net/budget/2013-14/portfolio_results.php?portfolio=%22".mysql_result($result3,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result3,$j, 'Portfolio')." - opens in new window'>".mysql_result($result3,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='http://infoaus.net/budget/2013-14/agency_results.php?agency=%22".mysql_result($result3,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result3,$j, 'Agency')." - opens in new window'>".mysql_result($result3,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='http://infoaus.net/budget/2013-14/program_results.php?program=%22".mysql_result($result3,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result3,$j, 'Program')." - opens in new window'>".mysql_result($result3,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>


<td class='id'><a href='http://infoaus.net/budget/2013-14/scheme_results.php?scheme=%22".mysql_result($result3,$j, 'Objective')."%22' target='_blank' title=' Get totals for ".mysql_result($result3,$j, 'Objective')." - opens in new window'>".mysql_result($result3,$j, 'Objective')."</a></TD>

</TR>




<TR>

<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'value12_13')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'value13_14')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'value14_15')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'value15_16')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'value16_17')).",000  </td></tr>
<tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result3,$j, 'value12_13')."000,".mysql_result($result3,$j, 'value13_14')."000,".mysql_result($result3,$j, 'value14_15')."000,".mysql_result($result3,$j, 'value15_16')."000,".mysql_result($result3,$j, 'value16_17')."000   </span>
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