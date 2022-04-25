<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'components/_dbConnect.php';

        if(isset($_POST['Submit'])) {	
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
                
                //link to the previous page
                echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
            } else { 
                // if all the fields are filled (not empty) 
                    
                //insert data to database	
                $result = mysqli_query($conn, "INSERT INTO customers(name,age,email) VALUES('$name','$age','$email')");
                
                //display success message
                echo "<font color='green'>Data added successfully.";
                echo "<br/><a href='viewAllCustomer.php'>View Result</a>";
            }
        }
    
    ?>
</body>
</html>