<div class="row">
	<div class="text-center col col-lg-4">
		<legend>Ajouter un admin</legend>
	</div>
	<div class="col col-lg-6 text-center">
		<legend>Liste des administrateurs</legend>
	</div>
</div>

<div class="row">
	<div class="col col-lg-4 form-group text-center" >
		<?php echo form_open('Lorion/ajouter_admin'); ?>
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
					<button type="submit" class="btn btn-primary form-control">Ajouter</button>
				</div> <hr>
				
		<?php  echo form_close(); ?>
	</div>
	<div class="col col-lg-6 text-center">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead class="thead-inverse">
					<tr>
						<th scope="col"></th>
							
						<th scope="col">Nom</th>
						<th scope="col">Prénoms</th>
						<th scope="col">Username</th>
						<th scope="col">Modifier</th>
						<th scope="col">Supprimer</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$admins = $this->user_model->select_admin();
						foreach ($admins as $admin) {
							$nom = $admin->nom_user;
							$prenom = $admin->prenom_user;
							$username = $admin->username;
							$id = $admin->id;
							$password = $admin->password;
							$email = $admin->email;
						
					 ?>
					 <tr>
					 	<div class="modal" tabindex="-1" role="dialog" id="<?php echo "supprModal".$id; ?>">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-danger"> Suppression</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="close">
												<span aria-hidden="true">&times;</span>
											</button>
									</div>
									<div class="modal-body">
										<p>Voulez-vous vraiment supprimer l'utilisateur  <?php echo $username; ?> ?</p>
									</div>
									<div class="modal-footer">
										<a type="button" class="btn btn-danger" href="<?php echo base_url("index.php/Lorion/supprimer_user/$id"); ?>">OK</a>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
									</div>
								</div>
							</div>
						</div>

						<div class="modal" tabindex="-1" role="dialog" id="<?php echo "modifModal".$id; ?>">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-danger">Modification</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<?php echo form_open("Lorion/modifier_user/$id"); ?>
												<div class="form-group">
													<?php echo form_error('nameModif'); ?>
													<label for="nameModif" class="form-control sr-only">Nom </label>
													<input type="text" name="nameModif" class="form-control" placeholder="nom" value="<?php echo $nom; ?>">
												</div>
												<div class="form-group">
													<?php echo form_error('prenomModif'); ?>
													<label for="prenomModif" class="form-control sr-only">Prénoms </label>
													<input type="text" name="prenomModif" class="form-control" placeholder="Prénom" value="<?php echo $prenom; ?>">
												</div>
												<div class="form-group">
													<?php echo form_error('usernameModif'); ?>
													<label for="usernameModif" class="form-control sr-only">Nom d'utilisateur </label>
													<input type="text" name="usernameModif" class="form-control" placeholder="nom d'utilisateur" value="<?php echo $username; ?>">
												</div>
												<div class="form-group">
													<?php echo form_error('passwordModif'); ?>
													<label for="passwordModif" class="form-control sr-only">Mot de passe</label>
													<input type="password" name="passwordModif" class="form-control" placeholder="Mot de passe" value="<?php //echo $password; ?>">
												</div>
												<div class="form-group">
													<?php echo form_error('confirmationModif'); ?>
													<label for="passwordModif" class="form-control sr-only">Confirmer le mot de passe</label>
													<input type="password" name="confirmationModif" class="form-control" placeholder="confirmer le mot de passe" >
												</div>
												<div class="form-group">
													<?php echo form_error('EmailModif'); ?>
													<label for="emailModif" class="form-control sr-only">Email </label>
													<input type="email" name="EmailModif" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
												</div>
												
												<div class="form-inline">
													<button type="submit" class="btn btn-primary ">Modifier</button>
													<button type="button" class="btn btn-secondary " data-dismiss="modal">Quitter</button>
												</div>
											<?php echo form_close(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>

					 	<th scope="row"><?php echo $id; ?></th>
					 	<td><?php echo $nom; ?></td>
					 	<td><?php echo $prenom; ?></td>
					 	<td><?php echo $username; ?></td>
					 	<td>
					 		<button class="btn btn-warning" data-toggle="modal" data-target="<?php echo "#modifModal".$id; ?>">Modifier</button>
					 	</td>
					 	<td>
					 		<button class="btn btn-danger" data-toggle="modal" data-target="<?php echo "#supprModal".$id; ?>">Supprimer</button>
					 	</td>
					 </tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
</div>