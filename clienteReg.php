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
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Tu Nombre" id="nombreCompleto" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" class="form-control bg-light border-0 px-4" placeholder="Tu Correo" id="txtCorreoUsu" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Calle" id="calle" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control bg-light border-0 px-4" placeholder="#" id="numero" style="height: 55px;" required pattern="[0-9]{1,5}">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Colonia" id="colonia" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Ciudad" id="ciudad" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control bg-light border-0 px-4" placeholder="Estado" id="estado" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control bg-light border-0 px-4" placeholder="Tel. Celular" id="telefonoCell" style="height: 55px;" required pattern="[0-9]{10}">
                            </div>
                            <div class="col-sm-6">
                                <input class="form-control bg-light border-0 px-4" placeholder="Tel. Casa" id="telefonoCasa" style="height: 55px;" pattern="[0-9]{10}">
                            </div>
                            <div class="col-sm-12">
                                <button id="btnRegistro" type="submit">Registrarse</button>
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