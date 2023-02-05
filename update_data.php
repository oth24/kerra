<?php 
 
	

include('config/constants.php');



       
				
		if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 
				$user_id = $_POST['user_id'];
				$user_name = $_POST['user_name'];
				$user_email = $_POST['user_email'];
				$user_phone = $_POST['user_phone'];
				$user_address = $_POST['user_address'];

		$query = "UPDATE user SET user_name ='".$user_name."' , user_email ='".$user_email."',user_phone ='".$user_phone."',user_address ='".$user_address."'
		WHERE user_id='".$user_id."'";

		$result = $conn->query($query);
		if(!$result){
			echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";
		}else{
		echo	"<script type='text/javascript'>
   alert('Data saved');
   window.location = 'index.php';</script>" ;
	$stmt->close();
	}
	

	
	}//end of if
?>