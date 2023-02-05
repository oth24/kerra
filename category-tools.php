    
    <?php include('header.php'); ?>

    <?php 
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            //CAtegory not passed
            //Redirect to Home page
            header('location:/index.php');
        }
    ?>


            <div class="container-fluid">
            
         <img src="images/banner-4.jpg" alt=" Logo" class="img-rounded"  width="100%" height="100%">

        </div>




    <section class="tool-menu">
        <div class="container">
            <h2 class="text-center" style= "text-align: center;" >قسم: <?php echo $category_title; ?> </h2>

            <?php 
            
                
                $sql2 = "SELECT * FROM tools WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

                //CHeck whether tool is available or not
                if($count2>0)
                {
                   
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        $owner_name = $row2['owner_name'];
                        $owner_id = $row2['owner_id'];
                        ?>
                        
                        <div class="tool-menu-box">
                            <div class="tool-menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="images/tool/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="tool-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="tool-price"><?php echo $price; ?> : ريال سعودي في اليوم</p>
                                <p class="tool-detail">
                                    <?php echo $description; ?>
                                </p>
                                <p class="tool-price"><?php echo $owner_name; ?> : المالك  </p>
                                <br>

                                <a href="order.php?tool_id=<?php echo $id; ?>&owner_name=<?php echo $owner_name; ?>&owner_id=<?php echo $owner_id; ?>" class="btn btn-primary">ارسال طلب ايجار</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                   
                    echo "<div class='error'>Tool not Available.</div>";
                }
            
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
   

    <?php include('footer.php'); ?>