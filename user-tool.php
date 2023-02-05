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
    <title>اعلاناتي المعروضة للايجار</title>
 
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
                <h1 class="mt-5 mb-3" style="text-align: right";>اعلاناتي المعروضة للايجار</h1>
                <div class="form-group">
        <br /><br />

                <!-- Button to Add Admin -->
             <h4>   <a href="add-tool.php" class="btn-primary" >اضافة اعلان جديد </a></h4>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>

                <table class="table table-striped table-hover" border>
                    <tr>
                        <th>#</th>
                        <th>اسم الاداة</th>
                        <th>سعر الايجار اليومي</th>
                        <th>صورة الاداة</th>
                       
                       
                        <th>حذف</th>
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the Tool
                        $sql = "SELECT * FROM tools WHERE owner_id=$user_id";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have tool in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                               
                              
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $title; ?></td>
                                    <td>SR. <?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Image not Added.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="images/tool/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    
                                  
                                    <td>
                                 
                                        <a href="delete-tool.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Tool</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Tool not Added in Database
                            echo "<tr> <td colspan='7' class='error'> لا يوجد اعلانات </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>
    
</div>
</div>
        </div>
    </div>
        </div>
</section>
</body>
</html>
<?php include('footer.php'); ?>