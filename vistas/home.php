<!DOCTYPE html>
<html lang="en">

<head>
   <link rel="stylesheet" href="./vistas/styles/home.css"> 
   <!-- link iconos -->
   <script src="https://kit.fontawesome.com/41a54f9b79.js" crossorigin="anonymous"></script>
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
      <section class="team">
        <ul>
         <li class="footer-social">
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="30px" width="30px" viewBox="0 0 496 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 .3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5 .3-6.2 2.3zm44.2-1.7c-2.9 .7-4.9 2.6-4.6 4.9 .3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3 .7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3 .3 2.9 2.3 3.9 1.6 1 3.6 .7 4.3-.7 .7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3 .7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3 .7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg></a>
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="30px" width="30px" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg></a>
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="30px" width="30px" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg></a>
         </li>
        </ul>
        <ul class="footer-list">
         <li>
            <a href="">Inicio</a>
            <a href="">Quienes somos</a>
            <a href="">Preguntas</a>
            <a href="">Contacto</a>
         </li>
        </ul>
      </section>
   </footer>
   <script src="./logica/alerta.js"></script> 
</body>