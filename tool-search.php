
    <?php include('header.php');

   
   


            ?>




    <section class="tool-menu">
        <div class="container">
   

            <?php

            if (isset($_POST['search'])) {
                //Get the Search Keyword

                $search = $_POST['search'];
                echo ' <h2 class="text-center">نتيجة البحث عن : '.$search.'</h2>';
                //Getting Foods from Database that are active and featured
                //SQL Query
                $sql2 = "SELECT * FROM tools WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count Rows
                $count2 = mysqli_num_rows($res2);


                if ($count2 > 0) {

                    while ($row = mysqli_fetch_assoc($res2)) {
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
                            if ($image_name == "") {
                                //Image not Available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
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
                } else {
                    //tool Not Available 
                    echo "<div class='error'>Tool not available.</div>";
                }
            }
            ?>

            

 

            <div class="clearfix"></div>

            

        </div>

     
    </section>

    <?php include('footer.php'); ?>