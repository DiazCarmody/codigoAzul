<!DOCTYPE html>
<html lang="en">

<head>
   <link rel="stylesheet" href="./vistas/styles/home.css"> 
</head>

<body>
  <main> 

      <section>
         <img src="./vistas/images/icon.png" alt="Logo">
         <h1>
            Código azul
         </h1>
      </section>

      <section>
         <ul>
            <li> <a href="index.php?vista=listaDePacientes"> <span class="material-symbols-outlined">patient_list</span> Listado de emergencias</a> </li>

            <li> <a href="index.php?vista=listaDeMedicos"> <span class="material-symbols-outlined">medical_information</span> Listado de médicos</a> </li>
            
            <li> <a href="index.php?vista=listaDeAreas"> <span class="material-symbols-outlined">window</span> Listado de áreas</a> </li>
            
            <li> <a href="index.php?vista=listaDeHabitaciones"> <span class="material-symbols-outlined">dataset</span> Listado de habitaciones</a> </li>
            
            <li> <a href="index.php?vista=registrarUsuarioForm"> <span class="material-symbols-outlined">person_add</span> Registro de usuarios</a> </li>
         </ul>
         <ul>
            <li> <a href="index.php?vista=ingresarPacienteForm"> <span class="material-symbols-outlined">patient_list</span> Ingresar paciente</a> </li>
            
            <li> <a href="index.php?vista=habilitarMedico"> <span class="material-symbols-outlined">medical_information</span> Habilitar médicos</a> </li>
            
            <li> <a href="index.php?vista=crearAreaForm"> <span class="material-symbols-outlined">window</span> Crear áreas</a> </li>
            
            <li> <a href="index.php?vista=crearHabitacionForm"> <span class="material-symbols-outlined">dataset</span> Creár habitaciones</a> </li>
            
            <li> <a href="./index.php?vista=listaDeCuentas"> <span class="material-symbols-outlined">manage_accounts</span> Adminsitrar cuentas</a> </li>
         </ul>
      </section>

      <section id="home_downloads">
               <a onclick="location.href='./vistas/listasImpresas/listaImpresaPacientes.php'"> <span class="material-symbols-outlined">download</span> Listado de pacientes</a>
        			<a onclick="location.href='./vistas/listasImpresas/listaImpresaMedicos.php'"> <span class="material-symbols-outlined">download</span> Listado de médicos</a>
					<a onclick="location.href='./vistas/listasImpresas/listaImpresaAreas.php'"> 
 
               <span class="material-symbols-outlined">download</span> Listado de áreas</a>
					<a onclick="location.href='./vistas/listasImpresas/listaImpresaHabitaciones.php'"> <span class="material-symbols-outlined">download</span> Listado de habitaciones</a>
					<a onclick="location.href='./vistas/listasImpresas/listaImpresaCuentas.php'"> <span class="material-symbols-outlined">download</span> Listado de cuentas</a>
      </section>
 
   </main>

   <footer>
      <h3>Equipo de desarrollo | <small>Código Azul</small> </h3>
      <section class="team">
        
        <ul>
            <h4>FRONT:  </h4>
             <li>Fausto Díaz Carmody</li>
             <li>Santiago Henze</li>
             <li>Rosario Finelli</li>
             <li>Valentina Saavedra</li>
             <li>Melanie Mayuri</li>
             <li>Damián sala</li>
         </ul>
         <ul>
            <h4>BACK:  </h4>
             <li>Fausto Díaz Carmody</li>
             <li>Santiago Henze</li>
             <li>Damián Sala</li>
         </ul>
         <ul>
            <h4>ARDUINO:  </h4>
             <li>Liuba Kosaruk</li>
             <li>Guido Herrera</li>
         </ul>
         <ul>
            <h4>APP:  </h4>
             <li>Pablo Gutiérrez</li>
             <li>Máximo Donza</li>
         </ul>
      </section>
      <section>
           <h2>E.E.S.T Nº2</h2>
      </section>
   </footer>
   <script src="./logica/alerta.js"></script> 
</body>