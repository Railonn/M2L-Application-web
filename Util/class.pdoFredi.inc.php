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
    		PDOFredi::$myPDO = new PDO('mysql:host=127.0.0.1;dbname=fredi', 'root', ''); 
    		// 172.16.106.4
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

	// Permet de mettre à jours les informations du demandeur
	public function ModifierProfilDemandeur($nom,$prenom,$nouveauMail,$adresse,$cp,$password,$ville,$mailActuel)
	{
		$sqlNewProfil = "UPDATE DEMANDEURS SET ADRESSE_MAIL = '$nouveauMail', NOM = '$nom', PRENOM = '$prenom', RUE = '$adresse', CP = '$cp', VILLE = '$ville', PASSWORD = '$password' WHERE ADRESSE_MAIL = '$mailActuel';";		
		$result = PDOFredi::$myPDO->exec($sqlNewProfil);
		echo $sqlNewProfil;
		echo $result;
	}

	// Permet de supprimer un lien entre un numéro de licence et un demandeur
	public function SupprimerLien($licence,$mailDemandeur)
	{
		$sqlSupprimerLien = "DELETE FROM LIEN WHERE NUMERO_LICENCE = '$licence' AND ADRESSE_MAIL = '$mailDemandeur';";
		$result = PDOFredi::$myPDO->exec($sqlSupprimerLien);
	}

	// Permet de récupérer les informations du CLUB en fonction du numéro de Licence
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

	// Permet de récupérer le nombre de demandes effectuées pour un demandeur de licence
	public function GetNbDemandes($mail)
	{
		$sqlNbDemandesFrais = "SELECT DISTINCT COUNT(*) FROM lignes_frais WHERE ADRESSE_MAIL = '$mail';";
		$res = PDOFredi::$myPDO->query($sqlNbDemandesFrais);
		$count = $res->fetchColumn();
		return $count;
	}

	// Permet de récupérer le nombre de demandes validées pour un demandeur de licence
	public function GetNbDemandesValid($mail)
	{
		$sqlNbDemandesFrais = "SELECT DISTINCT COUNT(*) FROM lignes_frais WHERE ADRESSE_MAIL = '$mail' AND LIGNEVALIDE = 1;";
		$res = PDOFredi::$myPDO->query($sqlNbDemandesFrais);
		$count = $res->fetchColumn();
		return $count;
	}

	// Permet de récupérer les informations des demandes de frais pour un demandeur
	public function GetDemandes($mail)
	{
		$sqlDemandesFrais = "SELECT * FROM lignes_frais WHERE ADRESSE_MAIL = '$mail';";
		$res = PDOFredi::$myPDO->query($sqlDemandesFrais);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function ListDesClub($mail)
	{
		$sqlClub = "SELECT DISTINCT c.NUM_CLUB, c.nom_club FROM clubs c, adherents a, demandeurs d, lien l where c.num_club = a.num_club and l.NUMERO_LICENCE = a.NUMERO_LICENCE and d.ADRESSE_MAIL = l.ADRESSE_MAIL and d.ADRESSE_MAIL = '$mail'";
		$res = PDOFredi::$myPDO->query($sqlClub);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	}

	public function Representant($mail)
	{
		$sqlRepresentant = "SELECT a.NUMERO_LICENCE, a.NOM, a.PRENOM, a.NUM_CLUB FROM adherents a, lien l where a.NUMERO_LICENCE = l.NUMERO_LICENCE and l.ADRESSE_MAIL = '$mail'";
		$res = PDOFredi::$myPDO->query($sqlRepresentant);
		$lesLignes = $res->fetchAll();

		return $lesLignes;
	}

	public function Motifs()
	{
		$sqlMotif = "SELECT * FROM motifs";
		$res = PDOFredi::$myPDO->query($sqlMotif);
		$lesLignes = $res->fetchAll();

		return $lesLignes;
	}

	public function AjoutLigne($mail, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $num_club)
	{
		$sqlAjoutLigne = "INSERT INTO LIGNES_FRAIS VALUES('$mail', '$dateF', $motif, '$trajet', $km, $coutP, $coutR, $coutH, 0, 0, 0, 0, 0, $num_club);";
		echo $sqlAjoutLigne;
		$res = PDOFredi::$myPDO->exec($sqlAjoutLigne);
	}

	public function ModifierLigne($mail, $dateActuel, $dateF, $motif, $trajet, $km, $coutP, $coutR, $coutH, $totalL)
	{
		$SqlModifierLigne = "UPDATE LIGNES_FRAIS SET DATE_FRAIS = '$dateF', ID_MOTIF = '$motif', TRAJET = '$trajet', KM = '$km', COUT_PEAGE = '$coutP', COUT_REPAS = '$coutR', COUT_HEBERGEMENT = '$coutH', TOTAL = '$totalL' WHERE ADRESSE_MAIL = '$mail' AND DATE_FRAIS = '$dateActuel';";		
		$res = PDOFredi::$myPDO->exec($SqlModifierLigne);
	}

	public function SupprimerDemande($mail,$date)
	{
		$sqlSupprimerDemande = "DELETE FROM LIGNES_FRAIS WHERE ADRESSE_MAIL = '$mail' AND DATE_FRAIS = '$date';";
		$res = PDOFredi::$myPDO->exec($sqlSupprimerDemande);
		
	}

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
		$InfosDemande['CoutTotal'] = $ligne['TOTAL'];

		return $InfosDemande;
	}
}