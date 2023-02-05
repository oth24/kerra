<?php 
    //Include COnstants Page
    include('config/constants.php');

    //echo "Delete tool Page";

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
        //Process to Delete
        //echo "Process to Delete";

        //1.  Get ID and Image NAme
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        //CHeck whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // IT has image and need to remove from folder
            //Get the Image Path
            $path = "images/tool/".$image_name;

            //REmove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //REdirect to Manage Tool
                header('index.php');
                //Stop the Process of Deleting Tool
                die();
            }

        }

        //3. Delete Tool from Database
        $sql = "DELETE FROM tools WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively
        //4. Redirect to Manage Tool with Session Message
        if($res==true)
        { 
	
			echo		"<script type='text/javascript'>
				alert('تم الحذف بنجاح');
				window.location = 'index.php';</script>" ;
        }
        else
        {
            //Failed to Delete Tool
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Tool.</div>";
            header('index.php');
        }

        

    }
    else
    {
        //Redirect to Manage Tool Page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('index.php');
    }

?>