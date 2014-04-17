<!--   <div class='content'>
     	<h3>Budget Totals by Year</h3>
<!-- this code was originally in the home page and written
specifically for 2013 as it has hardcoded values from PEFO included.
Balance is no longer included due to lack of clarification from gov on what should 
be included in the calculation. 

GRA was taken out of the total payments as this 
assumed to be the difference between the figure calculated by BudgetAus as total 
payments and the figure published by the gov as the difference equates to the GRA 
ie is around $50b.  This difference has been observed in prior years and is na
one off problem.

I was not able to establish the veracity of this assumption as the total payments 
figure published by Treasury does specify the GRA as included. The reason for the 
discrepancy between the two figures has not been established.
-->
<?php
  
include('2013-14/login.php');

 if (mysql_select_db($db_database))
 echo
 
 "<table class='results'><tr>
 <th>Year</th>
  <th>Total PEFO Receipts</th>
  <th>Total Payments + PEFO Increases</th>
 



 <th>Balance</th></tr>";

$total_last_calc = mysql_query("SELECT value12_13,sum(value12_13) FROM budget_table2");
$num_rows = mysql_num_rows($total_last_calc);
($rows = mysql_num_rows($total_last_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_last = "".mysql_result($total_last_calc,$j, 'SUM(value12_13)').",000";

$payments = 367204000+ 2682000;
$GRA_12_13 = mysql_query("SELECT value12_13,sum(value12_13) FROM budget_table2 where Program='1.4 General Revenue Assistance' "); ////////////calculates GRA for year
$num_rows = mysql_num_rows($GRA_12_13);
($rows = mysql_num_rows($GRA_12_13));

for ($j = 0 ; $j < $rows ; ++$j)
$GRA_12 = mysql_result($GRA_12_13,$j, 'sum(value12_13)');

$fed_budget_12 = (351052000 );///total taken from Economic Statement August 2 as 12/13 figures not in PEFO
echo
"<td>12/13</td>
<td class='money'>$".number_format(351052000  ).",000</td>
<td class='money'>$".number_format($fed_budget_12).",000</td>
<td>$".number_format($fed_budget_12 - $payments).",000</td></tr> ";
///////////////////////////////////////////////////////////////////////////////////////

$total_current_calc = mysql_query("SELECT value13_14,sum(value13_14) FROM budget_table2");
$num_rows = mysql_num_rows($total_current_calc);
($rows = mysql_num_rows($total_current_calc));
for ($j = 0 ; $j < $rows ; ++$j)
$total_current = "".mysql_result($total_current_calc,$j, 'SUM(value13_14)')."";

$GRA_13_14 = mysql_query("SELECT value13_14,sum(value13_14) FROM budget_table2 where Program='1.4 General Revenue Assistance' "); ////////////calculates GRA for year
$num_rows = mysql_num_rows($GRA_13_14);
($rows = mysql_num_rows($GRA_13_14));

for ($j = 0 ; $j < $rows ; ++$j)
$GRA_13 = mysql_result($GRA_13_14,$j, 'sum(value13_14)');
$with_PEFO = ($total_current + 11727000 + 373000 ) ;//additional expense figures from PEFO page 15
$fed_budget_13 = (369452000 - ($with_PEFO- $GRA_13));//total from PEFO page 13 minus GRA gives balance

echo
"<tr><td>13/14</td>
<td class='money'>$".number_format(369452000 ).",000</td>
<td class='money'>$".number_format($with_PEFO - $GRA_13).",000</td>
<td>$".number_format($fed_budget_13 ).",000</td></tr> ";
/////////////////////////////////////////////////////////////////////////////////////

$total_14_15 = mysql_query("SELECT value14_15,sum(value14_15) FROM budget_table2");
$num_rows = mysql_num_rows($total_14_15);
($rows = mysql_num_rows($total_14_15));
for ($j = 0 ; $j < $rows ; ++$j)
$total_14_15 = "".mysql_result($total_14_15,$j, 'SUM(value14_15)')."";


$GRA_14_15 = mysql_query("SELECT value14_15,sum(value14_15) FROM budget_table2 where Program='1.4 General Revenue Assistance' "); ////////////calculates GRA for year
$num_rows = mysql_num_rows($GRA_14_15);
($rows = mysql_num_rows($GRA_14_15));

for ($j = 0 ; $j < $rows ; ++$j)
$GRA_14 = mysql_result($GRA_14_15,$j, 'sum(value14_15)');
$total_14 = ($total_14_15 + 11477000 + 1607000) - GRA_14 ;//total payments minus GRA
$fed_budget_14 = ( 390305000 - $total_14);//total receipts minus GRA gives balance
echo
"<tr><td>14/15</td>
<td class='money'>$".number_format(390305000).",000</td>
<td class='money'>$".number_format($total_14).",000</td>
<td>$".number_format($fed_budget_14).",000</td></tr> ";
//////////////////////////////////////////////////////////////////////////////////

$total_15_16 = mysql_query("SELECT value15_16,sum(value15_16) FROM budget_table2");
$num_rows = mysql_num_rows($total_15_16);
($rows = mysql_num_rows($total_15_16));
for ($j = 0 ; $j < $rows ; ++$j)
$total_15_16 = "".mysql_result($total_15_16,$j, 'SUM(value15_16)')."";


$GRA_15_16 = mysql_query("SELECT value15_16,sum(value15_16) FROM budget_table2 where Program='1.4 General Revenue Assistance' "); ////////////calculates GRA for year
$num_rows = mysql_num_rows($GRA_15_16);
($rows = mysql_num_rows($GRA_15_16));

for ($j = 0 ; $j < $rows ; ++$j)
$GRA_15 = mysql_result($GRA_15_16,$j, 'sum(value15_16)');
$with_PEFO = ((($total_15_16 - 3364000) + 8921000) - $GRA_15) ;
$fed_balance_15 = (423419000 - $with_PEFO);//total receipts number minus GRA
echo
"<tr><td>15/16</td>
<td class='money'>$".number_format(423419000).",000</td>
<td class='money'>$".number_format($with_PEFO).",000</td>
<td class='money'>$".number_format($fed_balance_15).",000</td></tr> ";
//////////////////////////////////////////////////////////////////////////////
$total_16_17 = mysql_query("SELECT value16_17,sum(value16_17) FROM budget_table2");
$num_rows = mysql_num_rows($total_16_17);
($rows = mysql_num_rows($total_16_17));
for ($j = 0 ; $j < $rows ; ++$j)
$total_16_17 = "".mysql_result($total_16_17,$j, 'SUM(value16_17)')."";

$GRA_16_17 = mysql_query("SELECT value16_17,sum(value16_17) FROM budget_table2 where Program='1.4 General Revenue Assistance' "); ////////////calculates GRA for year
$num_rows = mysql_num_rows($GRA_16_17);
($rows = mysql_num_rows($GRA_16_17));

for ($j = 0 ; $j < $rows ; ++$j)
$GRA_16 = mysql_result($GRA_16_17,$j, 'sum(value16_17)');
$with_PEFO = (($total_16_17 + 9374000) - 6811000)- $GRA_16 ;//addition to totals from PEFO page 15
$fed_balance_16 = (450802000 - $with_PEFO );//revenue figure from PEFO page 13

echo
"<tr><td>16/17</td>
<td class='money'>$".number_format(450802000).",000</td>
<td class='money'>$".number_format($with_PEFO ).",000</td>
<td class='money'>$".number_format($fed_balance_16).",000</td></tr></table> 
<p>Total payment figures used above are the total payments minus GRA calculated by BudgetAus from all Programs based on 
the Portfolio Budget Statements (May 14, 2013) updated with increases/decreases published August 2013 in <a href='http://www.treasury.gov.au/~/media/Treasury/Publications%20and%20Media/Publications/2013/Pre-Election%20Economic%20and%20Fiscal%20Outlook%202013/Downloads/PDF/PEFO_2013.ashx'>Table 4: Reconciliation of 2013-14 Budget, 2013 Economic Statement and 
2013 PEFO underlying cash balance estimates</a>, 
<a href='http://www.treasury.gov.au/PublicationsAndMedia/Publications/2013/PEFO-2013'>PEFO</a>. Total receipt figures are taken from PEFO Cash Receipts table.  </p>
<p>Last year's figures for Total Payments and Total Reciepts are taken from <a href='http://www.budget.gov.au/2012-13/content/fbo/html/appendix_b.htm'>Final Budget Outcome</a> figures 27 Sept, 2013.</p>
 
<p>The database does not contain Coalition funding figures as they have not yet been through the Parliamentary appropriation process, nor published in a format that would allow me to input them into BudgetAus for the benefit of the public.</p>";


$query = mysql_result("SELECT * FROM  `budget_table2` WHERE match('OBJECTIVE') against('Bill 2' IN BOOLEAN MODE)");
$num_rows = mysql_num_rows($query);
($rows = mysql_num_rows($query));
for ($j = 0 ; $j < $rows ; ++$j)
echo
"<p><a href='2013-14/scheme_results.php?scheme=%22".mysql_result($query,$j, 'objective')."%22'  target='_blank' 
title=' Scheme results for ".mysql_result($query,$j, 'objective')." - opens in new window'>".mysql_result($query,$j, 'objective')."</a>
</p>";
					  ?>
					  
					  
</div>-->