<?php 

session_start(); 

include("includes/connection.php");

$id=$_SESSION['id'];
//$id=$_GET['updateid']

$sql="SELECT * FROM users WHERE id=$id";
$result=mysqli_query($connect, $sql);
$row=mysqli_fetch_assoc($result);
$id = $row['id'];
$username = $row['username'];
$password = $row['password'];

if(isset($_POST['update'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //$sql="UPDATE users SET id=$id, firstname='$firstname', surname='$surname', username='$username', gender='$gender', role='$role', contract_type='$contract_type', hiring_date='$hiring_date', password='$password' WHERE id=$id";

    if($_SESSION['username'] == "admin") {
    	$sql="UPDATE users SET id=$id, username='$username', password='$password' WHERE id=$id";
    	$result=mysqli_query($connect, $sql);
    } else if ($_SESSION['username'] == "employee") {
    	$sql="UPDATE users SET id=$id, firstname='$firstname', surname='$surname', gender='$gender', password='$password' WHERE id=$id";
    	$result=mysqli_query($connect, $sql);
    } else {
    	$sql="UPDATE users SET id=$id, username='$username', gender='$gender', password='$password' WHERE id=$id";
    	$result=mysqli_query($connect, $sql);
    }


    if($result) {
	        header('location:admin.php');
	    } else {
	        die(mysqli_error($connect));
	    }
    
    
    
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dexter's Lab</title>
</head>
<body>

	<?php include("includes/header.php"); ?>

<div class="container">
    <div class="col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 shadow-sm" style="margin-top:100px;">
                <form method="post">    
                <div class="container my-5">

					<?php 
						if($_SESSION['role'] == "admin") { ?>
							<p style = "line-height:1.4">
                        		<button class="btn btn-dark"><a href="admin.php" class="text-light">Go back</a></button>
                			</p>
							<div class="form-group">
	                            <label for="username">Username</label>
	                            <input type="text" class="form-control" id="username" name="username" autocomplete="off" 
	                                   placeholder="Enter new username..." value=<?php echo $username;?>>
                        	</div>

						<?php } else if($_SESSION['role'] == "employee"){ ?>
							<p style = "line-height:1.4">
                        		<button class="btn btn-dark"><a href="employee.php" class="text-light">Go back</a></button>
                			</p>
							<div class="form-group">
	                            <label for="firstname">First name</label>
	                            <input type="text" class="form-control" id="firstname" name="firstname" autocomplete="off" placeholder="Enter new first name..." value=<?php echo $firstname;?>>
                        	</div>

	                        <div class="form-group">
	                            <label for="surname">Surname</label>
	                            <input type="text" class="form-control" id="surname" name="surname" autocomplete="off" 
	                                   placeholder="Enter new surname..." value=<?php echo $surname;?>>
	                        </div>

	                        <div class="form-group">
	                            <label for="gender">Gender</label>
	                            <select class="form-control" id="gender" name="gender">
	                            <option>Male</option>
	                            <option>Female</option>
	                            </select>
                        	</div>

						<?php } else { ?>
							<p style = "line-height:1.4">
                        		<button class="btn btn-dark"><a href="patient.php" class="text-light">Go back</a></button>
                			</p>
							<div class="form-group">
	                            <label for="username">Username</label>
	                            <input type="text" class="form-control" id="username" name="username" autocomplete="off" 
	                                   placeholder="Enter new username..." value=<?php echo $username;?>>
                        	</div>

							<div class="form-group">
	                            <label for="gender">Gender</label>
	                            <select class="form-control" id="gender" name="gender">
	                            <option>Male</option>
	                            <option>Female</option>
	                            </select>
                        	</div>
						<?php } ?>

						<div class="form-group">
	                        <label>Password</label>
	                        <input type="password" name="password" class="form-control my-2" placeholder="Enter new password..." value=<?php echo $password; ?>>
                        </div>

						 <button type="submit" class="btn btn-primary" name="update">Update</button>

				</form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>