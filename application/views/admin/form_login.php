<section class="container">

	<section class="section-login box-one" >
	
		<h1 class="legend-one">Administração</h1>
	
		<?php echo form_open(''); ?>
			
			<label for="email" >Login: </label><input id="email" name="email" class="email" type="email" autofocus required tabindex="1" ><br>
			<label for="pwd" >Senha: </label><input id="pwd" name="pwd" class="pwd" type="password" required tabindex="2" ><br>
			<button tabindex="3" >Entrar</button>
	
		<?php echo form_close(); ?>
	
	</section>
	
</section>