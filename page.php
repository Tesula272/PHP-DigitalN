<?php 
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post(); 
		
		// Post Content here
		the_title(); // Această linie de cod va afișa titlul postării	
		the_content();	// Această linie de cod va afișa continutul postării	

	} // end while
} // end if
wp_link_pages();
?>
