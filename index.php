<?php include('scripts/magic.php');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
    "http://www.w3.org/TR/html4/strict.dtd">
    <html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en' />
	<head>
	<meta name="The Australian Federal Budget in searchable online format" content="Australia, budget, commonwealth, fiscal, deficit, surplus, blackhole, Joe Hockey, ALP, Liberals, Libs, economic, forecast, open data, opengov, #opendata, open knowledge, OKFN, Open Spending, funding, rorts, travel rorting, entitlements, Belcher, projection, MYEFO, PEFO, mini budget, rorts, entitlements,  FBO, final budget outcome, politics, democracy, GetUp, IPA, transparency, gonski">
	
	<meta http-equiv='Content-Type' content='text/html; UTF-8' />
       <meta name='viewport' content='width=device-width'>
 
<title>Home: BudgetAus </title>
	<meta name="author" content="Rosie Williams" />
	<link rel="shortcut icon" href="favicon.ico" />
    <meta charset="UTF-8">
   <link type="text/css" rel="stylesheet" href="styles.css" />
   
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="scripts/lib/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="scripts/lib/jquery-1.8.2.js"></script>
    <script type="text/javascript" src="scripts/lib/jquery.flot.js"></script>
    <script type="text/javascript" src="scripts/lib/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="scripts/charts.js"></script>

    <script type="text/javascript" src="script.js"> <!--IE fix do not remove-->
    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-b899e478-bbbb-7daa-18c7-5fcdaa74a06"}); </script>
 
   
    
    



	

<script type="text/javascript">

function getData()
{
foo = window.location.id;
bar = document.getElementById(id);
document.form.value(bar);

}

</script>

 </head>
<body>
	<div id="container">
<div id='upper_nav'>
<div id="header1"><a href="http://infoaus.net/index.php"><img src='http://infoaus.net/Infoaus_logo_thin.jpg'></img></a> </div>	

	
<div id='header2'>
   <a href="index.php"  title="BudgetAus Home page"><img src='http://infoaus.net/budgetaus_logo.jpg'></img></a></div>		
    
<div>
<!--uppper_nav-->



  <div class="clear"></div>

  <hr>
   <div class='contact_nav'>
     <div class="links"><a href="./about.php">About</a></div>
<div class="links"><a href="http://us7.campaign-archive2.com/home/?u=109c99ba0377cbca81d6260d8&id=b2d009cdd9">NewsLetter</a></div>
<div class="links"><a href="http://facebook.com/BudgetAus">Facebook</a></div>
<div class="links"><a href="http://twitter.com/Info_Aus">Twitter</a></div>
<div class="links"><a href="http://infoaus.net/wp">Blog</a></div>



   </div><!--nav-->
 	   <div class='clear'></div>

 	   
      <div id="blog" role="complimentary">

    

	

     <h3>Budget Overview<h3>
      <table class='two'>
      <tr>
 	   <th>100 Biggest Programs</th>
 <td><a href="program_size.php" target='_blank'>Web</a></td>

  </tr>
  <tr>
 	   <th>Biggest Scheme Cuts</th>
 	  <td> <a href="component_cuts.php" target='_blank'>Web</a></td>
 	
  </tr>
  <tr>

 	     <th>Biggest Scheme Increases</th>
 	     <td><a href="component_increases.php" target='_blank'>Web</a></td> 
 	
 	   </tr>
   <tr>
 	   <th>Agencies listed by Size</th>
 	   <td>  <a href="agency_size.php" target='_blank'>Web</a></td>
 	  
 	    </tr>
 	  
 	    
 	    </table>
 	<!--    <div class="content">

<h3>Power Search</h3>
<h5>Find and total results across entire budget based on your search term (Boolean). </h5>
<form action='power_search_results.php' target='_blank' method="GET">

<div role="form">
   <lable for="scheme"><input type="text"  id="ps" name="ps" value="road roads transport" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div>
</form>
</div><!--content div-->


   

<h3>Budget Quick Stats</h3>
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
       
     
	
	
$balance= ($increases-$decreases);


 ////////////////////////////////////////////////////////////
$result1=mysql_query("SELECT Component FROM budget_table2"); // Select all Component(Scheme) data from current budget year table
$schemes = mysql_num_rows($result1); //assign number of rows in result to $schemes
$result=mysql_query("SELECT Component FROM budget_table2 WHERE (current-last) <0 "); // Select component level data where current year value minus last year value is less than 0 and assign to array called $result
$num_rows = mysql_num_rows($result);
{
echo
"<table class='two'>
   <tr>
<td><b>Total number of Schemes</b>
  </td>
   <td class='money'><b>$schemes</b> </td> 
   </tr>";
   

 echo
   "
   <tr>
  <td><b>Number of Schemes cut</b>
  </td>
   <td class='money'><b>$num_rows</b>  </td> 
   </tr>";
   
   
$result3=mysql_query("SELECT  Component FROM budget_table2"); // select component level names from database and assign to variable name $result3
$schemes = mysql_num_rows($result3); //assign number of rows in result to $schemes
$result4=mysql_query("SELECT  Component FROM budget_table2 WHERE (current-last) >0 "); // Select component level data where current year value minus last year value is greater than zero
$increased = mysql_num_rows($result4); //assign number of results of previous query to $increased
  echo
   "
   <tr>
 <td><b>Number of Schemes increased</b>
  </td>
   <td class='money'><b>$increased</b>  </td> 
   </tr>";
   
$result3=mysql_query("SELECT  Component FROM budget_table2"); // Select component level data from table current budget year table
$schemes = mysql_num_rows($result3);// Assign number of results from prior query to $schemes
$result5=mysql_query("SELECT  Component FROM  budget_table2 WHERE (current-last)=0 "); // Select component level data where current year value minus last year value is equal to zero (ie no change)
$static = mysql_num_rows($result5); // Assign number of rows from prior query to $static
 echo
   "
   <tr><td><b>Number of Schemes unchanged </b></td><td class='money'><b>$static</b> </td>  </tr>";
$total_payments_current=mysql_query("SELECT current,sum(current) FROM budget_table2 "); // Select total of current year values.

$num_rows = mysql_num_rows($total_payments_current);

   ($rows = mysql_num_rows($total_payments_current));
  
  for ($j = 0 ; $j < $rows ; ++$j)
  $total1 = "".mysql_result($total_payments_current, $j, 'sum(current)')."";
  echo
"
<tr><td><b>Total Payments (current year)</b></td><td class='money'><b>$".number_format($total1).",000</b></td></tr>";


  ////////////////////////////////////////////////////////////////// 
  $total_payments_last=mysql_query("SELECT last,sum(last) FROM budget_table2");// Select This calculates a total of last year values.

   ($rows = mysql_num_rows($total_payments_last));
  
  for ($j = 0 ; $j < $rows ; ++$j)
  $total2 = "".mysql_result($total_payments_last, $j, 'sum(last)')."";
   echo
"<tr><td><b>Total Payments (last year)</b></td><td class='money'><b>$".number_format($total2).",000</b></td></tr>";
 
 $Difference = ($total1 - $total2);
 echo

"<tr><td><b>Difference</b></td><td class='money'><b>$".number_format($Difference).",000</b></td></tr>";
 }
 echo
 "</table>";
     ?>


<h3>InfoAus Blog</h3>
<script id="feed-1378855660180404" type="text/javascript" src="http://infoaus.net/rss2html/?url=http%3A%2F%2Finfoaus.net%2Fwp%2Ffeed%2F&detail=100&limit=2&showtitle=false&nocache=true&type=js&id=1378855660180404"></SCRIPT>

<div id='twitter'>
	
	  <h3>Budget Transparency on Twitter</h3>
  <a class="twitter-timeline" href="https://twitter.com/search?q=budget+transparency" data-widget-id="385967691481112578">Tweets about "budget transparency"</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


 </div> 
     	

 </div>

 </div><!--blog-->
  

<div id="accordion" role="main">

    <div class='content'>

	<?PHP
	//ini_set('display_errors', 0);

include('scripts/db.php');
  $result =mysql_query("SELECT Portfolio,current,SUM(current) from budget_table2 GROUP BY PORTFOLIO ORDER BY SUM(current) DESC ");
  $num_rows = mysql_num_rows($result);

   ($rows = mysql_num_rows($result));
   echo
   "
  <table class='results'>
<tr>
<td><b>Portfolio</b></td><td>Total</td></tr>";
  for ($j = 0 ; $j < $rows ; ++$j)
  {
   echo
"<tr>
<td><a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22&submit=Show'  target='_blank' title=' Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
</TD>
<td class='money'>$".number_format(mysql_result($result,$j, 'SUM(current)')).",000</td></tr>";

 }
 echo
 
 "</table>";
 ?>
</div><!--content-->

   	

	

 <div class="content"> 
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="agency_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="health" /></lable>
  
   <lable for="budget_year">
<select name='budget_year'>
<option value='current'>Current</option>
<option value='last'>Last</option>

</select>
   </lable>
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
	</div><!--content div-->

	
	
	<div class="content">
<h3>Program Search</h3>

<h5>Get cost of Programs in the Australian Federal budget based on your search term. eg refugee, baby. </h5>
<form action='program_results.php' target='_blank' method="GET">
<div role="form">
   <lable for="program_search"><input type="text"  id="program" name="program" value="refugee" /></lable>
     <lable for="budget_year">
<select name='budget_year'>
<option value='current'>Current</option>
<option value='last'>Last</option>

</select>
   </lable>
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div><!--innerform-->
</form>
</div><!--content div-->

		
<div class="content">
<h3>Scheme Search</h3>
<h5>Programs are broken down into Program Components (Schemes). This is the smallest financial grain in the Portfolio Budget Statements.</h5>
<form action='scheme_results.php' target='_blank' method="GET">

<div role="form">
   <lable for="scheme"><input type="text"  id="scheme" name="scheme" value="Indigenous" /></lable>
    
   <lable for="budget_year">
<select name='budget_year'>
<option value='current'>Current</option>
<option value='last'>Last</option>

</select>
   </lable>
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div><!--innerform-->
</form>
</div><!--content div-->


<!--
 <div class="content"> 
<h3><a name='objective'>Objectives</a></h3>
<h5>This form lists all the Programs administered which contain text within the Program Objectives field that match your search term and opens in a new window.</h5>
  <form action="index.php#objective" method="GET">
<div role="form">
   <lable for="objectives"><input type="text"  id="objectives" name="objectives" value="alcohol" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div>
</form>
<?php/*
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
$objectives = $_GET['objectives']; 
}

if (isset($_GET['objectives']))
{
$objectives =  mysql_query("SELECT * from objectives WHERE MATCH(text) AGAINST('$objectives'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($objectives);
 ($rows = mysql_num_rows($objectives));
  
echo "<h5>There is a total of ".$num_rows." Programs with your search term mentioned in their Program Components</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>
<td>Program: 
<a href='program_results.php?program=%22".mysql_result($objectives,$j, 'Program')."%22'  target='_blank' title='Program Results for ".mysql_result($objectives,$j, 'Program')."'>".mysql_result($objectives,$j, 'Program')."</a>
</td></tr>
<tr>
<td>Linked Programs: ".mysql_result($objectives,$j, 'Linked')."</td></tr>
<tr>
<td>Components: ".mysql_result($objectives,$j, 'text')."</td></tr>
</tr></table><p><hr></p>";
}*/
?>
</div><!-->


<div class='content'>

    <h3><a name='non_boolean'>Non Boolean Search All Fields</a> </h3>
<p>This form gives Budget results from all fields eg schools, housing.</p>
<p> Will find 'school', 'schools', 'schoolkid'. Also finds results for abbreviations with 2 or more characters eg <a href='search_term_non=ABC&submit=show#non_boolean'>ABC</a>, <a href='search_term_non=SBS&submit=show#non_boolean'>SBS</a>, <a href='search_term_non=NDIS&submit=show#non_boolean'>NDIS</a>.</p>
</p>
    
    

  <form action='index.php#non_boolean' target='_blank' method="GET">
<div id='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term_non" name="search_term_non" value="school" /></lable>
  
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

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_table2 WHERE Agency || Acronym  LIKE('%".$search_term_non."%') Group by Agency ");

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
"<table>
<tr>

<td>
<a href='program_results.php?program=%22".mysql_result($program_results,$j, 'Program')."%22'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." - opens in new window'>".mysql_result($program_results,$j, 'Program')."</a></td>
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
"<div class='content'>
<h4>
<a href='agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'agency')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
</p>
</div>";
//////////////////////////////////////////////////////////////////

$objective_results =  mysql_query("SELECT * from objectives WHERE text LIKE('%".$search_term_non."%') ");

 $num_rows = mysql_num_rows($objective_results);
 ($rows = mysql_num_rows($objective_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." mentioned in their Program Components</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class-'results'>
<tr>
<td class='objective'>Program: 
<a href='program_results.php?program=%22".mysql_result($objective_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Program Results for ".mysql_result($objective_results,$j, 'Program')."'>".mysql_result($objective_results,$j, 'Program')."</a>
</td></tr>
<tr>
<td>Linked Programs: ".mysql_result($objective_results,$j, 'Linked')."</td></tr>
<tr>
<td>Components: ".mysql_result($objective_results,$j, 'text')."</td></tr>




</tr></table><p><hr></p>";




}//////////////////////////////////////////////////////////////////////////////////////



?>

 </div><!--content-->



<div class='content'>

    <h3><a name='boolean'>Boolean Search</a> All Fields </h3>
<p>This form gives Budget results from all fields eg schools, carbon.</p>
<p>Will find 'schools' only. Opens in a new window. Also finds acronyms of 4 or more characters  <a href='search_term=ACARA'>ACARA</a>, 
<a href='search_term=CSIRO'>CSIRO</a>, <a href='search_term=ASADA'>ASADA</a>, <a href='search_term=AGIMO'>AGIMO</a>.</p>

    
    

  <form action='index.php#boolean' target='_blank' method="GET">
<div id='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term" name="search_term" value="pharmaceutical" /></lable>
  
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
$portfolio_results =  mysql_query("SELECT Portfolio from budget_table2 WHERE MATCH(Portfolio) AGAINST('$search_term'IN BOOLEAN MODE) Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td> <a href='portfolio_results.php?portfolio=%22".mysql_result($portfolio_results,$j, 'Portfolio')."%22'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Agency,Acronym from budget_table2 WHERE MATCH(Agency,Acronym) AGAINST('$search_term'IN BOOLEAN MODE) Group by Agency ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$search_term." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>


<td><a href='agency_results.php?agency=%22".mysql_result($agency_results,$j, 'Agency')."%22&submit=Show'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')." - 
".mysql_result($agency_results,$j, 'Acronym')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$program_results =  mysql_query("SELECT Program from budget_table2 WHERE MATCH(Program) AGAINST('$search_term'IN BOOLEAN MODE) Group by Program ");

 $num_rows = mysql_num_rows($program_results);
 ($rows = mysql_num_rows($program_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>

<td>
<a href='program_results.php?program=%22".mysql_result($program_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Find Program Results for ".mysql_result($program_results,$j, 'Program')." - opens in new window'>".mysql_result($program_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Agency,Program,Component from budget_table2 WHERE MATCH(Component) AGAINST('$search_term'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$search_term." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'agency')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
</p>
</div>";
//////////////////////////////////////////////////////////////////

$objective_results =  mysql_query("SELECT * from objectives WHERE MATCH(text) AGAINST('$search_term'IN BOOLEAN MODE) ");

 $num_rows = mysql_num_rows($objective_results);
 ($rows = mysql_num_rows($objective_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$search_term." mentioned in their Program Components</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class-'results'>
<tr>
<td class='objective'>Program: 
<a href='program_results.php?program=%22".mysql_result($objective_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Program Results for ".mysql_result($objective_results,$j, 'Program')."'>".mysql_result($objective_results,$j, 'Program')."</a>
</td></tr>
<tr>
<td>Linked Programs: ".mysql_result($objective_results,$j, 'Linked')."</td></tr>
<tr>
<td>Components: ".mysql_result($objective_results,$j, 'text')."</td></tr>




</tr></table><p><hr></p>";
}//////////////////////////////////////////////////////////////////////////////////////
?>

 </div><!--content-->
    	
 



<div class='clear'></div>
  <div style="float: left; clear:both; height: 0;"> </div>
</div><!--accordion-->
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>