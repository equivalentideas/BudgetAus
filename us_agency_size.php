<?php include('scripts/header.php');?>
      
<div id="blog" role="complimentary">


 <div class='featured'>
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="us_agency_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
	</div><!--content div-->
	
	<div class='clear'></div>
		<div class='clear'></div>
<div id='adsenseblog'>
<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
<!-- infoaus.net -->
<ins class='adsbygoogle'
     style='display:inline-block;width:300px;height:250px'
     data-ad-client='ca-pub-2297636589130219'
     data-ad-slot='3313654681'></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
	
	<div class="featured">
<h3>Program Search</h3>

<h5>Get cost of Programs in the Australian Federal budget based on your search term. eg health, baby. Program search is Boolean.</h5>
<form action='us_program_results.php' target='_blank' method="GET">
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
<form action='us_scheme_results.php' target='_blank' method="GET">

<div role="form">
   <lable for="scheme"><input type="text"  id="scheme" name="scheme" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>
 
  
</div><!--innerform-->
</form>
</div><!--content div-->
<div class='clear'></div>

</div><!--innerform-->
 
 
      </div>
   
	<div id="accordion" role="main">
	 	 <script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
<!-- forsixtyeightwide -->
<ins class='adsbygoogle'
     style='display:inline-block;width:468px;height:60px'
     data-ad-client='ca-pub-2297636589130219'
     data-ad-slot='2967389889'></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<div class="three"> 


<?php
include('scripts/db.php');

if (mysql_select_db($db_database))

    
  
//$total_last = 370000000; // the actual total for 2011-12 according to 2012 MYEFO
//$total_current = 390000000; // the current total according to Wayne Swan's last media on the matter


$query_total_last = mysql_query("SELECT value12_13,sum(value12_13) from `budget_us` GROUP BY AGENCY ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` GROUP BY AGENCY");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(value13_14)')."";

//////////////////////////////////////////////////////////////////////////////////////////
$percent = (($query_total_current_year/$total_current)*100);
//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);

$dif_percentage = ($query_total_current_year/$query_total_last_year)*100;
///////////////////////////////////////////////////


$billion_ = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us` GROUP BY AGENCY");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'SUM(value13_14)')."";
 $billion = ($value/1000000); //divides this year's value by 1 m
///////////////////////////////////////////////////////////////////////
//echo "".$value"";

$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$acutal_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
///////////////////////////////////////////////////////////////////


    
   
     

//////////////////////////////////////////////////////////////////

     
$results = mysql_query("SELECT Portfolio,Program,Agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) FROM budget_us GROUP BY AGENCY order by sum(value13_14) DESC");
$num_rows = mysql_num_rows($results);
        echo 
      "<h3>All agencies listed by size</h3>
<h4>Number of Agencies ".$num_rows."</h4>";
        ($rows = mysql_num_rows($results));
{
for ($j = 0 ; $j < $rows ; ++$j)
      echo
   "<table class='results'>
<tr><td width='30px'>Portfolio</td>
<td width='300px'>
<a href='http://infoaus.net/budget/2013-14/us_portfolio_results.php?portfolio=%22".mysql_result($results,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($results,$j, 'Portfolio')." - opens in new window'>".mysql_result($results,$j, 'Portfolio')."</a>
</td></tr>
<tr><td class='left'>Agency</td>
<td><a href='http://infoaus.net/budget/2013-14/us_agency_results.php?agency=%22".mysql_result($results,$j, 'Agency')."%22'   title='Find all Agency results for ".mysql_result($results,$j, 'Agency')." 'target='_blank' '>".mysql_result($results,$j, 'Agency')."</a>
</td></tr>
      
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value12_13)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value13_14)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value14_15)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value15_16)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($results,$j, 'sum(value16_17)')).",000  

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