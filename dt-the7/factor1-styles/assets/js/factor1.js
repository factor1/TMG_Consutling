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
        jQuery.map(posts, function(value, index){
          console.log(id);
        });
      }
    });
  }
});
