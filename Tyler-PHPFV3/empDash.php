<?php
include('./pages/header.php');
include('./services/dbservices.php');
?>
<?php
// get employee info using email
$email = $_SESSION['email'];
$db = new dbServices($dbConfig[0], $dbConfig[1], $dbConfig[2], $dbConfig[3]);
$db->dbConnect();

$empInfo = $db->select('emp_tb', array('email' => $email));
$empInfo = $empInfo->fetch_assoc();
$eid = $empInfo['eid'];
$fname = $empInfo['fname'];
$lname = $empInfo['lname'];
$married = $empInfo['married'];
$child_num = $empInfo['child_num'];
// using eid get position info
$positionInfo = $db->select('hire_tb', array('eid' => $eid));
$positionInfo = $positionInfo->fetch_assoc();
$contract_id = $positionInfo['contract_id'];
$pid = $positionInfo['pid'];
$sDate = $positionInfo['sDate'];
$eDate = $positionInfo['eDate'];
// using pid get position info
$positionInfo = $db->select('position_tb', array('pid' => $pid));
$positionInfo = $positionInfo->fetch_assoc();
$p_name = $positionInfo['p_name'];
$p_salary = $positionInfo['p_salary'];
// using contract_id get department info
$depInfo = $db->select('dep_tr', array('contract_id' => $contract_id));
$depInfo = $depInfo->fetch_assoc();
$did = $depInfo['did'];
// using did get department info
$depInfo = $db->select('dep_tb', array('did' => $did));
$depInfo = $depInfo->fetch_assoc();
$d_name = $depInfo['d_name'];
$p_phone = $depInfo['p_phone'];
$db->closeDb();

// 5- Considering the empdash.php design, fill the information with the actual information related to the logged in employee. Payable Salary = If the employee is married then 5% should be added to the base Salary. Additionally, if the employee has more than 2 children, for each child add 60$ to the base salary.
$payable = $p_salary;
if ($married == 'yes') {
  $payable += $payable * 0.05;
}
if ($child_num > 2) {
  $payable += ($child_num - 2) * 60;
}
?>

<div class="row justify-content-center align-items-start g-2 mt-3">
  <div class="col">
    <div class="card border-info mb-3">
      <div class="card-header">
        <?php
        echo ("<h5> $fname $lname - $eid </h5>");
        ?>
      </div>
      <div class="card-body">
        <h5 class="card-title">
          <?php
          echo $p_name;
          ?>
        </h5>
        <p class="card-text mt-4">
          <?php
          echo ("<b>Email: </b> $email <br />");
          echo ("<b>Married: </b> $married <br />");
          echo ("<b>Number of Children: </b> $child_num <br />");
          echo ("<b>Department: </b> $d_name <br />");
          echo ("<b>Contract Length: </b> $sDate - $eDate <br />");
          echo ("<b>Base Salary: </b> CAD$ $p_salary <br />");
          echo ("<b>Payable Salary: </b>CAD$ $payable <br />");
          ?>
          <!-- <b>Email: </b> dlenehamd6@thetimes.co.uk <br />
          <b>Married: </b> Yes <br />
          <b>Number of Children: </b> 9 <br />
          <b>Department: </b> Legal <br />
          <b>Contract Length: </b> 2018-06-20 - 2035-03-09 <br />
          <b>Base Salary: </b> CAD$ 4283.28 <br />
          <b>Payable Salary: </b>CAD$ to be calculated <br /> -->
        </p>
      </div>
    </div>
  </div>
</div>
<?php include './pages/footer.php'; ?>