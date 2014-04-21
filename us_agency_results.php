<?php include('scripts/header.php');?>      
<div id="blog" role="complimentary">

<div id='chart'></div>

 <div class="featured"> 
<h3>bureau Search</h3>
<h5>This form lists all the entries by the Sub-Function where your search term matches the Sub-Function eg research or housing. Find an explanation of Functions & Subfunctions <a href='http://www.gpo.gov/fdsys/pkg/BUDGET-2015-DB/pdf/BUDGET-2015-DB-4.pdf'>here</a></h5>
  <form action="us_bureau_results.php" target='_blank' method="GET">
<div role="form">
   <lable for="bureau_search"><input type="text"  id="bureau" name="bureau" value="" /></lable>
  
   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>

</div><!--innerform-->
</form>
	</div><!--content div-->
 <?php
  
include('scripts/db.php');

 if (mysql_select_db($db_database))
 
{
$bureau = $_GET['bureau']; 
}

    if (isset($_GET['bureau']))
    
  $result2 =  mysql_query("SELECT agency,subfunction,bureau,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_us  WHERE MATCH(bureau) AGAINST('$bureau'IN BOOLEAN MODE) group by subfunction ");

    $num_rows = mysql_num_rows($result2);
       ($rows = mysql_num_rows($result2));
     echo
  "<div class='button'>
  <a href='bureau_results_doc.php?bureau=%22".$bureau."%22' 
  target='_blank'>Word</a></div>
   <div class='button'>
   <a href='bureau_results_excel.php?bureau=%22".$bureau."%22' 
   target='_blank'>Excel</a></div><p></p>";
for ($j = 0 ; $j < $rows ; ++$j)
{

ECHO
  
"<TABLE class='two'>
<TR>
<TD>
<a href='us_subfunction_results.php?subfunction=".mysql_result($result2,$j,
 'subfunction')."' target='_blank' title='Get subfunctions for this bureau in new window'>
 ".mysql_result($result2,$j, 'subfunction')."</a>
</TD></TR>
<TR>
<TD class='money'>
<span class='inlinesparkline'>".mysql_result($result2,$j, 'sum(last)')."000,
".mysql_result($result2,$j, 'sum(current)')."000,".mysql_result($result2,$j, 
'sum(plus1)')."000,".mysql_result($result2,$j, 'sum(plus2)')."000,
".mysql_result($result2,$j, 'sum(plus3)')."000   </span>
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
$bureau = $_GET['bureau']; 
}

    if (isset($_GET['bureau']))
    
  
$total_last_calc = mysql_query("SELECT last,sum(last) FROM budget_us");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(last)')."";


$total_current_calc = mysql_query("SELECT current,sum(current) FROM budget_us");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(current)')."";

$query_total_last = mysql_query("SELECT last,sum(last) from `budget_us` 
WHERE MATCH(bureau) AGAINST('$bureau' IN BOOLEAN MODE) group by '$bureau' ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(last)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT current,sum(current) from `budget_us`
 WHERE MATCH(bureau) AGAINST('$bureau' IN BOOLEAN MODE) group by  '$bureau'");
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


$billion_ = mysql_query("SELECT current,sum(current) from `budget_us`
 WHERE MATCH(bureau) AGAINST('$bureau' IN BOOLEAN MODE)group by  '$bureau' ");
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



{


include('scripts/tax_totals.php');
} 
    
    
    
    

     

//////////////////////////////////////////////////////////////////

     $result_bureau =  mysql_query("SELECT agency,subfunction,bureau,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
 
FROM  `budget_us` WHERE MATCH (bureau) AGAINST ('$bureau'IN BOOLEAN MODE) group by bureau");
 $num_rows = mysql_num_rows($result_bureau);
if ($num_rows>0)
{
        echo 
      "<h3>Search Term: $bureau</h3>
<h4>Number of Agencies ".$num_rows."</h4>";
        ($rows = mysql_num_rows($result_bureau));

for ($j = 0 ; $j < $rows ; ++$j)
      echo
   "<table class='results'>
<tr><td width='30px'>agency</td>
<td width='300px'>
<a href='us_portfolio_results.php?agency=%22".mysql_result($result_bureau,$j, 'agency')."%22'  target='_blank' title='Find all agency results for ".mysql_result($result_bureau,$j, 'agency')." - opens in new window'>".mysql_result($result_bureau,$j, 'agency')."</a>
</td></tr>
<tr><td class='left'>bureau</td>
<td><a href='us_bureau_results.php?bureau=%22".mysql_result($result_bureau,$j, 'bureau')."%22'   title='Find all bureau results for ".mysql_result($result_bureau,$j, 'bureau')." 'target='_blank' '>".mysql_result($result_bureau,$j, 'bureau')."</a>
</td></tr>
      
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result_bureau,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result_bureau,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result_bureau,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result_bureau,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result_bureau,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result_bureau,$j, 'sum(last)')."000,".mysql_result($result_bureau,$j, 'sum(current)')."000,".mysql_result($result_bureau,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr>
</table>";

//////////////////////////////////////////////////////////////////////////////////////
  }
  
 
 
 if ($num_rows ==0)
 {
 
  echo
  "<p>Sorry there are no bureau names containing the term ".$bureau.". 
  Check spelling or the results below or try a similar term.</p>";
  



$portfolio_results =  mysql_query("SELECT agency from budget_us WHERE agency LIKE('%".$bureau."%') 
Group by agency ");

 $num_rows = mysql_num_rows($portfolio_results);
 ($rows = mysql_num_rows($portfolio_results));
  
echo "<h5>There is a total of ".$num_rows." Portfolios with ".$bureau." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>


<tr>

<td> <a href='us_portfolio_results.php?agency=%22".mysql_result($portfolio_results,$j, 'agency')."%22'  target='_blank' title='agency Results for ".mysql_result($portfolio_results,$j, 'agency')." - opens in new window'>".mysql_result($portfolio_results,$j, 'agency')."</a></td>

</tr>
</table>";
///////////////////////////////////////////////////////////

$bureau_results =  mysql_query("SELECT agency,subfunction,bureau from budget_us WHERE MATCH(AGENCY) AGAINST('$bureau' in BOOLEAN MODE) Group by bureau ");

 $num_rows = mysql_num_rows($bureau_results);
 ($rows = mysql_num_rows($bureau_results));
  
echo "<h5>There is a total of ".$num_rows." Agencies with ".$bureau." in their name.</h5>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>


<td><a href='us_bureau_results.php?bureau=%22".mysql_result($bureau_results,$j, 'bureau')."%22'  target='_blank' title='bureau Results for ".mysql_result($bureau_results,$j, 'bureau')." - opens in new window'>".mysql_result($bureau_results,$j, 'bureau')."</a></td>

</tr></table>";
/////////////////////////////////////////////////////////////////

$bureau_results =  mysql_query("SELECT agency,bureau,subfunction from budget_us WHERE bureau LIKE('%".$bureau."%') Group by subfunction  ");

 $num_rows = mysql_num_rows($bureau_results);
 ($rows = mysql_num_rows($bureau_results));
  
echo "<h5>There is a total of ".$num_rows." Programs with ".$bureau." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<table class='results'>
<tr>

<td>
<a href='us_program_results.php?subfunction=%22".mysql_result($bureau_results,$j, 'subfunction')."%22'  target='_blank' title='Find subfunction Results for ".mysql_result($bureau_results,$j, 'subfunction')." - opens in new window'>".mysql_result($bureau_results,$j, 'subfunction')."</a></td>
</tr>
</table>";
//////////////////////////////////////////////////////////////////

$scheme_results =  mysql_query("SELECT agency,bureau,subfunction,Component from budget_us WHERE Component LIKE('%".$bureau."%') ");

 $num_rows = mysql_num_rows($scheme_results);
 ($rows = mysql_num_rows($scheme_results));
  
echo "<h5>There is a total of ".$num_rows." Schemes with ".$bureau." in their name.</h5>
</a>";
for ($j = 0 ; $j < $rows ; ++$j)
echo 
"<div class='content'>
<h4>
<a href='us_bureau_results.php?bureau=%22".mysql_result($scheme_results,$j, 'bureau')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'bureau')."'>".mysql_result($scheme_results,$j, 'bureau')."</a>
</h4>
<p>
<a href='us_program_results.php?subfunction=%22".mysql_result($scheme_results,$j, 'subfunction')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'subfunction')."'>".mysql_result($scheme_results,$j, 'subfunction')."</a>
</p>
<p><a href='us_scheme_results.php?scheme=%22".mysql_result($scheme_results,$j, 'Component')."%22&submit=Show'  target='_blank' title='Scheme Results for ".mysql_result($scheme_results,$j, 'Component')."'>".mysql_result($scheme_results,$j, 'Component')."</a>
</p>
</div>";
//////////////////////////////////////////////////////////////////

  

$result = mysql_query("SELECT agency,subfunction,bureau,last,sum(last),current,sum(current),plus1,sum(plus1),plus2,sum(plus2),plus3,sum(plus3) 
FROM budget_us WHERE MATCH(bureau) AGAINST('$bureau' IN BOOLEAN MODE) GROUP BY subfunction order by bureau");

    $num_rows = mysql_num_rows($result);
    echo "<h4>Number of Programs ".$num_rows."</h4>";
    ($rows = mysql_num_rows($result));

for ($j = 0 ; $j < $rows ; ++$j)


 echo
   "<table class='results'>
   <tr><td class='left'>bureau</td>
<td><a href='us_bureau_results.php?bureau=%22".mysql_result($result,$j, 'bureau')."%22'   title='Find all bureau results for ".mysql_result($result,$j, 'bureau')." 'target='_blank' '>".mysql_result($result,$j, 'bureau')."</a>
</td></tr>
<tr>
<td width='30px'>subfunction</td>
<td><a href='us_program_results.php?subfunction=%22".mysql_result($result,$j, 'subfunction')."%22'   title='Find all Scheme results for ".mysql_result($result,$j, 'subfunction')." 'target='_blank' '>".mysql_result($result,$j, 'subfunction')."</a>
</td></tr>  
<TR>
<td>12/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>13/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>14/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>15/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>16/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr>
</table>";

  }

?>

</div>
	</div>
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>