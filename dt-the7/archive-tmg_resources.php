<?php

get_header();

$categories = get_terms( 'resource_category', array(
    'hide_empty' => true,
) );

$tags = get_terms( 'resource_tag', array(
    'hide_empty' => true,
) );

?>

<section class="container">
  <div class="row">
    <div class="col-12">
      <h1>
        TMG Research Library
      </h1>
      <p>
        RIMSolutions™, the research practice of TMG Consulting, produces deep intelligence into utility company operations and the factors and technologies forcing them to change.  Publications are infused with data from TMG’s projects. While some studies are available to research members only, others are complimentary. TMG’s client companies receive an automatic research membership with unlimited individual logins.  To find out if you belong to a client company, inquire about membership, or receive a login, email <a href="mailto:research@tmgconsulting.com">research@tmgconsulting.com</a>.
      </p>
    </div>
  </div>
  <div class="row filter-row">
    <div class="col-12">
      <h2 class="filter-headline">
        Filter Resources
      </h2>
      <div class="filter-select categories">
        <span>Categories</span>
        <div class="filter-dropdown">
          <ul>
            <?php foreach($categories as $category) { ?>
            <li data-value="<?php echo $category->term_id; ?>"><?php echo esc_html($category->name); ?></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="filter-select tags">
        <span>Topics</span>
        <div class="filter-dropdown">
          <ul>
            <?php foreach($tags as $tag) { ?>
            <li data-value="<?php echo $tag->term_id; ?>"><?php echo esc_html($tag->name); ?></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <a href="#" class="filter-submit">
        Submit
      </a>
      <a href="#" class="filter-clear">
        Clear Filters
      </a>
    </div>
  </div>
</section>


<div class="contianer">
	<div class="row">
		
		
		<div class="col-3 membersidebar">
		  <?php  dynamic_sidebar('member-sidebar'); ?>
	  	</div>
	  
	  

<section id="resource-posts" class="col-9">
  <div class="row">
	  
	  
    <div class="col-10 text-center">
      <img src="<?php bloginfo('template_url');?>/factor1-styles/assets/svg/rolling.svg" alt="Loading..." class="f1-loader">
    </div>
  </div>
</section>


	</div>
</div>

<div class="container">
  <div class="row" style="margin-bottom: 20px;">
    <div class="col-10 col-centered text-center">
      <button id="load-more" class="resource-button">
        Load More
      </button>
    </div>
  </div>
</div>

<script type="text/javascript">
    window.loggedin = <?php echo is_user_logged_in() ? 'true' : 'false'; ?>;
    window.wpJsonUrl = '<?php echo addslashes(home_url().'/wp-json/wp/v2/'); ?>';
</script>

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

// Modal Logins
function openModal(){
  console.log('Button Clicked!');
  $j('#f1-modal.modal').css('display','block');
  $j('body').append('<div class="modal-mask"></div>');
}

$j('.f1-close-thik').click(function(){
  console.log('close clicked');
  $j('#f1-modal.modal').css('display','none');
  $j('.modal-mask').remove();
});

</script>

<?php
get_footer();
