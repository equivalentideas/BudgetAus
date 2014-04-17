<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">

<div id='chart'></div>

 <div class="featured"> 
<h3>Agency Search</h3>
<h5>This form lists all the Programs administered by the Agencies where your search term is part of the Agency name eg research or housing. </h5>
  <form action="us_agency_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="agency_search"><input type="text"  id="agency" name="agency" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
	</div><!--content div-->
 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 
{
$agency = $_GET['agency']; 
}

    if (isset($_GET['agency']))
    
  $result2 =  mysql_query("SELECT Portfolio,Program,Agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) 
FROM budget_us  WHERE MATCH(Agency) AGAINST('$agency'IN BOOLEAN MODE) group by program ");

    $num_rows = mysql_num_rows($result2);
       ($rows = mysql_num_rows($result2));
     echo
  "<div class='button'>
  <a href='http://infoaus.net/budget/2013-14/agency_results_doc.php?agency=%22".$agency."%22' 
  target='_blank'>Word</a></div>
   <div class='button'>
   <a href='http://infoaus.net/budget/2013-14/agency_results_excel.php?agency=%22".$agency."%22' 
   target='_blank'>Excel</a></div><p></p>";
for ($j = 0 ; $j < $rows ; ++$j)
{

ECHO
  
"<TABLE class='two'>
<TR>
<TD>
<a href='http://infoaus.net/budget/2013-14/us_program_results.php?program=".mysql_result($result2,$j,
 'program')."' target='_blank' title='Get programs for this agency in new window'>
 ".mysql_result($result2,$j, 'program')."</a>
</TD></TR>
<TR>
<TD class='money'>
<span class='inlinesparkline'>".mysql_result($result2,$j, 'sum(value12_13)')."000,
".mysql_result($result2,$j, 'sum(value13_14)')."000,".mysql_result($result2,$j, 
'sum(value14_15)')."000,".mysql_result($result2,$j, 'sum(value15_16)')."000,
".mysql_result($result2,$j, 'sum(value16_17)')."000   </span>
 </td></tr>
</table>";
}



?>
	<div class='featured'>
<div id='adsense'>
Support InfoAus with a purchase from the <a href='http://cafepress.com/InfoAus'>InfoAus shop</a>: 
 <a href='http://www.cafepress.com/infoaus/10830395'>Orange Anarchy Cat Womens Range </a> | 

 <a href='http://www.cafepress.com/infoaus/10830822'>Red Anarchy Cat Womens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830336'>Orange Anarchy Cat Mens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830805'>Red Anarchy Cat Mens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830571'>Southern Cross Womens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830555'>Southern Cross Mens Range</a> |
 
 </div>
 <div class='adsenseblog'>
	  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- infoaus.net -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-2297636589130219"
     data-ad-slot="3313654681"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
      </div>
   
	<div id="accordion" role="main">
	 
	
<div class="three"> 


<?php
include('scripts/db.php');

if (mysql_select_db($db_database))
{
$agency = $_GET['agency']; 
}

    if (isset($_GET['agency']))
    
  
$total_last_calc = mysql_query("SELECT value12_13,sum(value12_13) FROM budget_us");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(value12_13)')."";


$total_current_calc = mysql_query("SELECT value13_14,sum(value13_14) FROM budget_us");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(value13_14)')."";

$query_total_last = mysql_query("SELECT value12_13,sum(value12_13) from `budget_us` 
WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) group by '$agency' ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us`
 WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) group by  '$agency'");
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


$billion_ = mysql_query("SELECT value13_14,sum(value13_14) from `budget_us`
 WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE)group by  '$agency' ");
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



{


include('scripts/tax_totals.php');
} 
    
    
    
    {

     

//////////////////////////////////////////////////////////////////

     $result_agency =  mysql_query("SELECT Portfolio,Program,Agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) 
 
FROM  `budget_us` WHERE MATCH (agency) AGAINST ('$agency'IN BOOLEAN MODE) group by agency");
 $num_rows = mysql_num_rows($result_agency);
if ($num_rows>0)
        echo 
      "<h3>Search Term: $agency</h3>
<h4>Number of Agencies ".$num_rows."</h4>";
        ($rows = mysql_num_rows($result_agency));
{
for ($j = 0 ; $j < $rows ; ++$j)
      echo
   "<table class='results'>
<tr><td width='30px'>Portfolio</td>
<td width='300px'>
<a href='http://infoaus.net/budget/2013-14/us_portfolio_results.php?portfolio=%22".mysql_result($result_agency,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result_agency,$j, 'Portfolio')." - opens in new window'>".mysql_result($result_agency,$j, 'Portfolio')."</a>
</td></tr>
<tr><td class='left'>Agency</td>
<td><a href='http://infoaus.net/budget/2013-14/us_agency_results.php?agency=%22".mysql_result($result_agency,$j, 'Agency')."%22'   title='Find all Agency results for ".mysql_result($result_agency,$j, 'Agency')." 'target='_blank' '>".mysql_result($result_agency,$j, 'Agency')."</a>
</td></tr>
      
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result_agency,$j, 'sum(value12_13)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result_agency,$j, 'sum(value13_14)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result_agency,$j, 'sum(value14_15)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result_agency,$j, 'sum(value15_16)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result_agency,$j, 'sum(value16_17)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result_agency,$j, 'sum(value12_13)')."000,".mysql_result($result_agency,$j, 'sum(value13_14)')."000,".mysql_result($result_agency,$j, 'sum(value14_15)')."000,".mysql_result($result,$j, 'sum(value15_16)')."000,".mysql_result($result,$j, 'sum(value16_17)')."000   </span>
 </td></tr>
</table>";

//////////////////////////////////////////////////////////////////////////////////////
  
  
 }
 
 if ($num_rows ==0)
 {
  echo
  "<p>Sorry there are no Agency names containing the term ".$agency.". 
  Check spelling or the results below or try a similar term.</p>";
  


{
$portfolio_results =  mysql_query("SELECT Portfolio from budget_us WHERE Portfolio LIKE('%".$agency."%') 
Group by Portfolio ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$agency." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td> <a href='us_portfolio_results.php?portfolio=%22".mysql_result($portfolio_results,$j, 'Portfolio')."%22'  target='_blank' title='Portfolio Results for ".mysql_result($portfolio_results,$j, 'Portfolio')." - opens in new window'>".mysql_result($portfolio_results,$j, 'Portfolio')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT Portfolio,program,Agency from budget_us WHERE MATCH(AGENCY) AGAINST('$agency' in BOOLEAN MODE) Group by Agency ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$agency." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>


<td><a href='us_agency_results.php?agency=%22".mysql_result($agency_results,$j, 'Agency')."%22'  target='_blank' title='Agency Results for ".mysql_result($agency_results,$j, 'Agency')." - opens in new window'>".mysql_result($agency_results,$j, 'Agency')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$agency_results =  mysql_query("SELECT portfolio,agency,Program from budget_us WHERE Agency LIKE('%".$agency."%') Group by Program  ");

 $num_rows = mysql_num_rows($agency_results);
 ($rows = mysql_num_rows($agency_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$agency." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>

<td>
<a href='us_program_results.php?program=%22".mysql_result($agency_results,$j, 'Program')."%22'  target='_blank' title='Find Program Results for ".mysql_result($agency_results,$j, 'Program')." - opens in new window'>".mysql_result($agency_results,$j, 'Program')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT Portfolio,Agency,Program,Objective from budget_us WHERE objective LIKE('%".$agency."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$agency." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='us_agency_results.php?agency=%22".mysql_result($scheme_results,$j, 'agency')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'agency')."'>".mysql_result($scheme_results,$j, 'agency')."</a>
</h4>
<p>
<a href='us_program_results.php?program=%22".mysql_result($scheme_results,$j, 'Program')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Program')."'>".mysql_result($scheme_results,$j, 'Program')."</a>
</p>
<p><a href='us_scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Objective')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Objective')."'>".mysql_result($scheme_results,$j, 'Objective')."</a>
</p>
</div>";
//////////////////////////////////////////////////////////////////





}



  }
  

$result = mysql_query("SELECT portfolio,Program,Agency,value12_13,sum(value12_13),value13_14,sum(value13_14),value14_15,sum(value14_15),value15_16,sum(value15_16),value16_17,sum(value16_17) 
FROM budget_us WHERE MATCH(Agency) AGAINST('$agency' IN BOOLEAN MODE) GROUP BY PROGRAM order by agency");

    $num_rows = mysql_num_rows($result);
    echo "<h4>Number of Programs ".$num_rows."</h4>";
    ($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)
{

 echo
   "<table class='results'>
   <tr><td class='left'>Agency</td>
<td><a href='http://infoaus.net/budget/2013-14/us_agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22'   title='Find all Agency results for ".mysql_result($result,$j, 'Agency')." 'target='_blank' '>".mysql_result($result,$j, 'Agency')."</a>
</td></tr>
<tr>
<td width='30px'>Program</td>
<td><a href='http://infoaus.net/budget/2013-14/us_program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22'   title='Find all Scheme results for ".mysql_result($result,$j, 'Program')." 'target='_blank' '>".mysql_result($result,$j, 'Program')."</a>
</td></tr>  
<TR>
<td>12/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value12_13)')).",000  </TD></tr><tr>
<td>13/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value13_14)')).",000  </TD></tr><tr>
<td>14/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value14_15)')).",000  </td></tr><tr>
<td>15/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value15_16)')).",000  </td></tr><tr>
<td>16/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(value16_17)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(value12_13)')."000,".mysql_result($result,$j, 'sum(value13_14)')."000,".mysql_result($result,$j, 'sum(value14_15)')."000,".mysql_result($result,$j, 'sum(value15_16)')."000,".mysql_result($result,$j, 'sum(value16_17)')."000   </span>
 </td></tr>
</table>";
}
  
}
?>

</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>