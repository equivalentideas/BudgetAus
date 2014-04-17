<?php
$scheme = mysqli_real_escape_string($scheme);
$ps = mysqli_real_escape_string($ps);
$program = mysqli_real_escape_string($program);
$agency = mysqli_real_escape_string($agency);
$portfolio = mysqli_real_escape_string($portfolio);
$search_term = mysqli_real_escape_string($search_term);
$search_term_non = mysqli_real_escape_string($search_term_non);
$objective = mysqli_real_escape_string($objective );
$objectives = mysqli_real_escape_string($objectives);
echo
"<hr>
<div id='footer'> 
<p>Site Design and Development Copyright <a href='http://www.linkedin.com/pub/rosie-williams/50/775/28b' target='_blank'>Rosie Williams</a>. Please visit the <a href='http://infoaus.net/about.php'>InfoAus About page</a> to view licensing information and Privacy Policy</p></div>
<script type='text/javascript'>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-43821221-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>";
?>