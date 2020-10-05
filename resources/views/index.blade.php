@extends('layouts.homeTemplate')

@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="banner_content">
                        <h2>NO MÁS<br/>COLAS LARGAS!</h2>
                        <p style="font-size: 1em; font-weight: bold;"> Con Rapi_Cola olvidate de las largas colas de 
                        espera para comprar tus productos en tus lugares favoritos.</p>
                        <a class="banner_btn" href="#users" style="font-size: 1em; font-weight: bold;">
                        <i class="lnr lnr-users" style=" font-size: 1.5em; font-weight: bold;"></i> Usuarios</a>
                        <a class="banner_btn2" href="#business" style="font-size: 1em; font-weight: bold;">
                        <i class="lnr lnr-apartment" style=" font-size: 1.5em; font-weight: bold;"></i> Empresas</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="home_left_img">
                        <img class="img-fluid" src="img/imgheader.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Work Area =================-->
<section id="users" class="work_area p_120">
    <div class="container">
        <div class="main_title">
            <h2>Usuarios</h2>
            <p>Como usuario o cliente utiliza nuestra aplicación móvil disponible tanto para Android como para IOS.
            Con ella podrás encontrar las tiendas o establecimientos asociados con nuestro sistema y entrar a las colas virtuales
            y disfrutar de una vida sin realizar colas largas de espera para comprar tus productos.</p>
        </div>
        <div class="work_inner row">
            <div class="col-lg-4">
                <div class="work_item">
                    <i class="lnr lnr-smartphone"></i>
                    <a href="{{ route('subregister') }}"><h4>Regístrate</h4></a>
                    <p>Descarga nuestra aplicación móvil y regístrate para que puedas comenzar a disfrutar de nuestro sistema. 
                    Es totalmente GRATIS!.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="work_item">
                    <i class="lnr lnr-magnifier"></i>
                    <a href="{{ route('subregister') }}"><h4>Encuentra</h4></a>
                    <p>Una vez dentro de la aplicación encuentra el local o tienda en la que te encuentras y entra a la cola virtual.
                    Mientras realizar la búsqueda de tus productos estarás en un estado de "Ocupado".</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="work_item">
                    <i class="lnr lnr-cart"></i>
                    <a href="{{ route('subregister') }}"><h4>Compra</h4></a>
                    <p>Cuando estes listo para pagar tu compra cambia tu estado a "Disponible" desde la aplicación. Y nosotros te avisaremos
                    cuando y a que cajero debes dirigirte para terminar tu proceso de compra. Así de fácil, que esperas!</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Work Area =================-->

<!--================Made Life Area =================-->
<section id="business" class="made_life_area p_120">
    <div class="container">
        <div class="made_life_inner">
            <div class="row made_life_text">
                <div class="col-lg-6">
                    <div class="left_side_text">
                        <h3>Si eres una EMPRESA o local <br />y quieres ser parte de nosotros</h3>
                        <h6>Con nuestro sistema te ayudamos a gestionar las colas</h6>
                        <p style=" text-align: justify;">Contamos con un dashboard administrativo para que puedas gestionarlo todo 
                        con mayor facilidad y comodidad. Solo tienes que registrarte y asociarte con nosotros para gestionar las 
                        colas de tus locales y tus usuarios puedan realizar las compras de manera más fácil y cómoda.</p>
                        <a class="main_btn" href="{{ route('register') }}">Empieza ahora</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="chart_img">
                        <img class="img-fluid" src="img/browser.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Made Life Area =================--> 
@endsection