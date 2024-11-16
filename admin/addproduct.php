<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> Name </label>
                <input type="text" name="name" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Enter Description">
            </div>
            <div class="form-group">
                <label>Prix</label>
                <input type="text" name="prix" class="form-control" placeholder="Enter Prix">
            </div>
            <div class="form-group">
                <label>s</label>
                <input type="text" name="S" class="form-control">
            </div>
            <div class="form-group">
                <label>m</label>
                <input type="text" name="M" class="form-control">
            </div>
            <div class="form-group">
                <label>l</label>
                <input type="text" name="L" class="form-control">
            </div>
            <div class="form-group">
                <label>xl</label>
                <input type="text" name="XL" class="form-control">
            </div><div class="form-group">
                <label>Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addproductbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Products
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Product
            </button>
    </h6>
  </div>
<?php 
  if(isset($_SESSION['status']) && $_SESSION['status'] !=''){

    echo '<h2>'.$_SESSION['status'].'</h2>';
    unset($_SESSION['status']);
  }
?>
<?php
include('security.php');
?>
<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <?php
            $query = "SELECT * FROM products";
            $query_run = mysqli_query($connection, $query);
        ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th> Name </th>
                        <th>Description </th>
                        <th>Prix</th>
                        <th>S</th>
                        <th>M</th>
                        <th>L</th>
                        <th>XL</th>
                        <th>image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($query_run) > 0)        
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                    ?>
                        <tr>
                            <td><?php  echo $row['id']; ?></td>
                            <td><?php  echo $row['name']; ?></td>
                            <td><?php  echo $row['description']; ?></td>
                            <td><?php  echo $row['prix']; ?></td>
                            <td><?php  echo $row['S']; ?></td>
                            <td><?php  echo $row['M']; ?></td>
                            <td><?php  echo $row['L']; ?></td>
                            <td><?php  echo $row['XL']; ?></td>
                            <td><?php  echo '<img src="upload/'.$row['image'].'" width="100px;" height="100px;">' ?></td>

                            <td>
                                <form action="product_edit.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                                </form>
                            </td>
                            <td>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="deletep_btn" class="btn btn-danger"> DELETE</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                        } 
                    }
                    else {
                        echo "No Record Found";
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>