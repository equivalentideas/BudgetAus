<?php
echo
"
<table class='top'>
<tr><td width='100px'>Total %</td><td width='100px'>Total Cost </td><td width='100px'>Personal Tax </td>
 <td width='100px'>Company Tax </td><td>Payroll Tax</td><td>Misc</td></tr>
<tr><td class='total'><span id='result_percentage'><b>".number_format($percent, 2)."%</b></span></td>
<td class='total'><b>$".number_format($billion, 2)."B</b></td>
<td class='total'><b>$".number_format($actual_PIT, 2)."B</b></td>
<td class='total'><b>$".number_format($acutal_TOS,2)."B</b></td>
<td class='total'><b>$".number_format($payroll,2)."B</b></td>
<td class='total'><b>$".number_format($misc,2)."B</b></td></tr>
</table>";

?>