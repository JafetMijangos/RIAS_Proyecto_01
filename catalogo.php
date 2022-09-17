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
						<label for="cmbTipo">Tipo</label>
						<select id="cmbTipo" required>
							<option value="">Seleccione</option>
							<option value="1">Pasteles</option>
							<option value="2">Galletas</option>
                            <option value="3">Gelatinas</option>
                            <option value="4">Panquesitos</option>
						</select>
						<label for="cmbFiltro">Filtro</label>
						<select id="cmbFiltro">
							<option value="">Todos</option>
						</select>
						<br/>
						<button type="submit" id="btnBuscar">Buscar</button>
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
									<th>Imagen</th>
									<th>Tipo</th>
									<th>Descripcion</th>
									<th>Sabor</th>
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