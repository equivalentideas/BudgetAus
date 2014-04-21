<?php include('scripts/header.php');?>   
      <div id="blog" role="complimentary">
    
 	  
<div class='featured'>

    <h3>Search All Fields &nbsp;&nbsp;&nbsp;<a href="budget_home.php">Clear</a></h3>
<h5>This form gives Budget results from all fields eg health, education.</h5>
    
    

  <form action='boolean_search_results.php' method="GET">
<div id='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term" name="search_term" value='health' /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit"  /></lable>
</div><!--form-->

</form>
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
       

 {
$search_term = $_GET['search_term']; 
}

if (isset($_GET['search_term']))





{
$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE MATCH(Portfolio) AGAINST('".mysql_real_escape_string($search_term)."'IN BOOLEAN MODE) Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>


<tr>

<td width='400px'> <a href='portfolio_results.php?portfolio=%22".mysql_result($portfolio_results,$j, 'Portfolio')."%22'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency from budget_table2 WHERE MATCH(Agency,acronym) AGAINST('".mysql_real_escape_string($search_term)."'IN BOOLEAN MODE) Group by Agency ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>


<td width='400px'><a href='agency_results.php?agency=%22".mysql_result($agency_results,$j, 'Agency')."%22'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')."
</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_table2 WHERE MATCH(Program) AGAINST('".mysql_real_escape_string($search_term)."'IN BOOLEAN MODE) Group by Program ");

 $num_rows = mysql_num_rows($program_results);
 ($rows = mysql_num_rows($program_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>

<td width='400px'>
<a href='program_results.php?program=".mysql_result($program_results,$j, 'Program')."'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." - opens in new window'>".mysql_result($program_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Component from budget_table2 WHERE MATCH(Component) AGAINST('".mysql_real_escape_string($search_term)."'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$search_term." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>
<td class='objective' width='400px'>
<a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Objective')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
</td>



</tr></table>";
//////////////////////////////////////////////////////////////////

$objective_results =  mysql_query("SELECT * from objectives WHERE MATCH(text) AGAINST('".mysql_real_escape_string($search_term)."'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($objective_results);
 ($rows = mysql_num_rows($objective_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." mentioned in their Program Objectives</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class-'results'>
<tr>
<td class='objective'>Program: 
<a href='program_results.php?program=%22".mysql_result($objective_results,$j, 'Program')."%22'  target='_blank' title='Program Results for ".mysql_result($objective_results,$j, 'Program')."'>".mysql_result($objective_results,$j, 'Program')."</a>
</td></tr>
<tr>
<td>Linked Programs: ".mysql_result($objective_results,$j, 'Linked')."</td></tr>
<tr>
<td>Objectives: ".mysql_result($objective_results,$j, 'text')."</td></tr>




</tr></table><p><hr></p>";
}//////////////////////////////////////////////////////////////////////////////////////
?>

 </div><!--content-->

      </div>
	<div id="accordion" role="main">
	  
<div class="three"> 



<?php 
include('scripts/db.php');
if (mysql_select_db($db_database))




echo
"<h3>Biggest Scheme Increases by Comparison with 2012-13 Funding</h3>";
$result = mysql_query("SELECT * FROM budget_table2 WHERE (current-last) > 0 ORDER BY (current-last) DESC ");
 $num_rows = mysql_num_rows($result);
        ($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)
      echo 
    "<table class='results'>
<tr>
<td class='left'>Portfolio</td>
<td class='right'><a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
</TD>
</tr>
<tr>
<td class='left'>Agency</td><td>
 <a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a></TD>
</tr>
<tr>
<td class='left'>Program</td>
<td> <a href='program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result,$j, 'Program')." - opens in new window'>".mysql_result($result,$j, 'Program')."</a>
</TD>
</tr>
<tr>
<td class='left'>Scheme</td>
<td class='objective'>
<a href='scheme_results.php?scheme=%22".mysql_result($result,$j, 'Component')."%22' target='_blank' title=' Get totals for ".mysql_result($result,$j, 'Component')." - opens in new window'>".mysql_result($result,$j, 'Component')."</a></TD>

</tr>

<TR>

<TD>Last <br></td>
<td class='money'>  $".number_format(mysql_result($result,$j, 'last')).",000 
</TD>

</TR>
<TR>
<TD>Current <br></td>

<td class='money'> $".number_format(mysql_result($result,$j, 'current')).",000 </TD>

</TR>
<TR>
<TD class='left'>Difference </td>

<td class='money'>
$".number_format((mysql_result($result,$j, 'current'))-(mysql_result($result,$j, 'last'))).",000 
 </td>
</TR>






<tr>
  <td class='left'></td>
  <td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</ a> </TD></tr>
 </table><p></p>";
?>

</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>