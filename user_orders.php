 <?php  include('header.php');  

if (empty($_SESSION['username'])) {

	header('location:login_client.php');
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css">
<body>

</section>
<section class="categories ">
<div class="container" >
    <div class="wrapper" >
        <h1  align="right">طلبات الايجار المرسله</h1>


                <table class="table table-striped table-hover" dir="rtl" >
                    <thead class="thead-dark" >
                    <td >#</td>
                        <td >تاريخ الطلب</td>
                        <td>الغرض</td>
                        <td >السعر</td>
                        <td> ايام الايجار</td>
                        <td >المجموع</td>
                        <td >المالك</td>
                        <td >الحالة</td>
                     
                        
                    </thead>
	
                    <?php 
					require_once "config/constants.php";
                        //Get all the orders from database
						$user_id=$_SESSION['user_id'];
                      $sql= "SELECT * FROM rent_order WHERE user_id='".$user_id."'";
                        $res = mysqli_query($conn,$sql);
                        
						
						//Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $tool = $row['tool'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $owner_name = $row['owner_name'];
                                $owner_id=$row['owner_id'];
                                
                                ?>

                                    <tr>
                                        <td ><?php echo $sn++; ?> </td>
                                        <td ><?php echo $order_date; ?></td>
                                        <td><?php echo $tool; ?></td>
                                        <td ><?php echo '$'.$price; ?></td>
                                        <td ><?php echo $qty; ?></td>
                                        <td><?php echo '$'.$total; ?></td>
                                        <td><?php echo $owner_name; ?></td>

                                        <td >
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label style='color: blue;'>$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'><b>$status</b></label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                       
                                        
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>لا يوجد طلبات مرسله</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>
</section>

 <?php include('footer.php'); ?>