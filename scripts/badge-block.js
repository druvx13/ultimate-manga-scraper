"use strict"; 
var { registerBlockType } = wp.blocks;
var gcel = wp.element.createElement;

registerBlockType( 'ultimate-manga-scraper/ums-badge', {
    title: 'Ultimate Mange Scraper Badge Embed',
    icon: 'smartphone',
    category: 'embed',
    attributes: {
        lang : {
            default: 'en',
            type:   'string',
        },
        pkg : {
            default: '560',
            type:   'string',
        },
        size : {
            default: '',
            type:   'string',
        },
        type : {
            default: '',
            type:   'string',
        }
    },
    keywords: ['badge', 'embed', 'ums'],
    edit: (function( props ) {
		var lang = props.attributes.lang;
        var pkg = props.attributes.pkg;
        var size = props.attributes.size;
        var type = props.attributes.type;
		function updateMessage( event ) {
            props.setAttributes( { lang: event.target.value} );
		}
        function updateMessage2( event ) {
            props.setAttributes( { pkg: event.target.value} );
		}
        function updateMessage3( event ) {
            props.setAttributes( { size: event.target.value} );
		}
        function updateMessage4( event ) {
            props.setAttributes( { type: event.target.value} );
		}
		return gcel(
			'div', 
			{ className: 'coderevolution_gutenberg_div' },
            gcel(
				'h4',
				{ className: 'coderevolution_gutenberg_title' },
                'Ultimate Mange Scraper Badge Embed ',
                gcel(
                    'div', 
                    {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                    ,
                    gcel(
                        'div', 
                        {className:'bws_hidden_help_text'},
                        'This block is used to embed a Play Store badge.'
                    )
                )
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Language: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Select the language of the badge.'
                )
            ),
			gcel(
				'input',
				{ type:'text',placeholder:'Badge language', value: lang, onChange: updateMessage, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Embed Package: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the package name to be embedded. Example: com.example.app.'
                )
            ),
			gcel(
				'input',
				{ type:'text',placeholder:'package name', value: pkg, onChange: updateMessage2, className: 'coderevolution_gutenberg_input' }
			),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Embed Size: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the embed size of the badge.'
                )
            ),
			gcel(
				'select',
				{ value: size, onChange: updateMessage3, className: 'coderevolution_gutenberg_select' }, 
                gcel(
                    'option',
                    { value: 'small'},
                    'small'
                ),
                gcel(
                    'option',
                    { value: 'large'},
                    'large'
                )
            ),
            gcel(
				'br'
			),
            gcel(
				'label',
				{ className: 'coderevolution_gutenberg_label' },
                'Embed Type: '
			),
            gcel(
                'div', 
                {className:'bws_help_box bws_help_box_right dashicons dashicons-editor-help'}
                ,
                gcel(
                    'div', 
                    {className:'bws_hidden_help_text'},
                    'Input the type of the embedded badge.'
                )
            ),
			gcel(
				'input',
				{ type:'text',placeholder:'Package type', value: type, onChange: updateMessage4, className: 'coderevolution_gutenberg_input' }
			)
		);
    }),
    save: (function( props ) {
       return null;
    }),
} );