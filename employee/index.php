<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

$select = "SELECT employee.id, employee.name, employee.email, employee.salary, department.name dept FROM employee
LEFT JOIN department ON employee.deptId = department.id";
$dpartment = mysqli_query($connication,  $select);

if (isset($_POST['search'])) {
  $search = $_POST['searchedName'];
  $selectSearch = "SELECT employee.id, employee.name, employee.email, employee.salary, department.name dept FROM employee
  LEFT JOIN department ON employee.deptId = department.id
  WHERE employee.name LIKE concat('%$search%')";
  $dpartment = mysqli_query($connication,  $selectSearch);
}

if (isset($_POST['reset'])) {
  $select = "SELECT employee.id, employee.name, employee.email, employee.salary, department.name dept FROM employee
  LEFT JOIN department ON employee.deptId = department.id";
  $dpartment = mysqli_query($connication,  $select);
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE FROM employee WHERE id =$id ";
  mysqli_query($connication, $delete);
  $myJS = <<<EOT
  <script type='text/javascript'>
      window.location.replace("/odc/S6/employee/index.php");
  </script>
  EOT;
  echo ($myJS);
}
?>

<form method="POST" class="w-25 mx-auto my-3">
  <input type="text" name="searchedName">
  <button class="btn btn-success" name="search">Search</button>
  <button class="btn btn-info" name="Reset">Reset</button>
</form>

<div class="container">
  <table class="table table-bordered text-white mt-5">
    <tr>
      <th>Name</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($dpartment as $data) { ?>
      <tr>
        <td><?= $data['name'] ?></td>
        <td>
          <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis-vertical"></i>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/odc/S6/employee/update.php?edit=<?= $data['id'] ?>"><i class="fa-solid fa-pen-to-square text-success"></i></a>
              <a class="dropdown-item" href="/odc/S6/employee/index.php?delete=<?= $data['id'] ?>"><i class="fa-solid fa-trash text-danger"></i></a>
              <a class="dropdown-item" href="/odc/S6/employee/show.php?show=<?= $data['id'] ?>"><i class="fa-solid fa-eye text-info"></i></a>
            </div>
          </div>
        </td>
      </tr>
    <?php } ?>
  </table>
</div>

<?php include '../shared/footer.php'; ?>