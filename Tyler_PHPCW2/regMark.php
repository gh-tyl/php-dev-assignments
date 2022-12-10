<?php include './data/config.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$course = $_POST['course'];
	$stID = $_POST['stID'];
	$stMark = $_POST['mark'];

	$stData = file_get_contents('./data/courses/' . $course . '/students.json');
	$stArray = json_decode($stData, true);
	foreach ($stArray as $key => $st) {
		if ($st['stID'] == $stID) {
			$stArray[$key]['mark'] = $stMark;
		}
	}
	$stJson = json_encode($stArray);
	file_put_contents('./data/courses/' . $course . '/students.json', $stJson);
	header("Location: " . $baseName . 'teacher.php');
	exit();
}
?>