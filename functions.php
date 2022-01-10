<?php

//wp_enqueue_style( 'slider', get_template_directory_uri() . 'themes/tesula-ancuta/style.css',false,'1.1','all');

//wp_enqueue_style( 'slider', get_template_directory_uri() . 'bootstrap5/css/bootstrap.min.css',false,'1.1','all');
//wp_enqueue_script( 'script', get_template_directory_uri() . 'bootstrap5/js/bootstrap.min.js', array ( 'jquery' ), 1.1, true);




if ( ! function_exists( 'theme_setup' ) ) {
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which runs
		 * before the init hook. The init hook is too late for some features, such as indicating
		 * support post thumbnails.
		 */
		function theme_setup() {
		 
		    /**
		     * Make theme available for translation.
		     * Translations can be placed in the /languages/ directory.
		     */
		    load_theme_textdomain( 'text_domain', get_template_directory() . '/languages' );
		 
		    /**
		     * Add default posts and comments RSS feed links to <head>.
		     */
		    add_theme_support( 'automatic-feed-links' );
		 
		    /**
		     * Enable support for post thumbnails and featured images.
		     */
		    add_theme_support( 'post-thumbnails' );
		 
		    /**
		     * Add support for two custom navigation menus.
		     */
		    register_nav_menus( array(
		        'primary'   => __( 'Primary Menu', 'text_domain' ),
		        'secondary' => __('Secondary Menu', 'text_domain' )
		    ) );
		 
		    /**
		     * Enable support for the following post formats:
		     * aside, gallery, quote, image, and video
		     */
		    add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
		}
} // theme_setup
add_action( 'after_setup_theme', 'theme_setup' );
;


function add_theme_scripts() {
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.cs' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array('bootstrap'), filemtime( get_stylesheet_directory() . '/style.css') );
	
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js', array ( 'jquery' ), 1.1, true);
	
	  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	  }
  }
  add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );


  

  // Register Custom Navigation Walker
//require_once get_template_directory() . '/wp-bootstrap-navwalker.php';






/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

//add_action( 'after_setup_theme', 'themename_custom_logo_setup');
//add_action('widgets_init' , 'my_awesome_sidebar');
