<!-- SCRIPT DARKMODE -->
<script>
	const storageTheme = localStorage.getItem('theme');
	const systemColorScheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
	const newTheme = storageTheme ?? systemColorScheme;
	document.documentElement.setAttribute('data-theme', newTheme);
</script>
<!-- SCRIPT DARKMODE -->
<!-- SCRIPT LOAD -->
<script>
 window.onload = function(){
 	var contenedor = document.getElementById('contenedor_carga');
 	contenedor.style.visibility = 'hidden';
 	contenedor.style.opacity = '0';
 }
</script>
<!-- SCRIPT LOAD -->