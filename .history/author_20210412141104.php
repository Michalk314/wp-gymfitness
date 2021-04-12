<?php get_header(); ?>

<main class="container page section">
    <?php
    $author = get_queried_object();
    ?>

    <h2 class="text-center primary-text">Author: <?php echo $author->data->display_name; ?></h2>

    <p class="text-center"><?php echo get_the_author_meta('description', $author->data->ID) ?></p>
    <ul class="blog-entries">
        <?php while (have_posts()) : the_post(); ?>
            <li class="card gradient">
                <?php the_post_thumbnail('mediumSize') ?>
                <div class="card-content">
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                    </a>

                    <p class="meta"> <span>By: </span>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                            <?php echo get_the_author_meta('first_name'); ?>
                        </a>
                    </p>

                    <p class="date-published meta">
                        <span>Date: </span>
                        <?php the_time(get_option('date_format')); ?>
                    </p>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
</main>

<?php get_footer(); ?>