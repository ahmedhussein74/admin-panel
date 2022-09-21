<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

$infoId = '';

if($_GET['edit']){
  $infoId = $_GET['edit'];
}

$info = "SELECT * FROM `department`
WHERE id = $infoId";
$data=mysqli_query($connication, $info);
$row=mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
  $id = $_GET['edit'];
  $user = $_POST['name'];
  $update = "UPDATE department
  SET `name` = '$user'
  WHERE id = $id";
  mysqli_query($connication, $update);
  $myJS = <<<EOT
  <script type='text/javascript'>
      window.location.replace("/odc/S6/department/index.php");
  </script>
  EOT;
  echo($myJS);
}

?>

<div class="container">
  <h2 class="text-center my-5">Update Department</h2>
  <form method="POST" class="rounded bg-dark p-3 text-white">
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" placeholder="Enter department" name="name" value="<?= $row['name'] ?>">
    </div>
    <button name="update" class="btn btn-success d-block mx-auto w-25">Update</button>
  </form>
</div>

<?php include '../shared/footer.php';?>