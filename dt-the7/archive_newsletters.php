<?php

/**
 * Template Name: #tmgtrending Newsletter Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive  
 */
 
get_header();?>
    
    <p><em>&#35;tmgtrending, TMG Consulting’s Monthly Market and Company Report, includes important industry headlines, key findings from TMG’s research practice,<a href="http://tmgconsulting.com/market-intelligence" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://tmgconsulting.com/market-intelligence&amp;source=gmail&amp;ust=1474642597336000&amp;usg=AFQjCNERtPh3-TQF_xtzp2vaZaABbANz8w">RIMSolutions™</a>, and TMG-specific corporate updates and opportunities. Reinvented in September 2016 for busy business professionals, it offers a heightened level of valuable content through a streamlined one page report.</em></p>

<?php
$args = array('post_type' => 'newsletters');

$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
				
		while( $loop->have_posts() ): $loop->the_post(); global $post;
		
		$file = get_field('pdf');

		echo '<div class="one-fourth">';
		echo '<div class="newsletter_thumbnail">';
		echo '<a href="' . $file . '">';
		echo get_the_post_thumbnail( $post_id, 'medium');
		echo '</a></div>';
		echo '<h3>' . get_the_title() . '</h3>';
		echo '</div>';
		endwhile;
		
	endif;
get_footer();