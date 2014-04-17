<?php include('scripts/header.php');?>
 <div id='blog' role='complimentary'>
    
<h3>2013-14 Appropriation Totals</h3>
<?PHP
	

include('scripts/db.php');
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

$CAC = ' CAC ';
$special_account = 'special account';
$special_appropriations = 'special appropriations';
$equity_injection = 'equity injection';
$departmental = 'Departmental'; 
$administered = 'Administered'; 
$non_appropriated= 'requiring'; //add together expenses not requiring appropriation in the budget year 
$admin_depart = $administered + $departmental ;
$total = mysql_query("SELECT current,SUM(current) FROM budget_table2");//total of all spending for curren year
$num_rows = mysql_num_rows($total);
   ($rows = mysql_num_rows($total));
   for ($j = 0 ; $j < $rows ; ++$j)

   $result_cac =mysql_query("SELECT current,SUM(current) from 
	 budget_table2 WHERE Component  LIKE('%$CAC%') GROUP BY '$CAC'");//sums current year spending for CAC agency results
    $num_rows = mysql_num_rows($result_cac);
   ($rows = mysql_num_rows($result_cac));
   for ($j = 0 ; $j < $rows ; ++$j)

   $equity =mysql_query("SELECT current,SUM(current) from 
	 budget_table2 WHERE Component  LIKE('%$equity_injection%') GROUP BY '$equity_injection'");//sums current year spending for program components that are equity injections
    $num_rows = mysql_num_rows($equity);
   ($rows = mysql_num_rows($equity));
   for ($j = 0 ; $j < $rows ; ++$j)


   $result_special_accounts =mysql_query("SELECT current,SUM(current) from 
	 budget_table2 WHERE Component LIKE('%special account%') GROUP BY 'special account'");
  $num_rows = mysql_num_rows($result_special_accounts);
   ($rows = mysql_num_rows($result_special_accounts));
   for ($j = 0 ; $j < $rows ; ++$j)



     $result_special_appropriations =mysql_query("SELECT current,SUM(current) from 
	 budget_table2 WHERE Portfolio Not like('%health%') && Portfolio Not like('%Veterans%')&& Component  LIKE('%$special_appropriations%')  GROUP BY '$special_appropriations'");//sums special appropriation spendings (as noted at program component level) other than from the health and veterans affairs portfolios. This is because special appropriations in these two portfolios are not listed at program component level and instead only included as a total.
  $num_rows = mysql_num_rows($result_special_appropriations);
   ($rows = mysql_num_rows($result_special_appropriations));
   for ($j = 0 ; $j < $rows ; ++$j)
$result_special_appropriations = "".mysql_result($result_special_appropriations,$j, 'SUM(current)')."";//assigns the value to a variable 

  $result_departmental_grand =mysql_query("SELECT current,SUM(current) from 
  budget_table2 WHERE Component  LIKE('%".$departmental."%') group by '$departmental'");//sums all departmental spending
  $num_rows = mysql_num_rows($result_departmental_grand);
   ($rows = mysql_num_rows($result_departmental_grand));
   
 $result_administered_grand =mysql_query("SELECT current,SUM(current) from 
 budget_table2 WHERE Component  LIKE('%".$administered."%') group by '$administered'");//sums all administered spending
  $num_rows = mysql_num_rows($result_administered_grand);
   ($rows = mysql_num_rows($result_administered_grand));
   
 $result_non_appropriated=mysql_query("SELECT current,SUM(current) from 
 budget_table2 WHERE Component  LIKE('%".$non_appropriated."%') GROUP BY '$non_appropriated'");//sums all non appropriated spending
  $num_rows = mysql_num_rows($result_non_appropriated);
   ($rows = mysql_num_rows($result_non_appropriated));
   for ($j = 0 ; $j < $rows ; ++$j)
   $non_approp = "".mysql_result($result_non_appropriated,$j, 'SUM(current)')."";
    
   $GRA_13_14 = mysql_query("SELECT current,sum(current) 
   FROM budget_table2 where Program='1.4 General Revenue Assistance' "); //selects spending on program 1.4 General Revenue Assistance (GST) 
   ////////////calculates GRA for year
$num_rows = mysql_num_rows($GRA_13_14);
($rows = mysql_num_rows($GRA_13_14));
  for ($j = 0 ; $j < $rows ; ++$j)
  
   $GRA = "".mysql_result($GRA_13_14,$j, 'SUM(current)')."";//assigns this value to a variable.

   
   echo
   "
  <table class='two'>
<tr>
<td width='300px'><b>Appropriation Type</b></td><td class='money'>Total</td></tr>";
  for ($j = 0 ; $j < $rows ; ++$j)
  {
   echo
//outputs totals for the queries above
   "<tr><td>Total</td><td class='money'>$".number_format(mysql_result($total,$j, 
'sum(current)')).",000</td></tr>

<tr><td><a href='scheme_results.php?scheme=%22equity injections%22&submit=Show' target='_blank'>Equity Injections</a></td><td class='money'>
$".number_format(mysql_result($equity,$j, 'sum(current)')).",000</td></tr>

<tr><td><a href='special_accounts.php?' target='_blank'>Special Accounts</a></td><td class='money'>
$".number_format(mysql_result($result_special_accounts,$j, 'sum(current)')).",000</td></tr>

<tr><td><a href='scheme_results.php?scheme='%22requiring%22'&submit=Show' target='_blank'>Non-appropriated expenses</a></td><td class='money'>
$".number_format(mysql_result($result_non_appropriated,$j,
 'sum(current)')).",000</td></tr>

<tr><td><a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_sat.htm' target='_blank'>
Special Appropriations</a></td><td class='money'>
$".number_format($result_special_appropriations + 16338230 + 42467483).",000</td></tr><!--hard coded values taken from portfolios where they are not listed in program component names-->

<tr><td><a href='scheme_results.php?scheme=%22departmental%22&submit=Show' target='_blank'>Departmental Appropriations</a></td><td class='money'>
$".number_format(mysql_result($result_departmental_grand,$j,
 'sum(current)')).",000</td></tr>

<tr><td><a href='scheme_results.php?scheme=%22administered%22&submit=Show' target='_blank'>Administered Appropriations</a></td><td class='money'>
$".number_format(mysql_result($result_administered_grand,$j,
 'sum(current)')).",000</td></tr>

";

   }
   echo
   "</table>";

 
?>
<div class='featured'>
<h3>Actual Treasury Figures</h3>

<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-01.htm'>Agriculture, Fisheries and Forestry</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-02.htm'>Attorney-General</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-03.htm'>Broadband, Communications and the Digital Economy</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-04.htm'>Defence</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-05.htm'>Education, Employment and Workplace Relations</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-06.htm'>Families, Housing, Community Services and Indigenous Affairs</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-07.htm'>Finance and Deregulation</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-08.htm'>Foreign Affairs and Trade</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-09.htm'>Health and Ageing</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-10.htm'>Human Services</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-11.htm'>Immigration and Citizenship</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-12.htm'>Industry, Innovation, Climate Change, Science, Research and Tertiary Education</a> <br>
<a href='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-13.htm'>Infrastructure and Transport</a> <br>
<A HREF='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar.htm'>Parliamentary Services</a> <br>
<A HREF='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-14.htm'>Prime Minister and Cabinet</a> <br>
<A HREF='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-15.htm'>Regional Australia, Local Government, Arts and Sport</a> <br>
<A HREF='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-16.htm'>Resources Energy and Tourism</a> <br>
<A HREF='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-17.htm'>Sustainability, Environment, Water, Population and Communities</a> <br>
<A HREF='http://budget.gov.au/2013-14/content/bp4/html/bp4_ar-18.htm'>Treasury</a>
</div>
<!--
<h3>Appropriation Bill (No. 1) </h3>
<p>Appropriation Bill (No. 1) proposes appropriations for activities that are considered to be the ordinary annual services of the Government and hence the Bill cannot be amended by the Senate under section 53 of the Constitution. The Bill sets out amounts according to whether they are departmental, administered, or for payment to CAC Act bodies.
</p><p>
Departmental appropriations are provided to meet costs over which an agency has control. They are the ordinary operating costs of government agencies. Expenditure typically covered by departmental appropriations include:
</p><ul>
<li>employee expenses;</li>
<li>supplier expenses;</li>
<li>other operational expenses (e.g. interest and finance expenses); and</li>
<li>non operating costs (e.g. replacement and capitalised maintenance of existing departmental assets valued at $10 million or less).</li>
</ul>
<h3>Appropriation Bill (No. 2)</h3>
<p>
Appropriation Bill (No. 2)  provides appropriations for matters that are not proposed for the ordinary annual services of the Government. It covers both 'non operating' costs (including certain payments to CAC Act bodies) and administered items in the form of administered amounts for new outcomes which have not previously been approved by Parliament, payments direct to local government, and some national partnership payments through the States, the Australian Capital Territory (ACT) and the Northern Territory (NT).
</p><p>
Most payments 'to' the States are made under the Federal Financial Relations Act 2009 and the related COAG Reform Fund Act 2008. Ongoing payments classified as 'through' the States for non-government schools are made under the Schools Assistance Act 2008. Other payments for non-government schools are proposed in Appropriation Bill (No. 2).
</p><p>
Financial assistance grants for local government continue to be made under the Local Government (Financial Assistance) Act 1995. Payments to local government for the Digital Regions Initiative were centralised through State and Territory treasuries, from November 2009. All other payments direct to local government continue to be proposed in Appropriation Bill (No. 2).
 </p>
 
 <h3>Special Appropriations</h3>
 <p>
 A special appropriation is a provision within an Act that provides authority to spend money for particular purposes, for example, to finance a particular project or to make social security payments. Special appropriations account for around three quarters of all government expenditure each year.  
    </p>
    <p>Explanations taken from Finance and Deregulation page http://www.finance.gov.au/budget/budget-process/appropriation-bills.html. Use on this site does not constitute endorsement by Finance and Deregulation of this site nor endorsement by this site of the government.</p>
   -->
  <h3>Administered</h3>
<p>   Revenues, expenses, assets or liabilities managed by agencies 
on behalf of the Commonwealth. Agencies do not control 
administered items. Administered expenses include grants, 
subsidies and benefits. In many cases, administered expenses 
fund the delivery of third party outputs.</p>

<h3>Annual Appropriation</h3>
<p>Two appropriation Bills are introduced into Parliament in 
May and comprise the Budget for the financial year beginning 
1 July. Further Bills are introduced later in the financial year as 
part of the additional estimates. Parliamentary departments 
have their own appropriations.</p>

<h3>Consolidated 
Revenue Fund</h3>
<p>
Section 81 of the Constitution stipulates that all revenue raised 
or money received by the Commonwealth forms the one 
consolidated revenue fund (CRF). </p>

<h3>Departmental</h3>
<p> Revenue, expenses, assets and liabilities that are controlled by 
the agency in providing its outputs. Departmental items 
would generally include computers, plant and equipment 
assets used by agencies in providing goods and services and 
most employee expenses, supplier costs and other 
administered expenses incurred. </p>

<h3>Outcome</h3>
<p>
The Government’s objectives in each portfolio area. Outcomes 
are desired results, impacts or consequences for the Australian 
community as influenced by the actions of the Australian 
Government. Actual outcomes are assessments of the end
results or impacts actually achieved.</p>

<h3>Program</h3><p>
Activity that delivers benefits, services or transfer payments to 
individuals, industry and/or the community as a whole, with 
the aim of achieving the intended result specified in an 
outcome statement.</p>

<h3>Special Account</h3>
<p>
Balances existing within the Consolidated Revenue Fund 
(CRF) that are supported by standing appropriations 
(Financial Management and Accountability (FMA) Act 1997, 
subsection 20 and 21). Special Accounts allow money in the 
CRF to be acknowledged as set-aside (hypothecated) for a 
particular purpose. Amounts credited to a Special Account 
may only be spent for the purposes of the Special Account. 
Special Accounts can only be established by a written 
determination of the Finance Minister (section 20 FMA Act) or 
through an Act of Parliament (referred to in section 21 of the 
FMA Act).</p>

<h3>Special Appropriation (including Standing Appropriation)</h3>
<p>
An amount of money appropriated by a particular Act of 
Parliament for a specific purpose and number of years. For 
Special Appropriations the authority to withdraw funds from 
the Consolidated Revenue Fund does not generally cease at 
the end of the financial year. Standing Appropriations are a 
sub-category consisting of ongoing Special Appropriations -
the amount appropriated will depend on circumstances 
specified in the legislation.</p>

<p>Glossary definitions taken from http://www.dfat.gov.au/dept/budget/2013-2014_pbs/2013-2014_DFAT_PBS_08_Part_C_Glossary.pdf</p>
       </div>
     
   
	<div id="accordion" role="main">
	 
	


<div class='three'>
	 <div class='content'>

<h3>Portfolio Spending by Appropriation Type</h3>
	<?PHP
	ini_set('display_errors', 0);

include('scripts/db.php');
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




 

//the following query takes the sum of all program components with names that include the terms 'special appropriations' and groups the results by portfolio 
        $result_special =mysql_query("SELECT Portfolio,current,SUM(current) from budget_table2 where portfolio Not LIKE('%Health and Ageing%')  && Component LIKE('%special appropriations%') GROUP BY PORTFOLIO ");
  $num_rows = mysql_num_rows($result_special);
   ($rows = mysql_num_rows($result_special));


/*
   
    $defence_special =mysql_query("SELECT Portfolio,current,SUM(current) WHERE objective LIKE('%special appropriations%') && portfolio like('%defence%')  GROUP BY PORTFOLIO");
  $num_rows = mysql_num_rows($defence_special);
   ($rows = mysql_num_rows($defence_special));
     for ($j = 0 ; $j < $rows ; ++$j)
   echo
   
   "".mysql_result($defence_special,$j, 'portfolio')." - ".mysql_result($defence_special,$j, 'sum(current)')."";
    
 $result_administered =mysql_query("SELECT current,SUM(current) from budget_table2 
 WHERE OBJECTIVE  LIKE('%".$administered2."%') GROUP BY PORTFOLIO");
  $num_rows = mysql_num_rows($result_administered);
   ($rows = mysql_num_rows($result_administered));
   
   $result_departmental =mysql_query("SELECT current,SUM(current) from budget_table2 
  WHERE OBJECTIVE  LIKE('%".$departmental2."%') GROUP BY PORTFOLIO");
  $num_rows = mysql_num_rows($result_departmental);
   ($rows = mysql_num_rows($result_departmental));
     
   
 $result_less_expenses =mysql_query("SELECT current,SUM(current) from budget_table2 
 WHERE OBJECTIVE  LIKE('%".$less_expenses."%') GROUP BY PORTFOLIO");
  $num_rows = mysql_num_rows($result_less_expenses);
   ($rows = mysql_num_rows($result_less_expenses));
   */
      
   echo
   "
  <table class='results'>
<tr>
<td width='300px'><b>Portfolio</b></td><td><font color='#333'>Special Appropriations</font></td></tr>";
  for ($j = 0 ; $j < $rows ; ++$j)
  {
   echo
"
<tr>
<td>
<a href='portfolio_scheme_search.php?portfolio=%22".mysql_result($result_special,$j, 'Portfolio')."%22&scheme=%22special%20appropriations%22' 
 target='_blank' title=' Portfolio results for ".mysql_result($result_special,$j, 'Portfolio')."-
 opens in new window'>".mysql_result($result_special,$j, 'Portfolio')."</a>
 </td>

<td class='money'>
<font color='#333'>$".number_format(mysql_result($result_special,$j, 'sum(current)')).",000</td>
</tr>
";
 }


$defence_result = (4391873);//Defence result for special appropriations needs to be hardcoded as program components in this PBS are not labelled as special appropriations
{
 echo
"<tr><td>
Defence
 </td><td class='money'>
<font color='#333'>$".number_format($defence_result).",000</td>
</tr> ";

}

$health_result = (45523688);//result for special appropriations needs to be hardcoded as program components in this PBS are not labelled as special appropriations
$health =mysql_query("SELECT Portfolio,current,SUM(current) FROM budget_table2 WHERE PORTFOLIO LIKE('%Health and Ageing%') && Component LIKE('%special appropriations%')");
$num_rows = mysql_num_rows($health);
   ($rows = mysql_num_rows($health));
for ($j = 0 ; $j < $rows ; ++$j)

{
echo

"<tr><td>
".mysql_result($health,$j, 'Portfolio')."
 </td><td class='money'>
<font color='#333'>$".number_format($health_result).",000</td>
</tr>
";

}
echo
"
</table>
";
   
 ?>
 
</div><!--content-->

<div class='content'>
<h3>Special Accounts by Portfolio/Agency</h3>
	<?PHP
	ini_set('display_errors', 0);

include('scripts/db.php');
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

$special_accounts_by_portfolio = 'special account';
//the following query takes the program components labelled with special accounts and groups these figures by portfolio and then the agencies within each portfolio
$special_accounts_by_portfolio_result =mysql_query("SELECT Portfolio,Agency,Component,current,SUM(current) FROM budget_table2 WHERE Component LIKE('%$special_accounts_by_portfolio%') GROUP BY Portfolio,Agency  ");
  $num_rows = mysql_num_rows($special_accounts_by_portfolio_result);

   ($rows = mysql_num_rows($special_accounts_by_portfolio_result));
   echo
   "
  <table class='results'>
<tr>
<td>Portfolio</td><td><b>Agency</b></td><td>Total</td></tr>";
  for ($j = 0 ; $j < $rows ; ++$j)
  {
   echo
"<tr><td><a href='portfolio_results.php?portfolio=%22".mysql_result($special_accounts_by_portfolio_result,$j, 'Portfolio')."%22&submit=Show' 
 target='_blank' title=' Portfolio results for ".mysql_result($special_accounts_by_portfolio_result,$j, 'Portfolio')." - opens in new window'>".mysql_result($special_accounts_by_portfolio_result,$j, 'portfolio')."</a>
</TD>
<td><a href='agency_results.php?agency=%22".mysql_result($special_accounts_by_portfolio_result,$j, 'agency')."%22&submit=Show' 
 target='_blank' title=' Agency results for ".mysql_result($special_accounts_by_portfolio_result,$j, 'agency')." - opens in new window'>".mysql_result($special_accounts_by_portfolio_result,$j, 'agency')."</a>
</TD>
<td class='money'>$".number_format(mysql_result($special_accounts_by_portfolio_result,$j, 'SUM(current)')).",000</td></tr>";

 }
 echo
 
 "</table>";
 ?>
 </div>
<div class='content'>
<h3>Portfolio Totals for Program Costs</h3>
	<?PHP
	ini_set('display_errors', 0);

include('scripts/db.php');
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
  $result =mysql_query("SELECT Portfolio,current,SUM(current) FROM budget_table2 GROUP BY Portfolio  ");//basic total of spending by portfolio
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
 </div>

</div>
</div>
	
</div><!--container-->
<div class='clear'></div>
<?php include('scripts/footer.php');?>