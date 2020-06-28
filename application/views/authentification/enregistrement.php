<div style="padding-top: 100px;">
	<div class="row justify-content-lg-center">
		<div class="text-center">
			<?php echo form_open('authentification/ajouter_user'); ?>

				<div class="form-group">
					<?php echo form_error('name'); ?>
					<label for="name" class="form-control sr-only">Nom </label>
					<input type="text" name="name" class="form-control" placeholder="nom">
				</div>
				<div class="form-group">
					<?php echo form_error('prenom'); ?>
					<label for="prenom" class="form-control sr-only">Prénoms </label>
					<input type="text" name="prenom" class="form-control" placeholder="Prénom">
				</div>
				<div class="form-group">
					<?php echo form_error('username'); ?>
					<label for="username" class="form-control sr-only">Nom d'utilisateur </label>
					<input type="text" name="username" class="form-control" placeholder="nom d'utilisateur" value=" ">
				</div>
				<div class="form-group">
					<?php echo form_error('password'); ?>
					<label for="password" class="form-control sr-only">Mot de passe</label>
					<input type="password" name="password" class="form-control" placeholder="Mot de passe">
				</div>
				<div class="form-group">
					<?php echo form_error('confirmation'); ?>
					<label for="password" class="form-control sr-only">Confirmer le mot de passe</label>
					<input type="password" name="confirmation" class="form-control" placeholder="confirmer le mot de passe">
				</div>
				<div class="form-group">
					<?php echo form_error('Email'); ?>
					<label for="email" class="form-control sr-only">Email </label>
					<input type="email" name="Email" class="form-control" placeholder="Email">
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary form-control">S'enrégistrer</button>
				</div> <hr>
				<div class="text-primary">
					<a href="<?php echo base_url("index.php/authentification/index"); ?>">Déjà Enrégistrer? Veuillez-vous connecter</a>
				</div>
			</form>
		</div>
	</div>
</div>