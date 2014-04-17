<?php include('scripts/header.php');?>     
 <div id="right" role="complimentary">  




 

      </div>
   
	<div id="left" role="main">
	 


	<h3>Search by Outcome Number</h3>
		
	<form action='search_by_outcome.php'  method="GET">

	<div role="form">
		   
	  <select name='portfolio'>
	     
 <option value="Agriculture, Fisheries and Forestry">Agriculture, Fisheries and Forestry</option>
 <option value="Attorney-General">Attorney-General</option>
 <option value="Broadband, Communications and the Digital Economy">Broadband, Communications and the Digital Economy</option>
 <option value="Defence">Defence</option>
 <option value="Education, Employment and Workplace Relations">Education, Employment and Workplace Relations</option>
 <option value="Families, Housing, Community Services and Indigenous Affairs">Families, Housing, Community Services and Indigenous Affairs</option>
 <option value="Finance and Deregulation">Finance and Deregulation</option>
 <option value="Foreign Affairs and Trade">Foreign Affairs and Trade</option>
 <option value="Health and Ageing">Health and Ageing</option>
 <option value="Human Services">Human Services</option>
 <option value="Immigration and Citizenship">Immigration and Citizenship</option>
 <option value="Industry, Innovation, Climate Change, Science, Research and Tertiary Education">Industry, Innovation, Climate Change, Science, Research and Tertiary Education</option>
 <option value="Infrastructure and Transport">Infrastructure and Transport</option>
 <option value="Parliamentary Services">Parliamentary Services</option>
 <option value="Prime Minister and Cabinet">Prime Minister and Cabinet</option>
 <option value="Regional Australia, Local Government, Arts and Sport">Regional Australia, Local Government, Arts and Sport</option>
 <option value="Sustainability, Environment, Water, Population and Communities">Sustainability, Environment, Water, Population and Communities</option>
 <option value="Treasury">Treasury</option>
 <option value="Veterans Affairs">Veterans Affairs</option>
</select>
<select name='outcome'>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
	   <lable for="submit"><input type="submit" name="submit" value="Show" id="submit" /></lable>



	</div><!--innerform-->

 


<?php 
 
include('scripts/db.php');
if (mysql_select_db($db_database))
{
$outcome = $_GET['outcome'];
$portfolio  = $_GET['portfolio'];

}

//takes user input via form and selects results from budget table for current year based on portfolio and outcome number. Output is summed/grouped by Outcome
$total = mysql_query("SELECT Portfolio,Agency,Program,Component,outcome,last,current,plus1,plus2,plus3,sum(last),sum(current),sum(plus1),sum(plus2),sum(plus3) 
FROM budget_table2 WHERE PORTFOLIO LIKE('%$portfolio%') && outcome LIKE('%$outcome%') GROUP BY outcome   ");
$num_rows = mysql_num_rows($total);

($rows = mysql_num_rows($total));

{
echo
"<h3>".$portfolio." total for Outcome ".$outcome." is $".number_format(mysql_result($total,$j, 'sum(current)')).",000</h3>";
///////////////////////////////////////////////////////////////////////
}
$result = mysql_query("SELECT Portfolio,Agency,Program,Component,outcome,last,current,plus1,plus2,plus3,sum(last),sum(current),sum(plus1),sum(plus2),sum(plus3) 
FROM budget_table2 WHERE PORTFOLIO LIKE('%$portfolio%') && outcome LIKE('%$outcome%') GROUP BY agency,$outcome   ");//Output is summed by agency then by outcome within each agency for selected portfolio
$num_rows = mysql_num_rows($result);
echo "<table class='results'><tr><td><h3>Agency </h3><th>2013/14</h></tr> ";
($rows = mysql_num_rows($result));
for ($j = 0 ; $j < $rows ; ++$j)

{
echo
"  
<TR>


 <td>
 <a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22' target='_blank'
 title='Find all results for ".mysql_result($result,$j, 'Agency')." - opens in new window'>".mysql_result($result,$j, 'Agency')."</a></TD>
<TD class='money'>
$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>

";
}echo
"</table>";

$result2 = mysql_query("SELECT Portfolio,Agency,Program,Component,outcome,last,current,plus1,plus2,plus3,sum(last),sum(current),sum(plus1),sum(plus2),sum(plus3),source,URL
FROM budget_table2 WHERE PORTFOLIO LIKE('%$portfolio%') && outcome LIKE('%$outcome%') GROUP BY program ");//Output is summed by program and outcome for selected portfolio
$num_rows = mysql_num_rows($result2);
echo "<h3>Outcome ".$outcome." in the ".$portfolio." Portfolio has ".$num_rows." Programs </h3>";
($rows = mysql_num_rows($result2));
for ($j = 0 ; $j < $rows ; ++$j)

  {
  echo 
  

"<TABLE class='results'>
<tr><td> Program<br> <a href='program_results.php?program=%22".mysql_result($result2,$j, 'Program')."%22' target='_blank' 
  title='Find all Programs for ".mysql_result($result2,$j, 'Program')." - opens in new window'>".mysql_result($result2,$j, 'Program')."</a>
</td>
 <td>Agency<br>
 <a href='agency_results.php?agency=%22".mysql_result($result2,$j, 'Agency')."%22' target='_blank'
 title='Find all results for ".mysql_result($result2,$j, 'Agency')." - opens in new window'>".mysql_result($result2,$j, 'Agency')."</a></TD>
 


<TD class='money'>13/14 total<br>$".number_format(mysql_result($result2,$j, 'sum(current)')).",000  </TD></tr><tr>

</TABLE><p></p>";

	
}

$result3 = mysql_query("SELECT Portfolio,Agency,Program,Component,outcome,last,current,plus1,plus2,plus3,source,URL
FROM budget_table2 WHERE PORTFOLIO LIKE('%$portfolio%') && outcome LIKE('%$outcome%') ");//output is summed by outcome at program component level
$num_rows = mysql_num_rows($result3);
echo "<h3>Outcome ".$outcome." in the ".$portfolio." Portfolio has ".$num_rows." schemes </h3>";
($rows = mysql_num_rows($result3));
for ($j = 0 ; $j < $rows ; ++$j)

  {
  echo 
  

"<TABLE class='results'>

 <td>Agency</td>
 <td class='search'>
 <a href='agency_results.php?agency=%22".mysql_result($result3,$j, 'Agency')."%22' target='_blank'
 title='Find all results for ".mysql_result($result3,$j, 'Agency')." - opens in new window'>".mysql_result($result3,$j, 'Agency')."</a></TD></tr><tr>
 <td>Program</td>
 <td class='search'>
  <a href='program_results.php?program=%22".mysql_result($result3,$j, 'Program')."%22' target='_blank' 
  title='Find all Programs for ".mysql_result($result3,$j, 'Program')." - opens in new window'>".mysql_result($result3,$j, 'Program')."</a>
  </TD></tr><tr>

<td>Scheme</td>


<td class='id'><a href='scheme_results.php?scheme=%22".mysql_result($result3,$j, 'Objective')."%22' target='_blank' 
title=' Get totals for ".mysql_result($result3,$j, 'Component')." - opens in new window'>".mysql_result($result3,$j, 'Component')."</a></TD>

</TR>




<TR>


<td>2013/14</td><TD class='money'>$".number_format(mysql_result($result3,$j, 'current')).",000  </TD></tr><tr>

<TR>
<TD> Source</td> 

<td class='source'><a href=" .mysql_result($result3,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result3,$j, 'Source')."</a> </TD>


</TR>
</TABLE><p></p>";

	
}

	?>
		

	</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>