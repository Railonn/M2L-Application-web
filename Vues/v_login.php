<!doctype html>
<html lang="fr">
   <head>
      <?php include("header.php"); ?>
      <title>M2L - Authentification</title>
   </head>
   <body>
      <!-- Après avoir cliquer sur le bouton "Se connecter", exécute le code du case $action = "seConnecter" qui permet de vérifier si les identifiants saisis sont correct(s). !-->
      <form class="col-sm-12" method="post" action="index.php?uc=identification&action=seConnecter">
         <div class="row justify-content-md-center">
            <div id="login_card" class="card text-white bg-dark col-sm-8 col-md-4">
               <div class="card-header text-center">Panel de connexion</div>

               <div class="form-group">
                  <label for="mail"> E-mail : </label>
                  <input type="text" class="form-control" placeholder="E-mail" name="mail" id="mail" required>
               </div>

               <div class="form-group">
                  <label for="password_user"> Mot de passe : </label>
                  <input type="password" class="form-control" placeholder="Mot de passe" name="password_user" id="password_user" required>
               </div>

               <button class="btn btn-info btn-block" type="submit">Se connecter</button>
      </form>

      <!-- Bloc qui permet d'afficher un/des message(s) d'erreur(s) en fonction de la valeur d'une/des variable(s) de session, puis supprime la/les variable(s) de session. !-->
      <div class="form-group text-center mt-2 mb-0" id="bloc_erreur">
         <?php 
            if((isset($_SESSION['MsgConfirmCompte'])) && ($_SESSION['MsgConfirmCompte']) == "1") { echo "<div class='alert alert-success' role='alert'> Votre compte a bien été créé ! </div>"; unset($_SESSION['MsgConfirmCompte']); }
            if((isset($_SESSION['MsgErreurVide'])) && ($_SESSION['MsgErreurVide']) == "1" ) { echo "<div class='alert alert-danger' role='alert'> Veuillez saisir des identifiants ! </div>"; unset($_SESSION['MsgErreurVide']); } 
            if((isset($_SESSION['MsgErreurIncorrect'])) && ($_SESSION['MsgErreurIncorrect']) == "1" ) { echo "<div class='alert alert-danger' role='alert'> Identifiants incorrects, veuillez réessayer ! </div>"; unset($_SESSION['MsgErreurIncorrect']); }
         ?>
      </div>

      <div class="form-group text-center" id="bloc_password_forget">
         <a href="index.php?uc=identification&action=voirMdpOublie">Mot de passe oublié ?</a>
      </div>

      <div class="form-group text-center mb-3" id="bloc_others">
         <div class="text-center">Vous n'êtes pas encore inscrit ?
         <a href="index.php?uc=identification&action=voirInscription">Inscrivez-vous !</a>
      </div>

      </div>
      </div>
      </div>
      </div>
   </body>
</html>
