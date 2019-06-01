<!doctype html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <?php 
         include("header.php"); 
         include('./includes/inc_protect.php');
         ?>
      <title><?php if($_SESSION['AfficheInformations'] == "True") { echo "M2L - Modification de frais";} else { echo "M2L - Demande de frais"; } ?></title>
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
      <?php
         // S'il s'agit d'une modification, alors l'action sera modifierDemandeFrais, s'il s'agit d'un ajout d'une demande de remboursement, alors l'action sera ajouterDemnadeFrais
         if((isset($_SESSION['ModifierDemande']) && ($_SESSION['ModifierDemande'] = "True")))
         {
         	?>
      <form style="margin-top: 100px;" method="post" action="index.php?uc=gestionDemandeur&date=<?=$date?>&action=modifierDemandeFrais"><?php unset($_SESSION['ModifierDemande']);
         }
         else
         {
         	?>
      <form style="margin-top: 100px;" method="post" action="index.php?uc=gestionDemandeur&action=ajouterDemandeFrais">
         <?php
            }
            ?>
         <div class="container-fluid">
            <div class="row justify-content-md-center mt-5">
               <div class="card text-white bg-dark col-sm-12 col-md-8">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-sm-6">
                           <h4> <?php if($_SESSION['AfficheInformations'] == "True") { echo "Modification de la note de frais";} else { echo "Note de frais des bénévoles"; } ?></h4>
                        </div>
                        <div class="col-sm-6">
                           <h4 class="text-right">Année civile <?php echo date('Y');?></h4>
                        </div>
                     </div>
                  </div>
                  <div class="card-body text-white">
                     <div class="row mt-2">
                        <div class="col-sm-12">
                           Je soussigné(e) 
                        </div>
                        <div class="col-sm-12 bg-light">
                           <div class="text-center text-dark"> <?php echo $_SESSION['InfosDemandeur']['prenom'] . " " . $_SESSION['InfosDemandeur']['nom'];?> </div>
                        </div>
                     </div>
                     <div class="row mt-4">
                        <div class="col-sm-12">
                           Demeurant 
                        </div>
                        <div class="col-sm-12 bg-light">
                           <div class="text-center text-dark"> <?php echo $_SESSION['InfosDemandeur']['rue'] . ", " . $_SESSION['InfosDemandeur']['cp'] . " " . $_SESSION['InfosDemandeur']['ville'];?> </div>
                        </div>
                     </div>
                     <div class="row mt-4">
                        <div class="col-sm-12">
                           Certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association 
                        </div>
                        <select name="club" class="form-control">
                        <?php	
                           foreach($lesClubs as $unClub) 
                           {
                           	echo "<option value=". $unClub['NUM_CLUB'] .">". $unClub['nom_club'] ."</option>";
                           }
                           ?>
                        </select>
                        <div class="col-sm-12">en tant que don.</div>
                     </div>
                     <div class="row mt-4">
                        <div class="col-sm-4">
                           Frais de déplacement
                        </div>
                        <div class="col-sm-8">
                           Tarif kilométrique appliqué pour le remboursement : 0,28 €
                        </div>
                     </div>
                     <table class="table table-responsive" id="tableaux">
                        <thead class="thead-light">
                           <tr>
                              <th>Date</th>
                              <th class="col-sm-3">Motif</th>
                              <th class="col-sm-2">Trajet</th>
                              <th class="col-sm-2">Kms parcourus</th>
                              <th class="col-sm-1">Péages</th>
                              <th class="col-sm-1">Repas</th>
                              <th class="col-sm-1">Hébergement</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr id="ligne1">
                              <td>
                                 <input class="form-control" type="date" id="date_frais1" name="date_frais1" size="8" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['DateFrais']; }?>" required> 
                              </td>
                              <td>
      <form>
      <!-- Récuperes le motif de la ligne de frais, pour que celui-ci soit selectionné dans la liste déroulante !-->
      <input id="demandeChoixMotif" type="hidden" value="<?php echo $_SESSION['InfosDemande']['Motif'];?>">
      </form>
      <select class="form-control" id="motif1" name="motif1" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['Motif']; }?>">
      <script>
         $(document).ready(function() {
         $('option').each(function(){
          if (this.value == $('#demandeChoixMotif').val()){
              this.setAttribute('selected', 'selected');
          }
         });
         });
      </script>
      <?php
         foreach($lesMotifs as $unMotif) 
         {
         	?><option value="<?php echo $unMotif['ID_MOTIF'];?>"><?php echo $unMotif['LIBELLE'];?></option><?php
         }
         ?>
      </select>
      </td>
      <td>
      <input class="form-control" type="text" id="trajet1" name="trajet1" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['Trajet']; }?>" required>
      </td>
      <td>
      <input class="form-control" type="number" id="km1" name="km1" size="8" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['Km']; } else { echo "0"; }?>" required>
      </td>
      <td>
      <input class="form-control" type="number" id="cout_peage1" name="cout_peage1" size="8" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['CoutPeage']; } else { echo "0"; }?>">
      </td>					
      <td>
      <input class="form-control" type="number" id="cout_repas1" name="cout_repas1" size="8" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['CoutRepas']; } else { echo "0"; }?>">
      </td>
      <td>
      <input class="form-control" type="number" id="cout_hebergement1" name="cout_hebergement1" size="8" value="<?php if($_SESSION['AfficheInformations'] == "True") { echo $_SESSION['InfosDemande']['CoutHebergement']; } else { echo "0"; }?>">
      </td>
      </tr>
      </tbody>
      </table>
      <?php 
         if((isset($_SESSION['PlusieursDemandes']) && ($_SESSION['PlusieursDemandes'] == "True")))
         {
         	?>
      <div class="btn-group" role="group" aria-label="Basic example">
      <div class="mr-1" id="btnAjouter">
      <div class="btn btn-success" name="ajouterLigne" id="ajouterLigne">Ajouter</div>
      <input type="hidden" name="nbLigne" id='nbLigne' value="1">		
      </div>
      <div id="btnRetirer">
      <div class="btn btn-danger" name="retirerLigne" id="retirerLigne">Retirer</div>
      </div>
      </div>
      <script type="text/javascript">
         $(document).ready(function () {
            $("#ajouterLigne").click(function() {
         
               var currentCount = $("#tableaux tbody tr").length, newCount = currentCount + 1;
         
               if(currentCount <= 9)
               {
                  $('#tableaux tbody > tr:last').clone(true).insertAfter('#tableaux tbody > tr:last');
                  $('#tableaux tbody>tr:last').find("input, select").each(function() {
                     var newId = this.id.replace(currentCount,newCount);
                     var newName = this.name.replace(currentCount,newCount);
                     var newValue = $(this).children("option:selected").val();
         
                     $(this).attr('id', newId);
                     $(this).attr('name', newName);
                     $(this).attr('value', newValue);
                     $("#nbLigne").val(newCount);
                  });
               }
               else
               {
                  $("#erreurLigne").show();
               }
            });
         
            $('#retirerLigne').click(function(){
               var currentCount = $("#tableaux tbody tr").length;
            if(currentCount >= 2)
            {
               $("#erreurLigne").hide();
            	$('#tableaux tr:last').remove();
               $("#nbLigne").val(($("#nbLigne").val()-1));
            }
         });
         });
      </script>
      <?php unset($_SESSION['PlusieursDemandes']);
         }
         if(isset($_SESSION['MessageErreurLimite']) && $_SESSION['MessageErreurLimite'] == "1")
         {}
         ?>
      <div class="text-center">
      <div class="alert alert-warning collapse mt-3" id="erreurLigne">
      <strong>Attention -</strong> Impossible d'ajouter plus de 10 lignes de frais !
      </div>
      </div>
      <p class="mt-2">Je suis le représentant légale des adhérents suivants :</p>
      <div class="col-sm-12 bg-light">
      <?php 
         if(count($lesRepresentes) > 0)
         {
            foreach($lesRepresentes as $unRepresenter) 
            {
               echo '<div class="text-dark text-center">';
               echo $unRepresenter['NOM'] . " " . strtolower($unRepresenter['PRENOM']) . ", licence n°" . $unRepresenter['NUMERO_LICENCE'] . "<br>";					
               echo '</div>';
            }
         }
         else
         {
            echo "<div class='alert alert-warning' role='alert'> Vous n'avez pas encore ajouté de clé de licence(s) valide(s) ! </div>";
         }
         ?>
      </div>
      <div class="row mt-2 mb-3">
      <div class="col-sm-12">Pour bénéficier du recu de dons, cette note de frais doit étres accompagnée de toutes les justificatifs correspondants.</div>
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
