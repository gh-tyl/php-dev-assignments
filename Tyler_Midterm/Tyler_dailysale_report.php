<?php
// load json
$filePath = "./data/json/sell_report.json";
$file = fopen($filePath, "r");
$report = fread($file, filesize($filePath));
$report = json_decode($report, true);
fclose($file);
echo "
<table>
	<thead>
		<tr>
			<th>id</th>
			<th>item_name</th>
			<th>Total Price</th>
		</tr>
	</thead>
	<tbody>
";
$sum = 0;
$max = $report[0]["price"] * $report[0]["amount"];
$max_item_name = $report[0]["item_name"];
$min = $max;
$min_item_name = $max_item_name;
foreach ($report as $key => $value) {
	// dispplay data
	echo "
		<tr>
			<td>" . $value["id"] . "</td>
			<td>" . $value["item_name"] . "</td>
			<td>" . $value["price"] * $value["amount"] . "</td>
		</tr>
	";
	// calculate avg, max, min
	$sum += $value["price"] * $value["amount"];
	if ($max < $value["price"] * $value["amount"]) {
		$max = $value["price"] * $value["amount"];
		$max_item_name = $value["item_name"];
	}
	if ($min > $value["price"] * $value["amount"]) {
		$min = $value["price"] * $value["amount"];
		$min_item_name = $value["item_name"];
	}
}
$avg = $sum / count($report);
echo "
	</tbody>
	<tfoot>
		<tr>
			<td>Average</td>
			<td></td>
			<td>$avg</td>
		</tr>
		<tr>
			<td>Max</td>
			<td>$max_item_name</td>
			<td>$max</td>
		</tr>
		<tr>
			<td>Min</td>
			<td>$min_item_name</td>
			<td>$min</td>
		</tr>
	</tfoot>
<table>
";
?>