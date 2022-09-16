<?php
include_once("header.html");
include_once("menu.php");
?>


<!-- Contact Start -->
<div class="container-fluid contact position-relative px-5" style="margin-top: 90px;">
        <div class="container">
        <div class="col-lg-12 col-md-6 text-center">
                        <h1 class="tituloN">REGISTRATE AQU&Iacute;</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form>
                    <br/><br/><br/><br/><br/><br/>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Tu Nombre" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control bg-light border-0 px-4" placeholder="Tu Correo" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Calle" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control bg-light border-0 px-4" placeholder="#" style="height: 55px;" required pattern="[0-9]{1,5}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Colonia" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Ciudad" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Estado" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control bg-light border-0 px-4" placeholder="Tel. Celular" style="height: 55px;" required pattern="[0-9]{10}">
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control bg-light border-0 px-4" placeholder="Tel. Casa" style="height: 55px;" required pattern="[0-9]{10}">
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit">Registrarse</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>    
        </div>
    </div>
<!-- Contact End -->

<br/>
                        <br/>
                        <br/>

<?php
include_once("footer.html");
?>	