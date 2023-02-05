
<?php include('header.php'); ?>


 <div class="container-fluid">
            
         <img src="images/banner-4.jpg" alt=" Logo" class="img-rounded"  width="100%" height="100%">

        </div>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">تواصل معنا</h2>

<style type="text/css">
   
        .wrapper{ width: 700px; margin-left: auto;
    margin-right: auto; justify-content: center;}
	.text{ width: 800px; margin-left: auto;
    margin-right: auto; justify-content: center;}
    </style>

<div id="page-container" style="margin-top:50px; position: relative;">
  <div class="container">
  <div id="content-wrap" style="padding-bottom:50px;">
   
    <div class="wrapper">
      <div class="col-lg-12 mb-4">
        <h3 style="text-align: center;">ارسل رسالتك إلينا</h3>
        <form name="sentMessage"  method="post" style="text-align:right;">
            <div class="control-group form-group">
                <div class="controls">
                    <label >الاسم:</label>
                    <input type="text" class="form-control" id="name" name="fullname" required>
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>رقم الجوال:</label>
                    <input type="tel" class="form-control" id="phone" name="contactno"  required >
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>البريد الالكتروني:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>الرسالة:</label>
                    <textarea rows="10" cols="100" class="form-control" id="message" name="message" required  maxlength="999" style="resize:none"></textarea>
                </div>
            </div>
            <button type="submit" name="send"  class="btn btn-primary">ارسال</button>
        </form>
    </div>
    
</div>
<!-- /.row -->


</div>
</div>

</div>


            

            <div class="clearfix"></div>
        </div>
    </section>
   


    <?php include('footer.php'); ?>