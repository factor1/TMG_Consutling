<?php get_header();
if( have_posts() ):
  while( have_posts() ): the_post();
?>

<section id="resource-single-header" class="container">
  <div class="row">
    <div class="col-9">
      <h1>
        <?php the_title();?>
      </h1>
      <span class="resource-post-date">
        <?php the_date('F d, Y'); ?>
      </span>
      <span class="resource-category">
        <?php
        $terms = get_the_terms( get_the_ID(), 'resource_category' );

        if ( $terms && ! is_wp_error( $terms ) ) :
          foreach ( $terms as $term ) {
            echo '<a href="'. esc_url( get_term_link( $term ) ) .'">';
            echo $term->name;
            echo '</a>';
          }
        endif; ?>
      </span>
      |
      <span class="resource-topics">
        Topics:
        <?php
        $terms = get_the_terms( get_the_ID(), 'resource_tag' );

        if ( $terms && ! is_wp_error( $terms ) ) :
          foreach ( $terms as $term ) {
            echo '<a href="'. esc_url( get_term_link( $term ) ) .'">';
            echo $term->name;
            echo '</a> ';
          }
        endif; ?>
      </span>
    </div>
    <div class="col-3 text-right">
      <?php
      // Logic for if user is logged in
      if( is_user_logged_in() ): ?>
        <a href="<?php the_field('resource_upload');?>" class="resource-button">
          Download
        </a>
      <?php else:
        // if the resource is members only
        if( get_field('resource_type') == 'members' ): ?>
          <a href="#" class="resource-button">
            Login To Download
          </a>
        <?php else: ?>
          <p>
            Fill out the form below to access your download.
          </p>
        <?php endif;
      endif; ?>
    </div>
  </div>
</section>

<?php
// Show Content or form based on user status
if( is_user_logged_in() ): ?>
  <article id="single-resource" class="container">
    <div class="row">
      <div class="col-4 resource-single-image">
        <?php the_post_thumbnail('resource_single'); ?>
      </div>
      <div class="col-8">
        <div class="row">
          <div class="col-12">
            <?php the_content(); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
            <?php
            // Logic for if user is logged in
            if( is_user_logged_in() ): ?>
              <a href="<?php the_field('resource_upload');?>" class="resource-button">
                Download
              </a>
            <?php else:
              // if the resource is members only
              if( get_field('resource_type') == 'members' ): ?>
                <a href="#" class="resource-button">
                  Login To Download
                </a>
              <?php else: ?>
                <p>
                  Fill out the form below to access your download.
                </p>
              <?php endif;
            endif; ?>
          </div>
        </div>
      </div>
    </div>
  </article>
<?php endif;


  endwhile;
endif;
get_footer(); ?>
