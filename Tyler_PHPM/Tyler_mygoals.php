<?php
// set goals
$goals = array(
	array("goal" => "study python", "achiev" => "true"),
	array("goal" => "study php", "achiev" => "true"),
	array("goal" => "study javascript", "achiev" => "true"),
	array("goal" => "study html", "achiev" => "true"),
	array("goal" => "study css", "achiev" => "true"),
	array("goal" => "study go", "achiev" => "false"),
);

// load json
$filePath = "./myfiles/mygoals.json";
$json = fopen($filePath, "w");
fwrite($json, json_encode($goals));
fclose($json);

?>