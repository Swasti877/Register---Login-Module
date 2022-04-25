<?php 
    include 'components/_dbConnect.php';
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        header("location: login.php");
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $username = $_SESSION['username'];

        //search for userid in user table
        $sql_query = "SELECT * from user where username='$username';";
        $result = mysqli_query($conn, $sql_query);
        $userID = $result->fetch_array()[0] ?? '';
        
        //storing toDo in toDo table
        $sql_add_query = "INSERT INTO `todolist` (`user_id`, `title`, `desc`) VALUES ('$userID', '$title', '$desc');";
        $result = mysqli_query($conn, $sql_add_query);

        //fetching all toDo of particular user
        $sql_fetch_query = "SELECT * from todolist where user_id='$userID';";
        $result = mysqli_query($conn, $sql_fetch_query);
        $row = mysqli_fetch_array($result);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="welcome.css">
    <title>Document</title>
</head>
<body>
    <header>
        <h1 class="title">Welcome <?php echo $_SESSION['username']?></h1>
        <?php include 'todolist.php' ?>
        <a class="logout" href="/website/logout.php">Logout</a>
        <a href="viewAllCustomer.php">View All</a>
    </header>

    <form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr> 
				<td>Age</td>
				<td><input type="text" name="age"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
</body>
</html>