<?php

/* 
Program: Vignere style cipher for encrypting text 
Author: Philippe Larocque
Created: 30 September 2019
Revision: 6 December 2019
*/

/* Two inputs for testing */
$text = "The quick brown fox jumps over the lazy dog!";
$key = "Klingon";

/* main encryption function inputs text and key */
function encrypt($t,$k){
	
	/* i used for parsing text, j used for parsing key */
	$j=0;
	$encryptedText = "";

	/* display text and key for testing */
	echo "Your text is: <br>$t<br><br>Your Key is: $k<br><br>";
	
	/* for loop to parse text */
	for ($i=0;$i < strlen($t);$i++){
		
		$temp = ord(substr($t,$i,1)) + ord(substr($k,$j,1)) - 32; //calculate new ascii
		
		/* if new ascii is out of range, loop back */
		if ($temp>126) {
			$temp -= 94;
		}
		
		/* generating new string
		if new ascii is less-than character '<', encode as html '<'
		otherwise encode as normal character */
		if ($temp==60) {
			$encryptedText = $encryptedText . chr($temp - 28);
		} else {
			$encryptedText = $encryptedText . chr($temp);
		}
		
		/* increment j counter and reset if end reached */
		$j++;
		if ($j > strlen($k)-1){
			$j = 0;
		}
	}
	return $encryptedText;
}

/* main decryption function */
function decrypt($t,$k){

	/* i used for parsing text, j used for parsing key */
	$j=0;
	$decryptedText = "";

	/* main loop to parse text */
	for ($i=0;$i < strlen($t);$i++){

		/* if the encoded character was less-than '<', return to its normal state then decrypt
		otherwise, simply decrypt the character */
		if (ord(substr($t,$i,1))==32){
			$temp = ord(substr($t,$i,1)) + 32 - ord(substr($k,$j,1)) + 28;
		} else {
			$temp = ord(substr($t,$i,1)) + 32 - ord(substr($k,$j,1));
		}
		
		/* if the ascii is out of bounds, loop back*/
		if ($temp<32){
			$temp += 94;
		}

		/* build the new string */
		$decryptedText = $decryptedText . chr($temp);
		
		/* increment j counter and reset if end reached */
		$j++;
		if ($j > strlen($k)-1){
			$j = 0;
		}
	}
	return $decryptedText;
}

/* function calls and display for testing */
$encodedText = encrypt($text,$key);
echo "The encoded text is:<br>" . $encodedText . "<br><br>";

$decodedText = decrypt($encodedText,$key);
echo "The decoded text is:<br>" . $decodedText;

?>