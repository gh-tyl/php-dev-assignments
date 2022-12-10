<?php include './pages/header.php'; ?>
<?php
?>
<div class="row justify-content-center align-items-center g-2">
	<div class="col-5">
		<?php
        $courses = array('Select one', 'HTML', 'CSS', 'JavaScript', 'JavaScript Advance', 'PHP', 'CMS');
        ?>
		<!-- <form method="POST" action="<?php echo $baseName . 'teacher.php'; ?>"> -->
		<form method="GET" action="<?php echo $baseName . 'teacher.php'; ?>">
			<div class="mb-3">
				<select class="form-select form-select-lg" name="course" onchange="this.form.submit()">
					<?php
                    foreach ($courses as $course) {
	                    if ($course == 'Select one') {
		                    echo "<option value='$course' selected disabled>$course</option>";
	                    } elseif (isset($_GET['course']) && $_GET['course'] == $course) {
		                    echo "<option value='$course' selected>$course</option>";
	                    } else {
		                    echo "<option value='$course'>$course</option>";
	                    }
                    }
                    ?>
				</select>
			</div>
			<div class="mb-3">
				<?php
                if (isset($_GET['course'])) {
	                if (is_file("./data/courses/" . $_GET['course'] . "/students.json")) {
		                $studentData = file_get_contents("./data/courses/" . $_GET['course'] . "/students.json");
		                $studentArray = json_decode($studentData, true);
	                }
                }
                ?>
				<select class="form-select form-select-lg" name="stID" onchange="this.form.submit()">
					<?php
                    echo "<option value='' selected disabled>Select one</option>";
                    foreach ($studentArray as $student) {
	                    $stId = $student['stID'];
	                    if (isset($_GET['stID']) && $_GET['stID'] == $stId) {
		                    echo "<option value='$stId' selected>$stId</option>";
	                    } else {
		                    echo "<option value='$stId'>$stId</option>";
	                    }
                    }
                    ?>
				</select>
			</div>
		</form>
		<form method="POST" action="<?php echo $baseName . 'regMark.php'; ?>">
			<div class="mb-3">
				<input type="text" name="course" value="<?php
                if (isset($_GET['course'])) {
	                echo ($_GET['course']);
                } else {
	                echo (0);
                }
                ?>" hidden disable>
				<input type="text" name="stID" value="<?php
                if (isset($_GET['stID'])) {
	                echo ($_GET['stID']);
                } else {
	                echo (0);
                }
                ?>" hidden disable>
				<?php
                if (isset($_GET['stID'])) {
	                if (is_file("./data/courses/" . $_GET['course'] . "/students.json")) {
		                foreach ($studentArray as $student) {
			                if ($_GET['stID'] == $student['stID']) {
				                $mark = $student['mark'];
			                }
		                }
		                if (isset($mark)) {
			                echo ('<input disable type="number" class="form-control" name="mark" value="' . $mark . '">');
		                } else {
			                echo ('<input disable type="number" class="form-control" name="mark" value="">');
		                }
	                } else {
		                echo ('<input disable type="number" class="form-control" name="mark" value="">');
	                }
                } else {
	                echo ('<input disable type="number" class="form-control" name="mark" value="">');
                }
                ?>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
<?php include './pages/footer.php'; ?>