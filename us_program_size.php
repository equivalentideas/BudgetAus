<?php include('scripts/header.php');?>
 <div id="blog" role="complimentary">
 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 

$result2 = mysql_query("SELECT Program, value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) FROM budget_us where program Not like('%1.4 General Revenue Assistance%') GROUP BY PROGRAM ORDER BY SUM(VALUE13_14) DESC limit 100");

    $num_rows = mysql_num_rows($result2);
    ($rows = mysql_num_rows($result2));

for ($j = 0 ; $j < $rows ; ++$j)
{

ECHO
  
"<TABLE class='two'>
<TR>
<TD>
<a href='program_results.php?program=%22".mysql_result($result2,$j, 'Program')."%22' target='_blank'
 title='Get Schemes for this Program in new window'>".mysql_result($result2,$j, 'Program')."</a></td>
 <td class='money'>$".number_format(mysql_result($result2,$j, 'sum(value13_14)')).",000
</TD></TR>

</table>";
}

?>


</div>
      </div>
   
	<div id="accordion" role="main">

	<div class='three'>
<h3>Top 100 biggest Programs</h3>

	 


<?php 
 
include('scripts/db.php');

 if (mysql_select_db($db_database))
$program= mysql_real_escape_string($program);

   {
$program = $_GET['program']; 
   }
    if (isset($_GET['program'])) 
    {
 
  
echo "<h3>".$program."</h3>";
    }
 
$scheme_tax = mysql_real_escape_string($scheme_tax);

$query_total_last = mysql_query("SELECT value12_13,sum(value12_13) from budget_us GROUP BY PROGRAM    ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";

////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value13_14,sum(value13_14) from budget_us GROUP BY PROGRAM  ");
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





     
    
$result = mysql_query("SELECT id,Portfolio,Program,Agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17)  FROM budget_us GROUP BY PROGRAM ORDER BY sum(value13_14) DESC  LIMIT 100 ");
$num_rows = mysql_num_rows($result);
  


($rows = mysql_num_rows($result));
for ($j = 0 ; $j < $rows ; ++$j)
{
  ECHO
  

"<TABLE class='results'>

<TR><TD width='30px'>Portfolio</TD>
<TD width='300px'><a href='http://infoaus.net/budget/2013-14/us_portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title=' Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
</TD></TR>
<TR><TD width='30px'>Agency</TD>
<TD width='300px'><a href='http://infoaus.net/budget/2013-14/us_agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22'  target='_blank' title='Agency results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a>
</TD></TR>

<TR><TD width='30px'>Program</TD>
<TD width='300px'>
<a href='http://infoaus.net/budget/2013-14/us_program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result,$j, 'Program')."</a></TD></TR>
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value12_13)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value13_14)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value14_15)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value15_16)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value16_17)')).",000  </td></tr>

</table>";
}

   
     ////////////////////////////////////////////////////////////////////////////
     
 


  
  
?>


</div>
</div>

	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>