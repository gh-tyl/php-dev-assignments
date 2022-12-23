<?php
include('./pages/header.php');
include('./services/dbservices.php');
?>
<?php
$admin_email = 'tyler.inari@gmail.com';
$admin_pass = 'Tyler';
if (isset($_POST['email']) && isset($_POST['pass'])) {
  $post_email = $_POST['email'];
  $post_pass = $_POST['pass'];
  // $post_email = $admin_email;
  // $post_pass = $admin_pass;
  // $post_email = "tgapper0@opera.com";
  // $post_pass = "jYH6f28tUvGr";
  if ($post_email == $admin_email && $post_pass == $admin_pass) {
    $_SESSION['role'] = "admin";
    $_SESSION['login'] = true;
    header('Location: ./admindash.php');
  } else {
    $db = new dbServices($dbConfig[0], $dbConfig[1], $dbConfig[2], $dbConfig[3]);
    $db->dbConnect();
    $QUERY = "SELECT * FROM emp_tb WHERE email = '$post_email'";
    $empInfo = $db->customQuery($QUERY);
    $empInfo = $empInfo->fetch_assoc();
    if ($empInfo == null) {
      header('Location: ./index.php');
    }
    $db->closeDb();
    $pass = $empInfo['pass'];
    $pass = password_verify($post_pass, $pass);
    if ($pass == true) {
      $_SESSION['role'] = "employees";
      $_SESSION['login'] = true;
      $_SESSION['email'] = $post_email;
      header('Location: ./empDash.php');
    }
  }
}
?>
<div class="row justify-content-center align-items-start g-2 mt-3">
  <div class="col-5">
    <form action="./index.php" method="POST">
      <div class="form-floating mb-3">
        <!-- <input type="email" class="form-control" name="email" placeholder="email" required> -->
        <input type="email" class="form-control" name="email" placeholder="email">
        <label for="email">Email</label>
      </div>
      <div class="form-floating mb-3">
        <!-- <input type="password" class="form-control" name="pass" placeholder="pass" required> -->
        <input type="password" class="form-control" name="pass" placeholder="pass">
        <label for="email">Password</label>
      </div>
      <button type="submit" class="btn btn-outline-success">Login</button>
    </form>
  </div>
</div>
<?php include './pages/footer.php'; ?>