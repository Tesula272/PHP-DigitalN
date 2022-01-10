<?php get_header(); ?>




<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		
		// Post Content here
		echo "<h1><a href=" . get_the_permalink() . ">" . get_the_title() . "</a></h1>" ; // Această linie de cod va afișa titlul postării	
        
        echo '<br>';
        the_excerpt();
		get_template_part( 'template-parts/post/content-excerpt.php');
		

	} // end while
} // end if


?>


<?php
the_posts_pagination( array ('prev_next' => false)) ; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>