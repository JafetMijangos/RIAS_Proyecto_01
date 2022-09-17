<?php
include_once("header.html");
include_once("menu.php");
include_once("heroVideo.html");
?>	
    
    <!-- ingresar Start -->
    <div class="container-fluid service position-relative px-5 mt-5" style="margin-bottom: 135px;">
        <div class="container">
        <script src="js/ctrlLogin.js" async="true"></script>
            <div class="row g-5">
                <div class="col-lg-12 col-md-6 text-center">
                            <h1 class="tituloN">Ingresar al Sistema</h1>
                </div>
                <div class="col-lg-12 col-md-6 text-center">
					<form id="frmLogin">
                    <br/>
                        <br/>
						<label class="text-primary text-uppercase mb-4" for="txtCorreoUsu">Correo</label> 
						<input class="form-control border-white p-3" type="email" id="txtCorreoUsu" required/>
						<br/>
                        <br/>
                        <br/>
						<label class="text-primary text-uppercase mb-4" for="txtPwd">Contrase&ntilde;a</label> 
						<input class="form-control border-white p-3" type="password" id="txtPwd" required/>
                        <br/>
                        <br/>
                        <br/>
						<input class="btn btn-primary border-inner py-3 px-5" type="submit" value="Entrar" id="btnEnviar"/>
					</form>
					<div id="divBienvenido" style="display:none">
						<h4>Hola <span id="paraNombre"></span></h4>
						<h5>Est&aacute;s firmado como <span id="paraTipo"></span></h5>
					</div>
                </div>    
            </div>
        </div>
    </div>
    <!-- ingresar End -->

     <!-- Testimonial Start -->
     <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Testimonios</h2>
                <h1 class="display-4 text-uppercase">Nuestros clientes dicen!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Carolina</h4>
                            <span>Estudiante</span>
                        </div>
                    </div>
                    <p class="mb-0">
                       Compre pasteles con ellos y son deliciosos, si duda volveria a comprar con ellos.
                    </p>
                </div>
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Emily</h4>
                            <span>Estudiante</span>
                        </div>
                    </div>
                    <p class="mb-0">
                    Mi hermano JuanPa me compro un pastel con sus ahorros y cien porciento valio la pena, muy ricos.
                    </p>
                </div>
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Johan</h4>
                            <span>Estudiante</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Compre una gelatina para mi novia Claudia y le fascin&oacute;, sin duda lo recomiendo.
                    </p>
                </div>
                <div class="testimonial-item bg-dark text-white border-inner p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img class="img-fluid flex-shrink-0" src="img/testimonial-4.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-3">
                            <h4 class="text-primary text-uppercase mb-1">Mariana M.</h4>
                            <span>Señora de Sanchez</span>
                        </div>
                    </div>
                    <p class="mb-0">
                        Mi esposo Arturo me compro un pastel de estos y saben deliciosos.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Service Start -->
    <div class="container-fluid service position-relative px-5 mt-5" style="margin-bottom: 135px;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <h4 class="text-uppercase mb-3">Pasteles y Panquecitos</h4>
                        <p>Los mejores pasteles y panquesitos de orizaba, 
                            en diferentes presentaciones</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <h4 class="text-uppercase mb-3">Gelatinas</h4>
                        <p>Disfruta de nuestras gelatinas de diferentes colores y sabores</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <h4 class="text-uppercase mb-3">Galletas</h4>
                        <p>La mejor variedad de galletas de chocolate, chispas y diferentes sabores.
                        </p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 text-center">
                    <h1 class="text-uppercase text-light mb-4">Normales, diet&eacute;ticos, para diab&eacute;ticos y veganos</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Start -->
    
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

<?php
include_once("team.html");
include_once("footer.html");
?>	