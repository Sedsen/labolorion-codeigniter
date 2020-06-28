<div class="row ">
	<div class="text-center col col-lg-10">
		<h4 class="text-danger"><?php echo urldecode($sous_domaine) ; ?> </h4>
	</div>
</div>

<div class="row">
	
	
	<?php //echo urldecode($sous_domaine) ; "</br>";
		//$produits = $this->produit_model->recuperer_nom_produit(urldecode($sous_domaine));
		$produits = $this->produit_model->liste_produit(urldecode($sous_domaine),$par_page,$nb_produit);
		foreach ($produits as $produit) {
			$nom_produit = $produit->nom_produit;
			$value = $this->produit_model->recuperer_image(urldecode($sous_domaine),$nom_produit);
			$filename = $value[0]->image_produit;
		//}
	?>
	<div>
		<div class="col col-lg-2">
			<div class="card bg-dark text-primary"  style="width: 15rem;">
				<img class="card-img-top img-fluid" style="height: 15rem;" src="<?php echo base_url("/assets/upload/$filename"); ?>">
				<div class="card-body">
					<p class="card-text text-center"><?php echo $nom_produit; ?></p>
					<p ><a href="<?php echo base_url("index.php/Lorion/afficher_detail/$produit->id"); ?>" class="btn btn-primary ">Voir details</a>
				</div>
			</div><br>
		</div>
	</div>
	
<?php } ?>
</div>

<div class="row d-flex justify-content-center text-center" style="height: 35px;">
	<?php echo $pagination; ?>
</div>