<div class="row">
	<div class="col col-lg-10">
		<table class="table">
			<thead class="thead-inverse">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nom</th>
					<th scope="col">Prénoms</th>
					<th scope="col">Utilisateur</th>
					<th scope="col">Discussion</th>
				</tr>
			</thead>
			<tbody>
				<?php $users = $this->user_model->select_list_user();
					foreach ($users as $user) {
						$nom = $user->nom_user;
						$prenom = $user->prenom_user;
						$username = $user->username;

					$unread = $this->discussion_model->discussion_unread($username);
				 ?>
				 
				<tr>
					<th scope="col"></th>
					<td><?php echo $nom; ?> </td>
					<td> <?php echo $prenom; ?></td>
					<td><?php echo $username; ?></td>
					<td> 
						<a href="<?php echo base_url("index.php/discussion/afficher_admin_discussion/$username"); ?>" class="btn btn-success">Discussion 
							<?php if ($unread != 0) { ?>
							<span class="badge badge-danger rounded-circle"> 
								<?php echo $unread; ?> 
							</span>
						<?php } ?>
						</a> 
					</td>
				</tr>
			<?php  } ?>
			</tbody>
		</table>
	</div>
</div>