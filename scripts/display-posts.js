"use strict"; 
var { registerBlockType } = wp.blocks;
var gcel = wp.element.createElement;

registerBlockType( 'ultimate-manga-scraper/ums-display', {
    title: 'Ultimate Mange Scraper Display Posts',
    icon: 'smartphone',
    category: 'embed',
    attributes: {
        ruletype : {
            default: '',
            type:   'string',
        },
        ruleid : {
            default: '',
            type:   'string',
        },
        wrapper : {
            default: 'ul',
            type:   'string',
        },
        read_more_text : {
            default: '',
            type:   'string',
        },
        wrapper_class : {
            default: 'display-posts-listing',
            type:   'string',
        },
        excerpt_font_size : {
            default: '100%',
            type:   'string',
        },
        title_font_size : {
            default: '100%',
            type:   'string',
        },
        link_to_source : {
            default: 'no',
            type:   'string',
        },
        excerpt_color : {
            default: '#000000',
            type:   'string',
        },
        title_color : {
            default: '#000000',
            type:   'string',
        },
        posts_per_page : {
            default: '10',
            type:   'string',
        },
        post_type : {
            default: 'post',
            type:   'string',
        },
        orderby : {
            default: 'date',
            type:   'string',
        },
        no_posts_message : {
            default: 'No posts found.',
            type:   'string',
        },
        include_title : {
            default: 'true',
            type:   'string',
        },
        include_link : {
            default: 'true',
            type:   'string',
        },
        include_excerpt : {
            default: 'false',
            type:   'string',
        },
        include_date : {
            default: 'false',
            type:   'string',
        },
        include_content : {
            default: 'false',
            type:   'string',
        },
        include_author : {
            default: 'false',
            type:   'string',
        },
        image_size : {
            default: 'false',
            type:   'string',
        },
        excerpt_more : {
            default: 'false',
            type:   'string',
        },
        excerpt_more_link : {
            default: 'false',
            type:   'string',
        },
        excerpt_length : {
            default: 'false',
            type:   'string',
        },
        date_format : {
            default: '(n/j/Y)',
            type:   'string',
        },
        content_class : {
            default: 'content',
            type:   'string',
        },
        author : {
            default: '',
            type:   'string',
        }
    },
    keywords: ['display', 'posts', 'ums'],
    edit: (function( props ) {
		var ruletype = props.attributes.ruletype;
        var ruleid = props.attributes.ruleid;
        var wrapper = props.attributes.wrapper;
        var read_more_text = props.attributes.read_more_text;
        var wrapper_class = props.attributes.wrapper_class;
        var excerpt_font_size = props.attributes.excerpt_font_size;
        var title_font_size = props.attributes.title_font_size;
        var excerpt_color = props.attributes.excerpt_color;
        var title_color = props.attributes.title_color;
        var posts_per_page = props.attributes.posts_per_page;
        var post_type = props.attributes.post_type;
        var orderby = props.attributes.orderby;
        var no_posts_message = props.attributes.no_posts_message;
        var include_title = props.attributes.include_title;
        var include_link = props.attributes.include_link;
        var include_excerpt = props.attributes.include_excerpt;
        var include_date = props.attributes.include_date;
        var include_content = props.attributes.include_content;
        var include_author = props.attributes.include_author;
        var image_size = props.attributes.image_size;
        var excerpt_more = props.attributes.excerpt_more;
        var excerpt_more_link = props.attributes.excerpt_more_link;
        var excerpt_length = props.attributes.excerpt_length;
        var date_format = props.attributes.date_format;
        var content_class = props.attributes.content_class;
        var author = props.attributes.author;
		function updateMessage( event ) {
            props.setAttributes( { ruletype: event.target.value} );
		}
        function updateMessage2( event ) {
            props.setAttributes( { ruleid: event.target.value} );
		}
        function updateMessage3( event ) {
            props.setAttributes( { wrapper: event.target.value} );
		}
        function updateMessage4( event ) {
            props.setAttributes( { read_more_text: event.target.value} );
		}
        function updateMessage5( event ) {
            props.setAttributes( { wrapper_class: event.target.value} );
		}
        function updateMessage6( event ) {
            props.setAttributes( { excerpt_font_size: event.target.value} );
		}
        function updateMessage7( event ) {
            props.setAttributes( { title_font_size: event.target.value} );
		}
        function updateMessage8( event ) {
            props.setAttributes( { excerpt_color: event.target.value} );
		}
        function updateMessage9( event ) {
            props.setAttributes( { title_color: event.target.value} );
		}
        function updateMessage10( event ) {
            props.setAttributes( { posts_per_page: event.target.value} );
		}
        function updateMessage11( event ) {
            props.setAttributes( { post_type: event.target.value} );
		}
        function updateMessage12( event ) {
            props.setAttributes( { orderby: event.target.value} );
		}
        function updateMessage13( event ) {
            props.setAttributes( { no_posts_message: event.target.value} );
		}
        function updateMessage14( event ) {
            props.setAttributes( { include_title: event.target.value} );
		}
        function updateMessage15( event ) {
            props.setAttributes( { include_link: event.target.value} );
		}
        function updateMessage16( event ) {
            props.setAttributes( { include_excerpt: event.target.value} );
		}
        function updateMessage17( event ) {
            props.setAttributes( { include_date: event.target.value} );
		}
        function updateMessage18( event ) {
            props.setAttributes( { include_content: event.target.value} );
		}
        function updateMessage19( event ) {
            props.setAttributes( { include_author: event.target.value} );
		}
        function updateMessage20( event ) {
            props.setAttributes( { image_size: event.target.value} );
		}
        function updateMessage21( event ) {
            props.setAttributes( { excerpt_more: event.target.value} );
		}
        function updateMessage22( event ) {
            props.setAttributes( { excerpt_more_link: event.target.value} );
		}
        function updateMessage23( event ) {
            props.setAttributes( { excerpt_length: event.target.value} );
		}
        function updateMessage24( event ) {
            props.setAttributes( { date_format: event.target.value} );
		}
        function updateMessage25( event ) {
            props.setAttributes( { content_class: event.target.value} );
		}
        function updateMessage26( event ) {
            props.setAttributes( { author: event.target.value} );
		}
		return gcel(
			'div', 
			{ className: 'coderevolution_gutenberg_div' },
            gcel(
				'h4',
				{ className: 'coderevolution_gutenberg_title' },
                'Ultimate Mange Scraper Display Posts ',
                gcel(
                    'div', 
                    {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                    ,
                    gcel(
                        'div', 
                        {className:'bws_hidden_help_text'},
                        'This block is used to display posts generated by this plugin. It has many features that can be customized.'
                    )
                )
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Rule Type: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the source of the posts that will be listed.'
                )
            ),
			gcel(
				'select',
				{ value: ruletype, onChange: updateMessage, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 0},
                    'APKs to Posts'
                ),
                gcel(
                    'option',
                    { value: 0},
                    'Custom Page Import'
                ),
                gcel(
                    'option',
                    { value: ''},
                    'Any'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Rule ID: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the ID of the rule you wish to list posts from. To list all posts from a specific rule, leave this field blank.'
                )
            ),
			gcel(
				'input',
				{ type:'number',min:0,placeholder:'Rule id to list', value: ruleid, onChange: updateMessage2, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Wrapper: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the wrapper type that will be used for displaying results.'
                )
            ),
            gcel(
				'select',
				{ value: wrapper, onChange: updateMessage3, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'ul'},
                    'List'
                ), 
                gcel(
                    'option',
                    { value: 'div'},
                    'Div'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Read More Text: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the text that will be displayed for the "Read More" link.'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'Read more...', value: read_more_text, onChange: updateMessage4, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Wrapper Class: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the class that will be used for wrapping results.'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'div class', value: wrapper_class, onChange: updateMessage5, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Excerpt Font Size: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the font size of the excerpt (CSS font size supported).'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'10px', value: excerpt_font_size, onChange: updateMessage6, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Title Font Size: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the font size of the title (CSS font size supported).'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'12px', value: title_font_size, onChange: updateMessage7, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Excerpt Color: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the color of the excerpt (CSS font color supported).'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'#000000', value: excerpt_color, onChange: updateMessage8, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Title Color: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the color of the title (CSS font color supported).'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'#000000', value: title_color, onChange: updateMessage9, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Posts Per Page: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the number of posts to be shown at max.'
                )
            ),
			gcel(
				'input',
				{ type:'number',min:1,placeholder:'10', value: posts_per_page, onChange: updateMessage10, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Post Type: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the post type to be listed. You can input a comma separated list of multiple post types (custom post types supported).'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'post', value: post_type, onChange: updateMessage11, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Order By: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select how to order results.'
                )
            ),
            gcel(
				'select',
				{ value: orderby, onChange: updateMessage12, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'none'},
                    'none'
                ), 
                gcel(
                    'option',
                    { value: 'date'},
                    'date'
                ), 
                gcel(
                    'option',
                    { value: 'ID'},
                    'ID'
                ), 
                gcel(
                    'option',
                    { value: 'author'},
                    'author'
                ), 
                gcel(
                    'option',
                    { value: 'title'},
                    'title'
                ), 
                gcel(
                    'option',
                    { value: 'name'},
                    'name'
                ), 
                gcel(
                    'option',
                    { value: 'type'},
                    'type'
                ), 
                gcel(
                    'option',
                    { value: 'modified'},
                    'modified'
                ), 
                gcel(
                    'option',
                    { value: 'parent'},
                    'parent'
                ), 
                gcel(
                    'option',
                    { value: 'rand'},
                    'rand'
                ), 
                gcel(
                    'option',
                    { value: 'comment_count'},
                    'comment_count'
                ), 
                gcel(
                    'option',
                    { value: 'relevance'},
                    'relevance'
                ), 
                gcel(
                    'option',
                    { value: 'menu_order'},
                    'menu_order'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'No Posts Message: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the message that will be shown when no posts found.'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'No posts found.', value: no_posts_message, onChange: updateMessage13, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Include Title: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to include the title in results.'
                )
            ),
            gcel(
				'select',
				{ value: include_title, onChange: updateMessage14, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                ), 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Include Link: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to include the link in results.'
                )
            ),
            gcel(
				'select',
				{ value: include_link, onChange: updateMessage15, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                ), 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Include Excerpt: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to include the excerpt in results.'
                )
            ),
            gcel(
				'select',
				{ value: include_excerpt, onChange: updateMessage16, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                ),
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Include Date: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to include the date in results.'
                )
            ),
            gcel(
				'select',
				{ value: include_date, onChange: updateMessage17, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                ),
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Include Content: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to include the content in results.'
                )
            ),
            gcel(
				'select',
				{ value: include_content, onChange: updateMessage18, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                ),
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Include Author: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to include the author in results.'
                )
            ),
            gcel(
				'select',
				{ value: include_author, onChange: updateMessage19, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                ),
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Image Size: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the image size to be shown in results.'
                )
            ),
            gcel(
				'select',
				{ value: image_size, onChange: updateMessage20, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'thumbnail'},
                    'thumbnail'
                ), 
                gcel(
                    'option',
                    { value: 'medium'},
                    'medium'
                ), 
                gcel(
                    'option',
                    { value: 'large'},
                    'large'
                ), 
                gcel(
                    'option',
                    { value: 'full'},
                    'full'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Show Read More: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to show the "Read More" button in results.'
                )
            ),
            gcel(
				'select',
				{ value: excerpt_more, onChange: updateMessage21, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                ),
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Link Read More: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select if you wish to link the "Read more" text from the excerpt.'
                )
            ),
            gcel(
				'select',
				{ value: excerpt_more_link, onChange: updateMessage22, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'false'},
                    'false'
                ),
                gcel(
                    'option',
                    { value: 'true'},
                    'true'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Excerpt Lenght: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the length of the excerpt (word count).'
                )
            ),
			gcel(
				'input',
				{ type:'number', min:1, placeholder:'30', value: excerpt_length, onChange: updateMessage23, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Date Format: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the date format to be used.'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'(n/j/Y)', value: date_format, onChange: updateMessage24, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Content Class: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the class to be assigned to resulting content.'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'content', value: content_class, onChange: updateMessage25, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Post Author: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the user_nicename of the author to list posts from. You can also use "current" to list posts for the currently logged in user.'
                )
            ),
			gcel(
				'textarea',
				{ rows:1,placeholder:'author name', value: author, onChange: updateMessage26, className: 'coderevolution_gutenberg_input' }
			)
		);
    }),
    save: (function( props ) {
       return null;
    }),
} );