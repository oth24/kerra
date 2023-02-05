    <?php include('header.php'); ?>

 

        <div class="container-fluid">
            
         <img src="images/banner-1.jpg" alt=" Logo" class="img-rounded"  width="100%" height="100%">

        </div>
  
   

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">الاقسام</h2>

            <?php 
                //Create SQL Query to Display CAtegories from Database
                $sql = "SELECT * FROM category ORDER BY id ASC LIMIT 9";
                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="category-tools.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display MEssage
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white" ><mark style="background-color:white;"><?php echo $title; ?></mark></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- tool MEnu Section Starts Here -->
    <section class="tool-menu">
        <div class="container">
            <h2 class="text-center">أغراض معروضه للإيجار	</h2>

            <?php 
            
            //Getting Foods from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM tools LIMIT 6";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

          
            if($count2>0)
            {
               
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="tool-menu-box">
                        <div class="tool-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not available.</div>";
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
                            <p class="tool-price"><?php echo $price; ?>/ريال سعودي في اليوم</p>
                            <p class="tool-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="order.php?tool_id=<?php echo $id; ?>" class="btn btn-primary">ارسال طلب ايجار</a>
                        </div>
                    </div>

                    <?php
                }
            }
            else
            {
                //tool Not Available 
                echo "<div class='error'>Tool not available.</div>";
            }
            
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

     
    </section>
    <!-- tool Menu Section Ends Here -->

    
  <?php include('footer.php'); ?>