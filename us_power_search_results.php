<?php include('scripts/header.php');?>     
 <div id="blog" role="complimentary">  
 <div id='chart'></div>
	<div class='clear'></div>
<div class='featured'>
<div id='adsense'>
Support InfoAus with a purchase from the InfoAus shop: 
 <a href='http://www.cafepress.com/infoaus/10830395'>Orange Anarchy Cat Womens Range </a> | 

 <a href='http://www.cafepress.com/infoaus/10830822'>Red Anarchy Cat Womens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830336'>Orange Anarchy Cat Mens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830805'>Red Anarchy Cat Mens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830571'>Southern Cross Womens Range</a> |
<a href='http://www.cafepress.com/infoaus/10830555'>Southern Cross Mens Range</a> |
 
 </div>
</div>
	<div class='clear'></div>
	


      </div>
   
	<div id="accordion" role="main">
	 
	
<div class="three"> 

<h3><?php ".$ps." ?></h3>


<?php 
 
include('scripts/db.php');
if (mysql_select_db($db_database))
{
$ps = $_GET['ps'];

}
if (isset($_GET['ps'])) 
{
$ps = $_GET['ps'];

}
if (isset($_GET['ps']))
echo
"<h3>Search results for: ".$ps."</h3>";
 $total_last_calc = mysql_query("SELECT value12_13,sum(value12_13) FROM budget_us");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(value12_13)')."";

$total_current_calc = mysql_query("SELECT value12_13,sum(value13_14) FROM budget_us");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(value13_14)')."";

$query_total_last = mysql_query("SELECT value12_13,sum(value12_13),value13_14,sum(value13_14) FROM budget_us JOIN objectives ON budget_us.program=objectives.program WHERE MATCH(text)  AGAINST('".$ps."'IN BOOLEAN MODE) ");
$num_rows = mysql_num_rows($query_total_last);
($rows = mysql_num_rows($query_total_last));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year = "".mysql_result($query_total_last,$j, 'SUM(value12_13)')."";

$query_total_last2 = mysql_query("SELECT value12_13,sum(value12_13),value13_14,sum(value13_14)FROM budget_us WHERE MATCH(program,objective,agency)  AGAINST('".$ps."'IN BOOLEAN MODE) ");
$num_rows = mysql_num_rows($query_total_last2);
($rows = mysql_num_rows($query_total_last2));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_last_year_two = "".mysql_result($query_total_last2,$j, 'SUM(value12_13)')."";
////////////////////////////////////////////////////////////////////

$query_total_current = mysql_query("SELECT value12_13,sum(value12_13),value13_14,sum(value13_14) FROM budget_us JOIN objectives ON budget_us.program=objectives.program WHERE MATCH(text)  AGAINST('".$ps."'IN BOOLEAN MODE)");
$num_rows = mysql_num_rows($query_total_current);
($rows = mysql_num_rows($query_total_current));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year = "".mysql_result($query_total_current,$j, 'SUM(value13_14)')."";

$query_total_current2 = mysql_query("SELECT value12_13,sum(value12_13),value13_14,sum(value13_14)FROM budget_us WHERE MATCH(program,objective,agency)  AGAINST('".$ps."'IN BOOLEAN MODE) ");
$num_rows = mysql_num_rows($query_total_current2);
($rows = mysql_num_rows($query_total_current2));
for ($j = 0 ; $j < $rows ; ++$j)
$query_total_current_year_two = "".mysql_result($query_total_current2,$j, 'SUM(value13_14)')."";

//////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////
$proportion1 = (($query_total_last_year/$total_last)*100);
$percent_one = (($query_total_current_year/$total_current)*100);
$proportion12 = (($query_total_last_year_two/$total_last)*100);
$percent2 = (($query_total_current_year_two/$total_current)*100);
//////////////////////////////////////////////////////////////////////////////////////////

$difference = ($query_total_current_year)-($query_total_last_year);
$dif_percent = ($query_total_current_year/$query_total_last_year)*100;
$diff_percent = ($percent - $proportion1);
$difference = ($query_total_current_year_two)-($query_total_last_year);
$dif_percent_two = ($query_total_current_year_two/$query_total_last_year)*100;
$diff_percent_two = ($percent2 - $proportion12);
///////////////////////////////////////////////////

$billion_ = mysql_query("SELECT value12_13,sum(value12_13),value13_14,sum(value13_14) FROM budget_us JOIN objectives ON budget_us.program=objectives.program WHERE MATCH(text)  AGAINST('".$ps."'IN BOOLEAN MODE)");
$num_rows = mysql_num_rows($billion_);
($rows = mysql_num_rows($billion_));
for ($j = 0 ; $j < $rows ; ++$j)
 $value = "".mysql_result($billion_,$j, 'sum(value13_14)')."";
 $billion = ($value/1000000); //divides this year's value by 1 million to express value in billions
 
 $billion_2 = mysql_query("SELECT value12_13,sum(value12_13),value13_14,sum(value13_14) FROM budget_us WHERE MATCH(program,objective,agency)  AGAINST('".$ps."'IN BOOLEAN MODE)  ");
$num_rows = mysql_num_rows($billion_2);
($rows = mysql_num_rows($billion_2));
for ($j = 0 ; $j < $rows ; ++$j)
 $value2 = "".mysql_result($billion_2,$j, 'sum(value13_14)')."";
 $billion_two = ($value2/1000000); //divides this year's value by 1 million to express value in billions

///////////////////////////////////////////////////////////////////////



$actual_PIT = $query_total_current_year * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT = ($actual_PIT/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$actual_TOS = $query_total_current_year * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS = ($actual_TOS/$total_current)*100/1;
//////////////////////////////////////////////////////////////
$actual_PIT_two = $query_total_current_year_two * 0.000000434;           //divides current year's value into proportion that comes from personal income tax
$PIT_two = ($actual_PIT_two/$total_current)*100/1;         //finds percentage actual_PIT is of the whole 
$actual_TOS_two = $query_total_current_year_two * 0.000000566;           //divides current year value into proportion that comes from company tax etc
$TOS_two = ($actual_TOS_two/$total_current)*100/1;
///////////////////////////////////////////////////////////////////

$billion3 = ($billion + $billion_two);
$actual_PIT3 = ($actual_PIT + $actual_PIT_two);
$actual_TOS3 = ($actual_TOS + $actual_TOS_two);
$percent = ($percent_one + $percent2);

{

echo
"<table class='top'>
<tr><td width='100px'>Total %</td><td width='100px'>Total Cost </td><td width='100px'>Personal Tax </td> <td width='100px'>Company Tax </td></tr>
<tr><td class='total'><span id='result_percentage'><b>".number_format($percent, 3)." %</b></span></td>
<td class='total'><b>$".number_format($billion3, 3)."</b> B</td>
<td class='total'><b>$".number_format($actual_PIT3, 3)."</b> B</td>
<td class='total'><b>$".number_format($actual_TOS3,3)." </b> B</td></tr>
</table>";

} 


if ($percent ==0)

echo
"<p>Sorry there are no results for that search term. Try a similar term or use the Boolean or Non Boolean All Fields search.<p>";



$result= mysql_query("SELECT * FROM budget_us WHERE MATCH(program,objective,agency)  AGAINST('".$ps."'IN BOOLEAN MODE)   ");
$num_rows = mysql_num_rows($result);

($rows = mysql_num_rows($result));
for ($j = 0 ; $j < $rows ; ++$j)
  {
  echo 
"<TABLE class='results'>
<TR>
<td>Portfolio</td>
<td>
<a href='http://infoaus.net/budget/2013-14/us_portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title=' Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
 </TD></tr><tr>
 <td>Agency</td>
 <td class='search'>
 <a href='http://infoaus.net/budget/2013-14/us_agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22' target='_blank' title='Find all results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='http://infoaus.net/budget/2013-14/us_program_results.php?program=%22".mysql_result($result,$j, 'Program')."%22' target='_blank' title='Find all Programs for ".mysql_result($result,$j, 'Program')." - opens in new window'>".mysql_result($result,$j, 'Program')."</a>
  </TD></tr><tr>
<td>Scheme</td>
<td class='id'><a href='http://infoaus.net/budget/2013-14/us_scheme_results.php?scheme=%22".mysql_result($result,$j, 'Objective')."%22' target='_blank' title=' Get totals for ".mysql_result($result,$j, 'Objective')." - opens in new window'>".mysql_result($result,$j, 'Objective')."</a></TD>
</TR>
<TR>
<td>2012/13</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value12_13')).",000  </TD></tr><tr>
<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value13_14')).",000  </TD></tr><tr>
<td>2014/15</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value14_15')).",000  </td></tr><tr>
<td>2015/16</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value15_16')).",000  </td></tr><tr>
<td>2016/17</td><TD class='money'>$".number_format(mysql_result($result,$j, 'value16_17')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'><span class='inlinesparkline'>".mysql_result($result,$j, 'value12_13')."000,".mysql_result($result,$j, 'value13_14')."000,".mysql_result($result,$j, 'value14_15')."000,".mysql_result($result,$j, 'value15_16')."000,".mysql_result($result,$j, 'value16_17')."000   
</span></td></tr>
<TR><TD> Source</td> <td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</a> </TD>
</TR></TABLE><p></p>";
;


  }
	?>
		
	</div>
	</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>