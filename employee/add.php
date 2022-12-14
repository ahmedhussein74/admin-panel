<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

$user = '';
$email = '';
$salary = '';
$departmentid = '';

if (isset($_POST['insert'])) {
  $user = $_POST['name'];
  $email = $_POST['email'];
  $departmentid = $_POST['departmentid'];
  $salary = $_POST['salary'];

  $image_name = time() . $_FILES['image']['name'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $location = "./upload/$image_name";

  move_uploaded_file($tmp_name, $location);

  $insert = "INSERT INTO employee 
  VALUES (null, '$user', '$email', '$location', $departmentid, $salary)";
  mysqli_query($connication, $insert);
  $myJS = <<<EOT
  <script type='text/javascript'>
      window.location.replace("/odc/S6/employee/add.php");
  </script>
  EOT;
  echo ($myJS);
}

$select = "SELECT * FROM `department`";
$dpartment = mysqli_query($connication,  $select);

?>

<div class="container">
  <h2 class="text-center my-5">Add Employee</h2>
  <form method="POST" class="rounded bg-dark p-3 text-white" enctype="multipart/form-data">
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" placeholder="Enter employee name" name="name">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label>Department</label>
      <select class="form-control" type="text" name="departmentid" required>
        <?php foreach ($dpartment as $data) { ?>
          <option value="<?= $data['id'] ?>"> <?= $data['name'] ?> </option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">Employee Profile</label>
      <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
      <label>Salary</label>
      <input type="text" class="form-control" placeholder="Enter salary" name="salary">
    </div>
    <button name="insert" class="btn btn-success d-block mx-auto w-25">Add</button>
  </form>
</div>

<?php include '../shared/footer.php'; ?>