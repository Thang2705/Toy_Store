<?php
ob_start();
session_start();
 ?>


<?php 
	include "head.php"
	?>
<?php
$title ="Shop huy";
$name ="Điện thoai";
?>
<?php 
	include "top.php"
    ?>
    <?php 
	include "header.php"
	?>
	<?php 
	include "navigation.php"
	?>
	<!--//////////////////////////////////////////////////-->
	<!--///////////////////Account Page///////////////////-->
	<!--//////////////////////////////////////////////////-->
	<?php
$tk = "" ;
$mk = "" ;
$kq = "";
if(isset($_POST['submit']))
{
    require 'inc/myconnect.php';
    $tk = $_POST['txtus'] ;
    $mk = $_POST['txtem'];
    $sql="SELECT * FROM loginuser  where email = '$tk'  and matkhau = '$mk'  ";
    $result = $conn->query($sql);
    // echo  $mk;
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
        $_SESSION['txtus'] = $tk ;
        $_SESSION['HoTen'] = $row["HoTen"];
        $_SESSION['email'] = $row["email"];
        $_SESSION['dienthoai'] = $row["DienThoai"];
            header('Location: cart.php');
            $row = $result->fetch_assoc();  
        }         
    }
    else
    {
        $kq ="Incorrect information please check again";
    }
}
?>
<?php
$name = "" ;
$email = "" ;
$dt= "";
$mk= "";
$kqdk ="";
$repass ="";

if(isset($_POST['dangky']))
{
    require 'inc/myconnect.php';
    $name  = $_POST['fullname'] ;
    $email = $_POST['email'];
    $dt = $_POST['phone'];
    $mk = $_POST['password'];
    $repass = $_POST['repass'];
    if($repass != $mk  )
    {
        $kqdk = "Re-entered password is incorrect";
    }
    else
    {
        $sql="INSERT INTO  loginuser (email,matkhau,hoten,DienThoai) 
        VALUES ('$email','$mk' ,'$name','$dt') ";
        // echo  $mk;
        if (mysqli_query($conn, $sql)) {
            $name = "" ;
            $email = "" ;
            $dt= "";
            $mk= "";
            $repass ="";
            $kqdk = "Sign Up Success";
        } else {
            $kqdk = "Registration failed, please check the information again";
        }
    }

    
    mysqli_close($conn);
}
?>
	<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="breadcrumb">
						<li><a href="index.php">Home</a></li>
						<li><a href="account.php">Account</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="heading"><h2>Login</h2></div>
					<form name="form1" id="ff1" method="POST" action="#">
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" name="txtus" required value="">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Password" name="txtem"required value="">
						</div>
						<button type="submit" name="submit" class="btn btn-1" name="login" id="login">Login</button>
						<P style="color:red"><?php echo $kq; ?></p>
						<a href="#"></a>
						<br>
					<i>*Do not have an account? Please signup.</i>
					</form>
				</div>
				<div class="col-md-6">
					<div class="heading"><h2> Signup account </h2></div>
					<form name="form2" id="ff2" method="post" action="#">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Name" name="fullname" id="firstname" value="<?php echo $name;?>" required >
						</div>
						<div class="form-group">
							<input type="email" class="form-control" placeholder="Email" name="email" id="email"  value="<?php echo $email;?>" required>
						</div>
						<div class="form-group">
						<input type="number" class="form-control" placeholder="Phone" name="phone" id="phone" value="<?php echo $dt;?>" required >
						</div>
						<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" name="password" id="password"  value="<?php echo $mk;?>"required >
						</div>
						<div class="form-group">
						<input type="password" class="form-control" placeholder="Repassword" name="repass" id="repass" value="<?php echo $repass;?>" required >
						</div>
						<button type="submit" name="dangky" class="btn btn-1"> Sign up</button>
						<P style="color:red"><?php echo $kqdk; ?></p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php 
	include "footer.php"
	?>
</body>
</html>
<?php ob_end_flush(); ?>
