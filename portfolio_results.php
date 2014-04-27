    
<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">

<div id='chart'></div><!--this div applies the CSS styles to the Flot chart -->
<div class='clear'></div>


 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))

   {
$portfolio = $_GET['portfolio']; 
   }
    if (isset($_GET['portfolio'])) 
     echo
    "<h3>".$portfolio."</h3>";
$results = mysql_query("SELECT PORTFOLIO,agency,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table2 WHERE MATCH(Portfolio) AGAINST('$portfolio' IN BOOLEAN MODE) GROUP BY Agency");//this query groups results triggered by user clicking on portfolio level url and shows all agencies within that portfolio with funding summed at agency level.

    $num_rows = mysql_num_rows($results);
echo "<h5>Number of Agencies:".$num_rows."</h5>";
/* echo
  "<div class='button'><a href='portfolio_results_doc.php?portfolio=%22".$portfolio."%22' target='_blank'>Word</a></div>
   <div class='button'>
   <a href='portfolio_results_excel.php?portfolio=".$portfolio."' target='_blank'>
   Excel</a></div> 
<p></p><div class='clear'></div>
 ";*/
        ($rows = mysql_num_rows($results));

for ($j = 0 ; $j < $rows ; ++$j)
{

ECHO
  
"<TABLE clas='two'>
<TR>
<TD>
<a href='agency_results.php?agency=%22".mysql_result($results,$j, 'agency')."%22&budget_year=current'' target='_blank' title='Get Programs for this agency in new window'>".mysql_result($results,$j, 'agency')."</a>
</TD></TR>
<TD class='money'>
<span class='inlinesparkline'>".mysql_result($results,$j, 'sum(last)')."000,".mysql_result($results,$j, 'sum(current)')."000,".mysql_result($results,$j, 'sum(plus1)')."000,".mysql_result($results,$j, 'sum(plus2)')."000,".mysql_result($results,$j, 'sum(plus3)')."000   </span>
 </td></tr>
</table>";
}
?>
 
       </div>
     
   
	<div id="accordion" role="main">
	 
	


<div class='three'>

	<?php

include('scripts/db.php');

 if (mysql_select_db($db_database))

   {
$portfolio = $_GET['portfolio']; 
   }
    if (isset($_GET['portfolio']))
    

////////////////////////////////////////////////////////////


include('scripts/totals.php');//includes script that calculates totals of all spending for last and current budget years.

 
$total_current = mysql_query("SELECT CURRENT,SUM(CURRENT) FROM budget_table2 ");
   $num_rows = mysql_num_rows($total_current);
($rows = mysql_num_rows($total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current,$j, 'SUM(current)')."";//assigns this value to a variable.
/////////////////////////////////////////////////
$query_total_last = mysql_query("SELECT last,sum(last) from `budget_table2` 
WHERE MATCH(Portfolio) AGAINST('%22".$portfolio."%22'IN BOOLEAN MODE)  ");//calculates total spend for portfolio based on url triggered by user for last budget year
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)')."";//assigns value to variable
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_table2` 
WHERE MATCH(Portfolio) AGAINST('%22".$portfolio."%22'IN BOOLEAN MODE)   ");//calculates total spend for portfolio based on url triggered by user for current budget year
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";//assigns the value to variable

//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100);//$percent variable is used in tax_totals.php and the Flot pie graph
//////////////////////////////////////////////////////////////////////////////////////////



$billion_ = mysql_query("SELECT current,sum(current) from `budget_table2` 
WHERE MATCH(Portfolio) AGAINST('%22".$portfolio."%22'IN BOOLEAN MODE)   ");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(current)')."";
 $billion = ($value/1000000); //divides this year's value by 1 million to express valuein billions

///////////////////////////////////////////////////////////////////////



$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////

{
include('scripts/tax_totals.php');

}

     
     $result = mysql_query("SELECT PORTFOLIO,agency,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table2 WHERE MATCH(Portfolio) AGAINST('$portfolio' IN BOOLEAN MODE) GROUP BY Agency");
        $num_rows = mysql_num_rows($result);
        echo
        "<p>There are $num_rows Agencies in the ".$portfolio." Portfolio.</p>";
        ($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)
{
      echo 
   "<table class='results'>
<tr>
<td class='left'>Agency</td>
<td class='right'>
<a href='agency_results.php?agency=%22".mysql_result($result,$j, 'agency')."%22&budget_year=current' target='_blank' title='Get Programs for this Agency in new window'>".mysql_result($result,$j, 'agency')."</a></TD></TR>
   
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr>
</table>";

  
 }
 ?>
</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>