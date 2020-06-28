<!DOCTYPE html>
<html>

<head>
	<title>Labo Lorion</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');  ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
	<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
</head>

<body>

	<div>
		<nav class=" navbar navbar-expand-lg navbar-expand-md navbar-expand-sm navbar-expand-xl navbar-dark bg-dark" id="horizNav">
			<!--<h2>
			<a href="#" class="navbar-brand">Lorion <br> Laboratoire</a>
		</h2>-->
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" id="bouton-toggler">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse " id="navigation">
				<!--<div class="d-flex ">-->
				<div class="container">
					<div class="">
						<!--<div class="mx-auto" style="width: 400px;" >-->
						<ul class="navbar-nav justify-content-lg-end list-unstyled">
							<li class="nav-item">
								<a href="<?php echo base_url('index.php/Lorion'); ?>" class="nav-link">Accueil</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">Contacts</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">Services</a>
							</li>
							<?php if ($this->session->utilisateur == NULL || $this->session->utilisateur == FALSE) { ?>
								<li class="nav-item">
									<a href="<?php echo base_url("index.php/authentification/index"); ?>" class="nav-link">Se connecter</a>
								</li>
							<?php } else { ?>
								<li class="nav-item">
									<a href="<?php echo base_url("index.php/authentification/deconnexion"); ?>" class="nav-link">Se deconnecter</a>
								</li>
								<?php
									$user_access = $this->session->utilisateur['user_access'];
									$user = $this->session->utilisateur['username'];
									$admins = $this->user_model->select_admin();
									if ($user_access == 0) {
										?>
									<li class="nav-item">
										<a href="<?php echo base_url("index.php/discussion"); ?>" class="nav-link">Notification
											<?php

													$chat_id = $this->discussion_model->select_chat_id($admins[0]->username)[0]->id;
													//}
													//if ($user_access == 0) {
													$unread = $this->discussion_model->discussion_unread_admin($chat_id, $admins[0]->username);
													if ($unread != 0) {
														?>
												<span class="badge badge-danger">
												<?php


															echo $unread; //$this->discussion_model->discussion_unread_admin($chat_id,$admins[0]->username);

														}
														?> </span>
											<?php } ?>
										</a>
									</li>
								<?php } ?>

						</ul>


					</div>

				</div>
				<!--</div>-->


			</div>
		</nav>
		<div class="wrapper ">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-sm-2" style="height: 100%;">
					<nav class="navbar navbar-vertical-left nav-fill" id="sidebar">
						<div class="sidebar-header text-center" style="background:white;width: 200px;">
							<h3>
								<a href="#" class="navbar-brand" style="color: black;">Lorion <br> Laboratoire</a>
							</h3>
						</div>
						<div id="ulVertical" class="">
							<ul class="nav list-unstyled components">
								<?php if ($this->session->utilisateur != NULL /*|| $this->session->utilisateur != FALSE*/) {
									//var_dump($this->session->utilisateur);
									if ($this->user_model->select_user_access($this->session->utilisateur['username']) == 1) {
										?>
										<li class="nav-item dropdown">
											<a href="#adminDropdown" id="" style="color: white;" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true">Administrateur</a>
											<ul class="collapse list-unstyled" aria-labelledby="adminDropdown" id="adminDropdown">

												<a href="<?php echo base_url('index.php/Lorion/afficher_domaine'); ?>" class="">Domaine</a>
												<a href="<?php echo base_url('index.php/Lorion/afficher_sous_domaine'); ?>" class="">Sous Domaine</a>
												<a href="<?php echo base_url('index.php/Lorion/afficher_liste_produit'); ?>" class="">Produits</a>
												<a href="<?php echo base_url('index.php/Lorion/afficher_liste_admin'); ?>" class="">Liste des admins</a>
												<a href="<?php echo base_url("index.php/discussion/list_admin_discussion"); ?>" class="">Discussion</a>
											</ul>
										</li>
								<?php }
								} ?>
								<li class="nav-item ">
									<a href="<?php echo base_url('index.php/Lorion'); ?>" style="color: white;width:190px;" class="">Accueil</a>
								</li>

								<?php $resultat = $this->domaineModel->recupererNomDomaine();
								// for ($id =0; $id < count($resultat);$id++) { 
								foreach ($resultat as $row) {
									$nom_domaine = $row->nom_domaine;
									//var_dump(count($resultat));

									?>
									<li class="nav-item">

										<a class="nav-link dropdown-toggle" href="<?php echo '#menuDeroulant' . $nom_domaine; ?> " style="color: white;width:190px;" data-toggle="collapse"> <?php echo $nom_domaine; ?> </a>

										<ul class="collapse list-unstyled text-center" aria-labelledby="menuDeroulant" id="<?php echo 'menuDeroulant' . $nom_domaine; ?>">


											<?php
												$data = $this->sousDomaineModel->recupererNomSousDomaine($nom_domaine);
												foreach ($data as $ligne) {
													$sous = $ligne->nom_sous_domaine;
													$sous_decode = urldecode($sous);
													//echo base_url("index.php/Lorion/afficher_liste_produit_sous_domaine/$sous");
													?>

												<a href="<?php echo base_url("index.php/Lorion/afficher_liste_produit_sous_domaine/$sous"); ?>" class="">
													<?php if (!empty($ligne->nom_sous_domaine)) {
																echo $ligne->nom_sous_domaine;
																//var_dump($this->afficher_liste_produit_sous_domaine($ligne->nom_sous_domaine));
															}
															?>
												</a>
											<?php } ?>
										</ul>
									</li>
								<?php } ?>
								<?php ?>
								<li class="nav-item ">
									<a href="#" style="color: white;width:150px;" class="">Contacts</a>
								</li>
								<li class="nav-item ">
									<a href="#" style="color: white;width:150px;" class="">Services</a>
								</li>
							</ul>
						</div>

					</nav>
				</div>

				<div style="position: absolute; left: 15%;top: 10%;" class="col-lg-10 col-md-10 col-sm-10 ">
					<div class="row justify-content-lg-center justify-content-md-end justify-content-sm-end">
						<div class="text-center">
							<form class="form-inline" action="<?php echo base_url("index.php/Lorion/afficher_recherche"); ?>" method="get">
								<?php //echo form_error('recherche') ; 
								?>
								<input type="search" name="recherche" class="form-control mr-sm-2" placeholder="Rechercher">
								<button class="btn btn-outline-success my-2" type="submit">Rechercher</button>
							</form>
						</div>

					</div>