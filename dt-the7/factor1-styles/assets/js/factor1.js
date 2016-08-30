console.log('[Success! - Factor1 JS Initialized]');

// set crucial variables
var siteURL = 'http://factor1.me/2016/tmg';

// if we are on the archive page, load initial posts
jQuery(document).ready(function(){
  if( jQuery('body').hasClass('post-type-archive-tmg_resources') ){
    console.log('Has correct body class for Rest API');
    jQuery.ajax({
      method: 'GET',
      url: siteURL + '/wp-json/wp/v2/tmg_resources/?_embed',
      data: { get_param: 'value'},
      dataType: 'json',
      success: function(posts){

        console.log('[Loaded Posts Successfully]');


        jQuery('#resource-posts').empty();

        jQuery.each(posts, function(index, value){

          // Get Post Values
          var postTitle       = this.title.rendered,
              postExcerpt     = this.excerpt.rendered,
              postDate        = this.date,
              postThumbnail   = this._embedded['wp:featuredmedia'][0].media_details.sizes.full.source_url,
              postCat         = [],
              postTag         = [],
              postTerms       = this._embedded['wp:term'],
              postPermalink   = this.link,
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

          // Determine what Terms the post is associated with
          jQuery.each(postTerms, function(i){
            //console.log(this[0].taxonomy);

            var termType = this[i].taxonomy,
                termName = this[i].name;

            if( termType == 'resource_category' ){
              postCat.push(termName);
            } else{
              postTag.push(termName);
            }

          });

          console.log(postCat);
          console.log(postTag);
          // Do the magic!
          jQuery('#resource-posts').append('<div class="row"><div class="col-3 text-center"><img src="' + postThumbnail + '"></div><div class="col-9"><h2>' + postTitle + '</h2><span class="resource-post-date">' + postDate + '</span> <span class="resource-category">' + 'postCat' + '</span> | <span class="resource-topics">Topics</span>' + 'postTag' + postExcerpt + postButton + '</div></div>');

        });

      }
    });
  }
});
