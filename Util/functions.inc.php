<?php
	/* Fonction qui compare le mot de passe que le demandeur a saisi et le mot de passe lié à l'identifiant dans la base de donnée. */
	/* @return Vrai si les mots de passe sont identiques. */
	/* @return Faux si les mots de passe ne sont pas identiques. */
	function VerifPassword($Password,$DBPassword)
	{
		if ($Password == $DBPassword) 
		{ return true; }
		else
		{ return false; }
	}
?>