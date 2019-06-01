<?php
session_start();
require_once("Util/functions.inc.php");
require_once("Util/class.pdoFredi.inc.php");

if(!isset($_REQUEST['uc']))
     $uc = 'login';
else
	$uc = $_REQUEST['uc'];

/* Création d'une instance d'accès à la base de données */

$pdo = PDOFredi::getPDOFredi();

switch($uc)
{
	case 'login' :
	{ 
		if((isset($_SESSION['Connexion'])) && ($_SESSION['Connexion'] == 'true'))
			header('location:index.php?uc=gestionDemandeur&action=voirPageDemandeur');
		else
			include("Vues/v_login.php"); 
		break; 
	}
	
	case 'identification' :
	{ include("Controleurs/c_identification.php"); break; }

	case 'gestionDemandeur' :
	{ include("Controleurs/c_gestionDemandeur.php"); break; }
}