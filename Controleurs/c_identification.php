<?php

/** La variable récupères l'action souhaité par l'utilisateur */

$action = $_REQUEST['action'];

switch ($action)
{
	// Permet de vérifier si les identifiants saisis correspondent à un compte demandeur.
	case 'seConnecter' :
	{
		$mail = $_POST['mail'];
		$password = $_POST['password_user'];

		// Vérifie que les champs ne sont pas vides.
		if((!empty($password) && (!empty($mail))))
		{
			//$DBPASSWORD : 1° Appel d'une fonction de la classe pdo qui va récupèrer un mot lié à une adresse mail saisit par l'utilisateur.
			$DBPassword = $pdo->GetPassword($mail);
			
			// Appel de la fonction VerifPassword (dans functions.inc.php) qui renvoie true si le mot de passe récupèré correspond à celui qui a été saisit par l'utilisateur.
			if (verifPassword($password,$DBPassword)) 
			{
				//$INFOSDEMANDEURS : 2° Appel d'une fonction de la classe pdo qui va récupérer toutes les informations d'un demandeur en fonction de son mail.
				$InfosDemandeur = $pdo->GetInfosDemandeur($mail);

				// Création de la variable de session qui contient les informations du demandeur.
				$_SESSION['InfosDemandeur'] = $InfosDemandeur;

				// Création de la variable de session (sécurité page) qui contient "true", puis dirige l'utilisateur vers la page demandeur dans le controleur gestionDemandeur.
				$_SESSION['Connexion'] = 'true';
				header('location:index.php?uc=gestionDemandeur&action=voirPageDemandeur');
			}
			else
			{
				$_SESSION['MsgErreurIncorrect'] = "1"; 
				header('location:index.php');
			}
		}
		else
		{
			$_SESSION['MsgErreurVide'] = "1"; 
			header('location:index.php');
		}
	}

	case 'voirInscription' :
	{
		include("Vues/v_inscription.php");
		break;
	}

	case 'inscrire' :
	{
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$mail = $_POST['mail'];
		$adresse = $_POST['adresse'];
		$cp = $_POST['cp'];
		$ville = $_POST['ville'];
		$password = $_POST['password_user'];

        if (isset($_POST['nbLicences'])) {
            $nbLicences = $_POST['nbLicences'];
		}

		if((!empty($nom)) && (!empty($prenom)) && (!empty($mail)) && (!empty($adresse)) && (!empty($cp)) && (!empty($ville)) && (!empty($password)) && (!empty($_POST['nbLicences']) ))
		{
			$lesLicences = array();
			$trouve = true;

			for($i = 0; $i<$nbLicences; $i++){
				$lesLicences[$i] = $_POST["licence".$i];
				if($pdo->VerifLicence($lesLicences[$i]))
				{
					if($i == 0)
						$Inscription = $pdo->InscriptionDemandeur($nom,$prenom,$mail,$adresse,$cp,$password,$ville);
					$AjouterLiens = $pdo->AjoutLien($lesLicences[$i], $mail);
				}
				else
					$trouve = false;
			}

			if($trouve == false)
			{
				$_SESSION['MsgErreurLicence'] = "1";
				include("Vues/v_inscription.php");
			}
			else 
			{
				$_SESSION['MsgConfirmCompte'] = "1";
				header('location:index.php');
			}
		}
		else
		{
			$_SESSION['MsgErreurVide'] = "1";
			header('location:index.php?uc=identification&action=voirInscription');
		}
		break;
	}

	case 'voirMdpOublie' :
	{
		include("Vues/v_password.php");
		break;
	}

	case 'seDeconnecter' :
	{
		include('./includes/inc_protect.php');
		session_destroy();
		header('location:index.php');
	}
}
?>