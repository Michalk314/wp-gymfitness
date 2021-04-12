<?php

//Link to the queries file
function gymfitness_classes_list($number = -1)
{ ?>
    <ul class="classes-list">
        <?php
        $args = array(
            'post_type' => 'gymfitness_classes',
            'posts_per_page' => $number,
        );
        //use wp_querry and appedn the results into $classes
        $classes = new WP_Query($args);

        while ($classes->have_posts()) : $classes->the_post();
        ?>
            <li class="gym-class card gradient">
                <?php the_post_thumbnail('mediumSize'); ?>
                <div class="card-content">
                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                    </a>
                    <?php
                    $sart_time = get_field('start_time');
                    $end_time = get_field('end_time');
                    ?>

                    <p><?php the_field('class_days');
                        echo $sart_time . " to " . $end_time  ?></p>

                </div>

            </li>
        <?php endwhile;
        wp_reset_postdata(); ?>

    </ul>
<?php
}
function gymfitness_home_list()
{
    echo "from the home.php";
}

//CREATE A MENUS
function gymfitness_menus()
{
    //Wordpress function
    register_nav_menus(array(
        'main-menu' => 'Main Menu'
    ));
}

//hook
add_action('init', 'gymfitness_menus');

//adds stylesheets and js

function gymfitness_scripts()
{
    //Normalize CSS
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0.1');
    //google font
    wp_enqueue_style('googlefont', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap', array(), "1.0.0");
    wp_enqueue_style('style', get_stylesheet_uri(), array('normalize', 'googlefont'));
    wp_enqueue_style('slicknavcss', get_template_directory_uri() . '/css/slicknav.min.css', array(), '1.0.10');
    if (is_front_page()) :
        wp_enqueue_style('bxslidercss', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css', array(), '4.2.12');
    endif;
    wp_enqueue_script('jquery');
    wp_enqueue_script('slicknavjs', get_template_directory_uri() . '/js/jquery.slicknav.min.js', '1.0.10', true);
    if (is_front_page()) :
        wp_enqueue_script('bxsliderjs', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '4.2.12', true);
    endif;
    wp_enqueue_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'gymfitness_scripts', "1.0.0");


//Enable images and other stuff

function gymfitness_setup()
{
    //register new image size
    add_image_size('square', 350, 350, true);
    add_image_size('portrait', 350, 724, true);
    add_image_size('box', 400, 375, true);
    add_image_size('mediumSize', 700, 400, true);
    add_image_size('blog', 966, 644, true);
    //add image
    add_theme_support('post-thumbnails');

    //seo titles
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'gymfitness_setup'); //when the theme is activated and ready


//Create a widget zone

function gymfitness_widgets()
{
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="text-primary">',
        'after_title' => '</h3>'
    ));
}

add_action('widgets_init', 'gymfitness_widgets');

/** Displays the hero image on background of the front-page **/

function gymfitness_hero_image()
{
    $front_page_id = get_option('page_on_front');
    $image_id = get_field('hero_image', $front_page_id);

    $image = $image_id['url'];

    //Create a FALSE stylesheet
    wp_register_style('custom', false);
    wp_enqueue_style('custom');

    $featured_image_css = "
   body.home .site-header {
       background-image: url ( $image );
   }
   ";

    wp_add_inline_style('custom', $featured_image_css);
}

add_action('init', 'gymfitness_hero_image');
