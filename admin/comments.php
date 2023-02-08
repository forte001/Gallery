<?php include("includes/header.php"); ?>
<?php
 if (!$session->is_signed_in()){ redirect("login.php");} 
 ?>

 <?php 

 // Pagination

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$items_total_count = Comment::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM comments ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()} ";

$comments = Comment::find_by_query($sql);


 ?>

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
                            COMMENTS
                            
                        </h1>
                        <p class="bg-success">
                            <?php echo $message; ?>
                        </p>
                

                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
        
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($comments as $comment):?> 
                                    <tr>
                                        <td><?php echo $comment->id; ?></td>
                                        
                                        <td><?php echo $comment->author; ?>
                                            <div class="action_links">
                                                <!-- <a href="">View</a> | 
                                                <a href="edit_comment.php?id=<?php echo $comment->id ?>">Edit</a> | -->
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>

                                             </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>  <!--End of table -->
                            
                        </div>

                         <div class="row">

                            <ul class="pager">
                            <?php 
                            if ($paginate->total_pages() > 1) {

                                if($paginate->has_next()){

                                    echo "<li class='next'><a href='comments.php?page={$paginate->next()}'>Next</a></li>";

                                }

                               

                                if ($paginate->has_previous()){

                                     echo "<li class='previous'><a href='comments.php?page={$paginate->previous()}'>Previous</a></li>";
                                }

                            }

                             for ($i=1; $i <= $paginate->total_pages(); $i++){

                                    if($i == $paginate->current_page){
                                         echo "<li class='active'><a href='comments.php?page={$i}'>$i</a></li>";
                                    } else {

                                        echo "<li><a href='comments.php?page={$i}'>$i</a></li>";

                                    }
                                }

                            ?>
                            
                        </ul>
                    </div>
                                





                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>