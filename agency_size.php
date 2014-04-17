<?php include('scripts/header.php');?>
      
<div id="blog" role="complimentary">


 <div class='featured'>
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="agency_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
<h4>Agencies listed by All Years funding</h4>
<?php
ini_set('display_errors', 0);
include'login.php';
$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (mysql_select_db($db_database))
if (!$db_server) 
{
die("Unable to connect to MySQL. " . mysql_error());
}
if (mysql_select_db(!$db_database))
 {
  die("Unable to select database. " . mysql_error());
}
$result = mysql_query("SELECT all_years,sum(all_years),Portfolio,Program,Agency,acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3)
 FROM budget_table2 GROUP BY AGENCY order by sum(all_years) DESC");
$num_rows = mysql_num_rows($result);
     
  
        ($rows = mysql_num_rows($result));
{
for ($j = 0 ; $j < $rows ; ++$j)
      echo
	  "<p>".mysql_result($result,$j, 'agency').": <b>$".number_format(mysql_result($result,$j, 'sum(all_years)')).",000 </b> 

 </p>";
 }
	  ?>
	  
	</div><!--content div-->
	


	
	<div class="featured">
<h3>Program Search</h3>

<h5>Get cost of Programs in the Australian Federal budget based on your search term. eg health, baby. Program search is Boolean.</h5>
<form action='program_results.php' target='_blank' method="GET">
<div role="form">
   <lable for="program_search"><input type="text"  id="program" name="program" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div><!--innerform-->
</form>
</div><!--content div-->
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


 
      </div>
   
	<div id="accordion" role="main">
<h3>All agencies listed by size</h3>
<div class="three"> 

<?php
include('scripts/db.php');

if (mysql_select_db($db_database))



$query_total_last = mysql_query("SELECT last,sum(last) from `budget_table2` GROUP BY AGENCY,acronym ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_table2` GROUP BY AGENCY,acronym");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(current)')."";

//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100);
//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

$dif_percentage = ($query_total_current_year/$query_total_last_year)*100;
///////////////////////////////////////////////////


$billion_ = mysql_query("SELECT current,sum(current) from `budget_table2` GROUP BY AGENCY,acronym");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(current)')."";
 $billion = ($value/1000000); //divides this year's value by 1 m
///////////////////////////////////////////////////////////////////////
//echo "".$value"";

$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////


    
   
     

//////////////////////////////////////////////////////////////////

     
$results = mysql_query("SELECT all_years,sum(all_years),Portfolio,Program,Agency,acronym,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) FROM budget_table2 GROUP BY AGENCY,acronym order by sum(current) DESC");
$num_rows = mysql_num_rows($results);
        
        ($rows = mysql_num_rows($results));
{
for ($j = 0 ; $j < $rows ; ++$j)
      echo
   "<table class='results'>
<tr><td width='30px'>Portfolio</td>
<td width='300px'>
<a href='http://infoaus.net/budget/2013-14/portfolio_results.php?portfolio=%22".mysql_result($results,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($results,$j, 'Portfolio')." - opens in new window'>".mysql_result($results,$j, 'Portfolio')."</a>
</td></tr>
<tr><td class='left'>Agency</td>
<td><a href='http://infoaus.net/budget/2013-14/agency_results.php?agency=%22".mysql_result($results,$j, 'Agency')."%22'   title='Find all Agency results for ".mysql_result($results,$j, 'Agency')." 'target='_blank' '>".mysql_result($results,$j, 'Agency')."</a>
</td></tr>
      
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(plus3)')).",000  

 </td></tr><tr>
 <td>All Years</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(all_years)')).",000  

 </td></tr>
</table>";

//////////////////////////////////////////////////////////////////////////////////////
  
  
 
  
}
?>

</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>