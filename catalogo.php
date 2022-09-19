<?php

include_once("modelo/Empleado.php");
include_once("modelo/Cliente.php");
session_start();
include_once("header.html");
include_once("menu.php");

$sStyle = "none";
	if (isset($_SESSION["sTipoFirmado"])){
		$sStyle = "block";
	}
?>
    <!--Tabla Proferora-->
    <main id="main-content">
				<script src="js/ctrlBuscaProductos.js" async="true"></script>
				<section>
					<header>
                    <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                       <h2 class="text-primary font-secondary">Menu</h2>
                        <h1 class="display-4 text-uppercase">Cat&aacute;logo de Productos</h1>
                    </div>
					</header>
                    <div class="container-fluid about py-5">
                    <div class="container">
					<form id="frmBuscarProd">
						<label class="text-primary text-uppercase mb-4" for="cmbTipo">Tipo</label>
						<select class="select" id="cmbTipo" required>
							<option value="0">Todos</option>
							<option value="1">Pasteles</option>
							<option value="2">Galletas</option>
                            <option value="3">Gelatinas</option>
                            <option value="4">Panquesitos</option>
						</select>
						<label class="text-primary text-uppercase mb-4" for="cmbFiltro">Filtro</label>
						<select class="select"s id="cmbFiltro">
							<option value="0">Todos</option>
						</select>
						<br/>
						<br/>
						<button class="btn btn-primary border-inner py-3" type="submit" id="btnBuscar">Buscar</button>
					</form>
                    </div>
                    </div>
					<div id="resBuscarProd" style="display:none">
						<h4>Productos encontrados</h4>
						<table border="1" id="tblProds">
							<thead>
								<tr>
								<th>Clave</th>
									<th>Nombre</th>
									<th>Linea</th>
									<th>Tipo</th>
									<th>Descripción</th>
									<th>Sabor</th>
									<th>Imagen</th>
									<th id="tdPrecio" style="display:<?php echo $sStyle;?>">Precio</th>
								</tr>
							</thead>
							<tbody id="tblBodyProds">
							</tbody>
						</table>
					</div>
				</section>
			</main>


<?php
include_once("footer.html");
?>	