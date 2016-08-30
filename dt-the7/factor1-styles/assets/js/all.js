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
              postThumbnailURL= '',
              resourceType    = this.acf.resource_type,
              resourceUpload  = this.acf.resource_upload;

          // Check if user is logged in to determine button outputs
          if( loggedin === false ){
            console.log('[User not logged in]');
            if( resourceType == "free" ){
              postButton = '<a href="' + postPermalink + '" class="resource-button">Download</a>';
            } else{
              postButton = '<a href="#" class="resource-button">Login to download</a>';
            }
          } else{
            // User is logged in...
            console.log('[User is logged in]');

            // determine the resource type
            if( resourceType == "free" ){
              postButton = '<a href="' + resourceUpload + '" class="resource-button">Download</a>';
            } else{
              // members only content
              postButton = '<a href="' + postPermalink + '" class="resource-button">Download</a>';
            }
          }

          // Get Post Thumbnail URL
          var getThumbnail = function(){
            if( postThumbnail !== 0 ){
              jQuery.ajax({
                method: 'GET',
                url: siteURL + '/wp-json/wp/v2/media/' + postThumbnail,
                data: { get_param: 'value'},
                dataType: 'json',
                success: function(image){
                  console.log('[Successfully fetched featured image id'+ postThumbnail +']');
                  return '<img src="' + image.media_details.sizes.full.source_url + '" alt="' + postTitle + '">';
                },
                error: function(){
                  console.log('[Fetching featured image failed!]');
                }
              });
            }
          };


          // Do the magic!
          jQuery('#resource-posts').append('<div class="row"><div class="col-3 text-center">' + 'getThumbnail()' + '</div><div class="col-9"><h2>' + postTitle + '</h2><span class="resource-post-date">' + postDate + '</span> <span class="resource-category">' + postCat + '</span> | <span class="resource-topics">Topics</span>' + postTag + postExcerpt + postButton + '</div></div>');

        });

      }
    });
  }
});
