

<div class="row">
	<div class="text-center col col-lg-4 " >
		<legend> Ajouter un domaine </legend>
	</div>
	<div class="col col-lg-6 text-center">
		<legend>Liste de domaines</legend>
	</div>
</div>	
	<!--<form class="" >-->
		
		<div class="row">
			<div class="col col-lg-4  form-group text-center ">
				<?php echo form_open('Lorion/ajouter'); "</br>";
			
				 ?>
				<?php echo form_error('domaine');"</br>"; ?>
					<label for="nomDomaine" class="sr-only">Domaine </label>
					<input type="text" name="domaine" class="form-control" placeholder="Domaine"> <br>
					<div class="text-right">
						<button type="submit" class="btn btn-primary ">Ajouter</button>
					</div>
				
				</form>
			</div>
			<!--<div class="col col-lg-4  form-group text-right">
				<button type="submit" class="btn btn-primary ">Ajouter</button>
			</div>-->
	

			<div class="col col-lg-6 text-center">
				<table class="table table-bordered table-striped table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col"></th>
							<th scope="col">Domaine</th>
							<th scope="col">Modifier</th>
							<th scope="col">Supprimer</th>
						</tr>
					</thead>
					<tbody>
					
						
							<?php $resultat = $this->domaineModel->recupererNomDomaine();
							//var_dump($resultat);
								foreach ($resultat as $row ) {
									$nom_domaine = $row->nom_domaine;
									$domaine_encode = urlencode($nom_domaine);
									$id = $row->id;
									
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
														<p>Voulez-vous vraiment supprimer le domaine <?php echo $row->nom_domaine; ?> ?</p>
													</div>
													<div class="modal-footer">
														<a type="button" class="btn btn-primary" data-whatever="<?php echo $row->nom_domaine; ?>" href="<?php echo base_url("index.php/Lorion/supprimer/$row->nom_domaine"); ?>">OK</a>
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
														
													</div>
												</div>
											</div>
										</div>

										<div class="modal" tabindex="-1" role="dialog" id="<?php echo "modifModal".$id ;?>">
											<div class="modal-dialog modal-dialog-centered " role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title text-center text-danger">Modification</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="close">
															<span aria-hidden="true"></span>
														</button>
													</div>
													<div class="modal-body">
														<div class="form-group">
															<?php echo form_open("Lorion/modifier_domaine/$id"); ?>
																<?php echo form_error('modif_domaine'); ?>
																<label for="modif_domaine" class="sr-only">Domaine </label>
																<input type="text" name="modif_domaine" class="form-control" value="<?php echo $nom_domaine; ?>"> <br>
																<div class="text-right">
																	<button type="submit" class="btn btn-warning ">Modifier</button>
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
																</div>

															</form>
														</div>
														
													</div>
												</div>
											</div>
										</div>
										
								  <th scope="row">
								  	<?php //echo $row->nom_domaine; ?>
								  </th>
								  <td>
								  	<?php echo $nom_domaine ; ?>

								  </td>
									<td>
										<button class="btn btn-warning" data-toggle="modal" data-target="<?php echo '#modifModal'.$id ;?>">Modifier</button>
									</td>
									<td>
										<button class="btn btn-danger" data-toggle="modal"  data-target="<?php echo '#supprModal'.$id ;?>">Supprimer</button>
											<?php //echo base_url("index.php/Lorion/supprimer/$row->nom_domaine") ;  ?>
										
									</td>
										
							</tr>
							
							
						<?php } ?>
						<?php echo form_error('modif_domaine'); ?>
					</tbody>
				</table>

			</div>
		</div>
		
		