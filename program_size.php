<?php include('scripts/header.php');?>
 <div id="blog" role="complimentary">
 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 

$result2 = mysql_query("SELECT Program, last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table2 where program Not like('%1.4 General Revenue Assistance%') GROUP BY PROGRAM ORDER BY SUM(current) DESC limit 100");

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
 <td><div class='money'>$".number_format(mysql_result($result2,$j, 'sum(plus1)')).",000</div>
</TD></TR>

</table>";
}

?>



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
 

$query_total_last = mysql_query("SELECT current,sum(current) from `budget_table2` GROUP BY PROGRAM    ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(current)')."";

////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT plus1,sum(plus1) from `budget_table2` GROUP BY PROGRAM  ");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(plus1)')."";


//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100);
//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

$dif_percentage = ($query_total_current_year/$query_total_last_year)*100;
///////////////////////////////////////////////////





     
    
$result = mysql_query("SELECT id,Portfolio,Program,Agency,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3)  
FROM budget_table2 where program Not like('%1.4 General Revenue Assistance%')  GROUP BY PROGRAM ORDER BY sum(current) DESC  LIMIT 100 ");
$num_rows = mysql_num_rows($result);
  


($rows = mysql_num_rows($result));
for ($j = 0 ; $j < $rows ; ++$j)
{
  ECHO
  

"<TABLE class='results'>

<TR><TD width='30px'>Portfolio</TD>
<TD width='300px'><a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title=' Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
</TD></TR>
<TR><TD width='30px'>Agency</TD>
<TD width='300px'><a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22'  target='_blank' title='Agency results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a>
</TD></TR>

<TR><TD width='30px'>Program</TD>
<TD width='300px'>
<a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result,$j, 'Program')."</a></TD></TR>
<TR>
<td>Last</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Plus 1</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Plus 2</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Plus 3</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr><tr>

</table>";
}

   
     ////////////////////////////////////////////////////////////////////////////
     
 


  
  
?>


</div>
</div>

	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>