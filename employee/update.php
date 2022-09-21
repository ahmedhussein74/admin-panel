<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

$infoId = '';

if($_GET['edit']){
  $infoId = $_GET['edit'];
}

$info = "SELECT * FROM `employee`
WHERE id = $infoId";
$data=mysqli_query($connication, $info);
$row=mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
  $id = $_GET['edit'];
  $user = $_POST['name'];
  $email = $_POST['email'];
  $departmentid = $_POST['departmentid'];
  $salary = $_POST['salary'];
  $update = "UPDATE employee
  SET `name` = '$user', email = '$email', deptId = $departmentid, salary = $salary
  WHERE id = $id";
  mysqli_query($connication, $update);
  $myJS = <<<EOT
  <script type='text/javascript'>
      window.location.replace("/odc/S6/employee/index.php");
  </script>
  EOT;
  echo($myJS);
}

$select = "SELECT * FROM `department`";
$dpartment = mysqli_query($connication,  $select);

?>

<div class="container">
  <h2 class="text-center my-5">Update Employee</h2>
  <form method="POST" class="rounded bg-dark p-3 text-white">
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" placeholder="Enter employee name" name="name" value="<?=  $row['name'] ?>">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?=  $row['email'] ?>">
    </div>
    <div class="form-group">
      <label>Department</label>
      <select class="form-control" type="text" name="departmentid" required>
      <?php foreach ($dpartment as $data) { ?>
        <option value="<?= $data['id'] ?>" <?php if($row['deptId'] == $data['id']) { echo "selected";}?>>
          <?= $data['name'] ?>
        </option>
      <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label>Salary</label>
      <input type="text" class="form-control" placeholder="Enter salary" name="salary" value="<?=  $row['salary'] ?>">
    </div>
    <button name="update" class="btn btn-success d-block mx-auto w-25">Update</button>
  </form>
</div>

<?php include '../shared/footer.php';?>