<?php
// including the database connection file
include 'components/_dbConnect.php';

if(isset($_POST['update'])){	

	$id = $_POST['id'];
	$name = $_POST['name'];
	$age = $_POST['age'];
	$email = $_POST['email'];	
	
	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {	
			
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($conn, "UPDATE customers SET name='$name',age='$age',email='$email' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: viewAllCustomer.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM customers WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$age = $res['age'];
	$email = $res['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php">Home</a>
    	<br/><br/>
	
	    <form name="form1" method="post" action="edit.php">
		    <table border="0">
			    <tr> 
				    <td>Name</td>
				    <td><input type="text" name="name" value="<?php echo $name;?>"></td>
			    </tr>
			    <tr> 
				    <td>Age</td>
				    <td><input type="text" name="age" value="<?php echo $age;?>"></td>
			    </tr>
			    <tr> 
    				<td>Email</td>
	    			<td><input type="text" name="email" value="<?php echo $email;?>"></td>
		    	</tr>
			    <tr>
    				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
	    			<td><input type="submit" name="update" value="Update"></td>
		    	</tr>
		    </table>
	    </form>
    </body>
</html>