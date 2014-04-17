<?php
echo
"
<table class='top'>
<tr><td width='100px'>Total %</td><td width='100px'>Total Cost </td><td width='100px'>Personal Tax </td>
 <td width='100px'>Company Tax </td></tr>
<tr><td class='total'><span id='result_percentage'><b>".number_format($percent, 3)."%</b></span></td>
<td class='total'><b>$".number_format($billion, 3)." B</b></td>
<td class='total'><b>$".number_format($actual_PIT, 3)." B</b></td>
<td class='total'><b>$".number_format($acutal_TOS,3)." B</b></td></tr>
</table>";
//$actual_PIT is the variable that contains the value for personal income tax spend for the current year for the term input by the user
//$actual_TOS is the variable that contains the value for company and other taxes for the current year total based on the term input by the user eg if user input is 'housing' this variable holds the value for the amount of company and taxes other than personal income tax that contribute to the spending total for housing in the current budget year.
//$percent holds the total for the spending based on user input eg 'housing' as a percentage of the entire budget for the current year. The value for this variable triggers the Flot pie graph proportion labelled 'Your Result'. This triggers the calculation for the 'Rest of Budget'.

//Company Tax here refers to company and other taxes (not including personal income tax). Proportions for calculating the algorithm are taken from http://www.budget.gov.au/2012-13/content/overview/html/overview_42.htm This proportion needs to be checked over time to ensure it is kept up to date.
?>