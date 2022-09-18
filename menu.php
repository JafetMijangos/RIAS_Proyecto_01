<!-- Navbar Start -->
	<!-- menu.php -->
    <?php
				$sClsMnPacientes="menu_inhab";
				$sClsMnCajero="menu_inhab";
				$sClsMnAlmacenista="menu_inhab";
				$sClsMnAdmor="menu_inhab";
				$sClsMnSalir="menu_inhab";
				$bFirmado = false;
				$oFirmado = null;
				
				$bFirmado = isset($_SESSION["sTipoFirmado"]);
				if ($bFirmado){
					$sClsMnSalir="menu";
					switch ($_SESSION["sTipoFirmado"]){
						case Empleado::CAJERO: $sClsMnCajero="menu";
											   break;
						case Empleado::ALMACENISTA: $sClsMnAlmacenista="menu";
											   break;
						case Empleado::ADMINISTRADOR: $sClsMnAdmor="menu";
											   break;
					}
				}
	?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.html" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>CakeZone</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto mx-lg-auto py-0">
            <a href="<?php echo ($bFirmado?"inicio.php":"index.php");?>" class="menu nav-item nav-link" id="mnuInicio">Inicio</a>			
				<a href="catalogo.php" class="menu nav-item nav-link" id="mnuCatalogo">Cat&aacute;logo de Productos</a>
				<a href="clienteReg.php" class="menu nav-item nav-link" id="mnuReg">Registrarse</a>
				<a href="productos.php" class="<?php echo $sClsMnAdmor;?> nav-item nav-link" id="mnuGesP">Gestionar Productos</a>
				<a href="comprar.php" class="<?php echo $sClsMnCajero;?> nav-item nav-link" id="mnuCompra">Comprar</a>
				<a href="control/ctrlLogout.php" class="<?php echo $sClsMnSalir;?> nav-item nav-link" id="mnuSalir">Salir</a>					
            </div>
        </div>
    </nav>
    <!-- Navbar End -->