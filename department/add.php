<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

if(isset($_POST['insert'])){
  $user = $_POST['deptName'];
  $insert = "INSERT INTO department (`name`) VALUES ('$user')";
  mysqli_query($connication, $insert);
  $myJS = <<<EOT
  <script type='text/javascript'>
      window.location.replace("/odc/S6/department/add.php");
  </script>
  EOT;
  echo($myJS);
}

?>

<div class="container">
  <h2 class="text-center my-5">Add Department</h2>
  <form method="POST" class="rounded bg-dark p-3 text-white">
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" placeholder="Enter department name" name="deptName">
    </div>
    <button name="insert" class="btn btn-success d-block mx-auto w-25">Add</button>
  </form>
</div>

<?php include '../shared/footer.php';?>
