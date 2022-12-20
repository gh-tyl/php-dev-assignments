<?php
// path to EmpList.php
$newData = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$position = $_POST['position'];
	$department = $_POST['department'];
	$salary = $_POST['salary'];
	$marriage = $_POST['marriage'];
	$finalSalary = 0;
	if ($marriage == 'single') {
		$finalSalary = $salary;
	} else {
		$finalSalary = $salary + ($salary * 0.1);
	}
	// echo ("First Name: $fname <br>");
	// echo ("Last Name: $lname <br>");
	// echo ("Position: $position <br>");
	// echo ("Department: $department <br>");
	// echo ("Salary: $salary <br>");
	// echo ("Marriage: $marriage <br>");
	$dataPath = './EmpData.txt';
	$dataForJson = array(
		'fname' => $fname,
		'lname' => $lname,
		'position' => $position,
		'department' => $department,
		'salary' => $salary,
		'marriage' => $marriage,
		'finalSalary' => $finalSalary,
	);
	$dataForJson = json_encode($dataForJson);
	echo $dataForJson;
	echo ("<br>");
	if (file_exists($dataPath)) {
		// get data from file
		$oldData = file_get_contents($dataPath);
		// convert data to array
		$oldData = json_decode($oldData, true);
		// add new data to array
		$oldData[] = $dataForJson;
		// convert array to json
		$newData = json_encode($oldData);
		// write data to file
		file_put_contents($dataPath, $newData);
	} else {
		// create new file
		$newData[] = $dataForJson;
		$newData = json_encode($newData);
		file_put_contents($dataPath, $newData);
	}
	// 	$fp = fopen($dataPath, 'w');
	// 	fwrite($fp, $dataForJson);
	// 	fwrite($fp, "\n");
	// 	fclose($fp);
	// }
}
echo ("<script>location.href = 'EmpList.php';</script>");
?>