<!doctype html>
<html lang="fr">
   <script type="text/javascript" src="./JS/Verif.js"></script>
   <head>
      <meta charset="UTF-8">
      <?php 
      include('./includes/inc_protect.php');
      include('header.php');
      ?>
      <title>M2L - Accueil </title>
   </head>
   <body>
	 <div class="pos-f-t">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h4 class="text-white">Collapsed content</h4>
      <a href="index.php?uc=gestionDemandeur&action=voirDemandeFrais" class="nav-link">Faire une demande de frais</a>
      <a href="index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais" class="nav-link">Consulter vos demandes de frais</a>
      <a href="index.php?uc=gestionDemandeur&action=voirProfil" class="nav-link">Profil</a>
			<a href="index.php?uc=identification&action=seDeconnecter" class="nav-link">Déconnexion</a>
    </div>
  </div>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  		<a class="navbar-brand" href="index.php?uc=gestionDemandeur&action=voirPageDemandeur">M2L</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span> </button>

  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
    		<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
        			<a class="nav-link" href="index.php?uc=gestionDemandeur&action=voirPageDemandeur">Accueil<span class="sr-only">(current)</span></a>
      			</li>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Gestion des frais</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
          				<a class="dropdown-item" href="index.php?uc=gestionDemandeur&action=voirDemandeFrais">Faire une demande de frais</a>
          				<a class="dropdown-item" href="index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais">Consulter vos demandes de frais</a>
        			</div>
	  			</li>
			</ul>
			
    		<form class="form-inline">
				<h5 class="text-white mr-3 mt-1"><?php echo $_SESSION['InfosDemandeur']['prenom'] . " " . $_SESSION['InfosDemandeur']['nom'];?></h5>
	  			<a class="btn btn-outline-warning my-2 my-sm-0 mr-3" href="index.php?uc=gestionDemandeur&action=voirProfil" type="submit">Profil</a>
      			<a class="btn btn-outline-danger my-2 my-sm-0" href="index.php?uc=identification&action=seDeconnecter" type="submit">Déconnexion</a>
			</form>
  		</div>
	</nav>
	<div style="margin-top:100px;">

		<div class="container-fluid">
            <div class="d-flex row justify-content-md-center mt-5">
				<div class="card text-white bg-dark col-sm-6 col-md-8 ">
  						<div class="card-body text-white">
						  <div class="card-header"><h4 class="mb-3"> Bienvenue sur l'application de la Maison des Ligues de Lorraine ! </h4></div>

						  <div class="container mt-3">

							<p >Cette application vous permet d'effectuer des demandes de remboursement de frais de déplacements à vos clubs.<br>Vous pouvez aussi <ins>ajouter</ins> ou supprimer des numéros de licence dans votre profil.</p>
							<div class="mb-4 mt-4 lead"><ins>Informations sur les demandes de remboursement</ins></div>

							<?php 
								if($nbDemandesFrais <= 0) 
								{
									?>
										<div class="alert alert-danger" role="alert">Vous n'avez pas encore effectué de demandes !<hr>
										<a href="index.php?uc=gestionDemandeur&action=voirDemandeFrais">Consulter la page des demandes de remboursement</a></div>
									<?php
								}
								else if(($nbDemandesFrais > 0)  && ($nbDemandesFraisValid <= 0))
								{
									?>
										<div class="alert alert-warning" role="alert">Vous avez effectué <?php echo $nbDemandesFrais; ?> demandes de remboursement.<br> Aucune des demandes n'ont été validées.<hr>
										<a href="index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais">Consultez vos demandes de remboursement</a></div>

									<?php
								}
								else if(($nbDemandesFrais > 0)  && ($nbDemandesFraisValid > 0))
								{
									?>
										<div class="alert alert-success" role="alert">Vous avez effectué <?php echo $nbDemandesFrais; ?> demandes de remboursement.<br> <?php echo $nbDemandesFraisValid; ?> demandes de remboursement à été validée.<hr>
										<a href="index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais">Consultez vos demandes de remboursement</a></div>
									<?php
								}
							?>
						<div class="card-footer text-muted">Ⓒ 2019 Application M2L</div>
						</div>
						</div>
            </div>
        </div>
    </div>   
   </body>
</html>
