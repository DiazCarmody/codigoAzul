<?php 
//genero un nuevo código cada vez que se actualiza la página.
$claveAutentificacion=generarCodigoAutentificacion();
$email=$_SESSION['email_verificar'];
$busqueda=conectar();
$busqueda=$busqueda->query("SELECT * FROM usuarios WHERE usuario_email = '$email';");
$actualizar=conectar();
$actualizar=$actualizar->prepare("UPDATE usuarios SET autentificacion = :claveAutentificacion WHERE usuario_email=:email;");
$arrayUpdate=[
":claveAutentificacion"=>$claveAutentificacion,
":email"=>$email
];
$actualizar->execute($arrayUpdate);
?>
<main>
	<script>
	alert("¡Recuerda anotar tu código para no perderlo!");
	</script> 
	<div class="gencode">

		<div class="gencodecard">
			<h2>¡Tu primer login! <?php echo $usuario;?></h2>
			<p>Tu código de acceso es : <b id="miTexto"><?php echo $claveAutentificacion; ?></b></p>
			<p>¡Recuerda copiar tu código para no perdelo!</p>
			<button onclick="copiarContenido()">¡Copiar!</button>
			<a style="text-decoration: none;" href="index.php?vista=listaDePacientes"> Avanzar</a>
		</div>
	</div>

<script>
  let texto = document.getElementById('miTexto').innerHTML;
  const copiarContenido = async () => {
    try {
      await navigator.clipboard.writeText(texto);
      console.log('Contenido copiado al portapapeles');
      alert('Contenido copiado al portapapeles')
    } catch (err) {
      console.error('Error al copiar: ', err);
    }
  }
</script>
</main>