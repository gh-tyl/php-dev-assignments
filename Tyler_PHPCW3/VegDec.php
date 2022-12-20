<?php
// decrypt a string by vigenere rule
function decrypt($str, $key)
{
	$keyLen = strlen($key);
	$strLen = strlen($str);
	$result = "";
	for ($i = 0; $i < $strLen; $i++) {
		$result .= chr((ord($str[$i]) - ord($key[$i % $keyLen]) + 256) % 256 + ord(''));
		// echo ("str: " . $str[$i] . " key: " . $key[$i % $keyLen] . " result: " . $result[$i] . "<br>");
	}
	return $result;
}
?>
<!-- form -->
<?php
echo "<h1>Decrypt</h1>";
echo "<form action='VegDec.php' method='post' enctype='multipart/form-data'>";
// upload file
echo "<input type='file' name='file' placeholder='Upload a file'>";
echo "<input type='text' name='key' placeholder='Enter a key'>";
echo "<input type='submit' name='submit' value='Decrypt'>";
echo "</form><br>";

if (isset($_POST['submit'])) {
	$key = $_POST['key'];
	// upload file
	$file = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	$allowed = array('txt');
	if (in_array($fileActualExt, $allowed)) {
		if ($fileError === 0) {
			if ($fileSize < 1000000) {
				$str = file_get_contents($fileTmpName);
				// decrypt
				$result = decrypt($str, $key);
				echo "Result: " . $result . "<br>";
			} else {
				echo "Your file is too big!";
			}
		} else {
			echo "There was an error uploading your file!";
		}
	} else {
		echo "You cannot upload files of this type!";
	}
	echo "<br>";
}
?>
<?php
// path to VegEnc.php
echo "<br><a href='VegEnc.php'>Encrypt</a>";
?>