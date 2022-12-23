<?php
include("./config.php");
include("./services/dbservices.php");
include("./services/jsonService.php");
?>
<?php
$db = new dbServices($dbConfig[0], $dbConfig[1], $dbConfig[2], $dbConfig[3]);
$db->dbConnect();
// emp_tb
$empData = new jsonService("./data/empList.json");
$empData = $empData->jsontoArray();
foreach ($empData as $key => $value) {
	// hash password
	$value['pass'] = password_hash($value['pass'], PASSWORD_DEFAULT);
	if ($value['married'] == 1) {
		$value['married'] = 1;
	} else {
		$value['married'] = 0;
	}
	// insert into database
	$fieldArray = array('eid', 'fname', 'lname', 'email', 'pass', 'married', 'child_num');
	$strTypeArray = array('int', 'str', 'str', 'str', 'str', 'int', 'int');
	$db->insert('emp_tb', $value, $strTypeArray, $fieldArray);
}

// position_tb
$positionData = new jsonService("./data/positions.json");
$positionData = $positionData->jsontoArray();
foreach ($positionData as $key => $value) {
	// insert into database
	$fieldArray = array('pid', 'p_name', 'p_salary');
	$strTypeArray = array('int', 'str', 'int');
	$db->insert('position_tb', $value, $strTypeArray, $fieldArray);
}

// dep_tb
$depData = new jsonService("./data/departments.json");
$depData = $depData->jsontoArray();
foreach ($depData as $key => $value) {
	// insert into database
	$fieldArray = array('did', 'd_name', 'p_phone');
	$strTypeArray = array('int', 'str', 'str');
	$db->insert('dep_tb', $value, $strTypeArray, $fieldArray);
}

// hire_tb
$hireData = new jsonService("./data/contractList.json");
$hireData = $hireData->jsontoArray();
foreach ($hireData as $key => $value) {
	// insert into database
	$fieldArray = array('contract_id', 'eid', 'pid', 'sDate', 'eDate');
	$strTypeArray = array('int', 'int', 'int', 'str', 'str');
	$db->insert('hire_tb', $value, $strTypeArray, $fieldArray);
}

// dep_tr
$depTrData = new jsonService("./data/deptrList.json");
$depTrData = $depTrData->jsontoArray();
foreach ($depTrData as $key => $value) {
	// insert into database
	$fieldArray = array('deptrid', 'contract_id', 'did');
	$strTypeArray = array('int', 'int', 'int');
	$db->insert('dep_tr', $value, $strTypeArray, $fieldArray);
}

$db->closeDb();
?>