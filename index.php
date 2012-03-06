<?php
require('./ua.php');

$user = new UserAgent();

function print_instructions(){
    global $user;
    
    if(preg_match("/OS X/", $user->operating_system) != 0) {
        if($user->browser === "Firefox"){
            print('&#8679; + &#8984; + F'); // shift + command + f
        } elseif ($user->browser === 'Safari' || $user->browser === 'Chrome') {
        	print('&#8963; + &#8984; + F'); // control + command + f
        } elseif ($user->browser === 'Opera') {
        	print('&#8997; + F11'); // Option + F11
        }
    } elseif (preg_match("/Linux/", $user->operating_system) != 0) { 
        if($user->browser === "Firefox" || $user->browser === "Chrome"){
            print('F11');
        } elseif( $user->browser === "Opera"){
            print('&#8963; + F11');
        } else {
        	print('… we\'re not sure actually.');
        }
    } elseif (preg_match("/Windows/", $user->operating_system) != 0) {
        if($user->browser === "Firefox" || $user->browser === "Chrome" || $user->browser === "Internet Explorer"){
            print('F11');
        } elseif( $user->browser === "Opera"){
            print('&#8963; + F11');
        } else {
        	print('… we\'re not sure actually.');
        }
    } else {
        print('… we\'re not sure actually.');
    }
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Tell Me How To Make My Browser Full Screen</title>
  <meta name="description" content="We'll show you how to make your browser full screen.">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" >

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">

   <link href="./css/bootstrap.css" rel="stylesheet">
    <style>

      .instructions {
          font-family: Corbel, 'Lucida Grande', Helvetica, sans-serif;
          color: #67A;
      }
    </style>
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
			  <a class="brand" href="/">Tell Me How To Make My Browser Fullscreen</a>
			</div>
		</div>
	</div>
  <div class="container">
      <div class="hero-unit">
        <img src="images/logo.png" width="128" height="128" style="float: left; margin-right: 50px"/>
          <?php if($user->is_mobile){ ?> 
          <h1>You are mobile, your browser is already full screen. DUH!</h1>
          <?php } else { ?>
        <h1 style="text-align: right">
            To Go Full Screen, Press:<br>
            <span class="instructions"><?php print_instructions(); ?></span>
        </h1>
        <?php } ?>
        <div style="clear: both;"></div>
      </div>
      <div role="main">
	      <div class="alert alert-info">
	        <span class="label label-info">Info</span> These instructions are targeted at <?php print($user->vendor) ?> <?php print($user->browser) ?> <?php print($user->version) ?>, running on <?php print($user->operating_system) ?>
	      </div>
      </div>
      <footer style="text-align: center">
        <p>&copy; <a href="http://www.jwf.us">Jason Feinstein</a>, MIT Licensed</p>
        <a href="http://github.com/jasonwyatt/tellmehowtomakemybrowserfullscreen.com"><img style="position: fixed; top: 40px; right: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a>
      </footer>
  </div>

  <script>
    var _gaq=[['_setAccount','UA-9451812-8'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
</body>
</html>