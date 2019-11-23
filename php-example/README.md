# nfinic PHP examples
en - This repository contains templates of nfinic usage in PHP

Placez ces fichiers selon la structure de votre site web, neeanmoins n'oubliez pas 
d'avoir le dossier `nfinic-auth` qui est le dossier permettant de securiser la requete
a partir de votre sit vers `nf-nc.com`.

Voici une procedure basique d'utlisateur de nfinic selon les fichiers dans ce dossier:

### Page de connexion
Vous pouvez copier le code code se trouvant dans index.php:
`	
	require_once "nfinic-auth/init.php";
	$authentification = new nfinicAuth("https://nf-nc.com/login/?t=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx","XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
	$lien = $authentification -> obtenirLienAuSite();
	echo '<a href="'.$lien.'" style="text-decoration:none;background:white;color:white;font-size:20px;font-family:;background:#205560;border:1px solid #205560;padding:10px;margin:10px;margin-top:20px;margin-bottom:20px;border-radius:5px;"><img style="height:30px;position:relative;top:7px" src="https://nfinic.com/logo.white.transparent.png"/> | Connexion avec nfinic</a>';
`
Le lien n'est valide que s'il est genere de cette facon.

### Page de reception des donnees
Apres traitement des donnees par nfinic(authentification de l'utilisateur) certaines donnees 
dont votre systeme a besoin de enregistrer ou connecter l'utilisateur seront envoyees notamment 
probablement une adresse email, les noms, un ID nfinic, ....

Pour les recevoir, utilisez le code se trouvant dans `data-receiver.php` qui illustre cela.
Les differentes cles ou token viennent de votre dashboard.

Notes : 
- Lorsque vous implementez ceci soyez sur d'avoir gere la clef primaire de votre systeme.
C'est a dire, si vers la ligne 25 vous effectuez simplement un enregistrement dans votre base 
des donnees, vous pourriez avoir des doublons. Il faut d'abord verifier si l'ID existait deja,
par exemple c'est l'adresse email votre donnee primaire, verifiez que l'utilisateur ayant cette 
adresse email existe avant de l'enregistrer. S'il existe, il faudra simplement le connecter.
- En cas d'utilisation d'une session, veuillez ne pas commenter les lignes `21` et `22` de `data-receiver.php`
de peur de ne pas perdre la session lors du transfert des donnees a partir de nfinic.

### La redirection apres connexion

Apres la connexion, vous pouvez demander a nfinic d'effectuer une redirection. nfinic vous 
se redirigera vers votre fichier redirection qui a son tour redirige l'utilisateur vers la page 
appropriee apres connexion
