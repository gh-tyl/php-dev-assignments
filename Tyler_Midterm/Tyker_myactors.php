<?php
$actors = array(
	"Tom Cruise" => "USA",
	"Tom Hanks" => "USA",
	"Suzu Hirose" => "Japan",
	"Nana Komatsu" => "Japan",
	"Kazunari Ninomiya" => "Japan",
);
echo "
<ol>
";
foreach ($actors as $name => $country) {
	echo "
	<li>$name ($country)</li>
	";
}
echo "
</ol>
";
?>