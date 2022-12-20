<?php
$filePath = './EmpData.txt';
if (file_exists($filePath)) {
	// get data from file
	$data = file_get_contents($filePath);
	// convert data to array
	$data = json_decode($data, true);
	// print_r($data);
} else {
	echo ("File not found");
	// finish the script
	exit();
}
?>

<!doctype html>
<html lang="en">

<head>
	<title>Title</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.2.1 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
	<header>
		<!-- place navbar here -->
	</header>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1>Employee List</h1>
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Full Name</th>
								<th scope="col">Position</th>
								<th scope="col">Department</th>
								<th scope="col">Base Salary</th>
								<th scope="col">Marriage Status</th>
								<th scope="col">Final Salary</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $key => $value):
	                            $value = json_decode($value, true);
                            ?>
							<tr>
								<td>
									<?php echo $value['fname'] . " " . $value['lname']; ?>
								</td>
								<td>
									<?php echo $value['position']; ?>
								</td>
								<td>
									<?php echo $value['department']; ?>
								</td>
								<td>
									<?php echo $value['salary']; ?>
								</td>
								<td>
									<?php echo $value['marriage']; ?>
								</td>
								<td>
									<?php echo $value['finalSalary']; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<td scope="col" colspan="5">Average salary</td>
								<td scope="col">
									<?php
                                    $avgSalary = 0;
                                    $sum = 0;
                                    foreach ($data as $key => $value) {
	                                    $value = json_decode($value, true);
	                                    $sum += $value['finalSalary'];
                                    }
                                    $avgSalary = $sum / count($data);
                                    echo $avgSalary;
                                    ?>
								</td>
							</tr>
							<tr>
								<!-- show fullname who is above the average -->
								<td scope="col" colspan="5">Fullname who is above the average</td>
								<td scope="col">
									<?php
                                    foreach ($data as $key => $value) {
	                                    $value = json_decode($value, true);
	                                    if ($value['finalSalary'] >= $avgSalary) {
		                                    echo $value['fname'] . " " . $value['lname'] . "<br>";
	                                    }
                                    }
                                    ?>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</main>
	<footer>
		<!-- place footer here -->
	</footer>
	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
		integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
		integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
		</script>
</body>

</html>