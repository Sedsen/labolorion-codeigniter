<div class="row">
	<div class="text-center col col-lg-10 col-md-10 col-sm-10 col-xl-10">
		<h4 class=" text-danger">Nos produits</h4>
	</div>
	
</div>

<div class="row ">
	<div class="card-deck justify-content-md-center justify-content-sm-center">
		<?php 

			/*$domaines = $this->domaineModel->recupererNomDomaine();
							
				foreach ($domaines as $domaine) {
					$nom_domaine = $domaine->nom_domaine;

					$sous_domaines = $this->sousDomaineModel->recupererNomSousDomaine($nom_domaine);
						foreach ($sous_domaines as $sous_domaine) {
							$nom_sous_domaine = $sous_domaine->nom_sous_domaine;*/

							//$produits = $this->produit_model->recuperer_nom_produit($nom_sous_domaine);
							$produits = $this->produit_model->recuperer_liste_produit($par_page,$nb_produit);
								foreach ($produits as $produit) {

									$nom_produit = $produit->nom_produit;
									$nom_sous_domaine = $this->produit_model->recuperer_sous_domaine($nom_produit)[0]->sous_domaine_id;
									$value = $this->produit_model->recuperer_image($nom_sous_domaine,$nom_produit);
					
									$filename = $value[0]->image_produit;
									//var_dump($nom_sous_domaine);
					//echo base_url("/assets/upload/$filename");
					?>
					<div class="">
					<div class="col col-lg-2 col-md-3 col-sm-4">
						<div class="card bg-dark text-primary " style="width: 15rem; ">
							<img class="card-img-top  img-fluid" style="height: 15rem;"  src="<?php echo base_url("/assets/upload/$filename"); ?>">
							<div class="card-body">
								<p class="card-text text-center"> <?php echo $nom_produit; ?> </p>
								<p ><a href="<?php echo base_url("index.php/Lorion/afficher_detail/$produit->id"); ?>" class="btn btn-primary ">Voir details</a>
									<span class="text-right text-success"><?php echo $produit->prix_vente." Fr"; ?></span></p>
							</div>
							
						</div><br>
					</div>
					
					</div>
					
					

					<?php 
				}
			/*}
		}*/

 ?>

	</div><br>

	
	
	<?php //echo($pagination) ;
		//var_dump($pagination);
	?>
</div>
	<div class="row d-flex justify-content-center text-center" style="height: 35px;">
		<!--<nav aria-label="Page navigation example">
			<ul class="pagination pagination-sm ">
			<!-	<li class="page-item">
					<a href="<?php //echo base_url('index.php/Lorion/index/0');?>" class="page-link">Previous</a>
				</li>
				<li class="page-item">
					<a href="<?php //echo base_url('index.php/Lorion/index/2');?>" class="page-link">1</a>
				</li>
				<li class="page-item">
					<a href="<?php //echo base_url('index.php/Lorion/index/5');?>" class="page-link">2</a>
				</li>
				<li class="page-item">
					<a href="<?php //echo base_url('index.php/Lorion/index/8');?>" class="page-link">3</a>
				</li>
				<li class="page-item">
					<a href="<?php //echo base_url('index.php/Lorion/index/12');?>" class="page-link">Next</a>
				</li>-->
					<?php echo $pagination; ?>				
				
				
		<!--	</ul>
		</nav>-->
	</div>
	</br>
