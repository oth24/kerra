
 <?php include('header.php'); 


if(empty($_SESSION['username'])){
 
    header('location:login_client.php');
	
	
}
?>
    <?php 

        if(isset($_GET['tool_id']))
        {
           
            $tool_id = $_GET['tool_id'];
			$user_id=$_SESSION['user_id'];
			$user_name=$_SESSION['username'];
			$email=$_SESSION['email'];
			$phone=$_SESSION['phone'];
			$address=$_SESSION['address'];
         
            $sql = "SELECT * FROM tools WHERE id=$tool_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $owner_name = $row['owner_name'];
                $owner_id = $row['owner_id'];
            }
            else
            {
                //tool not Availabe
                //REdirect to Home Page
                header('location:index.php');
            }
        }
        else
        {
            //Redirect to homepage
            header('location:index.php');
        }
    ?>
 <style>
	 
		
		
      
	
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
		 table tr td:last-child{
            width: auto;
			font-weight: bold;
        }
		th , td{ text-align: center;
		}
    </style>
    
   
        <div class="container">
          <div class="wrapper"> 
            <h2 class="text-center text-black">تأكيد طلب الإيجار</h2>

            <form action="" method="POST" class="order">
			<h4>
                <fieldset>
                    <legend>بيانات الاداة </legend>

                    <div class="tool-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="images/tool/<?php echo $image_name; ?>" alt="no photo" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div >
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="tool" value="<?php echo $title; ?>">

                        <p >تكلفة الايجار باليوم  /  <?php echo $price; ?> / ريال سعودي</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
<br>
                        <div >عدد أيام الايجار ؟</div>
                        <input type="number" name="qty"  value="1" required>
                        <br><br>
                        <p >المالك : <?php echo $owner_name; ?></p>
                        
                    </div>

                </fieldset>
                <br>
                <fieldset>
                    <legend>تفاصيل التوصيل</legend>
					 <input type="hidden" name="user_id" placeholder="<?php echo $user_id; ?>"  readonly>
                    <div class="order-label">اسم طالب الايجار</div>
                    <input type="text" name="username" placeholder="<?php echo $user_name; ?>"  readonly>

                    <div class="order-label">رقم الجوال</div>
                    <input type="tel" name="contact" placeholder="<?php echo $phone; ?>" readonly>

                    <div class="order-label">البريد الالكتروني</div>
                    <input type="email" name="email" placeholder="<?php echo $email; ?>"  readonly>

                    <div class="order-label">العنوان</div>
                    <input type="text" name="address"  placeholder="<?php echo $address; ?>"  readonly>
<br><br>
                    <input type="submit" name="submit" value="تأكيد الطلب" class="btn btn-primary">
                </fieldset>
</h4>
            </form>

            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form
                  
                    $tool = $_POST['tool'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:sa"); //Order DAte

                    $status = "تحت الطلب";  // Ordered, On Delivery, Delivered, Cancelled
					//$user_id=$_POST['user_id'];
                    $customer_name = $_POST['username'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO rent_order SET 
                        tool = '$tool',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$user_name',
                        customer_contact = '$phone',
                        customer_email = '$email',
                        customer_address = '$address',
						user_id=$user_id,
                        owner_name='$owner_name',
                        owner_id='$owner_id'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    if($res2==true)
                    {
                      echo		"<script type='text/javascript'>
   alert('تم ارسال طلب التأجير بنجاح');
   window.location = 'index.php';</script>" ;
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>فشل في ارسال الطلب حاول مره اخرى</div>";
                        header('location:index.php');
                    }

                }
            
            ?>
 </div>
        </div>
    


    <?php include('footer.php'); ?>