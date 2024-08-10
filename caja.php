<?php

session_start();
include("./model/config.php");
include("./config.php");

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }


		echo $_SESSION['user_email_address'];

		$consulta_email="SELECT COUNT(*) FROM usuarios WHERE correo='".$_SESSION['user_email_address']."'";
		$result_email=mysqli_query($_CNX,$consulta_email);
		$fila_email=mysqli_fetch_row($result_email);
		if($fila_email[0]==0){
			header("location:403.html");
		}
    }

		
}else{
	if(!isset($_SESSION["usuario"])){
		header("location:close.php");
	}
	
}





?>


<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Caja</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

		
	</head>
	<body>
		<!--<div class="pre-loader">
			<div class="pre-loader-box">
				<div class="loader-logo">
					<img src="vendors/images/deskapp-logo.svg" alt="" />
				</div>
				<div class="loader-progress" id="progress_div">
					<div class="bar" id="bar1"></div>
				</div>
				<div class="percent" id="percent1">0%</div>
				<div class="loading-text">Cargando...</div>
			</div>
		</div>-->

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
				
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<!--<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>-->
					</div>
				</div>
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<!--<li>
										<a href="#">
											<img src="vendors/images/img.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo1.jpg" alt="" />
											<h3>Lea R. Frith</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo2.jpg" alt="" />
											<h3>Erik L. Richards</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo3.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo4.jpg" alt="" />
											<h3>Renee I. Hansen</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/img.jpg" alt="" />
											<h3>Vicki M. Coleman</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>-->
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="<?php echo  isset($_SESSION['user_image'])?$_SESSION['user_image']:"vendors/images/photo1.jpg"; ?>" alt="" />
							</span>
							<span class="user-name"><?php echo isset($_SESSION["usuario"])?strtoupper($_SESSION["usuario"]): strtoupper($_SESSION['user_first_name']); ?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-user1"></i> Perfil</a
							>
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-settings2"></i> Configuraciones</a
							>
							<a class="dropdown-item" href="faq.html"
								><i class="dw dw-help"></i> Ayuda</a
							>
							<a class="dropdown-item" href="close.php"
								><i class="dw dw-logout"></i> Salir</a
							>
						</div>
					</div>
				</div>
				
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="index.php">
					<img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
					<img
						src="vendors/images/deskapp-logo-white.svg"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li>
						<a href="index.php?code=<?php echo $_GET["code"]; ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Panel</span>
							</a>
							
						</li>
						<li >
							<a href="movimiento.php?code=<?php echo $_GET["code"]; ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-cash-coin"></span
								><span class="mtext">Movimiento</span>
							</a>
							
						</li>
						<li >
							<a href="caja.php?code=<?php echo $_GET["code"]; ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-textarea-resize"></span
								><span class="mtext">Cajas</span>
							</a>
							
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-10">
				<div class="title pb-10">
					<h2 class="h3 mb-0">Cajas</h2>
				</div>

				<div class="card-box pb-10">
					<div class="h5 pd-20 mb-0">Cajas registradas
					<p class="mt-3">
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalcaja">
						<i class="fa fa-plus"></i> 
						Agregar </button></p>
					</div>
					
					<table class="data-table table nowrap" id="example">
						<thead>
							<tr>
								<th class="table-plus">Código</th>
								<th>Descripción</th>
								<th>Banco</th>
								<th>Cuenta</th>
								<th>Tipo moneda</th>
								<th>Saldo anterior</th>
								<th>Inicio capital</th>
								<th>Estado</th>
								<th class="datatable-nosort">Actions</th>
							</tr>
						</thead>
						<tbody>
						
						
						</tbody>
					</table>
				</div>

				

				

				<div class="footer-wrap pd-20 mb-20 card-box">
					Todos los derechos reservados para &copy;
					<a href="https://emdesi.com" target="_blank"
						>EMDESI</a
					>
				</div>
			</div>
		</div>
		<!-- Modal -->
<div class="modal fade " id="modalcaja" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Registrar caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
			<input type="hidden" name="" id="codigo" value="0">
			<div class="form-group row">
				<label for="descripcion" class="col-sm-3 col-form-label text-end">Descripción:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control form-control-sm" id="descripcion">
				</div>
			</div>
			<div class="form-group row">
				<label for="descripcion" class="col-sm-3 col-form-label text-end">Banco:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control form-control-sm" id="banco">
				</div>
			</div>
			<div class="form-group row">
				<label for="descripcion" class="col-sm-3 col-form-label text-end">Nr° de cuenta:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control form-control-sm" id="cuenta">
				</div>
			</div>
			<div class="form-group row">
				<label for="descripcion" class="col-sm-3 col-form-label text-end">Tipo de moneda:</label>
				<div class="col-sm-4">
					<select name="" id="tipo" class="form-select form-control">
						<option value="0">--Seleccionar--</option>
						<option value="1">S/. Soles</option>
						<option value="2">$ Dolares</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="descripcion" class="col-sm-3 col-form-label text-end">Saldo anterior:</label>
				<div class="col-sm-4">
				<input type="text" class="form-control form-control-sm" id="saldo">
				</div>
			</div>
			<div class="form-group row">
				<label for="descripcion" class="col-sm-3 col-form-label text-end">Inicio capital:</label>
				<div class="col-sm-4">
				<input type="text" class="form-control form-control-sm" id="capital">
				</div>
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="bi bi-x-lg"></i> Salir</button>
        <button type="button" class="btn btn-primary btn-sm" id="btn_guardar_caja"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>

		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="vendors/scripts/dashboard3.js"></script>
		<script src="assets/datacaja.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
