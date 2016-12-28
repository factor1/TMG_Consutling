;(function($) {

    console.log('[Success! - Factor1 JS Initialized]');

    // if we are on the archive page, load initial posts
    $(document).ready(function() {

        // if we are not on the archive page, skip
        if(!$('body.post-type-archive-tmg_resources').length) {
            return;
        }

        // Load elements
        var posts$ = $('#resource-posts');
        var loggedin = window.loggedin || false;
        var wpJsonUrl = window.wpJsonUrl || '';

        // If no wpJsonUrl set, bail
        if(!wpJsonUrl) {
            return;
        }

        // Resource API Wrapper
        var resources = {

            fetch: function() {

                // Send request & get response
                $.get(wpJsonUrl+'tmg_resources/?_embed&per_page=20',{
                    get_param: 'value',
                    category: $('div.filter-select.categories').data('value'),
                    tag: $('div.filter-select.tags').data('value')
                },function(data) {

                    // Clear the previous list
                    posts$.empty();

                    // No data, bail early
                    if(!data || !data.length) {
                        return;
                    }

                    // Prepare the posts data into standardized format
                   var posts = data.map(function(obj) {

                        // Prepare standardized list format for terms
                        var terms = [];
                        var wp_term = obj._embedded['wp:term'] || [];
                        wp_term.forEach(function(taxonomy) {
                            taxonomy.forEach(function(term) {
                                terms.push({
                                    id: term.id,
                                    name: term.name,
                                    link: term.link,
                                    taxonomy: term.taxonomy
                                });
                            });
                        });

                        // Prepare the list of categories
                        var categories = terms.filter(function(term) {
                            return term.taxonomy === 'resource_category';
                        });

                        // Prepare the list tags
                        var tags = terms.filter(function(term) {
                            return term.taxonomy === 'resource_tag';
                        });

                        // Prepare the date value
                        var post_date = new Date(Date.parse(obj.date));

                        var wp_media = obj._embedded['wp:featuredmedia'] || [];

                        // Prepare the base post
                        var post = {
                            id: obj.id || '',
                            title: obj.title.rendered || '',
                            date: post_date.toDateString(),
                            link: obj.link || '',
                            thumbnail: (wp_media && wp_media[0].media_details) ? wp_media[0].media_details.sizes.resources.source_url : '',
                            excerpt: obj.excerpt.rendered || '',
                            categories: categories,
                            tags: tags,
                            //terms: terms,
                            resourceType: obj.acf.resource_type,
                            resourceUpload: obj.acf.resource_upload
                        };

                        // Add buttons for post based on user and type
                        post.button = (function() {

                            // Check for not logged in
                            if(!loggedin) {

                                // Resource free, provide download
                                if(post.resourceType === 'free') {
                                    return '<a href="' + post.link + '" class="resource-button">Download</a>';
                                }

                                // Not Free, require login to download
                                return '<a class="resource-button f1login" onClick="openModal()">Login to download</a>';
                            }

                            // Logged in and resource free
                            if(post.resourceType === 'free') {
                                return '<a href="' + post.link + '" class="resource-button">Download</a>';
                            }

                            // Returns members only download
                            return '<a href="' + post.link + '" class="resource-button">Download</a>';

                        })();

                        return post;
                    });

                    // Add new posts from list
                    posts.forEach(function(post) {

                        posts$.append(
                            '<div class="row" style="margin-bottom: 40px;">'+
                                '<div class="col-3 text-center">'+
                                    '<img src="'+post.thumbnail+'" />'+
                                '</div>'+
                                '<div class="col-9">'+
                                    '<h2 class="resource-title">'+post.title+'</h2>'+
                                    '<span class="resource-post-date">'+post.date+'</span> '+
                                    '<span class="resource-category">'+post.categories.map(function(term) { return term.name; }).join(', ')+'</span> | '+
                                    '<span class="resource-topics">Topics:</span> '+post.tags.map(function(term) { return term.name; }).join(', ')+' '+
                                    '<div class="resource-excerpt">'+post.excerpt+post.button+'</div>'+
                                '</div>'+
                            '</div>'
                        );

                    });

                },'json');

            } // end fetch

        }; // end resources

        // Handle dropdown open
        $(document).on('click','div.filter-select',function(e) {
            $(this).toggleClass('active');
        });

        // Handle dropdown item selection
        $(document).on('click','div.filter-dropdown li',function(e) {

            var select$ = $(this).closest('.filter-select');
            var label$ = select$.children('span:first-child');

            select$.data('value',$(this).data('value'));
            label$.html($(this).text());

        });

        // Handle filter submit
        $(document).on('click','a.filter-submit',function(e) {
            e.preventDefault();
            resources.fetch();
        });

        // Handle filter clear
        $(document).on('click','a.filter-clear',function(e) {
            e.preventDefault();
            $('div.filter-select.categories').removeClass('active').data('value','').children('span:first-child').html('Categories');
            $('div.filter-select.tags').removeClass('active').data('value','').children('span:first-child').html('Topics');
            resources.fetch();
        });

        // Reset and load all posts initially
        $('a.filter-clear').click();

    });

})(jQuery);
