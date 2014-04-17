<?php

for ($j = 0 ; $j < $rows ; ++$j)
      echo
   "<table class='results'>
<tr><td width='30px'>Portfolio</td>
<td width='300px'>
<a href='portfolio_results.php?portfolio=%22".mysql_result($result,$j, 'Portfolio')."%22'  target='_blank' title='Find all Portfolio results for ".mysql_result($result,$j, 'Portfolio')." - opens in new window'>".mysql_result($result,$j, 'Portfolio')."</a>
</td></tr>
<tr><td class='left'>Agency</td>
<td><a href='agency_results.php?agency=%22".mysql_result($result,$j, 'Agency')."%22'   title='Find all Agency results for ".mysql_result($result,$j, 'Agency')." 'target='_blank' '>".mysql_result($result,$j, 'Agency')."</a>
</td></tr>
      
<TR>
<td>Last</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(last)')).",000  </TD></tr><tr>
<td>Current</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(current)')).",000  </TD></tr><tr>
<td>Plus 1</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus1)')).",000  </td></tr><tr>
<td>Plus 2</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus2)')).",000  </td></tr><tr>
<td>Plus 3</td><TD class='money'>$".number_format(mysql_result($result,$j, 'sum(plus3)')).",000  </td></tr><tr>
<td>Trend</td><TD class='money'>
<span class='inlinesparkline'>".mysql_result($result,$j, 'sum(last)')."000,".mysql_result($result,$j, 'sum(current)')."000,".mysql_result($result,$j, 'sum(plus1)')."000,".mysql_result($result,$j, 'sum(plus2)')."000,".mysql_result($result,$j, 'sum(plus3)')."000   </span>
 </td></tr><TR>
<TD> Source</td> 
<td class='source'><a href=" .mysql_result($result,$j, 'URL').' target="_blank" title="Opens in new window">' .mysql_result($result,$j, 'Source')."</a> </TD>

</TR>
</table>";

?>