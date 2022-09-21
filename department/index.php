<?php
include '../shared/header.php';
include '../shared/navbar.php';

$connication = mysqli_connect("localhost", "root", "", "s5");

$select = "SELECT * FROM `department`";
$dpartment = mysqli_query($connication,  $select);

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = "DELETE FROM department WHERE id =$id ";
  mysqli_query($connication, $delete);
  $myJS = <<<EOT
  <script type='text/javascript'>
      window.location.replace("/odc/S6/department/index.php");
  </script>
  EOT;
  echo($myJS);
}

?>

<div class="container">
  <table class="table table-bordered rounded overflow-hidden text-white mt-5">
    <tr>
      <th>Department ID</th>
      <th>Department Name</th>
      <th>Actions</th>
    </tr>
    <?php foreach ($dpartment as $data) { ?>
    <tr>
      <td><?= $data['id'] ?></td>
      <td><?= $data['name'] ?></td>
      <td class='d-flex justify-content-around'>
        <a class="btn btn-primary" href="/odc/S6/department/update.php?edit=<?= $data['id'] ?>">Update</a>
        <a class="btn btn-danger" href="/odc/S6/department/index.php?delete=<?= $data['id'] ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>

<?php include '../shared/footer.php';?>