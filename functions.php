<?php

/*  Register Scripts and Style */

function theme_register_scripts() {
    wp_enqueue_style( 'olympos-css', get_stylesheet_uri() );
    //wp_enqueue_script( 'olympos-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/olympos.min.js' ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'vue-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/vue.js' ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'vue-resource-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/vue-resource.js' ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'vue-router-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/vue-router.js' ), array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'ap-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'js/app.js' ), array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );


/* Add menu support */
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}

/* Add post image support */
add_theme_support( 'post-thumbnails' );


/* Add custom thumbnail sizes */
if ( function_exists( 'add_image_size' ) ) {
    //add_image_size( 'custom-image-size', 500, 500, true );
    add_image_size( '300x180', 300, 180, true );
}

/* Add widget support */
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name'          => 'SidebarOne',
        'id'            => 'SidebarOne',
	    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name'          => 'SidebarTwo',
        'id'            => 'SidebarTwo',
	    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>',
    ));


/*  EXCERPT 
    Usage:
    
    <?php echo excerpt(100); ?>
*/

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
    } else {
    $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}


/* Preapare Rest API */

function prepare_rest_post($data,$post,$request){
    $_data = $data->data;
    // get Thumbnail
    $thumbnail_id = get_post_thumbnail_id( $post->ID );
    $thumbnail300x180 = wp_get_attachment_image_src( $thumbnail_id, '300x180') ;
    $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'medium') ;
    $thumbnailMedium = wp_get_attachment_image_src( $thumbnail_id, 'medium') ;
    $thumbnailLarge = wp_get_attachment_image_src( $thumbnail_id, 'large') ;
    $thumbnailFull = wp_get_attachment_image_src( $thumbnail_id, 'full') ;

    // Get Categories
    $cats = get_the_category( $post->ID );

    $_data['mi_300x180'] = $thumbnail300x180[0];
    $_data['mi_thumbnail'] = $thumbnail[0];
    $_data['mi_medium'] = $thumbnailMedium[0];
    $_data['mi_large'] = $thumbnailLarge[0];
    $_data['mi_full'] = $thumbnailFull[0];
    $_data['mi_category'] = $cats;
    $data->data = $_data;

    return $data;
}

add_filter( 'rest_prepare_post', 'prepare_rest_post',10,3);

function prepare_rest_books($data,$post,$request){
    $_data = $data->data;

    $thumbnail_id = get_post_thumbnail_id( $post->ID );
    $thumbnail300x180 = wp_get_attachment_image_src( $thumbnail_id, '300x180') ;
    $thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'medium') ;
    $thumbnailMedium = wp_get_attachment_image_src( $thumbnail_id, 'medium') ;
    $thumbnailLarge = wp_get_attachment_image_src( $thumbnail_id, 'large') ;
    $thumbnailFull = wp_get_attachment_image_src( $thumbnail_id, 'full') ;

    $_data['mi_300x180'] = $thumbnail300x180[0];
    $_data['mi_thumbnail'] = $thumbnail[0];
    $_data['mi_medium'] = $thumbnailMedium[0];
    $_data['mi_large'] = $thumbnailLarge[0];
    $_data['mi_full'] = $thumbnailFull[0];
    $data->data = $_data;

    return $data;
}
add_filter( 'rest_prepare_books', 'prepare_rest_books', 10, 3 );