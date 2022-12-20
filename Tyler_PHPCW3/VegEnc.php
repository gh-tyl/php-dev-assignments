<?php
// Encrypt by vigenere rule using ASCII code's table
function encrypt($str, $key)
{
	// $asciiLen = 256;
	$strLen = strlen($str);
	$keyLen = strlen($key);
	$result = "";
	for ($i = 0; $i < $strLen; $i++) {
		$result .= chr((ord($str[$i]) + ord($key[$i % $keyLen])));
	}
	return $result;
}
?>
<?php
// save
function saveEncryptText($str)
{
	$myfile = fopen("./data/keyword.txt", "w") or die("Unable to open file!");
	fwrite($myfile, $str);
	fclose($myfile);
}
if (isset($_POST['submit'])) {
	$str = $_POST['str'];
	$key = $_POST['key'];
	$result = encrypt($str, $key);
	saveEncryptText($result);
}
?>
<!-- form -->
<?php
echo "<h1>Encrypt</h1>";
echo "<form action='VegEnc.php' method='post'>";
echo "<input type='text' name='str' placeholder='Enter a string'>";
echo "<input type='text' name='key' placeholder='Enter a key'>";
echo "<input type='submit' name='submit' value='Encrypt'>";
echo "</form><br>";
?>
<?php
if (isset($_POST['submit'])) {
	echo "<a href='./data/keyword.txt' download>Download</a><br>";
}
// path to VegDec.php
echo "<br><a href='VegDec.php'>Decrypt</a><br>";
?>