<?php
session_start();
$connection=mysqli_connect("localhost","root","","ecommerce");
if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password) VALUES ('$username','$email','$password')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}
?>

<?php
include('security.php');

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}

?>




<?php
include('security.php');

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}
?>




<?php
include('security.php');

if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);

   if(mysqli_fetch_array($query_run))
   {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
   } 
   else
   {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
   }
    
}
?>







<?php
$connection=mysqli_connect("localhost","root","","ecommerce");
if(isset($_POST['addproductbtn']))
{
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $prix = $_POST['prix'];
    $s = $_POST['S'];
    $m = $_POST['M'];
    $l = $_POST['L'];
    $xl = $_POST['XL'];
    $imgname = $_FILES["image"]['name'];

    if(file_exists("upload/" .$_FILES["image"]["name"]))
    {
    
    echo "lol";
    
    }
    else{

    $email_query = "SELECT * FROM products";
    $email_query_run = mysqli_query($connection, $email_query);
    $query = "INSERT INTO products (name,description,prix,S,L,M,XL,image) VALUES ('$name','$desc','$prix','$s','$l','$m','$xl','$imgname')";
    $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                move_uploaded_file($_FILES["image"]["tmp_name"], "upload/".$_FILES["image"]["name"]);
                $_SESSION['status'] = "Product Added";
                $_SESSION['status_code'] = "success";
                header('Location: addproduct.php');
            }
            else 
            {
                $_SESSION['status'] = "Product Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: addproduct.php');  
            }
    }

}
?>







<?php
include('security.php');

if(isset($_POST['updatepbtn']))
{
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $desc = $_POST['edit_desc'];
    $prix = $_POST['edit_prix'];
    $s = $_POST['edit_s'];
    $m = $_POST['edit_m'];
    $l = $_POST['edit_l'];
    $xl = $_POST['edit_xl'];
    $img = $_FILES["edit_image"]['name'];

    $query = "UPDATE products SET name='$name',description='$desc',prix='$prix',S='$s',L='$m',M='$l',XL='$xl',image='$img' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        move_uploaded_file($_FILES["edit_image"]["tmp_name"], "upload/".$_FILES["edit_image"]["name"]);
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: addproduct.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: addproduct.php'); 
    }
}

?>


<?php
include('security.php');

if(isset($_POST['deletep_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM products WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: addproduct.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: addproduct.php'); 
    }    
}
?>