    
<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">

<div id='chart'></div>
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
$results = mysql_query("SELECT PORTFOLIO,agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) 
FROM budget_us WHERE MATCH(Portfolio) AGAINST('$portfolio' IN BOOLEAN MODE) GROUP BY Agency");

    $num_rows = mysql_num_rows($results);
echo "<h5>Number of Agencies:".$num_rows."</h5>";
 echo
  "<div class='button'><a href='http://infoaus.net/budget/2013-14/portfolio_results_doc.php?portfolio=%22".$portfolio."%22' target='_blank'>Word</a></div>
   <div class='button'>
   <a href='http://infoaus.net/budget/2013-14/portfolio_results_excel.php?portfolio=".$portfolio."' target='_blank'>
   Excel</a></div> 
<p></p><div class='clear'></div>
 ";
        ($rows = mysql_num_rows($results));

for ($j = 0 ; $j < $rows ; ++$j)
{

ECHO
  
"<TABLE clas='two'>
<TR>
<TD>
<a href='http://infoaus.net/budget/2013-14/us_agency_results.php?agency=%22".mysql_result($results,$j, 'agency')."%22' target='_blank' title='Get Programs for this agency in new window'>".mysql_result($results,$j, 'agency')."</a>
</TD></TR>
<TD class='money'>
<span class='inlinesparkline'>".mysql_result($results,$j, 'sum(value12_13)')."000,".mysql_result($results,$j, 'sum(value13_14)')."000,".mysql_result($results,$j, 'sum(value14_15)')."000,".mysql_result($results,$j, 'sum(value15_16)')."000,".mysql_result($results,$j, 'sum(value16_17)')."000   </span>
 </td></tr>
</table>";
}
?>
 <div class='featured'>

</div>
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

 

$query_total_last = mysql_query("SELECT value12_13,sum(value12_13) from `budget_us` 
WHERE MATCH(Portfolio) AGAINST('%22".$portfolio."%22'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` 
WHERE MATCH(Portfolio) AGAINST('%22".$portfolio."%22'IN BOOLEAN MODE)   ");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(value13_14)')."";

//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100);
//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

$dif_percentage = ($query_total_current_year/$query_total_last_year)*100;
///////////////////////////////////////////////////


$billion_ = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` 
WHERE MATCH(Portfolio) AGAINST('%22".$portfolio."%22'IN BOOLEAN MODE)   ");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(value13_14)')."";
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

     
     $result = mysql_query("SELECT PORTFOLIO,agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) 
FROM budget_us WHERE MATCH(Portfolio) AGAINST('$portfolio' IN BOOLEAN MODE) GROUP BY Agency");
        $num_rows = mysql_num_rows($result);
        echo
        "<H4>There are $num_rows Agencies in the ".$portfolio." Portfolio.</H4>";
        ($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)
{
      echo 
   "<table class='results'>
<tr>
<td class='left'>Agency</td>
<td class='right'>
<a href='us_agency_results.php?agency=%22".mysql_result($result,$j, 'agency')."%22' target='_blank' title='Get Programs for this Agency in new window'>".mysql_result($result,$j, 'agency')."</a></TD></TR>
   
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value12_13)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value13_14)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value14_15)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value15_16)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value16_17)')).",000  </td></tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(value12_13)')."000,".mysql_result($result,$j, 'sum(value13_14)')."000,".mysql_result($result,$j, 'sum(value14_15)')."000,".mysql_result($result,$j, 'sum(value15_16)')."000,".mysql_result($result,$j, 'sum(value16_17)')."000   </span>
 </td></tr>
</table>";

  
 }
 ?>
</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>