<?php
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_GET, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}
?>
<?php
ini_set('display_errors', 0);
echo
	
"<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 
    'http://www.w3.org/TR/html4/strict.dtd'>
    <html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
	<head>
	<meta name='The Australian Federal Budget in searchable online format' content='Australia, budget, commonwealth, fiscal, deficit, surplus, blackhole, Joe Hockey, ALP, Liberals, Libs, economic, forecast, open data, opengov, #opendata, open knowledge, OKFN, Open Spending, funding, projection, MYEFO, PEFO, mini budget, FBO, final budget outcome, politics, democracy, GetUp, IPA, transparency, Gonski, school, public, private'>
	
	<meta http-equiv='Content-Type' content='text/html; UTF-8'>
      
 <meta name='viewport' content='width=device-width'>
<title>Results: BudgetAus </title>
	<meta name='author' content='Rosie Williams' />
	<link rel='shortcut icon' href='favicon.ico' />
    <meta charset='charset=iso-8859-1'>
   <link type='text/css' rel='stylesheet' href='styles.css' />
   
    <!--[if lte IE 8]><script language='javascript' type='text/javascript' src='scripts/lib/excanvas.min.js'></script><![endif]-->
    <script type='text/javascript' src='scripts/lib/jquery-1.8.2.js'></script>
    <script type='text/javascript' src='scripts/lib/jquery.flot.js'></script>
    <script type='text/javascript' src='scripts/lib/jquery.flot.pie.js'></script>
    <script type='text/javascript' src='scripts/charts.js'></script>

<script type='text/javascript' src='script.js'> <!--IE fix do not remove-->
<script type='text/javascript'>var switchTo5x=true;</script>
<script type='text/javascript' src='http://w.sharethis.com/button/buttons.js'></SCRIpt>
<script type='text/javascript'>stLight.options({publisher: 'ur-278853dd-74-447-af6f-22a7299b05a', doNotHash: true, doNotCopy: true, hashAddressBar: false});</SCRIpt>

 
    <script type='text/javascript' src='scripts/lib/jquery.sparkline.js'></script>
    <script type='text/javascript'>
    $(function() {
        /** This code runs when everything has been loaded on the page */
        /* Inline sparklines take their values from the contents of the tag */
        $('.inlinesparkline').sparkline(); 

        /* Sparklines can also take their values from the first argument 
        passed to the sparkline() function 
        var myvalues = [10,8,5,7,4,4,1];
        $('.dynamicsparkline').sparkline(myvalues);*/

        /* The second argument gives options such as chart type */
        $('.dynamicbar').sparkline(myvalues, {type: 'bar', barColor: 'green'} );

        /* Use 'html' instead of an array of values to pass options 
        to a sparkline with data in the tag */
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: 'red'} );
    });
    </script>
  

 </head>
<body>
	<div id='container'>
			
	
<div id='upper_nav'>

		 <div id='header1'>
               <a href='http://infoaus.net'>
<img src='http://infoaus.net/Infoaus_logo_thin.jpg'></img></a>
  
		

                  </div>
		 
<div>
	
</div>


  <div id='header2'>
      <a href='/'  title='BudgetAus Home page'>
<img src='http://infoaus.net/budgetaus_logo.jpg'></img></a>
</div><!--header2-->
</div>


  <div class='clear'></div>
  
   <hr>

 
   <div id='contact_nav'>
     
   <div class='links'><a href='http://infoaus.net/about.php'>About BudgetAus</a></div>
<div class='links'><a href='http://facebook.com/BudgetAus'>Facebook</a></div>
<div class='links'><a href='http://twitter.com/Info_Aus'>Twitter</a></div>
<div class='links'><a href='http://infoaus.net/wp'>Blog</a></div>
<div class='links'><a href='http://infoaus.net/about.php'>About InfoAus</a></div>


	                                              

   </div><!--nav-->
     

      <div class='clear'></div>";

  
  ?>