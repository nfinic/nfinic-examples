
<?php
	/*
	Ce fichier est un modele permettant de connecter votre site a nfinic.
	Il est simple d'utitlisation.Vous devez simplement utilisez les donnees 
	en provenance de nfinic en utilisant les donnees venant de $_POST
	Comme vous l'avez demande lors de l'enregistrement de Test(https://test.com).
	Pour plus d'informations contactez nfinic sur support@nfinic.com ou 
	allez sur votre tableau de bord de nfinic( https://nf-nc.com ).
	*/

	
	$__h = getallheaders();
	$token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
	
	if(!empty($__h) && !empty($__h['nf-token']) && $__h['nf-token'] == $token && !empty($_POST) && !empty($_POST['token'])){
		//Ce site a demande email, noms, sexe et biographie de l'utilisation.
		if(!empty($_POST['email']) && !empty($_POST['noms']) && !empty($_POST['sexe']) && !empty($_POST['bio'])){

			//Si vous utilisez une session, veuillez laisser ces lignes.
			session_start();
			session_id($__h['ksess']);
			
			//Exemple avec votre base des donnees, supposant que vous utilisez PDO
			try{
				$serveurMysql = "127.0.0.1";$nomDeLaBDD = "mabase";$nomUtilisateurBDD = "utilisateur";$motDePasseBDD = "motDePasse";
				$connexionBDD = new PDO("mysql:host=$serveurMysql;dbname=$nomDeLaBDD", $nomUtilisateurBDD, $motDePasseBDD);
				$connexionBDD -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$requeteVerifierUtiisateur = $connexionBDD -> prepare("SELECT id_utilisateur FROM tableUtilisateur WHERE emailutilisateur=?");
				$requeteVerifierUtiisateur -> execute(array($_POST['email']));
				if($requeteVerifierUtiisateur -> fetch()){
					//l'utilisateur existe deja, on place simplement les donnees de l'utilisateur dans la session
					$_SESSION['nomutilisateur'] = $_POST['noms'];
					$_SESSION['connecte'] = true;
					// et ainsi de suite 
					$requeteVerifierUtiisateur -> closeCursor();
				}else{
					//l'utilisateur n'existe pas, on l'enregistre puis on le connecte
					$requeteVerifierUtiisateur -> closeCursor();
					$requeteEnregistrerUtilisateur = $connexionBDD -> prepare("INSERT INTO tableUtilisateur(idUtilisateur,noms,sexe,idnfinic,...) VALUES('',?,?,?,...)");
					$i = $requeteEnregistrerUtilisateur -> execute(array($_POST['email'],$_POST['sexe'],$_POST['idnfinic']));
					if($i > 0){
						$requeteEnregistrerUtilisateur -> closeCursor();
						//Apres enregistrement de l'utilisateur, on peut le connecter par la session
						$_SESSION['nomutilisateur'] = $_POST['noms'];
						$_SESSION['connecte'] = true;
					}
				}
			}catch(Exception $err){
				die("Erreur, impossible de se connecter a la base des donnees a cause de ".$err -> getMessage());
			}
			
			
			
			echo json_encode(array('etat' => 'ok'));//Si la connexion s'est passee avec succes!
		}

	}
