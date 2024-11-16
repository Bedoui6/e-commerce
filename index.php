
<?php
session_start();
include('includes/navbar.php'); 
include('admin/database/dbconfig.php'); 
?>
<link rel="stylesheet" href="css/stylee.css">


<h3 class="title">NEW RELEASES</h3>
<hr>
    <section class="shopcont">
    <div class="shop-content">
    <?php
            $query = "SELECT * FROM products";
            $query_run = mysqli_query($connection, $query);
                    if(mysqli_num_rows($query_run) > 0)        
                    {
                        while($row = mysqli_fetch_assoc($query_run))
                        {
                    ?>


                                    <div class="product-box">
                                    <?php  echo '<img src="admin/upload/'.$row['image'].'" class="product-img">' ?>
                                        <h2 class="product-title"><?php  echo $row['name']; ?></h2>
                                        <span class="price"><?php  echo $row['prix']; ?></span>
                                    </div>
                                    
                    <?php
                        }?>
                    <?php
                    };
                    ?>
                    </div>
                        

           
        
    </section>
   

    






    <?php
include('includes/scripts.php');
include('includes/footer.php');
?>










