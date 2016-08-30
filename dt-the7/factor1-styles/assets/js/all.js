console.log('[Success! - Factor1 JS Initialized]');

// set crucial variables
var siteURL = 'http://factor1.me/2016/tmg';

// if we are on the archive page, load initial posts
jQuery(document).ready(function(){
  if( jQuery('body').hasClass('post-type-archive-tmg_resources') ){
    console.log('Has correct body class for Rest API');
    jQuery.ajax({
      method: 'GET',
      url: siteURL + '/wp-json/wp/v2/tmg_resources/',
      data: { get_param: 'value'},
      dataType: 'json',
      success: function(posts){

        console.log('[Loaded Posts Successfully]');

        if( loggedin === false ){
          console.log('Not logged in!');
        } else{
          console.log('User is logged in!');
        }

        jQuery('#resource-posts').empty();

        jQuery.each(posts, function(index, value){

          //testing purposes only
          console.log(value);

          // Get Post Values
          var postTitle       = this.title.rendered,
              postExcerpt     = this.excerpt.rendered,
              postDate        = this.date,
              postThumbnail   = this.featured_media,
              postCat         = this.resource_category[0],
              postTag         = this.resource_tag,
              postPermalink   = this.link,
              resourceType    = this.acf.resource_type,
              resourceUpload  = this.acf.resource_upload;


          jQuery('#resource-posts').append('<div class="row"><div class="col-3 text-center">Featured Image</div><div class="col-9"><h2>' + postTitle + '</h2><span class="resource-post-date">' + postDate + '</span> <span class="resource-category">' + postCat + '</span> | <span class="resource-topics">Topics</span>' + postTag + postExcerpt + '</div></div>');

        });

      }
    });
  }
});
