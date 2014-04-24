<?php include('scripts/header.php');?>
      
<div id="blog" role="complimentary">

	


	

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


$objective_results =  mysql_query("SELECT * from objectives WHERE MATCH(text) AGAINST('$search_term'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($objective_results);
 ($rows = mysql_num_rows($objective_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." mentioned in their Objectives</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
   <tr>
    <td class='objective'>Program: 
<a href='program_results.php?program=%22".mysql_result($objective_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Program Results for ".mysql_result($objective_results,$j, 'Program')."'>".mysql_result($objective_results,$j, 'Program')."</a> 
    </td>
   </tr>
   <tr>
    <td>Linked Programs: ".mysql_result($objective_results,$j, 'Linked')."
   </td>
    </tr>
   <tr>
   <td>Components: ".mysql_result($objective_results,$j, 'text')."
   </td>
   </tr>
</table>
<p><hr></p>";
 ?>
      </div>
   
	<div id="accordion" role="main">


<div class='content'>

  <h3>Boolean Search All Fields </h3>
<p>This form gives Budget results from all fields eg schools, carbon.</p>
<p>Will find 'schools' only. Opens in a new window. Also finds acronyms of 4 or more characters  
<a href='boolean_search_results.php?search_term=ACARA'>ACARA</a>, 
<a href='boolean_search_results.php?search_term=CSIRO'>CSIRO</a>, <a href='boolean_search_results.php?search_term=ASADA'>ASADA</a>.</p>

    
    

  <form action='boolean_search_results.php#boolean' target='_blank' method="GET">
<div class='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term" name="search_term" value="pharmaceutical" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit"  /></lable>
</div><!--form-->
</form>
</div>

<div class='content'>

  

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
$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE MATCH(Portfolio) AGAINST('$search_term'IN BOOLEAN MODE) Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
   <tr>

    <td> <a href='portfolio_results.php?portfolio=%22".mysql_result($portfolio_results,$j, 'Portfolio')."%22'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a>
    </td>

  </tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_table2 WHERE MATCH(Agency) AGAINST('$search_term'IN BOOLEAN MODE) Group by Agency ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
  <tr>
   <td>
<a href='agency_results.php?agency=%22".mysql_result($agency_results,$j, 'Agency')."%22&submit=Show'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')." - 
".mysql_result($agency_results,$j, 'Acronym')."</a>
   </td>
  </tr>
</table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_table2 WHERE MATCH(Program) AGAINST('$search_term'IN BOOLEAN MODE) Group by Program ");

 $num_rows = mysql_num_rows($program_results);
 ($rows = mysql_num_rows($program_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"
    <p>
<a href='program_results.php?program=%22".mysql_result($program_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." - opens in new window'>".mysql_result($program_results,$j, 'Program')."</a>
    </p>
  ";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Agency,Program,Component from budget_table2 WHERE MATCH(Component) AGAINST('$search_term'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"
 
   <p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
   </p>
";
//////////////////////////////////////////////////////////////////

}//////////////////////////////////////////////////////////////////////////////////////

?>

 </div><!--featured boolean-->
    	
 
 










  <div style="float: left; clear:both; height: 0;"> </div>
</div><!--accordion-->
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>






