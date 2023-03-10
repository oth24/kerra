<?php
 include('header.php'); 


	
	include('config/constants.php');
	 

	$username = $password = "";
	$username_err = $password_err ="";
	 
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	// $usertype=trim($_POST["usertype"]);
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}
	
		
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement


			$sql = "SELECT user_id, user_name,user_email,user_phone ,user_address, user_pass FROM user WHERE user_name = ?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Store result
					$stmt->store_result();
					
					// Check if username exists, if yes then verify password
					if($stmt->num_rows == 1){                    
						// Bind result variables
						$stmt->bind_result($user_id, $username, $email,$phone,$address,$hashed_password);
						// $stmt->fetch() will fetch results from a prepared statement into
						// the bound variables
						if($stmt->fetch()){
							//  password_verify ( string $password , string $hash ) : bool
							//	password : The user's password.
							//  hash : A hash created by password_hash().
							if(password_verify($password, $hashed_password)){
								
								// Password is correct, so start a new session
								session_start();
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["user_id"] = $user_id;
								$_SESSION["username"] = $username;
								$_SESSION["email"] = $email;
								$_SESSION["phone"] = $phone;
								$_SESSION["address"] = $address;
								header("location: index.php");
								
							} // end of if(password_verify($password, $hashed_password))
							else{
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid.";
							}
						} // end of $stmt->fetch()
					} // end of if($stmt->num_rows == 1)
					else{
						// Display an error message if username doesn't exist
						$username_err = "No account found with this username.";
					}
				}  // end of if($stmt->execute())
				else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			} // End of if($stmt = $conn->prepare($sql))
			
			// Close statement
			$stmt->close();
		}		
		// Close connection
		$conn->close();
}
?>
 
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>?????????? ????????????</title>
    
  	



    <style type="text/css">
       
        .wrapper{ width: 500px; margin-left: auto;
    margin-right: auto; justify-content: center;
	
}
	
	
    </style>
</head>
<body>

 <section class="categories">
        <div class="container">



    <div class="wrapper"><br>
    
        <h2 style="text-align: center;"> ?????????? ???????? ????????????????</h2> <br>
       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            <div style="text-align: right;">
                <label>?????? ????????????????</label>
                <input type="text" name="username" class="form-control" >
                <span class="text-danger"><?php echo $username_err; ?></span>
            </div> <br>   
            <div style="text-align: right;">
                <label >???????? ????????????</label>
                <input type="password" name="password" class="form-control">
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div>
			<br>
			

            <div style="text-align: center;">
			
                <input type="submit" class="btn btn-primary" value="????????"> 
			<a href="register_client.php">	<input type="button" class="btn btn-muted" value="?????????? ???????????? ????????"> </a>
            </div>
			
            
        </form>
		
		<br>
		<br>
		<div style="text-align: center;">
		<a href="login_admin.php">	<input type="button" class="btn btn-muted" value=" ???????? ??????????????"> </a>
		 </div>
    </div>  
    </div>
	 
  </section>
</body>
</html>
 <?php include('footer.php'); ?>