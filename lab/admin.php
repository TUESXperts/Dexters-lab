<?php 

session_start(); 

include("includes/connection.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dexter's Lab</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<?php include("includes/header.php"); ?>

	<div class="container" style="text-align:center">
        <button class="btn btn-info my-5">
            <a href="addEmployee.php" class="text-light" >
                Add Employee
            </a>
        </button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                <th scope="col">First name</th>
                <th scope="col">Surname</th>
                <th scope="col">Username</th>
                <th scope="col">Gender</th>
                <th scope="col">Role</th>
                <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>

                <?php

                    $sql="SELECT id,firstname, surname, username, gender, contract_type, hiring_date FROM users WHERE role='Employee'";
                    $result=mysqli_query($connect, $sql);
                    if($result) {
                        $i = 1;
                        while($row=mysqli_fetch_assoc($result)) {
                            $id=$row['id'];
                            $firstname = $row['firstname'];
                            $surname=$row['surname'];
                            $username=$row['username'];
                            $gender = $row['gender'];
                            $contract_type = $row['contract_type'];
                            $hiring_date = $row['hiring_date'];
                            
                            echo '
                                <tr>
                                    <th scope="row">' . $i . '</th>
                                    <td>'.$firstname.'</td>
                                    <td>'.$surname.'</td>
                                    <td>'.$username.'</td>
                                    <td>'.$gender.'</td>
                                    <td>'.$contract_type.'</td>
                                    <td>'.$hiring_date.'</td>
                                    <td>
                                    <p style = "line-height:1.4">
                                        <button class="btn btn-success"><a href="updateEmployee.php?updateid='.$id.'" class="text-light">Update</a></button>
                                        <button class="btn btn-danger"><a href="deleteEmployee.php?deleteid='.$id.'" class="text-light">Delete</a></button>
                                    </p>
                                    </td>
                                </tr>
                            ';
                            $i++;
                        }
                    }
    
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>