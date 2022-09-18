<?php
/*
Archivo:  catalogo.php
Objetivo: página para consultar el catálogo (en construcción) 
Autor:    BAOZ
*/
include_once("modelo/Empleado.php");
include_once("modelo/Cliente.php");
session_start();
include_once("cabecera.html");
include_once("menu.php");
$sStyle = "none";
	if (isset($_SESSION["sTipoFirmado"])){
		$sStyle = "block";
	}
?>		
			<main id="main-content">
				<script src="js/ctrlBuscaProductos.js" async="true"></script>
				<section>
					<header>
						<h3>Cat&aacute;logo de Productos</h3>
					</header>
					<form id="frmBuscarProd">
						<label for="cmbTipo">Tipo de Producto</label>
						<select id="cmbTipo" required>
							<option value="">Seleccione</option>
							<option value="1">Planta en maceta</option>
							<option value="2">Semillas</option>
						</select>
						<label for="cmbFiltro">Filtro (tama&ntilde;o/presentaci&oacute;n)</label>
						<select id="cmbFiltro">
							<option value="">Todos</option>
						</select>
						<br/>
						<button type="submit" id="btnBuscar">Buscar</button>
					</form>
					<div id="resBuscarProd" style="display:none">
						<h4>Productos encontrados</h4>
						<table border="1" id="tblProds">
							<thead>
								<tr>
									<th>Clave</th>
									<th>Nombre Com&uacute;n</th>
									<th>Imagen</th>
									<th>Es de sombra</th>
									<th>Tama&ntilde;o/Presentaci&oacute;n</th>
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
include_once("lateral1.html");
include_once("lateral2.html");
include_once("pie.html");
?>		