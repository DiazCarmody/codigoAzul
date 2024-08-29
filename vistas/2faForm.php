<main>
	<div class="container2fa">
    	<h2 class="h2-2fa">Autenticación de Dos Factores (2FA)</h2>
    	<div class="user-info-2fa">
        <p>Saludos, <strong><?php echo $_SESSION['email_verificar']; ?></strong></p>
    	</div>
    	<form autocomplete="off" action="./logica/verificar2fa.php" method="post" class="">
        	<div class="form-group-2fa">
                <div class="form-rest"></div>
            <label class="label-2fa" for="codigo">Código de Autenticación:</label>
            <div class="code-inputs-2fa">
                <input class="input-2fa" type="text" id="codigo1" name="codigo1" maxlength="1" required>
                <input class="input-2fa" type="text" id="codigo2" name="codigo2" maxlength="1" required>
                <input class="input-2fa" type="text" id="codigo3" name="codigo3" maxlength="1" required>
                <input class="input-2fa" type="text" id="codigo4" name="codigo4" maxlength="1" required>
            </div>
            	<small class="small-2fa">Introduce los cuatro caracteres de tu código de autenticación.</small>
        	</div>
        	<div class="form-group">
            	<button class="button-2fa" type="submit">Verificar Código</button>
        	</div>
    	</form>
    </div>
</main>