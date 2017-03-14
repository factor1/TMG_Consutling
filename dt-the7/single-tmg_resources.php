<?php get_header();
if( have_posts() ):
  while( have_posts() ): the_post();
?>

<section id="resource-single-header" class="container">
  <div class="row">
    <div class="col-12">
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
      </div>
</section>

<?php
// Show Content or form based on user status
if( is_user_logged_in() === true || is_user_logged_in() === false && get_field('resource_type') === 'members' ): ?>
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
              <a class="resource-button f1login" href="<?php echo esc_url(home_url(get_field('resource_upload')));?>">Download</a>
            <?php else:
              // if the resource is members only
              if( get_field('resource_type') == 'members' ): ?>
                <a class="resource-button f1login">
                  Login To Download
                </a>
              <?php else:
                // ssshhh
              endif;
            endif; ?>
          </div>
        </div>
      </div>
    </div>
  </article>

<?php else: ?>
  <article id="single-resource" class="container">
    <div class="row">
      <div class="col-4 resource-single-image">
        <?php the_post_thumbnail('resource_single'); ?>
      </div>
      <div class="col-8">
        <p>Please fill out the form below to access your resource.</p>
        <?php
        gravity_form( 22, false, false, false, '', false );
        ?>
      </div>
    </div>
  </article>
<?php endif;


  endwhile;
endif;?>

<div id="f1-modal" class="modal">
  <div class="container">
    <div class="row" style="margin-bottom: 30px;">
      <div class="col-6 col-end text-right">
        <a href="#" class="f1-close-thik"></a>
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-left">
        <h2 class="text-center">
          Login to Access Resources
        </h2>
        <?php wp_login_form(); ?>
      </div>
      <div class="col-12 text-center">
        <p>
          Not a member? <a href="<?php echo get_home_url();?>/contact/">Contact us</a>
          for more information about membership.
        </p>
        <p>
          <a href="<?php echo wp_lostpassword_url(); ?>">
            Forgot Password?
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

<script>
// Modal JS
var $j = jQuery.noConflict();

$j('.f1login').click(function() {
  console.log('button clicked');
  $j('#f1-modal.modal').css('display','block');
  $j('body').append('<div class="modal-mask"></div>');
});

$j('.f1-close-thik').click(function(){
  console.log('close clicked');
  $j('#f1-modal.modal').css('display','none');
  $j('.modal-mask').remove();
});
</script>

<?php
get_footer(); ?>
