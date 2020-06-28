<div class="row">
	<div class="text-center col col-lg-4">
		<legend>Ajouter un sous domaine</legend>
	</div>
	<div class="col col-lg-6 text-center">
		<legend>Liste des sous domaines</legend>
	</div>
</div>

	<div class="row">
		<div class="col col-lg-4 form-group text-center">
			<?php echo form_open('Lorion/ajouter_sous_domaine'); "</br>" ;
				echo form_error('sous_domaine');"</br>";
			?>
			<label for="sous_domaine" class="sr-only">Sous domaine</label>
			<input type="text" name="sous_domaine" class="form-control" placeholder="Sous domaine"> <br>
			<div class=" form-group form-horizontal">
				<label for="domaine" class=" col-form-label sr-only">Domaine</label>
				<select class="form-control" name="mon_select">
				<?php $resultat = $this->domaineModel->recupererNomDomaine();
					foreach ($resultat as $row) {
						
					
				 ?>
					<option> <?php echo $row->nom_domaine; ?> </option>
					<?php } ?>
				</select>
			</div>
			
			<div class="text-right">
				<button type="submit" class="btn btn-primary">Ajouter</button>
			</div>
		</form>
		</div>
		<div class="col col-lg-6 text-center">
			<div class="table-responsive">
				<table class="table table-bordered table-striped table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col"></th>
							
							<th scope="col">Sous domaine </th>
							<th scope="col">Domaine</th>
							<th scope="col">Modifier</th>
							<th scope="col">Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$domaines = $this->domaineModel->recupererNomDomaine();
							foreach ($domaines as $domaine) {
								$nom_domaine = $domaine->nom_domaine;
								$nom_domaine_encode = urlencode($nom_domaine);
								//var_dump($nom_domaine);
								$sous_domaines = $this->sousDomaineModel->recupererNomSousDomaine($nom_domaine);	
								foreach ($sous_domaines as $sous_domaine) {
									//var_dump($sous_domaine->nom_sous_domaine);
									$nom_sous_domaine = $sous_domaine->nom_sous_domaine;
									$nom_sous_domaine_encode = urlencode($nom_sous_domaine);
									//echo urlencode($nom_sous_domaine);
									//echo $nom_sous_domaine_encode ;//." ".$nom_sous_domaine_encode ;
									$id = $sous_domaine->id;
							
						 ?>
						 <tr>
						 	<div class="modal" tabindex="-1" role="dialog" id="<?php echo "supprModal".$id; ?>">
						 		<div class="modal-dialog modal-dialog-centered" role="document">
						 			<div class="modal-content">
						 				<div class="modal-header">
						 					<h5 class="modal-title text-center text-danger">Suppression</h5>
						 					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						 						<span aria-hidden="true"></span>
						 					</button>
						 				</div>
						 				<div class="modal-body">
						 					<p>Voulez-vous vraiment supprimer le sous domaine <?php echo $nom_sous_domaine; ?> ?</p>
						 				</div>
						 				<div class="modal-footer">
						 					<a type="button" class="btn btn-danger" href="<?php echo base_url("index.php/Lorion/supprimer_sous_domaine/$nom_domaine_encode/$nom_sous_domaine_encode") ;?>">OK</a>
						 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
						 				</div>
						 			</div>
						 		</div>
						 	</div>

						 	<div class="modal" tabindex="-1" role="dialog" id="<?php echo "modifModal".$id; ?>">
						 		<div class="modal-dialog modal-dialog-centered" role="document">
						 			<div class="modal-content">
						 				<div class="modal-header">
						 					<h5 class="modal-title text-center text-danger">Modification</h5>
						 					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						 						<span aria-hidden="true"></span>
						 					</button>
						 				</div>
						 				<div class="modal-body">
						 					<div class="form-group">

						 						<?php echo form_open("Lorion/modifier_sous_domaine/$id"); 
						 							echo form_error('modif_sous_domaine');
						 						?>
						 						<label for="modif_sous_domaine" class="form-control">Sous domaine</label>
												<input type="text" name="modif_sous_domaine" class="form-control" value="<?php echo $nom_sous_domaine ;?>"> <br>
													<div class=" form-group form-horizontal">
														<label for="modif_domaine" class="form-control">Domaine</label>
														<select class="form-control" name="modif_select">
															<?php $resultat = $this->domaineModel->recupererNomDomaine();
																foreach ($resultat as $row) {
								
							
						 									?>
																<option> <?php echo $row->nom_domaine; ?> </option>
															<?php } ?>
														</select>
														<div class="modal-footer text-right">
															<button type="submit" class="btn btn-warning" >
																Modifier
															</button>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
														</div>
						 					</div>
						 				</form>
						 				</div>
						 			</div>
						 		</div>
						 	</div>
						 	<?php echo form_error('modif_sous_domaine'); ?>
						 	<th scope="row"><?php echo $id; ?></th>
						 	
						 	<td><?php echo $nom_sous_domaine  ; ?> </td>
						 	<td> <?php echo $nom_domaine ; ?> </td>
						 	<td> 
						 		<button class="btn btn-warning" data-toggle="modal" data-target="<?php echo '#modifModal'.$id; ?>">Modifier</button>
						 	</td>
						 	<td>
						 		<button class="btn btn-danger" data-toggle="modal" data-target="<?php echo '#supprModal'.$id; ?>">Supprimer</button>
						 	</td>
						 </tr>

						<?php } ?>

						<?php } ?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>