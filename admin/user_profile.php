<?php include("includes/header.php"); ?>
 

<?php
 if (!$session->is_signed_in()){ redirect("login.php");} 
 ?>

 <?php 



 if (empty($_GET['id'])) {
    redirect("users.php");
    
 } 

$user = User::find_by_id($_GET['id']);

 

 ?>


<?php include("includes/photo_library_modal.php"); ?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php include("includes/top_nav.php");?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php");?>
            
            <!-- /.navbar-collapse -->
        </nav>


        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           User Profile
                        </h1>

                        <div class="col-md-6 user_image_box">
                            <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""><a/>
                        </div>
                        <br>
                        <form action="" method="POST" enctype="multipart/form-data">
                        <div class="col-md-6 ">
                            

                            <div class="form-group">
                                <label for="username">Username : <?php echo $user->username; ?></label>
                            </div>

                            <div class="form-group">
                                <label for="first name"> First Name : <?php echo $user->first_name; ?></label>
                                
                            </div>

                            <div class="form-group">
                                <label for="last name"> Last Name : <?php echo $user->last_name; ?></label>
                               
                            </div>
                            
                            <div class="info-box-delete pull-left">
                                    <a id="user-id" href="edit_user.php?id=<?php echo $user->id ?>" class="btn btn-primary ">Edit</a>   
                                </div>
                                 

                        </div>
                        
                </form>

                        





                    </div>
                </div>





                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>