<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
            <?php 
  if(isset($_SESSION['status']) && $_SESSION['status'] !=''){

    echo '<h2>'.$_SESSION['status'].'</h2>';
    unset($_SESSION['status']);
  }
?>
        </div>
        <div class="card-body">
        <?php
            $connection=mysqli_connect("localhost","root","","ecommerce");
            if(isset($_POST['edit_btn']))
            {
                $id = $_POST['edit_id'];
                
                $query = "SELECT * FROM products WHERE id='$id' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $row)
                {
                    ?>

                        <form action="code.php" method="POST">

                            <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">

                            <div class="form-group">
                                <label> Name </label>
                                <input type="text" name="edit_name" value="<?php echo $row['name'] ?>" class="form-control"
                                    placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label> Description </label>
                                <input type="text" name="edit_desc" value="<?php echo $row['description'] ?>" class="form-control"
                                    >
                            </div>
                            <div class="form-group">
                                <label> Prix </label>
                                <input type="text" name="edit_prix" value="<?php echo $row['prix'] ?>" class="form-control"
                                    >
                            </div>
                            <div class="form-group">
                                <label> S </label>
                                <input type="text" name="edit_s" value="<?php echo $row['S'] ?>" class="form-control"
                                    >
                            </div>
                            
                            <div class="form-group">
                                <label>M</label>
                                <input type="text" name="edit_m" value="<?php echo $row['M'] ?>" class="form-control"
                                    placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label> L </label>
                                <input type="text" name="edit_l" value="<?php echo $row['L'] ?>" class="form-control"
                                    >
                            </div>
                            <div class="form-group">
                                <label> XL </label>
                                <input type="text" name="edit_xl" value="<?php echo $row['XL'] ?>" class="form-control"
                                    >
                            </div>
                            <div class="form-group">
                                <label> image </label>
                                <input type="file" name="edit_image" id="edit_image" value="<?php echo $row['image'] ?>" class="form-control"
                                    >
                            </div>

                            <a href="register.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updatepbtn" class="btn btn-primary"> Update </button>

                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>