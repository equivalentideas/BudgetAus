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
   <a href="index.php"  title="BudgetAus Home page"><img src='http://infoaus.net/budgetaus_logo.jpg'></img></a>
          </div>		
    
      </div>
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
     
     <h3>Budget Overview</h3>
<table class='two'>
      <tr>
      <td>Compare <a href='estimated_v_actual.php'>Estimated v Actual Funding</a></td>
      
      </tr>
      
      
      
      
      
      <tr>
     
 	   
           <td>Find out which are the <a href="program_size.php" target='_blank'>Biggest Programs</a> in the budget.
           </td>

      </tr>
     
     <tr>
 	   
 	   <td>List all  <a href="agency_size.php" target='_blank'>Agencies by Size</a>
           </td>
 	  
    </tr>
 	  <tr>
      <td>Show funding by <a href='appropriation_type.php'>Appropriation Type</a></td>
      
      </tr>
      <tr>
      <td>Search spending by <a href='outcome.php'>Outcome Totals</a></td>
      
      </tr>
 	    
</table>

 
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
     <td>
     <b>Total Schemes</b>
     </td>
     <td class='money'><b>$schemes</b> </td> 
   </tr>";
   

 echo
   "
   <tr>
    <td>
    <b><img src='images/arrow3.png' height='12px'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='component_cuts.php' target='_blank'>Scheme Cuts</a></b>
    </td>
    <td class='money'>
    <b>$num_rows</b>  
    </td> 
   </tr>";
   
   
$result3=mysql_query("SELECT  Component FROM budget_table2"); // select component level names from database and assign to variable name $result3
$schemes = mysql_num_rows($result3); //assign number of rows in result to $schemes
$result4=mysql_query("SELECT  Component FROM budget_table2 WHERE (current-last) >0 "); // Select component level data where current year value minus last year value is greater than zero
$increased = mysql_num_rows($result4); //assign number of results of previous query to $increased
  echo
   "
   <tr>
    <td>
    <b><img src='images/arrow4.png' height='12px'>&nbsp;&nbsp;&nbsp;&nbsp;<a href='component_increases.php' target='_blank'>Scheme Increases</a></b>
    </td>
    <td class='money'>
    <b>$increased</b>  
    </td> 
   </tr>";
   
$result3=mysql_query("SELECT  Component FROM budget_table2"); // Select component level data from table current budget year table
$schemes = mysql_num_rows($result3);// Assign number of results from prior query to $schemes
$result5=mysql_query("SELECT  Component FROM  budget_table2 WHERE (current-last)=0 "); // Select component level data where current year value minus last year value is equal to zero (ie no change)
$static = mysql_num_rows($result5); // Assign number of rows from prior query to $static
 echo
   "
   <tr>
    <td>
    <b>Number unchanged </b>
    </td><td class='money'><b>$static</b> 
    </td>  
   </tr>";
$total_payments_current=mysql_query("SELECT current,sum(current) FROM budget_table2 "); // Select total of current year values.

$num_rows = mysql_num_rows($total_payments_current);

   ($rows = mysql_num_rows($total_payments_current));
  
  for ($j = 0 ; $j < $rows ; ++$j)
  $total1 = "".mysql_result($total_payments_current, $j, 'sum(current)')."";
  echo
"
   <tr>
    <td><b>Total current</b>
    </td>
    <td class='money'><b>$".number_format($total1).",000</b>
    </td>
   </tr>";


  ////////////////////////////////////////////////////////////////// 
  $total_payments_last=mysql_query("SELECT last,sum(last) FROM budget_table2");// Select This calculates a total of last year values.

   ($rows = mysql_num_rows($total_payments_last));
  
  for ($j = 0 ; $j < $rows ; ++$j)
  $total2 = "".mysql_result($total_payments_last, $j, 'sum(last)')."";
   echo
"   <tr>
     <td><b>Total last</b>
     </td><td class='money'><b>$".number_format($total2).",000</b>
     </td>
    </tr>";
 
 $Difference = ($total1 - $total2);
 echo

"   <tr>
     <td><b>Difference</b>
     </td><td class='money'><b>$".number_format($Difference).",000</b>
     </td>
    </tr>";
 }
 echo
 "</table>";
     ?>



        <div id='twitter'>
	  <h3>Budget Transparency on Twitter</h3>
	
  <a class="twitter-timeline" href="https://twitter.com/search?q=budget+transparency" data-widget-id="385967691481112578">Tweets about "budget transparency"</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<h3>InfoAus Blog</h3>
<script id="feed-1378855660180404" type="text/javascript" src="http://infoaus.net/rss2html/?url=http%3A%2F%2Finfoaus.net%2Fwp%2Ffeed%2F&detail=100&limit=2&showtitle=false&nocache=true&type=js&id=1378855660180404"></SCRIPT>

      </div> 
    
     	

     <div class='featured'>

    <h3><a name='non_boolean_search_results.php'>Non Boolean Search All Fields</a> </h3>
<p>This form gives Budget results from all fields eg schools, housing.</p>
<p> Will find 'school', 'schools'. Also finds results for abbreviations with 2 or more characters eg <a href='index.php?search_term_non=ABC&submit=show#non_boolean'>ABC</a>, <a href='index.php?search_term_non=SBS&submit=show#non_boolean'>SBS</a>, <a href='index.php?search_term_non=NDIS&submit=show#non_boolean'>NDIS</a>.</p>
<form action='non_boolean_search_results.php' target='_blank' method="GET">
       <div class='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term_non" name="search_term_non" value="school" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit"  /></lable>
      </div><!--form-->

  </form>
    
 </div><!--featured non boolean-->



<div class='featured'>

    <h3><a name='boolean_search_results.php'>Boolean Search</a> All Fields </h3>
<p>This form gives Budget results from all fields eg schools, carbon.</p>
<p>Will find 'schools' only. Opens in a new window. Also finds acronyms of 4 or more characters  <a href='index.php?search_term=ACARA'>ACARA</a>, 
<a href='index.php?search_term=CSIRO'>CSIRO</a>, <a href='index.php?search_term=ASADA'>ASADA</a>.</p>

    <form action='boolean_search_results.php' target='_blank' method="GET">
       <div class='form' role='form'>
   <lable for="search_term"><input type="text"  id="search_term" name="search_term" value="school" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit"  /></lable>
      </div><!--form-->

  </form>

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
	</div><!--content-->

	
	
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
</div><!--content -->

		
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
</div><!--content -->









  <div style="float: left; clear:both; height: 0;"> </div>
</div><!--accordion-->
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>