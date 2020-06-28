<div class="row">
	<div class="text-center col col-lg-10">
		<h4 class=" text-secondary">Résulat de la recherche : <?php echo $recherche; ?></h4>
	</div>
	
</div>
<div class="row">
	<div class="col col-lg-10">
		<?php 
			if ($nom_produit==NULL){?>
				<p class="h5 text-danger">
					Le mot recherché n'a pas été trouvé!
				</p>  
			<?php } else {
			?>
		<ul class="list-unstyled">
			<?php foreach ($nom_produit as $row) { ?>

				<li class="">
					<a href="<?php echo base_url("index.php/Lorion/afficher_detail/$row->id"); ?>" class="h5 text-primary"><?php echo $row->nom_produit;echo "</br>"; ?></a>
					<div class="bg-secondary text-light" style="margin-left: 50px;">
						<p > <?php echo word_limiter($row->description,10) ; ?></p>
					</div>
					
				</li>
			
			<?php }
			} ?>
		</ul>
	</div>
	
	
</div>