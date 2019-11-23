
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
		//Ce site a demande noms, sexe et biographie de l'utilisation.
		if(!empty($_POST['noms']) && !empty($_POST['sexe']) && !empty($_POST['bio'])){

			//Si vous utilisez une session, veuillez laisser ces lignes.
			session_start();
			session_id($__h['ksess']);


			
			//Votre code ici...
			
			
			echo json_encode(array('etat' => 'ok'));//Si la connexion s'est passee avec succes!
		}

	}
