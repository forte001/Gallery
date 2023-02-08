<?php require_once("init.php"); 



 if (!$session->is_signed_in()){ redirect("login.php");} 


 $user = User::find_by_id($session->user_id);




?>
<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Visit Home Page</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user->username ;?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="user_profile.php?id=<?php echo $session->user_id ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                    
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>