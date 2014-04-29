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
{
$budget_year = $_GET['budget_year']; 
}
$agency=mysql_real_escape_string($agency);
if(isset($_GET['agency']))
{


 
 $result_last_non_boolean =  mysql_query("SELECT Agency,Acronym,last,sum(last),current,sum(current),source,url
FROM budget_table  WHERE (Agency) LIKE('%$agency%') GROUP BY Agency ");
// this query asks for the total for the current year from the LAST BUDGET YEAR DATA for the agencies matching the user search term. This value for the last budget year data will be the ESTIMATED cost. This search is NON BOOLEAN.
      

 $num_rows = mysql_num_rows($result_last_non_boolean);
 ($rows = mysql_num_rows($result_last_non_boolean));
     
          for ($j = 0 ; $j < $rows ; ++$j)
	 
$result_current_non_boolean =  mysql_query("SELECT Portfolio,Program,Agency,Acronym,last,sum(last),current,sum(current),source,url 
FROM budget_table2  WHERE (Agency) LIKE('%$agency%')  &&  NOT('%Workplace Gender Equality Agency%') GROUP BY Agency ");
//this query asks for the total for the agencies matching the user input search term from the CURRENT BUDGET YEAR DATA for the column relating to 'last' year. This is going to be the ACTUAL spend as these are the REVISED figures for what was ESTIMATED in last year's budget data. With the value from this query and the one above, these two values can be compared and a difference calculated between ESTIMATED and ACTUAL spend for agencies that match the search term. This search is NON BOOLEAN.
       

 $num_rows = mysql_num_rows($result_current_non_boolean);

   ($rows = mysql_num_rows($result_current_non_boolean));
     
          for ($j = 0 ; $j < $rows ; ++$j)
		  
          echo
"<table class='results'>
<tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($result_current_non_boolean,$j, 'Agency')."%22&budget_year=current'   title='Find all Agency results for ".mysql_result($result_current_non_boolean,$j, 'Agency')." 'target='_blank' '>".mysql_result($result_current_non_boolean,$j, 'Agency')."</a> (".mysql_result($result_current_non_boolean,$j, 'ACRONYM').")
</td></tr>
<TR>
<td>Estimated<TD class='money'><a href=" .mysql_result($result_last_non_boolean,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result_last_non_boolean,$j, 'Source')."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
$".number_format(mysql_result($result_last_non_boolean, $j, 'sum(current)')).",000  </TD>
</tr>
<td>Actual<TD class='money'><a href=" .mysql_result($result_current_non_boolean,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result_current_non_boolean,$j, 'Source')."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
$".number_format(mysql_result($result_current_non_boolean, $j, 'sum(last)')).",000</TD>
</tr>
<tr>
<td>Difference</td><td class='money'>$".number_format(mysql_result($result_current_non_boolean, $j, 'sum(last)') - mysql_result($result_last_non_boolean, $j, 'sum(current)')).",000</td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////////////////////////  

	}
		
?>

<?php
include('scripts/db.php');

if (mysql_select_db($db_database))
{
$agency = $_GET['agency']; 
}

if(!isset($_GET['agency']))
{

$all_agencies = mysql_query("Select distinct BI.Agency, BA.B2Last, BA.B2Current, BB.B1last, BB.B1Current from
(Select distinct BU.Agency from
((select B2.Agency
from budget_table2 as B2
group by Agency) union distinct (
select B1.Agency
from budget_table1 as B1
group by B1.Agency) 
) as BU) BI left join 
(select B2.Agency, sum(B2.last) B2last, sum(B2.current) B2Current
from budget_table2 as B2
group by Agency) BA on BI.Agency = BA.Agency
left join 
(select B1.Agency, sum(B1.last) B1Last, sum(B1.current) B1Current
from budget_table1 B1
group by B1.Agency) BB on BI.Agency = BB.Agency");

 $num_rows = mysql_num_rows($all_agencies);

   ($rows = mysql_num_rows($all_agencies));
     
          for ($j = 0 ; $j < $rows ; ++$j)
		  
          echo
"<table class='results'>
<tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($all_agencies,$j, 'Agency')."%22&budget_year=current'   title='Find all Agency results for ".mysql_result($all_agencies,$j, 'Agency')." 'target='_blank' '>".mysql_result($all_agencies,$j, 'Agency')."</a> (".mysql_result($all_agencies,$j, 'ACRONYM').")
</td></tr>
<TR>
<td>Estimated<TD class='money'><a href=" .mysql_result($all_agencies,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($all_agencies,$j, 'Source')."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
$".number_format(mysql_result($all_agencies, $j, 'sum(B1current)')).",000  </TD>
</tr>
<td>Actual<TD class='money'><a href=" .mysql_result($all_agencies,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($all_agencies,$j, 'Source')."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
$".number_format(mysql_result($all_agencies, $j, 'sum(B2last)')).",000</TD>
</tr>
<tr>
<td>Difference</td><td class='money'>$".number_format(mysql_result($all_agencies, $j, 'sum(B2last)') - mysql_result($all_agencies, $j, 'sum(B1current)')).",000</td>
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