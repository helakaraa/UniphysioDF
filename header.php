<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1028805173781426",
    enable_page_level_ads: true
  });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-115476874-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-115476874-1');
</script>
<title>Ferreira Alves Fisioterapia Clinica</title>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" media="all" href="css/flexslider.css">
    <link rel="stylesheet" href="css/testimonails-slider.css">
 
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Doctor Plus Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script> 
<!-- //js -->	
<!-- start-smoth-scrolling-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>	
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>    

<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!--//end-smoth-scrolling-->
</head>
<body>
	<!--header-->
	<div class="header">
		<div class="container">
			<div class="header-logo">
		
			<div class="header-info">
            
			<a href="index.html"><h4><img src="images/logozied.png"  width="100" height="100"  alt="logo"/> Ferreira Alves Fisioterapia Especializada</h4></a> 
           
			</div>	
			</div>
			<div class="header-info">
				<p>Serviço de Informações:</p>
				<h4><a href="tel:+556135782017" style="color:white">61-3578-2017</a></h4>
			</div>			
			<div class="clearfix"> </div>
		</div>	
	</div>
	<!--//header-->
	<!--header-bottom-->
	<div class="header-bottom">
		<div class="container">
			<!--top-nav-->
			<div class="top-nav cl-effect-5">
				<span class="menu-icon"><img src="images/menu-icon.png" alt=""/></span>		
				<ul class="nav1">
					<li><a href="index.php" class="active"><span data-hover="Home">Home</span></a></li>
                <!-- <li><a href="about.php"> <span data-hover="Quem Somos">Quem Somos</span></a></li> -->
					<li><a href="services.php"> <span data-hover="Especialidades">Especialidades</span></a></li>
					<li><a href="add_patient.php"> <span data-hover="Pré-Agendamento">Pré-Agendamento</span></a></li>
				
                    <li><a href="blog.php"> <span data-hover="blog">Blog</span></a></li>
                    <li><a href="convenios.php"> <span data-hover="Convênios">Convênios</span></a></li>
                    <li><a href="contact.php"> <span data-hover="Contato">Contato</span></a></li>
                    		<?php


                if (isset($_SESSION['islogin'])) {

                	 echo '<li><a href="admin/dashboard.php"> <span data-hover="Painel de AdministraÃ§Ã£o">Painel de AdministraÃ§Ã£o</span></a></li>';
                	
                    echo '<li><a href="admin/logout.php"> <span data-hover="logout">logout</span></a></li>';
                }
               
              ?>
                	
				</ul>
				<!-- script-for-menu -->
				<script>
				   $( "span.menu-icon" ).click(function() {
					 $( "ul.nav1" ).slideToggle( 300, function() {
					 // Animation complete.
					  });
					 });
				</script>
				<!-- /script-for-menu -->
			</div>
			<!--//top-nav-->
			<form class="navbar-form navbar-right">
				<div class="form-group">
					 <form name="search_form" class="search_form" method="get" action="search.php">
	
                    <input id="search" class="form-control" type="text" name="q" value="<?php echo isset($_REQUEST['q'])?$_REQUEST['q']:""; ?>"/>
					<button type="submit"  id="search-button"  class="btn btn-default"></button>
				</div>
			</form>
                	
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//header-bottom-->
