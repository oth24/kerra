<?php

 include('header.php'); 


	// Include config file
	include('config/constants.php');
	 
	// Define variables and initialize with empty values
	$user_name =	$user_pass = $confirm_password =$user_email=$user_phone="";
	$username_err = $password_err = $confirm_password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
	
		$user_email= trim($_POST["user_email"]);
		$user_phone= trim($_POST["user_phone"]);
		$user_address= trim($_POST["user_address"]);
		
		// Validate user_name 
		// The trim() function removes white space from both sides(left and right) of a string
		if(empty(trim($_POST["user_name"]))){
			$username_err = "ادخل اسم المستخدم";
		} else{
			// Prepare a select statement
			$sql = "SELECT user_id FROM user WHERE user_name=?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["user_name"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// store result
					$stmt->store_result();
					
					if($stmt->num_rows == 1){
						$username_err = "اسم المستخدم محجوز مسبقاً";
					} else{
						$user_name = trim($_POST["user_name"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}	 
			// Close statement
			$stmt->close();
		}
		
		// Validate user_pass
		if(empty(trim($_POST["user_pass"]))){
			$password_err = "ادخل كلمة المرور";     
		} elseif(strlen(trim($_POST["user_pass"])) < 4){
			$password_err = "كلمة المرور يجب الا تقل عن 4 حروف ";
		} else{
			$user_pass = trim($_POST["user_pass"]);
		}
		
		// Validate confirm user_pass
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "ادخل تأكيد كلمة المرور";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($user_pass != $confirm_password)){
				$confirm_password_err = "كلمة المرور غير متطابقة";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{


			// Prepare an insert statement $user_phone=$id_no=$companyname= $companyfield=$aboutcompany=
			$sql = "INSERT INTO user (user_name, user_pass ,user_email ,user_phone,user_address) VALUES (?,?,?,?,?)";
			 
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("sssss", $param_username, $param_password, $param_email,$param_phone,$param_address);
				
				// Set parameters
				
				$param_username = $user_name;
				$param_email =$user_email;
				$param_phone= $user_phone;
				$param_address=$user_address;
		       
				$param_password = password_hash($user_pass, PASSWORD_DEFAULT); 
				// Creates a user_pass hash
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Redirect to login page
					echo		"<script type='text/javascript'>
   alert('تم انشاء مستخدم جديد بنجاح');
   window.location = 'login_client.php';</script>" ;
				} else{
					echo "Something went wrong. Please try again later.";
				}
			} 
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
    <title>انشاء مستخدم جديد</title>

<style type="text/css">
    
        .wrapper{ width: 500px; margin-left: auto;
    margin-right: auto; justify-content: center;}
	
    </style>
	
 
  
  
</head>
<body>


 <section class="categories">
        <div class="container">

    <div class="wrapper">
       

        <h2 class="mt-3">انشاء مستخدم جديد</h2>
        <p>رجاء تعبئة البيانات *</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            <div class="mb-3 >">
                <label>اسم المستخدم</label>
                <input type="text" name="user_name" class="form-control" required>
                <span class="text-danger"><?php echo $username_err; ?></span>
            </div>    
			<br>
            <div class="mb-3">
                <label>كلمة المرور</label>
                <input type="user_pass" name="user_pass" class="form-control" required>
                <span class="text-danger"><?php echo $password_err; ?></span>
            </div><br>
            <div class="mb-3">
                <label>تأكيد كلمة المرور</label>
                <input type="user_pass" name="confirm_password" class="form-control" required>
                <span class="text-danger"><?php echo $confirm_password_err; ?></span>
            </div><br>
			
			   <div class="mb-3">
                <label>البريد الالكتروني</label>
                <input type="user_email" name="user_email" class="form-control" required>
                </div><br>
				
				
				 <div class="mb-3">
                <label>رقم الجوال/ مثال(0512345678)</label>
                <input type="tel" name="user_phone" class="form-control" maxlength="10"  pattern="[0]{1}[1-9]{1}[0-9]{1}[0-9]{7}" required>
                </div><br>
				 <div class="mb-3">
                <label>العنوان</label>
                <input type="text" name="user_address" class="form-control" required>
                </div><br>
			
                <input type="submit" class="btn btn-primary" value="انشاء مستخدم">
                <input type="reset" class="btn btn-default" value="مسح">
           <br>
            
        </form>
    </div> 
<br><br><br><br><br><br>
	</div><br>
    
	 
  </section>
	
 <?php include('footer.php'); ?>