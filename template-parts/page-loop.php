<?php while(have_posts(  )): the_post(  ); ?>
<h1 class="text-center text-primary"><?php the_title(); ?></h1>

 <?php the_post_thumbnail('blog', array('class' => 'feature-image'));
 
 //chcec the current post typ

 if( get_post_type() === 'gymfitness_classes'):
    
    $sart_time = get_field('start_time');
    $end_time = get_field('end_time');
    ?>
    
    <p class="content-class"><?php the_field('class_days'); echo $sart_time . " to " . $end_time  ?></p>
 <?php endif; ?>
 
 

 

<?php the_content(); ?>

<?php endwhile; ?>