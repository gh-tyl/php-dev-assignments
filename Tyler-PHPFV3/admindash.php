<?php
include('./pages/header.php');
include('./services/dbservices.php');
?>
<?php
// get all employees from db
$db = new dbServices($dbConfig[0], $dbConfig[1], $dbConfig[2], $dbConfig[3]);
$db->dbConnect();
// $empInfo = $empInfo->fetch_assoc();
$QUERY = "SELECT * FROM emp_tb e, hire_tb h, position_tb p, dep_tr d, dep_tb de WHERE e.eid = h.eid AND h.pid = p.pid AND h.contract_id = d.contract_id AND d.did = de.did";
$empInfo = $db->customQuery($QUERY);
$db->closeDb();

function calc($salary, $married, $child_num)
{
    $payable = $salary;
    if ($married == 'yes') {
        $payable += $payable * 0.05;
    }
    if ($child_num > 2) {
        $payable += ($child_num - 2) * 60;
    }
    return $payable;
}
?>
<div class="row justify-content-center align-items-start g-2 mt-3">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped-columns
            table-hover	
            table-borderless
            table-primary
            align-middle">
                <thead class="table-light">
                    <caption>Employee details</caption>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Employee Email</th>
                        <th>Married</th>
                        <th>Child#</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Contract (from-to)</th>
                        <th>Base Salary</th>
                        <th>Payable Salary</th>
                    </tr>
                </thead>
                <!-- foreach data -->
                <tbody class="table-group-divider">
                    <?php
                    while ($row = $empInfo->fetch_assoc()) {
                        echo ("<tr class='table-primary'>");
                        echo ("<td scope='row'>" . $row['eid'] . "</td>");
                        echo ("<td>" . $row['fname'] . " " . $row['lname'] . "</td>");
                        echo ("<td>" . $row['email'] . "</td>");
                        echo ("<td>" . $row['married'] . "</td>");
                        echo ("<td>" . $row['child_num'] . "</td>");
                        echo ("<td>" . $row['p_name'] . "</td>");
                        echo ("<td>" . $row['d_name'] . "</td>");
                        echo ("<td>" . $row['sDate'] . " - " . $row['eDate'] . "</td>");
                        echo ("<td>" . $row['p_salary'] . "</td>");
                        echo ("<td>" . calc($row['p_salary'], $row['married'], $row['child_num']) . "</td>");
                        echo ("</tr>");
                    }
                    ?>
                    <!-- <tr class="table-primary">
                        <td scope="row">20220475</td>
                        <td>Douglas Leneham</td>
                        <td>dlenehamd6@thetimes.co.uk</td>
                        <td>Yes</td>
                        <td>9</td>
                        <td>Associate Professor</td>
                        <td>Legal</td>
                        <td>2018-06-20 - 2035-03-09</td>
                        <td>CAD$ 4283.28</td>
                        <td>CAD$ calculated</td>
                    </tr> -->

                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>

    </div>
</div>
<?php include './pages/footer.php'; ?>