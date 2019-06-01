<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>M2L - Modification du mot de passe</title>
	<?php include("Vues/header.php"); ?>
</head>

<body>
	<form class="test" method="post" action="index.php?uc=identification&action=MdpOublie">
    	<div class="container">
        	<div class="row justify-content-md-center mt-5">
            	<div id="password_card" class="card text-white bg-dark col-sm-12 col-md-8">
                	<div class="card-header">Modification du mot de passe</div>

                	<div class="card-body text-white">

                		<div class="text mb-3">Veuillez renseigner votre adresse e-mail pour recevoir un nouveau mot de passe.</div>

						<div class="form-group mb-3">
							<label>Adresse e-mail : </label>
							<input type="text" class="form-control" placeholder="Saisir votre adresse e-mail" name="mail" id="mail" required>
						</div>

           				<button class="btn btn-info" type="submit">Valider</button>
           				<button class="btn btn-warning" type="reset">Effacer</button>		

       					<button class="btn btn-danger float-right" type="submit" onclick="window.location.href='index.php'" >Retour</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</body>
</html>