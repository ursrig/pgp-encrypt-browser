<h1>pgp-encrypt-browser</h1>
<p>Encrypt/store data on server, and decrypt in browser with private key via Mailvelope API.</p>

Load jQuery, required by Mailvelope's API
<script
src="https://code.jquery.com/jquery-3.7.0.js"
integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
crossorigin="anonymous"></script>

Style the Mailvelope containers that display the decrypted information in a way that the browser can't access (iframe).
<style>
.mailvelope_string > iframe{height:120px!important; }
</style>

<?php
//encrypt a string using a public key
//data is ideally stored already pgp-encrypted in the database, but for the sake of this exmaple, data can be encrypted on-the-fly.
function end_to_end_encrypt_string($string){
	//Source: https://www.php.net/manual/en/function.gnupg-encrypt.php#81229
	putenv("GNUPGHOME=/tmp");
	//replace this key with your mailvelope public key.
	$pubkey = "
	-----BEGIN PGP PUBLIC KEY BLOCK-----
	Version: Mailvelope v5.1.0
	Comment: https://mailvelope.com
	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
	=s8HP
	-----END PGP PUBLIC KEY BLOCK-----";
	$res = gnupg_init();
	$rtv = gnupg_import($res, $pubkey);
	$rtv = gnupg_addencryptkey($res, $rtv["fingerprint"]);
	$enc = gnupg_encrypt($res, $string);
	return rtrim( $enc);
}

//creates the html/js that transmits the encrypted string to the browser. 
function render_encrypted_string($string){
	$GLOBALS['string_id'] += 1; //create a unique string id for JS and Mailvelope Iframes.
	echo "<script>
	window.addEventListener('mailvelope', function() {
		var armored = `" . end_to_end_encrypt_string($string) . "`;
		window.mailvelope.createDisplayContainer('#mailvelope_string_id_" . $GLOBALS['string_id'] . "', armored );
	}, false);
	</script>";
	echo "<div class='mailvelope_string' id='mailvelope_string_id_" . $GLOBALS['string_id'] . "'></div>";

}

//finally, render some encrypted strings for mailvelope to decrypt in browser
render_encrypted_string("test 1");
render_encrypted_string("test 2");
render_encrypted_string("test 3");

?>


