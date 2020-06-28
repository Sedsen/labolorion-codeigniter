			<!--<div class="bg-success navbar navbar-expand-lg" style="position: absolute;bottom: 0px;left: 0px;">
				<ul class="">
				    <li> <a href="">Accueil</a> </li>
				    <li></li>
				    <li></li>
				    <li></li>
				</ul>
			</div>-->
			<footer>
				<div class="container" style="color: white;width: 100%;">
					<div class="row">
						<?php $user = $this->session->utilisateur;
							if ($user['user_access'] == 1 ) {
						 ?>
						 	<ul class="list-unstyled">
								<p>Adminstrateur</p>		
								<a href="<?php echo base_url('index.php/Lorion/afficher_domaine') ; ?>" class="text-info">Domaine</a><br>
								<a href="<?php echo base_url('index.php/Lorion/afficher_sous_domaine');?>" class="text-info">Sous Domaine</a><br>
								<a href="<?php echo base_url('index.php/Lorion/afficher_liste_produit'); ?>" class="text-info">Produits</a><br>
								<!--<a href="<?php echo base_url('index.php/Lorion/afficher_liste_admin') ;?>" class="text-info">Liste des admins</a><br>-->
								<a href="<?php echo base_url("index.php/discussion/list_admin_discussion"); ?>" class="text-info">Discussion</a><br>
							</ul>		
						<?php } ?>
							<!--<h4>Menu</h4>
							<a href="<?php echo base_url("index.php/Lorion"); ?>">Accueil</a>-->
							<?php $result = $this->domaineModel->recupererNomDomaine();
								foreach ($result as $row ) {
									$nom_domaine = $row->nom_domaine;
							 ?>
						<div class="col-md-2 col-lg-2 col-sm-3 footer-nav">
							<p class="text-light">
								<?php echo $nom_domaine; echo '</br>';?>
							</p>
							<?php
								$data = $this->sousDomaineModel->recupererNomSousDomaine($nom_domaine);
								foreach ($data as $value) {
									$sous_domaine = $value->nom_sous_domaine;
								//	echo $sous_domaine; echo '</br>';
								//}
							?>
							<a href="<?php echo base_url("index.php/Lorion/afficher_liste_produit_sous_domaine/$sous_domaine"); ?>" class="text-info"><?php echo $sous_domaine; ?></a><br>
						<?php } ?>
						</div>
					<?php } ?>
					</div>
				</div>
				<hr style="color: white;border-width: 3px;">
			</footer>

    
		</div>
		
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript " src="<?php echo base_url('assets/js/modal.js'); ?>"></script>
<script >
CKEDITOR.replace('description_modif');
</script>
</body>
</html>