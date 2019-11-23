<?php
	//Code du bouton a placer sur la page d'accueil

	require_once "nfinic-auth/init.php";
	$authentification = new nfinicAuth("https://nf-nc.com/login/?t=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx","XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
	$lien = $authentification -> obtenirLienAuSite();
	
	
	//Ce bouton est a placer sur votre page de connexion
	echo '<a href="'.$lien.'" style="text-decoration:none;background:white;color:white;font-size:20px;font-family:;background:#205560;border:1px solid #205560;padding:10px;margin:10px;margin-top:20px;margin-bottom:20px;border-radius:5px;"><img style="height:30px;position:relative;top:7px" src="https://nfinic.com/logo.white.transparent.png"/> | Connexion avec nfinic</a>';