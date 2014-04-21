

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
$search_term_non = $_GET['search_term_non']; 
}
if (isset($_GET['search_term_non']))





$objective_results =  mysql_query("SELECT * from objectives WHERE text LIKE('%".$search_term_non."%') ");

 $num_rows = mysql_num_rows($objective_results);
 ($rows = mysql_num_rows($objective_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term_non." mentioned in their Objectives</h5>";
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
  <h3>Non Boolean Search All Fields</h3>
<p>This form gives Budget results from all fields eg schools, housing.</p>
<p> Will find 'school', 'schools'. Also finds results for abbreviations with 2 or more characters eg <a href='non_boolean_search_results.php?search_term_non=ABC&submit=show#non_boolean'>ABC</a>, <a href='non_boolean_search_results.php?search_term_non=SBS&submit=show#non_boolean'>SBS</a>, <a href='non_boolean_search_results.php?search_term_non=NDIS&submit=show#non_boolean'>NDIS</a>.</p>

    
    

  <form action='non_boolean_search_results.php' target='_blank' method="GET">
       <div class='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term_non" name="search_term_non" value="school" /></lable>
  
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
$search_term_non = $_GET['search_term_non']; 
}
if (isset($_GET['search_term_non']))





{
$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE Portfolio LIKE('%".$search_term_non."%') Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$search_term_non." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td> <a href='portfolio_results.php?portfolio=%22".mysql_result($portfolio_results,$j, 'Portfolio')."%22'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_table2 WHERE Agency   LIKE('%".$search_term_non."%') GROUP BY AGENCY");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$search_term_non." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table>
<tr>


<td><a href='agency_results.php?agency=%22".mysql_result($agency_results,$j, 'Agency')."%22'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')." - 
".mysql_result($agency_results,$j, 'Acronym')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_table2 WHERE Program LIKE('%".$search_term_non."%') Group by Program ");

 $num_rows = mysql_num_rows($program_results);
 ($rows = mysql_num_rows($program_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term_non." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"    <table>
      <tr>

        <td>
<a href='program_results.php?program=%22".mysql_result($program_results,$j, 'Program')."%22'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." - opens in new window'>".mysql_result($program_results,$j, 'Program')."</a>
        </td>
     </tr>
     </table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Agency,Program,Component from budget_table2 WHERE Component LIKE('%".$search_term_non."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$search_term_non." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
   </p>
";
//////////////////////////////////////////////////////////////////






}//////////////////////////////////////////////////////////////////////////////////////



?>

 </div><!--featured non boolean-->
    	
 
 










  <div style="float: left; clear:both; height: 0;"> </div>
</div><!--accordion-->
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>






