	<head>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
		<script src="./vistas/scripts/darkmodeScroll.js"></script>

	</head>

	<header>
 
		<input type="checkbox" name="" id="open_menu">

		<a class="navoption home is-in-dropdown" href="./index.php?vista=home"> <img src="./vistas/images/icon.png" alt="logotipo" width="28px" height="28px"> 
			<!-- <span>Código azul</span>  -->
		</a>
		
		<label for="open_menu" class="header_open_nav_button" role="button">
			<span class="material-symbols-outlined menu">menu</span>
		</label> 

		<li class="navoption download is-not-in-dropdown dropdown">
					<a href="#" class="dropbtn"> <span class="material-symbols-outlined">download</span> </a>
      				<div class="dropdown-content">
        				<a onclick="location.href='./vistas/listasImpresas/listaImpresaPacientes.php'"> <span class="material-symbols-outlined">download</span> Listado de pacientes</a>
        				<a onclick="location.href='./vistas/listasImpresas/listaImpresaMedicos.php'"> <span class="material-symbols-outlined">download</span> Listado de médicos</a>
						<a onclick="location.href='./vistas/listasImpresas/listaImpresaAreas.php'"> <span class="material-symbols-outlined">download</span> Listado de áreas</a>
						<a onclick="location.href='./vistas/listasImpresas/listaImpresaHabitaciones.php'"> <span class="material-symbols-outlined">download</span> Listado de habitaciones</a>

						<a onclick="location.href='./vistas/listasImpresas/listaImpresaCuentas.php'"> <span class="material-symbols-outlined">download</span> Listado de cuentas</a>

      				</div> 
		</li>

		<label for="toggler" class="darkmode is-not-in-dropdown">
			<span class="material-symbols-outlined" id="lightmodeicon">light_mode</span> 
			<span class="material-symbols-outlined" id="darkmodeicon">dark_mode</span>
		</label>
		<input type="checkbox" name="" id="toggler" class="toggler is-not-in-dropdown">   

		<label for="account-toggler" class="account">
		
				<span class="material-symbols-outlined navicon">account_circle</span>
					
				<div class="account-info">
					<img src="./vistas/images/person_icon.png" alt="Icono de persona">
					<span> <?php echo $_SESSION['email'] ?> </span>
					<strong> 
						<?php if ($_SESSION['cargo'] == 1 ){
								echo "Administrador";
							  } 
							  else if ($_SESSION['cargo'] == 2 ) {
								echo "Médico";
							  }
							  else {
								echo "Genérico";
							  }
						?> 
					</strong>
					<a href="index.php?vista=cerrarSesion"> CERRAR SESIÓN </a>
				</div>

		</label>
		<input type="checkbox" name="" id="account-toggler" class="account-toggler">

		<nav class="nav">
			
			<ul>

				<li class="home-li is-not-in-dropdown"> 
					<a href="./index.php?vista=home" class="home">
						<img src="./vistas/images/icon.png" alt="logotipo" width="28px" height="28px"> 
						<!-- <span>Código azul</span>  --> 
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropbtn"> <span class="material-symbols-outlined">patient_list</span> </a>
      				<div class="dropdown-content">
        				<a href="index.php?vista=listaDePacientes">Listado de pacientes</a>
        				<a href="index.php?vista=ingresarPacienteForm">Ingresar paciente</a>
      				</div> 
				</li>
				<li class="antidropdown"> <a href="index.php?vista=listaDePacientes"> <span class="material-symbols-outlined">patient_list</span> Listado de pacientes</a> </li>
				<li class="antidropdown"> <a href="index.php?vista=ingresarPacienteForm"> <span class="material-symbols-outlined">patient_list</span> Ingresar paciente</a> </li>

				<li class="dropdown">
					<a href="#" class="dropbtn"> <span class="material-symbols-outlined">medical_information</span> </a>
      				<div class="dropdown-content">
        				<a href="index.php?vista=listaDeMedicos">Listado de médicos</a>
        				<a href="index.php?vista=habilitarMedico">Habilitar médicos</a>
      				</div> 
				</li>
				<li class="antidropdown"> <a href="index.php?vista=habilitarMedico"> <span class="material-symbols-outlined">medical_information</span>Listado de médicos</a> </li>
				<li class="antidropdown"> <a href="index.php?vista=habilitarMedico"> <span class="material-symbols-outlined">medical_information</span> Habilitar médicos</a> </li>

				<li class="dropdown">
					<a href="#" class="dropbtn"> <span class="material-symbols-outlined">window</span> </a>
      				<div class="dropdown-content">
        				<a href="index.php?vista=listaDeAreas">Listado de áreas</a>
        				<a href="index.php?vista=crearAreaForm">Crear área</a>
      				</div> 
				</li>
				<li class="antidropdown"> <a href="index.php?vista=listaDeAreas"> <span class="material-symbols-outlined">window</span> Listado de áreas</a> </li>
				<li class="antidropdown"> <a href="index.php?vista=crearAreaForm"> <span class="material-symbols-outlined">window</span> Crear áreas</a> </li>
				
				<li class="dropdown">
					<a href="#" class="dropbtn"> <span class="material-symbols-outlined">dataset</span> </a>
      				<div class="dropdown-content">
        				<a href="index.php?vista=listaDeHabitaciones">Listado de habitaciones</a>
        				<a href="index.php?vista=crearHabitacionForm">Crear habitación</a>
      				</div> 
				</li>
				<li class="antidropdown"> <a href="index.php?vista=listaDeHabitaciones"> <span class="material-symbols-outlined">dataset</span> Listado de habitaciones</a> </li>
				<li class="antidropdown"> <a href="index.php?vista=crearHabitacionForm"> <span class="material-symbols-outlined">dataset</span> Crear habitación</a> </li>

				<li class="dropdown"> 
					<a href="index.php?vista=registrarUsuarioForm"> <span class="material-symbols-outlined">person_add</span> </a>
					<span class="tooltip">Registro de usuarios</span>
				</li>
				<li class="antidropdown"> 
					<a href="index.php?vista=registrarUsuarioForm"> <span class="material-symbols-outlined">person_add</span> Registro usuarios </a>
				</li>

				<li class="dropdown">
					<a href="./index.php?vista=listaDeCuentas"> <span class="material-symbols-outlined">manage_accounts</span> </a>
					<span class="tooltip"> Administrar cuentas</span>
				</li>
				<li class="antidropdown">
					<a href="./index.php?vista=listaDeCuentas"> <span class="material-symbols-outlined">manage_accounts</span> Administrar cuentas </a>
				</li>

				<li class="dropdown">
					<a href="./index.php?vista=listaDeEmergencias"> <span class="material-symbols-outlined">e911_emergency</span> </a>
					<span class="tooltip"> Registro de emergencias</span>
				</li>
				<li class="antidropdown">
					<a href="./index.php?vista=listaDeEmergencias"> <span class="material-symbols-outlined">e911_emergency</span> Registro de emergencias </a>
				</li>
				
				
				<li>
					<label for=""></label>
					<form action="./logica/alertas.php" class="formularioAjax">
						<input type="hidden" name="habitacion_id" value="2">
						<button type="submit" class="alertabutton"> <span class="material-symbols-outlined">emergency_home</span></button>
						
					</form>
				</li>
				<li class="antidropdown">
					<form action="./logica/alertas.php" class="FormularioAjax">
						<input type="hidden" name="habitacion_id" value="2">
						<button type="submit" class="alertabutton"> <span class="material-symbols-outlined">emergency_home</span></button>
						
					</form>
					
				</li>

				<li class="is-in-dropdown dropdown-download"> 
					<a class="navoption download" href="./index.php?vista=home#home_downloads"> <span class="material-symbols-outlined navicon">download</span> Descargas</a> 
				</li>

				<li class="is-in-dropdown dropdow-ndarkmode"> 
					<label for="toggler" class="darkmode">
						<span class="material-symbols-outlined" id="lightmodeicon">light_mode</span>
						<span class="material-symbols-outlined" id="darkmodeicon">dark_mode</span>
						<p>Tema</p>
					</label>
					<input type="checkbox" name="" id="toggler" class="toggler">   
				</li>

			</ul>
		</nav>

	</header>