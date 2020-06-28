<div class="row">
	<div class="text-center col col-lg-4">
		<legend>Ajouter un produit</legend>
	</div>
	<div class="col col-lg-6 text-center">
		<legend>Liste des produits</legend>
	</div>
</div>

<div class="row">
	<div class="col col-lg-4 form-group text-center">
		<?php echo form_open_multipart('Lorion/ajouter_produit');
		"</br>";
		echo form_error('nom_produit');
		?>
		<label for="produit" class="sr-only">Produit</label>
		<input type="text" name="nom_produit" class="form-control" placeholder="produit"><br>
		<div class="form-group form-horizontal">
			<label for="sous_domaine" class="col-form-label sr-only">Sous domaine</label>
			<select class="form-control" name="sous_dom_select">
				<?php $domaines = $this->domaineModel->recupererNomDomaine();

				foreach ($domaines as $domaine) {
					$nom_domaine = $domaine->nom_domaine;
					//var_dump($nom_domaine);
					$sous_domaines = $this->sousDomaineModel->recupererNomSousDomaine($nom_domaine);
					foreach ($sous_domaines as $sous_domaine) {
						$nom_sous_domaine = $sous_domaine->nom_sous_domaine;


						?>
						<option><?php echo $nom_sous_domaine; ?></option>
				<?php }
				}
				?>
			</select>
		</div>

		<div class="form-group">
			<?php echo form_error('prix_vente'); ?>
			<label class="sr-only">Prix</label>
			<input type="number" name="prix_vente" class="form-control" placeholder="Prix">
		</div>
		<div class="form-group">
			<label class="sr-only">Description</label>
			<textarea class="form-control" name="description"></textarea>
		</div>
		<div class="form-group form-horizontal">
			<!--<div class="alert alert-danger">--><?php echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); ?>
			<!--</div>-->
			<label for="image_produit">Ajouter une image</label>
			<input type="file" name="image_produit" class="form-control-file">
		</div>
		<div class="text-right">
			<button type="submit" class="btn btn-primary">Ajouter</button>
		</div>
		</form>
		<script>
			CKEDITOR.replace('description', {
				allowedContent: true
			});
		</script>
	</div>
	<div class="col col-lg-6 text-center">
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead class="thead-inverse">
					<tr>
						<th scope="col"></th>
						<th scope="col">Produit</th>
						<th scope="col"> Sous domaine</th>
						<th scope="col">Modifier</th>
						<th scope="col"> Supprimer</th>
					</tr>
				</thead>
				<tbody>
					<?php $domaines = $this->domaineModel->recupererNomDomaine();

					foreach ($domaines as $domaine) {
						$nom_domaine = $domaine->nom_domaine;

						$sous_domaines = $this->sousDomaineModel->recupererNomSousDomaine($nom_domaine);
						foreach ($sous_domaines as $sous_domaine) {
							$nom_sous_domaine = $sous_domaine->nom_sous_domaine;
							$nom_sous_domaine_encode = rawurlencode($nom_sous_domaine);

							$produits = $this->produit_model->recuperer_nom_produit($nom_sous_domaine);
							foreach ($produits as $produit) {
								$nom_produit = $produit->nom_produit;
								$nom_produit_encode = rawurlencode($nom_produit);
								//echo rawurlencode($nom_produit);
								$id = $produit->id;

								?>
								<tr>
									<div class="modal" tabindex="-1" role="dialog" id="<?php echo "supprModal" . $id; ?>">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title text-danger"> Suppression</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p>Voulez-vous vraiment supprimer le produit <?php echo $nom_produit; ?> ?</p>
												</div>
												<div class="modal-footer">
													<a type="button" class="btn btn-danger" href="<?php echo base_url("index.php/Lorion/supprimer_produit/$nom_produit_encode/$nom_sous_domaine"); ?>">OK</a>
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
												</div>
											</div>
										</div>
									</div>

									<div class="modal" tabindex="-1" role="dialog" id="<?php echo "modifModal" . $id; ?>">
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
														<?php echo form_open_multipart("Lorion/modifier_produit/$id");
																	"</br>";
																	echo form_error('modif_produit');
																	?>
														<label for="produit" class="sr-only">Produit</label>
														<input type="text" name="modif_produit" class="form-control" value="<?php echo $nom_produit; ?>"><br>
														<div class="form-group form-horizontal">
															<label for="sous_domaine" class="col-form-label sr-only">Sous domaine</label>
															<select class="form-control" name="sous_dom_modif_select">
																<?php

																			?>
																<option><?php echo $nom_sous_domaine; ?></option>
																<?php //} 
																			//}
																			?>
															</select>
														</div>
														<div class="form-group">
															<label class="col-form-label sr-only">Prix</label>
															<input type="number" class="form-control" name="prix_vente_modif" value="<?php echo $produit->prix_vente; ?>">
														</div>
														<div class="form-group">

															<label class="col-form-label sr-only">Description</label>
															<textarea class="form-control" name="description_modif"><?php echo $produit->description; ?></textarea>

														</div>
														<div class="form-group form-horizontal">
															<!--<div class="alert alert-danger">--><?php echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); ?>
															<!--</div>-->
															<label for="image_produit">Ajouter une image</label>
															<input type="file" name="image_modif_produit" class="form-control-file" value="<?php echo $produit->image_produit; ?>">
														</div>
														<div class="text-right">
															<button type="submit" class="btn btn-warning">Modifier</button>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
														</div>
														</form>

													</div>
												</div>
											</div>
										</div>
									</div>

									<th scope="row"><?php echo $id; ?></th>
									<td><?php echo $nom_produit; ?> </td>
									<td> <?php echo $nom_sous_domaine; ?> </td>
									<td>
										<button class="btn btn-warning" data-toggle="modal" data-target="<?php echo '#modifModal' . $id; ?>">Modifier</button>
									</td>
									<td>
										<button class="btn btn-danger" data-toggle="modal" data-target="<?php echo '#supprModal' . $id; ?>">Supprimer</button>
									</td>
								</tr>
					<?php }
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>