<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()){ redirect("login.php");} ?>

    <?php 

if (empty($_GET['id'])) {

    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if ($user) {
 $session->message("User: {$user->name} has been deleted.");
    $user->delete();
    redirect("users.php");

} else {
    echo "Could not delete user";
    redirect("users.php");
}



    ?>   