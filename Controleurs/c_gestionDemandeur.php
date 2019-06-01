<?php
include('./includes/inc_protect.php');
$action = $_REQUEST['action'];
$mail   = $_SESSION['InfosDemandeur']['mail'];

switch ($action) {
    // Dirige le demandeur vers la page demandeur et affiche des informations concernant les demandes de frais
    case 'voirPageDemandeur': {
        $nbDemandesFrais      = $pdo->GetNbDemandes($mail);
        $nbDemandesFraisValid = $pdo->GetNbDemandesValid($mail);
        include("Vues/v_demandeur.php");
        break;
    }
    // Dirige le demandeur vers la page qui lui permettra de modifier ses informations
    case 'voirProfil': {
        $lesRepresentes = $pdo->Representant($mail);
        include("Vues/v_profilDemandeur.php");
        break;
    }
    // Récupères les informations saisies par le demandeur, puis met à jours les informations dans la base de données
    case 'modifierProfil': {
        $mailActuel  = $mail;
        $nom         = $_POST['nom'];
        $prenom      = $_POST['prenom'];
        $nouveauMail = $_POST['mail'];
        $adresse     = $_POST['adresse'];
        $cp          = $_POST['cp'];
        $ville       = $_POST['ville'];
        $password    = $_POST['password_user'];
        
        if (isset($_POST['nbLicences'])) {
            $nbLicences = $_POST['nbLicences'];
        }
        
        // Permet de vérifier que les zones de textes ne soient pas vides
        if ((!empty($nom)) && (!empty($prenom)) && (!empty($nouveauMail)) && (!empty($adresse)) && (!empty($cp)) && (!empty($ville)) && (!empty($password)) && (!empty($_POST['nbLicences']))) {
            
            $modifierProfil = $pdo->ModifierProfilDemandeur($nom, $prenom, $nouveauMail, $adresse, $cp, $password, $ville, $mailActuel);
            $lesLicences = array();
            $trouve      = true;
            
            // Parcours le nombre de licences que le demandeur a saisit
            for ($i = 0; $i < $nbLicences; $i++) {
                $lesLicences[$i] = $_POST["licence" . $i];
                if ($pdo->VerifLicence($lesLicences[$i])) {
                    // Si le numéro de licence existe dans la base de données, alors lie le numéro de licence au nouveau mail du demandeur 
                    $AjouterLiens = $pdo->AjoutLien($lesLicences[$i], $nouveauMail);
                } else
                    $trouve = false;
            }
            
            if ($trouve == true) {
                // Mise à jours de la variable de session InfosDemandeur après modification du profil
                $InfosDemandeur              = $pdo->GetInfosDemandeur($mail);
                $_SESSION['InfosDemandeur']  = $InfosDemandeur;
                // Création de la variable de session afin d'afficher le message de confirmation
                $_SESSION['MsgConfirmModif'] = "1";
                header("location:index.php?uc=gestionDemandeur&action=voirProfil");
            } else {
                $_SESSION['MsgErreurLicence'] = "1";
                header("location:index.php?uc=gestionDemandeur&action=voirProfil");
            }
        } else {
            $_SESSION['MsgErreurVideModif'] = "1";
            header("location:index.php?uc=gestionDemandeur&action=voirProfil");
        }
        break;
    }
    // Permet au demandeur de retirer un numéro de licence
    case 'supprimerLien': {

        $licence = $_REQUEST['licence'];
        $pdo->SupprimerLien($licence, $mail);

        header("location:index.php?uc=gestionDemandeur&action=voirProfil");

        break;
    }

    // Affiche la page pour effectuer des demandes de remboursement et affiche les clubs, motifs, adhérents
    case 'voirDemandeFrais': {
        // Appel de la fonction ListDesClub et representant de la classe PDO en fonction du mail du demandeur
        $lesClubs                        = $pdo->ListDesClub("$mail");
        $lesMotifs                       = $pdo->motifs();
        $lesRepresentes                  = $pdo->representant("$mail");

        // Met à jours les variables de session pour afficher la page des demandes de remboursements de frais et non pas la page de consultation des demandes
        $_SESSION['PlusieursDemandes']   = "True";
        $_SESSION['AfficheInformations'] = "False";
        include("Vues/v_demandeFrais.php");
        break;
    }
    
    // Recuperes les informations saisis par le demandeur et ajoute un nombre x (max 10) de lignes de frais
    case 'ajouterDemandeFrais': {

        $nbLigne = $_POST["nbLigne"];
        $dateF  = $_POST["date_frais1"];
        $motif  = $_POST["motif1"];
        $trajet = $_POST["trajet1"];
        $km     = $_POST["km1"];
        $coutP  = $_POST["cout_peage1"];
        $coutR  = $_POST["cout_repas1"];
        $coutH  = $_POST["cout_hebergement1"];
        $num_club  = $_POST["club"];

        // Appel de la fonction AjoutLigne de la classe PDO
        $pdo->AjoutLigne($mail, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $num_club);

        // Recuperes les informations saisis dans les autres lignes de frais (si le demandeur souhaite en ajouter plusieurs)
        for ($i = 2; $i <= $nbLigne; $i++) {
            $dateF  = $_POST["date_frais" . $i];
            $motif  = $_POST["motif" . $i];
            $trajet = $_POST["trajet" . $i];
            $km     = $_POST["km" . $i];
            $coutP  = $_POST["cout_peage" . $i];
            $coutR  = $_POST["cout_repas" . $i];
            $coutH  = $_POST["cout_hebergement" . $i];
            $num_club  = $_POST["club"];
            
            $pdo->AjoutLigne($mail, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $num_club);
        }

        // Dirige le demandeur vers la consultation des demandes de remboursement
        header('location:index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais');
        break;
    }
    
    // Affiche la page qui recense les demandes de remboursement d'un demandeur
    case 'voirConsulterDemandeFrais': {
        $listeDemandesFrais = $pdo->GetDemandes($mail);
        include("Vues/v_consultFrais.php");
        break;
    }
    
    // Permet au demandeur de supprimer une demande de remboursement en fonction du mail et de la date lié à la demande
    case 'supprimerDemande': {
        $date = $_REQUEST['date'];
        // Appel de la fonction SupprimerDemande de la classe PDO
        $pdo->SupprimerDemande($mail, $date);
        header("location:index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais");
        break;
    }
    
    // Permet au demandeur d'afficher la page de modification de demande de remboursement
    case 'voirModifierDemande': {
        $date           = $_REQUEST['date'];
        $motif          = $_REQUEST['motif'];
        $lesClubs       = $pdo->ListDesClub("$mail");
        $lesMotifs      = $pdo->motifs();
        $lesRepresentes = $pdo->representant("$mail");
        
        $InfosDemande                    = $pdo->GetInformationsDemande($mail, $date);

        // Met à jours les variables de session pour afficher la page des consultations de remboursements de frais
        $_SESSION['PlusieursDemandes']   = "False";
        $_SESSION['InfosDemande']        = $InfosDemande;
        $_SESSION['ModifierDemande']     = "True";
        $_SESSION['AfficheInformations'] = "True";
        include("Vues/v_demandeFrais.php");
        break;
    }
    
    // Permet au demandeur de modifier la demande de remboursement de frais
    case 'modifierDemandeFrais': {
        $dateF      = $_POST["date_frais1"];
        $motif      = $_POST["motif1"];
        $trajet     = $_POST["trajet1"];
        $km         = $_POST["km1"];
        $coutP      = $_POST["cout_peage1"];
        $coutR      = $_POST["cout_repas1"];
        $coutH      = $_POST["cout_hebergement1"];
        $num_club  	= $_POST["club"];
        
        $pdo->ModifierLigne($mail, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $num_club);
        header("location:index.php?uc=gestionDemandeur&action=voirConsulterDemandeFrais");
        break;
    }
}
?> 
