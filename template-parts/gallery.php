<?php
/*
*Template Name: Galeery
*/
get_header(); ?>

<main class="container page section">
<?php while(have_posts(  )): the_post(  ); ?>
<h1 class="text-center text-primary"><?php the_title(); ?></h1>
<?php 
$gallery = get_post_gallery(get_the_ID(), false);
$gallery_images_ids = explode(',', $gallery['ids']);

echo "<pre>";
var_dump($gallery_images_ids);
echo "<pre>";
?>

<ul class="gallery-images">
<?php
$i=0;
    foreach($gallery_images_ids as $id):
        $size = ($i === 3 || $i ==6) ? 'portrait' : 'square';
        $image = wp_get_attachment_image_src($id, 'square'); ?>
        <img src="<?php echo $image[0]; ?>"/>
    <?php endforeach; ?>
    </ul>
<?php endwhile; ?>
</main>
<?php get_footer(); ?>