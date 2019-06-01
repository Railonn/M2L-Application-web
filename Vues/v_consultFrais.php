<!doctype html>
<html lang="fr">
   <script type="text/javascript" src="./JS/Verif.js"></script>
   <head>
      <meta charset="UTF-8">
      <?php 
         include('./includes/inc_protect.php');
         include('header.php');
         ?>
      <title>M2L - Consultation des demandes de remboursement </title>
   </head>
   <body>
	<div class="pos-f-t">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h4 class="text-white"></h4>
      <a href="index.php?uc=gestionDemandeur&action=voirDemandeFrais" class="nav-link">Faire une demande de frais</a>
      <a href="index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais" class="nav-link">Consulter vos demandes de frais</a>
      <a href="index.php?uc=gestionDemandeur&action=voirProfil" class="nav-link">Profil</a>
			<a href="index.php?uc=identification&action=seDeconnecter" class="nav-link">Déconnexion</a>
    </div>
  </div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
         <a class="navbar-brand" href="index.php?uc=gestionDemandeur&action=voirPageDemandeur">M2L</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon">
         <li class="nav-item dropdown">
         </li></span> 
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="index.php?uc=gestionDemandeur&action=voirPageDemandeur">Accueil<span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestion des frais</a>
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
            <div class="card text-white bg-dark col-sm-4 col-md-6">
               <div class="card-body text-white">
                  <div class="card-header">
                     <h4 class="mb-3">Consultation des demandes de remboursement</h4>
                  </div>
                  
                  <div class="container mt-3">
									<?php
										if(count($listeDemandesFrais) > 0)
										{
									?>
							<form class="form-inline mb-4">
                        <input class="form-control form-control-md w-100" type="text" placeholder="Rechercher vos demandes de remboursement" aria-label="Search">
                     </form>

                     <table class="table bg-light text-dark">
                        <thead class="thead-light">
                           <tr>
                              <th>#</th>
                              <th>Date</th>
                              <th>Motif</th>
                              <th>Trajet</th>
                              <th>Kms parcourus</th>
                              <th>Status</th>
                              <th></th>
                              <th></th>
                           </tr>
                        </thead>
												<?php
														$i = 1;
														foreach($listeDemandesFrais as $uneDemande) {
															$date = $uneDemande['DATE_FRAIS'];
                                             $motif = $uneDemande['ID_MOTIF'];
                                             $trajet = $uneDemande['TRAJET'];
                                             $km = $uneDemande['KM'];
                                             $status = $uneDemande['LIGNEVALIDE'];
                        		      ?>
                        			<tbody>
																<tr>
																	<td class="font-weight-bold"><?=$i?></td>
																	<td><?=$date?></td>
																	<td class="font-weight-light"><?php
																	switch($motif)
																	{
																		case 1 :
																			echo "Réunion";
																			break;
																		case 2 :
																			echo "Compétition régionale";
																			break;
																		case 3 :
																			echo "Compétition nationale";
																			break;
																		case 4 :
																			echo "Compétition internationale";
																			break;
																		case 5 :
																			echo "Stage";
																			break;
																	}?></td>
                                                   <td class="font-weight-light"><?=$trajet?></td>
                                                   <td class="font-weight-light"><?=$km?></td>
                                                   <td><?php 
                                                   if($status == 0)
                                                   { 
                                                      echo "<div class='font-weight-bold text-warning'>En cours</div>"; 
                                                   }
                                                   else
                                                   { 
                                                      echo "<div class='font-weight-bold text-success'>Validée</div>"; 
                                                   }
                                                   ?></td>
                                                   <td class="text-right"><a href="index.php?uc=gestionDemandeur&date=<?=$date?>&motif=<?=$motif?>&action=voirModifierDemande"> 
                                                   <img src="https://img.icons8.com/color/48/000000/edit.png" style="width:30px; height:30px;" title="Modifier lade demande de frais"></a></td>
                                                   <td><a href="index.php?uc=gestionDemandeur&date=<?=$date?>&action=supprimerDemande"> 
                                                   <img src="https://img.icons8.com/color/48/000000/close-window.png" style="width:30px; height:30px;" title="Supprimer la demdande de frais" onclick="return confirm('Voulez-vous vraiment supprimer cette demande de frais ?');"></a></td>
										 <?php
										 	$i = $i + 1;
											}
										}
										else
										{
											echo "<div class='alert alert-warning mt-4'>Vous n'avez pas encore effectué de demandes de remboursements de frais !</div>";
										}
										?>
										 </tr>
                     </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>