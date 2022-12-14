<?php
$filePath = "./myfiles/mygoals.json";
if (file_exists($filePath)) {
	// load json
	$json = fopen($filePath, "r");
	$goals = fread($json, filesize($filePath));
	$goals = json_decode($goals, true);
	fclose($json);
	// display goals in table
	echo "
	<table>
	<thead>
	<tr>
	<th>Goal</th>
	<th>Achieved</th>
	</tr>
	</thead>
	<tbody>
	";
	foreach ($goals as $goal) {
		echo "
		<tr>
		<td>{$goal["goal"]}</td>
		<td>{$goal["achiev"]}</td>
		</tr>
		";
	}
	echo "
	</table>";
} else {
	echo ("no goals listed");
}
?>