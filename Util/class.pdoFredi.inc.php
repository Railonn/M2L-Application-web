<?php
/** 
 * Classe d'accès aux données. 
 * Utilise les services de la classe PDO pour l'application Fredi
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoFredi qui contiendra l'unique instance de la classe
 * @package default
 * @author William & Loic
 * @version    1.0
 */
class PDOFredi
{
	private static $myPDO;
	private static $myPDOFredi;
	
	/**
 	* Constructeur privé, crée l'instance de PDO qui sera sollicitée
 	* pour toutes les méthodes de la classe
 	**/
 	private function __construct()
	{
    		PDOFredi::$myPDO = new PDO('mysql:host=172.16.106.4;dbname=fredi', 'root', ''); 
		PDOFredi::$myPDO->query("SET CHARACTER SET utf8");
	}
	
	public function _destruct()
	{
		PDOFredi::$myPDO = null;
	}
	
	/**
 	* Fonction statique qui crée l'unique instance de la classe
 	*
 	* Appel : $instancePDOFredi = PDOFredi::getPDOFredi();
 	* @return l'unique objet de la classe PDOFredi
 	**/
	public static function getPDOFredi()
	{
		if(PDOFredi::$myPDOFredi == null)
		{
			PDOFredi::$myPDOFredi= new PDOFredi();
		}
		return PDOFredi::$myPDOFredi;  
	}
	
	/**
	* Fonction publique qui permet d'ajouter un demandeur à la base de données
	* @param $nom : nom du demandeur
	* @param $prenom : prénom du demandeur
	* @param $mail : email du demandeur
	* @param $adresse : adresse du demandeur
	* @param $cp : code postal du demandeur
	* @param $password : mot de passe du demandeur
	* @param $ville : ville où vit le demandeur
	*/
	public function InscriptionDemandeur($nom, $prenom, $mail, $adresse, $cp, $password, $ville)
	{
		$sqlInscription = "INSERT INTO DEMANDEURS VALUES('$mail','$nom','$prenom','$adresse','$cp','$ville','$password','0');";
		$result = PDOFredi::$myPDO->exec($sqlInscription);
	}
	
	/**
	* Fonction publique qui permet de vérifier qu'un numéro de licence donné existe dans la base de données
	* @param $licence : numéro de licence d'un adhérent
	*/
	public function VerifLicence($licence)
	{
		$sqlVerifLien = "SELECT NUMERO_LICENCE FROM ADHERENTS WHERE NUMERO_LICENCE = '$licence';";
		$result = PDOFredi::$myPDO->query($sqlVerifLien);
		$licence = $result->rowCount();
		if ($licence == 0) 
			return false;
		else
			return true;
	}
	
	/**
	* Fonction publique qui permet de lier un demandeur avec un adhérent
	* @param $licence : numéro de licence d'un adhérent
	* @param $mail : mail d'un demandeur
	*/
	public function AjoutLien($licence, $mail)
	{
		$sqlLien = "INSERT INTO LIEN VALUES('$licence', '$mail');";
		$result = PDOFredi::$myPDO->exec($sqlLien);
	}
	
	/**
	* Fonction publique qui récupère le mot de passe d'une adresse mail
	* @return $ligne['PASSWORD'] : mot de passe d'un demandeur
	* @param $mail : adresse mail du demandeur
	**/
	public function GetPassword($mail)
	{
		$sqlPassword = "SELECT PASSWORD FROM DEMANDEURS WHERE ADRESSE_MAIL = '$mail';";
		$result = PDOFredi::$myPDO->query($sqlPassword) ;
		$ligne = $result->fetch();
		$BDPassword = $ligne['PASSWORD'];
		return $BDPassword;
	}
	
	/**
	* Fonction publique qui récupère toutes les informations d'un demandeur en fonction du mail
	* @param $mail : nom du demandeur
	* @return $Infos : liste qui contient les informations d'un demandeur
	*/
	public function GetInfosDemandeur($mail)
	{
		$sqlInfos = "SELECT * FROM DEMANDEURS WHERE ADRESSE_MAIL = '$mail';";
		$result = PDOFredi::$myPDO->query($sqlInfos);
		$ligne = $result->fetch();
		$Infos['mail'] = $ligne['ADRESSE_MAIL'];
		$Infos['nom'] = $ligne['NOM'];
		$Infos['prenom'] = $ligne['PRENOM'];
		$Infos['rue'] = $ligne['RUE'];
		$Infos['cp'] = $ligne['CP'];
		$Infos['ville'] = $ligne['VILLE'];
		$Infos['password'] = $ligne['PASSWORD'];
		return $Infos;
	}
	
	/**
	* Fonction publique qui permet de mettre à jours les informations du demandeur dans la base de données.
	* @param $nom : nom du demandeur
	* @param $prenom : prénom du demandeur
	* @param $mail : email du demandeur
	* @param $adresse : adresse du demandeur
	* @param $cp : code postal du demandeur
	* @param $password : mot de passe du demandeur
	* @param $ville : ville où vit le demandeur
	* @param $nouveauMail : nouveau mail du demandeur
	* @param $mailActuel : mail du demandeur avant modification
	*/
	public function ModifierProfilDemandeur($nom,$prenom,$nouveauMail,$adresse,$cp,$password,$ville,$mailActuel)
	{
		$sqlNewProfil = "UPDATE DEMANDEURS SET ADRESSE_MAIL = '$nouveauMail', NOM = '$nom', PRENOM = '$prenom', RUE = '$adresse', CP = '$cp', VILLE = '$ville', PASSWORD = '$password' WHERE ADRESSE_MAIL = '$mailActuel';";		
		$result = PDOFredi::$myPDO->exec($sqlNewProfil);
	}
	
	/**
	* Fonction publique qui permet de supprimer un lien entre un numéro de licence et un demandeur
	* @param $licence : numéro de licence à supprimer
	* @param $mailDemandeur : mail du demandeur
	*/
	public function SupprimerLien($licence,$mailDemandeur)
	{
		$sqlSupprimerLien = "DELETE FROM LIEN WHERE NUMERO_LICENCE = '$licence' AND ADRESSE_MAIL = '$mailDemandeur';";
		$result = PDOFredi::$myPDO->exec($sqlSupprimerLien);
	}
	/**
	* Fonction publique qui permet de récupérer les informations du CLUB en fonction du numéro de licence
	* @param $licence : numéro de licence à supprimer
	*/
	public function GetInfosClub($numLicence)
	{
		$sqlInfosClub = "SELECT NOM_CLUB, VILLE, CP, RUE FROM CLUBS AS C, ADHERENTS AS A WHERE C.NUM_CLUB = A.NUM_CLUB AND A.NUMERO_LICENCE = '$numLicence';";
		$result = PDOFredi::$myPDO->query($sqlInfosClub);
		$ligne = $result->fetch();
		$InfosClub['nom'] = $ligne['NOM_CLUB'];
		$InfosClub['ville'] = $ligne['VILLE'];
		$InfosClub['cp'] = $ligne['CP'];
		$InfosClub['rue'] = $ligne['RUE'];
		return $InfosClub;
	}
	
	/**
	* Fonction publique qui permet de récupérer le nombre de demandes effectuées pour un demandeur
	* @param $mail : mail du demandeur
	* @return $count : nombre de demandes effectuées
	*/
	public function GetNbDemandes($mail)
	{
		$sqlNbDemandesFrais = "SELECT DISTINCT COUNT(*) FROM lignes_frais WHERE ADRESSE_MAIL = '$mail';";
		$res = PDOFredi::$myPDO->query($sqlNbDemandesFrais);
		$count = $res->fetchColumn();
		return $count;
	}
	
	/**
	* Fonction publique qui permet de récupérer le nombre de demandes validées pour un demandeur
	* @param $mail : mail du demandeur
	* @return $count : nombre de demandes effectuées
	*/
	public function GetNbDemandesValid($mail)
	{
		$sqlNbDemandesFrais = "SELECT DISTINCT COUNT(*) FROM lignes_frais WHERE ADRESSE_MAIL = '$mail' AND LIGNEVALIDE = 1;";
		$res = PDOFredi::$myPDO->query($sqlNbDemandesFrais);
		$count = $res->fetchColumn();
		return $count;
	}
	
	/**
	* Fonction publique qui permet de récupérer les informations des demandes de frais pour un demandeur
	* @param $mail : mail du demandeur
	* @return $lesLignes : liste avec les informations des demandes de frais
	*/
	public function GetDemandes($mail)
	{
		$sqlDemandesFrais = "SELECT * FROM lignes_frais WHERE ADRESSE_MAIL = '$mail';";
		$res = PDOFredi::$myPDO->query($sqlDemandesFrais);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	/**
	* Fonction publique qui permet de récupérer les informations des clubs en fonction du mail
	* @param $mail : mail du demandeur
	* @return $lesLignes : liste avec les informations des clubs
	*/
	public function ListDesClub($mail)
	{
		$sqlClub = "SELECT DISTINCT c.NUM_CLUB, c.nom_club FROM CLUBS c, adherents a, DEMANDEURS d, LIEN l WHERE c.num_club = a.num_club and l.NUMERO_LICENCE = a.NUMERO_LICENCE and d.ADRESSE_MAIL = l.ADRESSE_MAIL and d.ADRESSE_MAIL = '$mail'";
		$res = PDOFredi::$myPDO->query($sqlClub);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	/**
	* Fonction publique qui permet de récupérer les adhérents liés à un demandeur en fonction du mail
	* @param $mail : mail du demandeur
	* @return $lesLignes : liste avec les informations sur les adhérents
	*/
	public function Representant($mail)
	{
		$sqlRepresentant = "SELECT a.NUMERO_LICENCE, a.NOM, a.PRENOM, a.NUM_CLUB FROM adherents a, lien l where a.NUMERO_LICENCE = l.NUMERO_LICENCE and l.ADRESSE_MAIL = '$mail'";
		$res = PDOFredi::$myPDO->query($sqlRepresentant);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	/**
	* Fonction publique qui permet de récupérer les motifs des lignes de frais
	* @return $lesLignes : liste avec les motifs
	*/
	public function Motifs()
	{
		$sqlMotif = "SELECT * FROM motifs";
		$res = PDOFredi::$myPDO->query($sqlMotif);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}
	
	/**
	* Fonction publique qui permet d'ajouter des demandes de frais de remboursement
	* @param $mail : mail du demandeur
	* @param $dateF : date de création de la demande
	* @param $motif : motif de la demande
	* @param $trajet : ville départ et destination
	* @param $km : nombre de km parcourus
	* @param $coutP : cout des peages
	* @param $coutR : cout des repas
	* @param $coutH : cout des hebergements
	* @param $num_club : numéro du club
	*/
	public function AjoutLigne($mail, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $num_club)
	{
		$sqlAjoutLigne = "INSERT INTO LIGNES_FRAIS VALUES('$mail', '$dateF', $motif, '$trajet', $km, $coutP, $coutR, $coutH, 0, 0, 0, 0, 0, $num_club);";
		$res = PDOFredi::$myPDO->exec($sqlAjoutLigne);
	}
	
	/**
	* Fonction publique qui permet de modifier des demandes de frais de remboursement
	* @param $mail : mail du demandeur
	* @param $dateF : date de création de la demande
	* @param $motif : motif de la demande
	* @param $trajet : ville départ et destination
	* @param $km : nombre de km parcourus
	* @param $coutP : cout des peages
	* @param $coutR : cout des repas
	* @param $coutH : cout des hebergements
	* @param $num_club : numéro du club
	*/
	public function ModifierLigne($mail, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $num_club)
	{
		$SqlModifierLigne = "UPDATE LIGNES_FRAIS SET DATE_FRAIS = '$dateF', ID_MOTIF = '$motif', TRAJET = '$trajet', KM = '$km', COUT_PEAGE = '$coutP', COUT_REPAS = '$coutR', COUT_HEBERGEMENT = '$coutH', NUM_CLUB = '$num_club' WHERE ADRESSE_MAIL = '$mail';";		
		$res = PDOFredi::$myPDO->exec($SqlModifierLigne);
	}
	
	/**
	* Fonction publique qui permet de supprimer des demandes de frais de remboursement en fonction du mail et de la date
	* @param $mail : mail du demandeur
	* @param $date : date de création de la demande
	*/
	public function SupprimerDemande($mail,$date)
	{
		$sqlSupprimerDemande = "DELETE FROM LIGNES_FRAIS WHERE ADRESSE_MAIL = '$mail' AND DATE_FRAIS = '$date';";
		$res = PDOFredi::$myPDO->exec($sqlSupprimerDemande);
	}
	
	/**
	* Fonction publique qui permet de récupérer les informations sur les demandes de frais de remboursement
	* @param $mail : mail du demandeur
	* @param $date : date de création de la demande
	* @return $InfosDemande : liste avec les informations des demandes de frais
	*/
	public function GetInformationsDemande($mail,$date)
	{
		$sqlInformationsDemande = "SELECT * FROM LIGNES_FRAIS WHERE ADRESSE_MAIL = '$mail' AND DATE_FRAIS = '$date';";
		$res = PDOFredi::$myPDO->query($sqlInformationsDemande);
		$ligne = $res->fetch();
		$InfosDemande['DateFrais'] = $ligne['DATE_FRAIS'];
		$InfosDemande['Motif'] = $ligne['ID_MOTIF'];
		$InfosDemande['Trajet'] = $ligne['TRAJET'];
		$InfosDemande['Km'] = $ligne['KM'];
		$InfosDemande['CoutPeage'] = $ligne['COUT_PEAGE'];
		$InfosDemande['CoutRepas'] = $ligne['COUT_REPAS'];
		$InfosDemande['CoutHebergement'] = $ligne['COUT_HEBERGEMENT'];
		return $InfosDemande;
	}
}
