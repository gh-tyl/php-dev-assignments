<?php include './pages/header.php'; ?>
<div class="row justify-content-center align-items-center g-2">
	<div class="col-5">
		<?php
        $courses = array('HTML', 'CSS', 'JavaScript', 'JavaScript Advance', 'PHP', 'CMS');
        $studentData = file_get_contents('./data/students/students.json');
        $studentArray = json_decode($studentData, true);
        ?>
		<form method="POST" action="<?php echo $baseName . 'regCourse.php'; ?>">
			<div class="mb-3">

				<select class="form-select form-select-lg" name="course">
					<?php
                    foreach ($courses as $course) {
	                    echo "<option value='$course'>$course</option>";
                    }
                    ?>
				</select>
			</div>
			<div class="mb-3">

				<select class="form-select form-select-lg" name="stID">
					<?php
                    foreach ($studentArray as $student) {
	                    $stId = $student['stID'];
	                    $stName = $student['fname'] . ' ' . $student['lname'];
	                    echo "<option value='$stId'>$stId: $stName</option>";
                    }
                    ?>
				</select>
			</div>
			<button type="submit" class="btn btn-primary">Register</button>
		</form>
	</div>
</div>
<?php include './pages/footer.php'; ?>