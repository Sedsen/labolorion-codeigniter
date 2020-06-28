<div style="padding-top: 100px;">
	<div class="row justify-content-lg-center">
		<div class="text-center">
			<?php echo form_open('authentification/connection'); ?>
				<div class="form-group">
					<?php echo form_error('username'); ?>
					<label for="username" class="form-control sr-only">Nom d'utilisateur</label>
					<input type="text" name="username" class="form-control" placeholder="nom d'utilisateur" value=" ">
				</div>
				<div class="form-group">
					<?php echo form_error('password'); ?>
					<label for="password" class="form-control sr-only">Mot de passe</label>
					<input type="password" name="password" class="form-control" placeholder="Mot de passe">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary form-control">Se connecter</button>
				</div>
				<div>
					<a href="#">Mot de passe oublié?  </a><hr>
					<a href="<?php echo base_url("index.php/authentification/enregistrer"); ?>">S'enrégistrer</a>
				</div>
			</form>
			<?php var_dump($this->session->utilisateur);
				//if($this->session->utilisateur != NULL /*|| $this->session->utilisateur == FALSE*/) { 
				
					/*if($this->session->utilisateur == false) {
						var_dump($this->session->utilisateur);
						$this->session->utilisateur == NULL;
						if ($this->session->utilisateur == NULL ) {

					?>
						<div class="alert alert-danger">
							<p>le nom d'utilisateur ou le mot de passe est incorrect</p>
						</div>
					<?php }
						}
					  else { var_dump($this->session->utilisateur);
					  	var_dump($username);
					  		if ($username == $this->session->utilisateur[0]->username && password_verify($password,$this->session->utilisateur[0]->password) ) {
					  			
					  		
					  	?>

					<div class="alert alert-success">
						<p><?php echo $this->session->utilisateur[0]->username; ?> est connecté</p>
					</div>
				<?php } 
				 else { ?>
					<div class="alert alert-danger">
						<p>le nom d'utilisateur ou le mot de passe est incorrect</p>
					</div>
				<?php } 
			}*/?>
		</div>
	</div>
</div>

