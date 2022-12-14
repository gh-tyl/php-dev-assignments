<?php
$places = array(
	"Japan" => array("Tokyo", "Kyoto", "Osaka"),
	"USA" => array("New York", "Los Angeles", "Chicago"),
	"Canada" => array("Toronto", "Montreal", "Vancouver")
);
echo "
<table>
<thead>
<tr>
<th>Country</th>
<th>City</th>
</tr>
</thead>
<tbody>
";
foreach ($places as $country => $cities) {
	foreach ($cities as $city) {
		echo "
		<tr>
		<td>$country</td>
		<td>$city</td>
		</tr>
		";
	}
}
echo "
</tbody>
</table>
";
?>