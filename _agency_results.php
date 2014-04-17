<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">




      </div>
   
	<div id="accordion" role="main">
	 
	
<div class="three">
<!-- 
 <div class="featured"> 
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="_agency_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="" /></lable>
  
   <lable for="budget_year">
<select name='budget_year'>
<option value='current'>Current</option>
<option value='last'>Last</option>

</select>
   </lable>
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div>
</form>
	</div><!--content div-->
	<div class='chart'></div>
<?php
include('scripts/db.php');

if (mysql_select_db($db_database))

{
$agency = $_GET['agency']; 
}
{
$budget_year = $_GET['budget_year']; 
}


 $result_last =  mysql_query("SELECT Portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table  WHERE MATCH(Agency,Acronym) AGAINST('$agency'IN BOOLEAN MODE) GROUP BY Agency ");
      

 $num_rows = mysql_num_rows($result_last);
 ($rows = mysql_num_rows($result_last));
     
          for ($j = 0 ; $j < $rows ; ++$j)
	   
$result_current =  mysql_query("SELECT Portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_table2  WHERE MATCH(Agency,Acronym) AGAINST('$agency'IN BOOLEAN MODE) GROUP BY Agency ");
       
 echo
"
<a href='portfolio_results.php?portfolio=%22".mysql_result($result_current,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result_current,$j, 'Portfolio')." - opens in new window'>".mysql_result($result_current,$j, 'Portfolio')."</a>";
 $num_rows = mysql_num_rows($result_current);

   ($rows = mysql_num_rows($result_current));
     
          for ($j = 0 ; $j < $rows ; ++$j)
		  {
          echo
   "<table class='results'>

<tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($result_current,$j, 'Agency')."%22'   title='Find all Agency results for ".mysql_result($result_current,$j, 'Agency')." 'target='_blank' '>".mysql_result($result_current,$j, 'Agency')."</a>
</td></tr>
      <TR>

<td>Estimated<TD class='money'><a href=" .mysql_result($result_last,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result_current,$j, 'Source')."$".number_format(mysql_result($result_current,$j, 'sum(current)')).",000 </a> </TD>
</tr>
<td>Actual<TD class='money'><a href=" .mysql_result($result_current,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result_current,$j, 'Source')."$".number_format(mysql_result($result_current,$j, 'sum(last)')).",000 </a> </TD>
</tr>
<tr>
<td>Difference</td><td class='money'>".mysql_result($result_current,$j, 'Source')."$".number_format(mysql_result($result_current,$j, 'sum(last)')- mysql_result($result_current,$j, 'sum(current)')).",000</td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////////////////////////  
        }
		
?>
</div>
 

</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>