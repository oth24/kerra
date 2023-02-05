
 <?php  include('header.php');  
 if (empty($_SESSION['username'])) {

header('location:login_client.php');
}
?>
 <?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
  include('config/constants.php');
    
	$user_id=$_GET["id"];
	
    // Prepare a select statement
    $sql = "SELECT * FROM user WHERE user_id = '".$user_id."'";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
       // mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $user_id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $user_id = $row['user_id'];
				$user_name = $row['user_name'];
				$user_email = $row['user_email'];
				$user_phone = $row['user_phone'];
				$user_address = $row['user_address'];

                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>بيانات المستخدم</title>

    <style>
	 
		
		
      
	
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
		 table tr td:last-child{
            width: auto;
			font-weight: bold;
        }
		th , td{ text-align: center;
		}
    </style>
</head>
<body>

  
    <section class="categories">
        <div class="container">
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3" style="text-align: right";>بيانات المستخدم</h1>
                    <div class="form-group">
                       <form action="update_data.php" method="POST" style="text-align: right";>
					   <table class="table table-striped table-hover" border >               
							<tr>        
					   <td >رقم المستخدم :</td>
                        <td><b><input type="number" name="user_id" class="form-control" value="<?php echo $user_id; ?>" readonly></b></td>
						</tr> 
                        <tr>  
                        <td>اسم المستخدم :</td>
                        <td><b><input type="text" name="user_name" class="form-control" value="<?php echo $user_name; ?>"  > </b></td>
                        </tr> 

					<tr>  
					 <td>البريد الإلكتروني :</td>
                        <td><b><input type="email" name="user_email" class="form-control"  value="<?php echo $user_email; ?>" ></b></td>
					</tr>  
					<tr>             
					 <td>رقم الجوال :</td>
                        <td><b><input type="number" name="user_phone" class="form-control" value="<?php echo $user_phone; ?>"></b></td>
					</tr> 
                        <tr>             
					 <td>العنوان :</td>
                        <td><b><input type="text" name="user_address" class="form-control" value="<?php echo $user_address; ?>"></b></td>
					</tr> 
                      </table>   
                 
					<input type="submit"  class="btn btn-primary" name="Submit" value="حفظ التعديلات">
						<a href="index.php" class="btn btn-primary">رجوع</a>
                    
                    </form> 
					</div>
                </div>
            </div>        
        </div>
    </div>
	  </div>
  </section>
 <?php include('footer.php'); ?>