
<?php $post_id = get_the_ID();?>
<!--<h1>--><?php //the_tite(); ?><!--</h1>-->
<p> <?php echo get_field('exercises', $post_id )?></p>




<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file" />
    <input type="submit" name="submit" value="Upload File" />
</form>