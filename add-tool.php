
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
    <title>عرض اداة للإيجار</title>
 
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
                <h1 class="mt-5 mb-3" style="text-align: right";>عرض اداة للإيجار</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
 <div class="form-group">
        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="table table-striped table-hover" border >

                <tr>
                    <td>اسم الاداة :</td>
                    <td>
                        <input type="text" name="title"  required>
                    </td>
                </tr>

                <tr>
                    <td> الوصف : </td>
                    <td>
                        <textarea name="description" cols="22" rows="5" ></textarea>
                    </td>
                </tr>

                <tr>
                    <td>سعر الايجار اليومي : </td>
                    <td>
                        <input type="number" name="price" required>
                    </td>
                </tr>

                <tr>
                    <td>صورة الاداة :  </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>القسم : </td>
                    <td>
                        <select name="category">

                            <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM category ";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>

                        </select>
                    </td>
                </tr>

                

               

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Tool" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        </div>
        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Tool in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

               
                // Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                 

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "images/tool/".$image_name;

                        //Finally Uppload the tool image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Tool Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('index.php');
                            //STop the process
                            die();
                        }

                    }

                
                else
                {
                    $image_name = ""; //SEtting DEfault Value as blank
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add tool
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tools SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    owner_name = '$username',
                    owner_id=$user_id
                   
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Tool page
                if($res2 == true)
                {
                     echo		"<script type='text/javascript'>
				alert('تم عرض الاداة للإيجار');
   window.location = 'index.php';</script>" ;
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Failed to Add Tool.</div>";
                    header('index.php');
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
<?php include('footer.php'); ?>