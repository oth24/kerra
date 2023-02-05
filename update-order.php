<?php  include('header.php');  
 if (empty($_SESSION['username'])) {

header('location:login_client.php');
}else{

$username=$_SESSION['username'];
$user_id=$_SESSION["user_id"];
}
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تحديث حالة الطلب</title>
 
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
                <h1 class="mt-5 mb-3" style="text-align: right";>تحديث حالة الطلب</h1>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                require_once "config/constants.php";
                $sql = "SELECT * FROM rent_order WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

                    $tool = $row['tool'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('request.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('request.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="table table-striped table-hover" border>
                <tr>
                    <td>اسم الإداة</td>
                    <td><b> <?php echo $tool; ?> </b></td>
                </tr>

                <tr>
                    <td>تكلفة الايجار / اليوم</td>
                    <td>
                        <b>  <?php echo $price; ?>/ريال سعودي</b>
                    </td>
                </tr>

                <tr>
                    <td>عدد ايام الايجار</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>حالة الطلب</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="تحت الطلب"){echo "تحت الطلب";} ?> value="تحت الطلب">تحت الطلب</option>
                            <option <?php if($status=="تم التوصيل"){echo "تم التوصيل";} ?> value="تم التوصيل">تم التوصيل</option>
                            <option <?php if($status=="تم الارجاع"){echo "تم الارجاع";} ?> value="تم الارجاع">تم الارجاع</option>
                            <option <?php if($status=="تم الالغاء"){echo "تم الالغاء";} ?> value="تم الالغاء">تم الالغاء</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>اسم طالب الايجار: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>رقم الجوال: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>البريد الالكتروني: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>العنوان: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5" readonly><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td >
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        
                    </td>
                    <td > <input type="submit" name="submit" value="تحديث حالة الطلب" class="btn-secondary"></td>
                </tr>
            </table>
        
        </form>


        <?php 
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Update the Values
                $sql2 = "UPDATE rent_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    echo		"<script type='text/javascript'>
				alert('تم تحديث حالة الطلب بنجاح');
					window.location = 'request.php';</script>" ;
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('request.php');
                }
            }
        ?>


    </div>
</div>
</div>
    </div>
        </div>
</section>
</body>
</html>

<?php include('footer.php'); ?>