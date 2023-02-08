<?php include("includes/init.php"); ?>

<?php if (!$session->is_signed_in()){ redirect("login.php");} ?>

    <?php 

if (empty($_GET['id'])) {

    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {

    $comment->delete();
    $session->message("Comment with id {$comment->id} was deleted");
    redirect("comments.php");

} else {
    echo "Could not delete comment";
    redirect("comments.php");
} 



    ?>   