<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">
 <div class="featured"> 
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="estimated_v_actual.php" method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="housing" /></lable>
  

</select>
   </lable>
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
	</div><!--content div-->
<?php
include('scripts/db.php');

if (mysql_select_db($db_database))

$agencies = mysql_query("SELECT AGENCY from budget_table GROUP BY AGENCY ");//creates list of all agencies which provide clickable links that trigger results for that agency
 $num_rows = mysql_num_rows($agencies);
 ($rows = mysql_num_rows($agencies));
     
          for ($j = 0 ; $j < $rows ; ++$j)
		  
		  echo
		  "<p><a href='estimated_v_actual.php?agency=".mysql_result($agencies, $j, 'agency')."'>".mysql_result($agencies, $j, 'agency')."</a></p>";//html output for above query
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



$row = mysql_query("SELECT * from agencies");

 $num_rows = mysql_num_rows($row);

   ($rows = mysql_num_rows($row));
     
          for ($j = 0 ; $j < $rows ; ++$j)
		  
{
		  
          echo
"<table class='results'>
<tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($row,$j, 'Agency')."%22&budget_year=current'   title='Find all Agency results for ".mysql_result($row,$j, 'Agency')." 'target='_blank' '>".mysql_result($row,$j, 'Agency')."</a> 
</td></tr>
<TR>
<td>Estimated<TD class='money'>
$".number_format(mysql_result($row, $j, 'Budget_year_one_current')).",000  </TD>
</tr>
<td>Actual<TD class='money'>
$".number_format(mysql_result($row, $j, 'Budget_year_two_last')).",000</TD>
</tr>
<tr>
<td>Difference</td><td class='money'>$".number_format(mysql_result($row, $j, 'Budget_year_two_last') - mysql_result($row, $j, 'Budget_year_one_current')).",000</td>
</tr>
</table>";
}

?>

</div>
 

</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>