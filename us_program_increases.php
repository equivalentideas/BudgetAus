<?php include('scripts/header.php');?> 
    <div id="blog" role="complimentary">
<div class='clear'></div>
 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 

$result2 = mysql_query("SELECT Program, value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17),DIFFERENCE,SUM(DIFFERENCE) FROM budget_us where DIFFERENCE >0 GROUP BY PROGRAM ORDER BY SUM(DIFFERENCE) DESC ");
    $num_rows = mysql_num_rows($result2);
    ($rows = mysql_num_rows($result2));

for ($j = 0 ; $j < $rows ; ++$j)
{

ECHO
  
"<TABLE class='two'>



<TR>
<TD>
<a href='program_results.php?program=%22".mysql_result($result2,$j, 'Program')."%22' target='_blank' title='Get Schemes for this Program in new window'>".mysql_result($result2,$j, 'Program')."</a> </td>
<TD class='money'>$".number_format(mysql_result($result2,$j, 'SUM(DIFFERENCE)')).",000</TD></TR>

</table>";
}

?>
	
	
	
	
	
<div class='clear'></div>


      </div>
   
	<div id="accordion" role="main">

	
	
	
	
	
<div class="three"> 
 
<h3>Biggest Program Increases - Top 100</h3>
<?php

include('scripts/db.php');

if (mysql_select_db($db_database))



$results = mysql_query("SELECT Agency,Program,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17),DIFFERENCE,SUM(DIFFERENCE) FROM budget_us where DIFFERENCE > 0 GROUP BY PROGRAM ORDER BY SUM(DIFFERENCE) DESC");
 $num_rows = mysql_num_rows($results);
        ($rows = mysql_num_rows($results));

for ($j = 0 ; $j < $rows ; ++$j)
{
      echo 
     "<table class='results'>
<tr><td>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($results,$j, 'agency')."%22' target='_blank' title='Get Programs for this agency in new window'>".mysql_result($results,$j, 'agency')."</a>
</td></tr>
<tr><td>Program</td><td>
<a href='program_results.php?program=%22".mysql_result($results,$j, 'program')."%22' target='_blank' title='Get Schemes for this program in new window'>".mysql_result($results,$j, 'program')."</a></td>



<td class='money'>$".number_format(mysql_result($results,$j, 'SUM(DIFFERENCE)')).",000</td></tr>
      
<TR>
<td>12/13</td><td></td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value12_13)')).",000  </TD></tr><tr>
<td>13/14</td><td></td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value13_14)')).",000  </TD></tr><tr>
<td>14/15</td><td></td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value14_15)')).",000  </td></tr><tr>
<td>15/16</td><td></td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value15_16)')).",000  </td></tr><tr>
<td>16/17</td><td></td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value16_17)')).",000  </td></tr>
</table>";
}
?>

</div>
</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>