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
									<th>Linea</th>
									<th>Tipo</th>
									<th>Descripción</th>
									<th>Sabor</th>
									<th>Imagen</th>
									<th id="tdPrecio" style="display:<?php echo $sStyle;?>">Precio</th>
									<th id="tdOpe" style="display:<?php echo $sStyle;?>">Operaciones</th>
								</tr>
							</thead>
							<tbody id="tblBodyProds">
							</tbody>
						</table>
						<input type="button" value="Crear" id="btnCrearProducto"/>
					</div>

					<div id="dlgEdProductos">
						<form id="frmEdProductos" method="post" action="" enctype="multipart/form-data">
							<input type="hidden" id="txtCve"/>
							<input type="hidden" id="txtTipo"/>
							<input type="hidden" id="txtOpe"/>
							<label for="txtNom">Nombre</label>
							<input type="text" id="txtNom" required/>
							<br>
							<label for="cmbTipo" id="lbTipos"></label>
							<select id="cmbTipo" required>
							    <option value="0">Todos</option>
							    <option value="1">Pasteles</option>
							    <option value="2">Galletas</option>
                                <option value="3">Gelatinas</option>
                                <option value="4">Panquesitos</option>
							</select>
							&nbsp;&nbsp;
							<label for="cmbFiltro" id="lbFiltro"></label>
							<select id="cmbFiltro" required>
							    <option value="0">Todos</option>
							    <option value="1">Normal</option>
							    <option value="2">Dietético</option>
                                <option value="3">Diabético</option>
                                <option value="4">Vegano</option>
							</select>
							&nbsp;&nbsp;

							<label for="txtDescripcion">Descripci&oacute;n</label>
							<input type="text" id="txtDescripcion" required/>
							<br>
							<label for="txtSabor">Sabor</label>
							<input type="text" id="txtSabor" required/>
							<br>
							<label for="txtImg">Imagen</label>
							<input type="file" id="txtImg" required accept="image/jpg, image/png, image/jpeg"/>
							<br>
							<label for="txtPrecio">Precio</label>
							<input type="number" id="txtPrecio" required/>
							<br>
							<input type="submit" id="btnGestionar"/>
						</form>
					</div>
				</section>
			</main>


<?php
include_once("footer.html");
?>	