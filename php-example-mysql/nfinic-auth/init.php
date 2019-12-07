<?php
	@session_start();
	class nfinicAuth{
		private $siteID;private $code;
		public function __construct($adresseDeVotreSite,$code){if(!empty($adresseDeVotreSite) && !empty($code)){$this -> siteID = $adresseDeVotreSite;$this -> code = $code;}}
		public function obtenirLienAuSite(){$lien = $siteID;$th = session_id();$e = $this -> change(session_id(),$this -> code);return $this -> siteID . "&s=" . $e;}
		private function change($plaintext, $param) {$method = "AES-256-CBC";$key = hash('sha256', $param, true); $iv = openssl_random_pseudo_bytes(16);$ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);$hash = hash_hmac('sha256', $ciphertext, $key, true);return urlencode(base64_encode($iv . $hash . $ciphertext));}
	}	
	
	