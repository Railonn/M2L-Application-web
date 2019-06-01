<!doctype html>
<html lang="fr">
   <script type="text/javascript" src="./JS/Verif.js"></script>
   <head>
      <meta charset="UTF-8">
      <?php 
      include('./includes/inc_protect.php');
      include('header.php');
      ?>
      <title>M2L - Modification du profil</title>
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
      <form style="margin-top:100px;" method="post" action="index.php?uc=gestionDemandeur&action=modifierProfil">
         <div class="container">
            <div class="row justify-content-md-center mt-5">
               <div class="card text-white bg-dark col-sm-12 col-md-8">
                  <div class="card-header text-light"><h4>Modification du profil</h4></div>
                  <div class="card-body text-white">
                     <div class="form-group">
                        <label for="nom">Nom : </label>
                        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $_SESSION['InfosDemandeur']['nom']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="prenom">Prenom : </label>
                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $_SESSION['InfosDemandeur']['prenom']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="mail">Adresse mail : </label>
                        <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $_SESSION['InfosDemandeur']['mail']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="adresse">Adresse : </label>
                        <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $_SESSION['InfosDemandeur']['rue']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="cp">Code postal : </label>
                        <input type="text" class="form-control" name="cp" id="cp" value="<?php echo $_SESSION['InfosDemandeur']['cp']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="ville">Ville : </label>
                        <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $_SESSION['InfosDemandeur']['ville']; ?>">
                     </div>
                     <div class="form-group">
                        <label for="password_user"><mark>Mot de passe * :</mark></label>
                        <input type="password" class="form-control" name="password_user" id="password_user" placeholder="●●●●●●●●" required>
                     </div>
                     <div class='text-white mb-2'> Je suis le représentant légale des adhérents suivants : </div>
                     <div class="col-sm-12 bg-light mb-4 text-dark">

                        <?php 
                           if(count($lesRepresentes) > 0)
                           {
                              ?>
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>Nom</th>
                                          <th>Prénom</th>
                                          <th>Numéro de licence</th>
                                       </tr>
                                    </thead>
                              <?php

                              $mailDemandeur = $_SESSION['InfosDemandeur']['mail'];

                              foreach($lesRepresentes as $unRepresenter) {
                                 $nom = $unRepresenter['NOM'];
                                 $prenom = $unRepresenter['PRENOM'];
                                 $licence = $unRepresenter['NUMERO_LICENCE'];
                                 ?>
                                    <tbody>
	                                    <tr> 
                                          <td><?=$nom?></td>
                                          <td><?=strtolower($prenom)?></td>
                                          <td><?=$licence?></td>
                                          <td class="text-right"><a href="index.php?uc=gestionDemandeur&mailDemandeur&licence=<?=$licence?>&action=supprimerLien"> 
                                          <img src="https://img.icons8.com/color/48/000000/close-window.png" style="width:30px; height:30px;" title="Retirer cette adhérent" onclick="return confirm('Voulez-vous vraiment retirer cet adhérent ?');"></a></td>
                                 <?php
                              }
                           }
                           else
                           {
                              echo "<div class='alert alert-warning' role='alert'> Vous n'avez pas encore ajouté de clé de licence(s) valide(s) ! </div>";
                           }
                        ?>
                     </tr>
                     </tbody>
                     </table>
                     </div>

                     <p><strong> Ajouter les numéros de licences dont vous êtes le représentant légal </strong></p>
                     <div class="form-group">
                        <label for="nbLicences"><mark>Nombres de licences * :</mark></label>
                        <select name="nbLicences" id="nbLicences" class="nbLicences form-control" onchange="ajoutLicence(this.value)">
                           <option selected disabled>--- Selectionner ---</option>
                           <?php			
                              for ($i = 1; $i <= 10 ; $i++) 
                              {
                              	if ($i == 1) 
                              		echo "<option value=".$i.">".$i." Licence</option>";
                              	else
                              		echo "<option value=".$i.">".$i." Licences</option>";
                              }
                              ?>
                        </select>
                     </div>
                     
                     <!-- valeur de l'ancien nombre de licence -->
                     <input type="hidden" id="lastNbL">
                     <!-- bloc where the various licence input will be created -->
                     <div class="form-group" id="bloc_licences"></div>

                     <div class="form-group text-center mt-2 mb-1" id="bloc_erreur">
                        <?php
                           if((isset($_SESSION['MsgErreurLicence'])) && ($_SESSION['MsgErreurLicence']) == "1" ) { echo "<div class='alert alert-danger' role='alert'> Le numéro de licence que vous avez saisie est incorrect. </div>"; unset($_SESSION['MsgErreurLicence']); }  
                           if((isset($_SESSION['MsgErreurVideModif'])) && ($_SESSION['MsgErreurVideModif']) == "1" ) { echo "<div class='alert alert-danger' role='alert'> Veuillez remplir les champs vides ! </div>"; unset($_SESSION['MsgErreurVideModif']); } 
                           if((isset($_SESSION['MsgConfirmModif'])) && ($_SESSION['MsgConfirmModif']) == "1" ) { echo "<div class='alert alert-success' role='alert'> Votre compte a bien été modifié </div>"; unset($_SESSION['MsgConfirmModif']); } 
                        ?>
                     </div>

                     
                     <button class="btn btn-info" type="submit" >Valider</button>
                     <button class="btn btn-warning" type="reset" >Effacer</button>

                     <button class="btn btn-danger float-right" type="submit" onclick="window.location.href='index.php?uc=gestionDemandeur&action=voirPageDemandeur'">Retour</button>

                  </div>
               </div>
            </div>
         </div>
      </form>   
   </body>
</html>