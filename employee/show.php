<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

$id = $_GET['show'];

$select = "SELECT employee.id, employee.name, employee.email, employee.salary, department.name dept FROM employee
LEFT JOIN department ON employee.deptId = $id";

$data=mysqli_query($connication, $select);
$row=mysqli_fetch_assoc($data);


?>

<div class="card mx-auto mt-5" style="width: fit-content;">
  <div class="card-header">
    <?= $row['name'] ?>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Email : <?= $row['email'] ?></li>
    <li class="list-group-item">Department : <?= $row['dept'] ?></li>
    <li class="list-group-item">Salary : <?= $row['salary'] ?></li>
  </ul>
</div>

<?php include '../shared/footer.php'; ?>