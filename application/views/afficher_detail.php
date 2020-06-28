<div class="row">
	<div class="text-center col col-lg-10">
		<h4 class=" text-danger"><?php echo $nom_produit; ?></h4>
	</div>
	
</div>
<?php $cart_content = $this->session->userdata('cart_contents');
			$user = $this->session->utilisateur ; ?>
<div class="row">
	<div class="col-lg-6">
		<div >
			<img class="card-img-top img-thumbnail img-fluid" src="<?php echo base_url("assets/upload/$file_name"); ?>">
		</div>
		
	</div>
	<div class="alert alert-light " style="width: 30%;">
		<small class="text-primary text-capitalize"><u> <a href="<?php echo base_url("index.php/Lorion/afficher_liste_produit_sous_domaine/$sous_domaine"); ?>"> <?php echo $sous_domaine ;?></a></u></small>
		<a href="<?php echo base_url("index.php/Lorion/liste_corbeille"); ?>">Corbeille <span class="badge badge-danger text-right align-top"><?php echo $cart_content['total_items']; ?></span> </a>
		
		<div  style="position: absolute; bottom: 30%;">
			<span class="text-success align-text-bottom">Prix: <?php echo $prix_vente." Fr CFA"; ?> </span> <br> 
			<?php echo form_open("Lorion/ajouter_corbeille/$id"); ?>
				<div class="form-group">
					<label for="nombre" class="">Nombre de produits</label>
					<input type="number" name="nombre" value="1" class="form-control">
				</div>
				 
				 <div class="form-group">
				 	<button type="submit" class="btn btn-info form-control">Ajouter à la corbeille</button>
				 </div>
				
			</form>
		</div><br>
		<?php if ($user['user_access'] == 0 ) { ?>
		<span style="position: absolute;bottom: 5%;"><a href="<?php echo base_url("index.php/discussion"); ?>" class="btn btn-dark btn-block">Discuter avec nous</a> </span>
	<?php } else { ?><br>
		<?php if ($user['user_access'] == 1 ) { ?>
			<span><button  class="btn btn-warning" data-toggle="modal" data-target="#modifModal">Modifier</button></span>
			<?php $nom_produit_encode = rawurlencode($nom_produit); ?>
			<a href="<?php echo base_url("index.php/Lorion/supprimer_produit/$nom_produit_encode/$sous_domaine"); ?>" class="btn btn-danger">Supprimer</a>
			<div class="modal" tabindex="-1" role="dialog" id= "modifModal">
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
								<?php  echo form_open_multipart("Lorion/modifier_produit/$id"); "</br>";
									echo form_error('modif_produit');
								 ?>
								 <label for="produit" class="sr-only">Produit</label>
								 <input type="text" name="modif_produit" class="form-control" value="<?php echo $nom_produit; ?>"><br>
								 <div class="form-group form-horizontal">
								 	<label for="sous_domaine" class="col-form-label sr-only">Sous domaine</label>
								 	<select class="form-control" name="sous_dom_modif_select">
								 		<?php 
								 			$domaines = $this->domaineModel->recupererNomDomaine();
							
												foreach ($domaines as $domaine) {
													$nom_domaine = $domaine->nom_domaine;

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
									 	<label class="col-form-label sr-only">Prix</label>
									 	<input type="number" class="form-control" name="prix_vente_modif" value="<?php echo $prix_vente; ?>">
									 </div>
									 <div class="form-group">

									 	<label class="col-form-label sr-only">Description</label>
									 	<textarea class="form-control" name="description_modif" ><?php echo $description; ?></textarea>
									 	
									 </div>
									 <div class="form-group form-horizontal">
									 	<!--<div class="alert alert-danger"><?php //echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>'); ?> </div>-->
									 	<label for="image_produit">Ajouter une image</label>
									 	<input type="file" name="image_modif_produit" class="form-control-file" value="<?php echo base_url("assets/upload/$file_name"); ?>">
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
		<?php }
		} ?>
	</div><br>
	
</div>
<div class="row">
	<div class="col-lg-8">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<h5 class="text-secondary">Description</h5>
			</li>
			
		</ul>
		<p><?php echo $description;echo "</br>";	?></p>
	</div>
</div>