<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>RapiCola - Gestión de Colas</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../vendors/linericon/style.css">
        <link rel="stylesheet" href="../css/font-awesome.min.css">
        <link rel="stylesheet" href="../vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="../vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="../vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="../vendors/animate-css/animate.css">
        <link rel="stylesheet" href="../vendors/flaticon/flaticon.css">
        <!-- main css -->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/responsive.css">
    </head>
    <body>
        <!--================Header Menu Area =================-->
        <header class="header_area">
            <div class="main_menu">
            	<nav class="navbar navbar-expand-lg navbar-light">
    				<div class="container box_1620">
    					<!-- Brand and toggle get grouped for better mobile display -->
    					<a class="navbar-brand logo_h" href="{{ route('index') }}"><img src="../img/logopage.png" alt=""></a>
    					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" 
    					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    						<span class="icon-bar"></span>
    					</button>
    					<!-- Collect the nav links, forms, and other content for toggling -->
    					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
    						<ul class="nav navbar-nav menu_nav justify-content-center">
    							<li class="nav-item active"><a style="font-size: 1em; font-weight: bold;" class="nav-link" href="{{ route('index') }}">Principal</a></li> 
    							<li class="nav-item submenu dropdown">
    								<a style="font-size: 1em; font-weight: bold;" href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" 
    								aria-haspopup="true" aria-expanded="false">Login</a>
    								<ul class="dropdown-menu">
    									<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Empresa</a> 
    									<li class="nav-item"><a class="nav-link" href="{{ route('sublogin') }}">Sucursal / Cajero</a></li>
    								</ul>
    							</li> 
    							<li class="nav-item submenu dropdown">
    								<a style="font-size: 1em; font-weight: bold;" href="" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" 
    								aria-haspopup="true" aria-expanded="false">Registrarse</a>
    								<ul class="dropdown-menu">
    									<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Como Empresa</a></li>
    									<li class="nav-item"><a class="nav-link" href="{{ route('subregister') }}">Como Usuario</a></li>
    								</ul>
    							</li> 
    						</ul>
    					</div> 
    				</div>
            	</nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->           
        
        @yield('content')

        <!--================Footer Area =================-->
        <footer class="footer_area p_120">
        	<div class="container">
        		<div class="row footer_inner">
        			<div class="col-lg-5 col-sm-6">
        				<aside class="f_widget ab_widget">
        					<div class="f_title">
        						<h3>Sobre nosotros</h3>
        					</div>
        					<p>Somos una empresa que desarrolló un sistema de gestión de clientes o colas en establecimientos comerciales.</p>
        					<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    						Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
    						Todos los derechos reservados Rapi_Cola. Diseñado con <i class="fa fa-heart-o" aria-hidden="true">
    						</i> por Zisko y <a href="https://colorlib.com" target="_blank">Colorlib</a>
    						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        				</aside>
        			</div>
        			<div class="col-lg-5 col-sm-6">
        				<aside class="f_widget news_widget">
        					<div class="f_title">
        						<h3>Rapi_Cola</h3>
        					</div>
        					<p>Una nueva forma de comprar y hacer colas en establecimientos.</p>
        					<div id="mc_embed_signup">
    							<h5>Hacer largas colas de espera para comprar es aburrido!</h5>
                            </div>
        				</aside>
        			</div>
        			<div class="col-lg-2">
        				<aside class="f_widget social_widget">
        					<div class="f_title">
        						<h3>Síguenos</h3>
        					</div>
        					<p>Nuestras Redes Sociales</p>
        					<ul class="list">
        						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
        						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
        						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
        					</ul>
        				</aside>
        			</div>
        		</div>
        	</div>
        </footer>
        <!--================End Footer Area =================-->
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../js/jquery-3.2.1.min.js"></script>
        <script src="../js/popper.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/stellar.js"></script>
        <script src="../vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="../vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="../vendors/isotope/imagesloaded.pkgd.min.js"></script>
        <script src="../vendors/isotope/isotope-min.js"></script>
        <script src="../vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="../js/jquery.ajaxchimp.min.js"></script>
        <script src="../vendors/counter-up/jquery.waypoints.min.js"></script>
        <script src="../vendors/counter-up/jquery.counterup.min.js"></script>
        <script src="../js/mail-script.js"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="../js/gmaps.min.js"></script>
        <script src="../js/theme.js"></script>
    </body>
</html>