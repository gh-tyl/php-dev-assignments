<?php include './data/config.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$course = $_POST['course'];
	$stID = $_POST['stID'];
	$stMark = 0;
	// create folder if not exist
	if (!file_exists('./data/courses/')) {
		mkdir('./data/courses/');
	}
	if (!file_exists('./data/courses/' . $course)) {
		mkdir('./data/courses/' . $course);
	}
	function sameStu($stID, $stArray)
	{
		foreach ($stArray as $st) {
			if ($st['stID'] == $stID) {
				return true;
			}
		}
		return false;
	}
	// create file if not exist
	if (!file_exists('./data/courses/' . $course . '/students.json')) {
		$stArray = array();
		$stArray[] = array(
			'stID' => $stID,
			'mark' => $stMark
		);
		$stJson = json_encode($stArray);
		file_put_contents('./data/courses/' . $course . '/students.json', $stJson);
	} else {
		$stData = file_get_contents('./data/courses/' . $course . '/students.json');
		$stArray = json_decode($stData, true);
		if (sameStu($stID, $stArray)) {
			header("Location: " . $baseName . 'admin.php?msg=1');
			exit();
		}
		$stArray[] = array(
			'stID' => $stID,
			'mark' => $stMark
		);
		$stJson = json_encode($stArray);
		file_put_contents('./data/courses/' . $course . '/students.json', $stJson);
	}
	header("Location: " . $baseName . 'admin.php');
	exit();
}
?>