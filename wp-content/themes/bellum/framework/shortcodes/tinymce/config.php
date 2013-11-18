<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'mclang'),
			'desc' => __('Add the button\'s url eg http://example.com', 'mclang')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Button Style', 'mclang'),
			'desc' => __('Select the button\'s style, ie the button\'s colour', 'mclang'),
			'options' => array(
				'white' => __('white', 'mclang'),
				'grey' => __('grey', 'mclang'),
				'pink' => __('pink', 'mclang'),
				'aqua' => __('aqua', 'mclang'),
				'purple' => __('purple', 'mclang'),
				'green' => __('green', 'mclang'),
				'blue' => __('blue', 'mclang'),
				'orange' => __('orange', 'mclang'),
				'darkblue' => __('dark blue', 'mclang'),
				'black' => __('black', 'mclang')
			)
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Button Target', 'mclang'),
			'desc' => __('_self = open in same window. _blank = open in new window', 'mclang'),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Alternative class', 'mclang'),
			'desc' => __('Add a custom class to the button', 'mclang')
		),
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'label' => __('Button\'s Text', 'mclang'),
			'desc' => __('Add the button\'s text', 'mclang'),
		)
	),
	'shortcode' => '[button url="{{url}}" style="{{style}}" target="{{target}}"] {{content}} [/button]',
	'popup_title' => __('Insert Button Shortcode', 'mclang')
);




/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['separators'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Separator Style', 'mclang'),
			'desc' => __('Select the separator style.', 'mclang'),
			'options' => array(
				'double' => 'Double Line',
				'single' => 'Single Line',
				'dotted' => 'Dotted'
			)
		),
		'margintop' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Margin Top', 'mclang'),
			'desc' => __('Add top margin to the separator', 'mclang')
		),
		'marginbottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Margin Bottom', 'mclang'),
			'desc' => __('Add bottom margin to the separator', 'mclang')
		)
	),
	'shortcode' => '[separator style="{{style}}" margintop="{{margintop}}" marginbottom="{{marginbottom}}"]',
	'popup_title' => __('Insert Separator Shortcode', 'mclang')
);

/*-----------------------------------------------------------------------------------*/
/*	Quote Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['quote'] = array(
	'no_preview' => true,
	'params' => array(
		
		'style' => array(
			'type' => 'select',
			'label' => __('Quote Style', 'mclang'),
			'desc' => __('Select the quote style, ie the alert colour', 'mclang'),
			'options' => array(
				'normal' => 'normal',
				'styled' => 'styled'
			)
		),
		'author' => array(
			'type' => 'text',
			'label' => __('Quote Author', 'mclang'),
			'desc' => __('Add the title that will go above the toggle content', 'mclang'),
			'std' => 'Author'
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'mclang'),
			'desc' => __('Add the toggle content. Will accept HTML', 'mclang'),
		),
		
		
	),
	'shortcode' => '[quote author="{{author}}" style="{{style}}"] {{content}} [/quote]',
	'popup_title' => __('Insert Toggle Content Shortcode', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	Dropcaps Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['dropcaps'] = array(
	'no_preview' => true,
	'params' => array(
		'letter' => array(
			'type' => 'text',
			'label' => __('Dropcap', 'mclang'),
			'desc' => __('The letter that will become bigger', 'mclang'),
			'std' => ''
		),
		'color' => array(
			'std' => '#ee6251',
			'type' => 'text',
			'label' => __('Color of dropcap', 'mclang'),
			'desc' => __('Change the color of dropcap', 'mclang'),
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('Toggle Content', 'mclang'),
			'desc' => __('Dropcap Content', 'mclang'),
		),
		
		
	),
	'shortcode' => '[dropcap letter="{{letter}}" color="{{color}}"] {{content}} [/dropcap]',
	'popup_title' => __('Insert Dropcap Content Shortcode', 'mclang')
);


/*-----------------------------------------------------------------------------------*/
/*	Social Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['social'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'type' => 'select',
			'label' => __('Social Icon', 'mclang'),
			'desc' => __('Select the social icon', 'mclang'),
			'options' => array(
				'facebook' => 'Facebook',
				'facebook-two' => 'Facebook Alternative',
				'twitter' => 'Twitter',
				'twitter-two' => 'Twitter Alternative',
				'digg' => 'Digg',
				'digg-two' => 'Digg Alternative',
				'delicious' => 'Delicious',
				'tumblr' => 'Tumblr',
				'dribble' => 'Dribble',
				'dribble-two' => 'Dribble Alternative',
				'stumbleupon' => 'Stumbleupon',
				'myspace' => 'MySpace',
				'skype' => 'Skype',
				'vimeo' => 'Vimeo',
				'youtube' => 'Youtube',
				'lastfm' => 'Lastfm',
				'behance' => 'Behance'
			)
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Url to social page', 'mclang'),
			'desc' => __('Add the url to the social page', 'mclang'),
		),
		
	),
	'shortcode' => '[social icon="{{icon}}" url="{{url}}"]',
	'popup_title' => __('Insert Social Content Shortcode', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	Social Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['video'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Video URL', 'mclang'),
			'desc' => __('Enter thr full url of the video, youtube or vimeo', 'mclang'),
		),
		
	),
	'shortcode' => '[video url="{{url}}"]',
	'popup_title' => __('Insert Video Content Shortcode', 'mclang')
);


/*-----------------------------------------------------------------------------------*/
/*	Heading Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['heading'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Title', 'mclang'),
			'desc' => __('Add the title content', 'mclang'),
			'std' => 'Title'
		),
		'subtitle' => array(
			'std' => 'subtitle',
			'type' => 'text',
			'label' => __('Subtitle', 'mclang'),
			'desc' => __('Add the subtitle', 'mclang'),
		),
		
		
	),
	'shortcode' => '[heading title="{{title}}" subtitle="{{subtitle}}"]',
	'popup_title' => __('Insert Custom Title Shortcode', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	Heading Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['heading2'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('Title', 'mclang'),
			'desc' => __('Add the title content', 'mclang'),
			'std' => 'Title'
		)
	),
	'shortcode' => '[heading_line title="{{title}}"]',
	'popup_title' => __('Insert Custom Title Shortcode', 'mclang')
);


/*-----------------------------------------------------------------------------------*/
/*	Lists Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['lists'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('List Style', 'mclang'),
			'desc' => __('Select the list style, ie the list icon', 'mclang'),
			'options' => array(
				'check' => 'check',
				'circle' => 'circle',
				'triangle' => 'triangle',
				'arrow' => 'arrow',
				'error' => 'error'
			)
		),
		'content' => array(
			'std' => 'Content',
			'type' => 'textarea',
			'label' => __('List Content', 'mclang'),
			'desc' => __('Add the toggle content. Will accept HTML', 'mclang'),
		),
		
		
	),
	'shortcode' => '[list style="{{style}}"] {{content}} [/list]',
	'popup_title' => __('Custom Lists Shortcode', 'mclang')
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __('Alert Style', 'mclang'),
			'desc' => __('Select the alert\'s style, ie the alert colour', 'mclang'),
			'options' => array(
				'warning' => __('Warning', 'mclang'),
				'error' => __('Error', 'mclang'),
				'success' => __('Success', 'mclang'),
				'info' => __('Info', 'mclang')
			)
		),
		
		'close' => array(
			'type' => 'select',
			'label' => __('Close button?', 'mclang'),
			'desc' => __('Show or hide the close button', 'mclang'),
			'options' => array(
				'true' => __('True', 'mclang'),
				'false' => __('False', 'mclang')
			)
		),
				
		'content' => array(
			'std' => 'Your Alert!',
			'type' => 'textarea',
			'label' => __('Alert Text', 'mclang'),
			'desc' => __('Add the alert\'s text', 'mclang'),
		),
		
	),
	'shortcode' => '[alert type="{{type}}" close="{{close}}"] {{content}} [/alert]',
	'popup_title' => __('Insert Alert Shortcode', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['toggle'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[accordion] {{child_shortcode}}  [/accordion]',
    'popup_title' => __('Insert Tab Shortcode', 'mclang'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'mclang'),
                'desc' => __('Title of the tab', 'mclang'),
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'mclang'),
                'desc' => __('Add the tabs content', 'mclang')
            )
        ),
        'shortcode' => '[atab title="{{title}}"] {{content}} [/atab]',
        'clone_button' => __('Add Tab', 'mclang')
    )
);


/*-----------------------------------------------------------------------------------*/
/*	GMap Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['gmap'] = array(
	'no_preview' => true,
	'params' => array(		
		'address' => array(
			'std' => 'Address',
			'type' => 'text',
			'label' => __('Address', 'mclang'),
			'desc' => __('Add the address', 'mclang'),
		),
		
		'zoom' => array(
			'std' => '18',
			'type' => 'text',
			'label' => __('Map Zoom', 'mclang'),
			'desc' => __('Change the map zoom', 'mclang'),
		),
		
		'height' => array(
			'std' => '360',
			'type' => 'text',
			'label' => __('Map Height', 'mclang'),
			'desc' => __('Change the map height', 'mclang'),
		),
		
	),
	'shortcode' => '[gmap address="{{address}}" zoom="{{zoom}}" height="{{height}}"]',
	'popup_title' => __('Insert Gmap Shortcode', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	GMap Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['contactform'] = array(
	'no_preview' => true,
	'params' => array(		
		
	),
	'shortcode' => '[contact_form]',
	'popup_title' => __('Insert Contact form Shortcode', 'mclang')
);

/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['teammember'] = array(
	'no_preview' => true,
	'params' => array(
		'photo' => array(
			'type' => 'text',
			'label' => __('Member photo', 'mclang'),
			'desc' => __('Add the photo full url of the team member', 'mclang'),
			'std' => ''
		),
		'name' => array(
			'type' => 'text',
			'label' => __('Member name', 'mclang'),
			'desc' => __('Add the name of the team member', 'mclang'),
			'std' => ''
		),
		'position' => array(
			'type' => 'text',
			'label' => __('Member position', 'mclang'),
			'desc' => __('Add the position of the team member', 'mclang'),
			'std' => ''
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Member Info', 'mclang'),
			'desc' => __('Enter the info of the member', 'mclang'),
		),
		'face' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Facebook ULR', 'mclang'),
			'desc' => __('Enter the facebook url of the member', 'mclang'),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Twitter Username', 'mclang'),
			'desc' => __('Enter the  twitter username of the member', 'mclang'),
		),
		
		
		'dribble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Dribble url', 'mclang'),
			'desc' => __('Enter the  dribble url of the member', 'mclang'),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Skype', 'mclang'),
			'desc' => __('Enter the  flickr url of the member', 'mclang'),
		),
		
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Vimeo url', 'mclang'),
			'desc' => __('Enter the  vimeo url of the member', 'mclang'),
		)
		
		
		
	),
	'shortcode' => '[member photo="{{photo}}" name="{{name}}" position="{{position}}" face="{{face}}" twitter="{{twitter}}" dribble="{{dribble}}" skype="{{skype}}" vimeo="{{vimeo}}"] {{content}} [/member]',
	'popup_title' => __('Insert Toggle Content Shortcode', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[tabs] {{child_shortcode}}  [/tabs]',
    'popup_title' => __('Insert Tab Shortcode', 'mclang'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Title',
                'type' => 'text',
                'label' => __('Tab Title', 'mclang'),
                'desc' => __('Title of the tab', 'mclang'),
            ),
            'content' => array(
                'std' => 'Tab Content',
                'type' => 'textarea',
                'label' => __('Tab Content', 'mclang'),
                'desc' => __('Add the tabs content', 'mclang')
            )
        ),
        'shortcode' => '[tab title="{{title}}"] {{content}} [/tab]',
        'clone_button' => __('Add Tab', 'mclang')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['testimonial'] = array(
	'params' => array(),
	'shortcode' => '{{child_shortcode}}', // as there is no wrapper shortcode
	'popup_title' => __('Insert Shortcode Shortcode', 'mclang'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Client name', 'mclang'),
				'desc' => __('Add the client name.', 'mclang'),
			),
			'position' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Client Company/Position', 'mclang'),
				'desc' => __('Add the client company/position.', 'mclang'),
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Testimonial text', 'mclang'),
				'desc' => __('Add the testimonial text.', 'mclang'),
			)
		),
		'shortcode' => '[testimonial name="{{name}}" position="{{position}}"] {{content}} [/testimonial] ',
		'clone_button' => __('Add Testimonial', 'mclang')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => '[row] {{child_shortcode}} [/row]', // as there is no wrapper shortcode
	'popup_title' => __('Insert Columns Shortcode', 'mclang'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Type', 'mclang'),
				'desc' => __('Select the type, ie width of the column.', 'mclang'),
				'options' => array(
					'one_third' => 'One Third',
					'two_third' => 'Two Thirds',
					'one_half' => 'One Half',
					'one_fourth' => 'One Fourth',
					'three_fourth' => 'Three Fourth',
					'one_sixth' => 'One Sixth',
					'five_sixth' => 'Five Sixth'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Column Content', 'mclang'),
				'desc' => __('Add the column content.', 'mclang'),
			)
		),
		'shortcode' => '[column size="{{column}}"] {{content}} [/column] ',
		'clone_button' => __('Add Column', 'mclang')
	)
);




/*-----------------------------------------------------------------------------------*/
/*	Price table Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['pricetable'] = array(
	'params' => array(),
	'shortcode' => '[row] {{child_shortcode}} [/row]', // as there is no wrapper shortcode
	'popup_title' => __('Insert price table Shortcode', 'mclang'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'size' => array(
				'type' => 'select',
				'label' => __('Table Column size', 'mclang'),
				'desc' => __('Select the size, ie width of the column.', 'mclang'),
				'options' => array(
					'one_third' => 'One Third',
					'one_half' => 'One Half',
					'one_fourth' => 'One Fourth'
				)
			),
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Price table title', 'mclang'),
				'desc' => __('Add the price table title.', 'mclang'),
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Price table Content', 'mclang'),
				'desc' => __('Add the price table content.', 'mclang'),
			)
		),
		'shortcode' => '[price_column size="{{size}}" title="{{title}}"] {{content}} [/price_column] ',
		'clone_button' => __('Add Column', 'mclang')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$mc_shortcodes['slider'] = array(
    'params' => array(
    	'effect' => array(
    		'type' => 'select',
    		'label' => __('Slider Effect', 'mclang'),
    		'desc' => __('Select the slider effect', 'mclang'),
    		'options' => array(
    			'random' => 'random',
    			'sliceDown' => 'sliceDown',
    			'sliceDownLeft' => 'sliceDownLeft',
    			'sliceUp' => 'sliceUp',
    			'sliceUpLeft' => 'sliceUpLeft',
    			'sliceUpDown' => 'sliceUpDown',
    			'sliceUpDownLeft' => 'sliceUpDownLeft',
    			'fold' => 'fold',
    			'fade' => 'fade',
    			'slideInRight' => 'slideInRight',
    			'slideInLeft' => 'slideInLeft',
    			'boxRandom' => 'boxRandom',
    			'boxRain' => 'boxRain',
    			'boxRainReverse' => 'boxRainReverse',
    			'boxRainGrow' => 'boxRainGrow',
    			'boxRainGrowReverse' => 'boxRainGrowReverse'
    		)
    	),
    	
    	'auto' => array(
    		'type' => 'select',
    		'label' => __('Autostart', 'mclang'),
    		'desc' => __('Autostart the slider', 'mclang'),
    		'options' => array(
    			'no' => 'no',
    			'yes' => 'yes'
    		)
    	),
    	'delay' => array(
    	    'std' => '7000',
    	    'type' => 'text',
    	    'label' => __('Delay', 'mclang'),
    	    'desc' => __('Delay between each slide in milliseconds', 'mclang'),
    	),
    	
    	
    ),
    'no_preview' => false,
    'shortcode' => '[slider effect="{{effect}}" auto="{{auto}}" delay="{{delay}}"] {{child_shortcode}}  [/slider]',
    'popup_title' => __('Insert Slider Shortcode', 'mclang'),
    
    'child_shortcode' => array(
        'params' => array(
            'url' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Image URL', 'mclang'),
                'desc' => __('Enter the full url of the image', 'mclang'),
            ),
            'link' => array(
                'std' => '',
                'type' => 'text',
                'label' => __('Image Link', 'mclang'),
                'desc' => __('Add a link to the image content', 'mclang')
            )
        ),
        'shortcode' => '[img url="{{url}}" link="{{link}}"]',
        'clone_button' => __('Add Slide', 'mclang')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Full Slider text Config
/*-----------------------------------------------------------------------------------*/
$mc_shortcodes['fulltext'] = array(
	'no_preview' => true,
	'params' => array(
		'top' => array(
			'std' => '150',
			'type' => 'text',
			'label' => __('Margin Top', 'mclang'),
			'desc' => __('Add the margin top', 'mclang')
		),
		'xpos' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __('Left or right margin', 'mclang'),
			'desc' => __('Add the left or right margin ', 'mclang')
		),
		'effect' => array(
			'type' => 'select',
			'label' => __('Effect', 'mclang'),
			'desc' => __('Select the text effect', 'mclang'),
			'options' => array(
				'slide' => 'slide',
				'fade' => 'fade'
			)
		),
		'enterfrom' => array(
			'type' => 'select',
			'label' => __('Text align', 'mclang'),
			'desc' => __('Where the description should be positioned', 'mclang'),
			'options' => array(
				'left' => 'left',
				'right' => 'right'
			)
		),
		'speed' => array(
			'std' => '700',
			'type' => 'text',
			'label' => __('Text speed', 'mclang'),
			'desc' => __('The text slide speed', 'mclang')
		)
	),
	'shortcode' => '[fullslider top="{{top}}" xpos="{{xpos}}" effect="{{effect}}" enterfrom="{{enterfrom}}" speed="{{speed}}"] Add your text here [/fullslider]',
	'popup_title' => __('Insert full slider descripton', 'mclang')
);



/*-----------------------------------------------------------------------------------*/
/*	Full Slider text Config
/*-----------------------------------------------------------------------------------*/
$mc_shortcodes['fullvideo'] = array(
	'no_preview' => true,
	'params' => array(
		'top' => array(
			'std' => '60',
			'type' => 'text',
			'label' => __('Margin Top', 'mclang'),
			'desc' => __('Add the margin top', 'mclang')
		),
		'speed' => array(
			'std' => '700',
			'type' => 'text',
			'label' => __('Speed', 'mclang'),
			'desc' => __('Speed of slide', 'mclang')
		),
		'video' => array(
			'std' => 'http://vimeo.com/52805894',
			'type' => 'text',
			'label' => __('Video URL', 'mclang'),
			'desc' => __('Enter the video full url', 'mclang')
		),
		'height' => array(
			'std' => '480',
			'type' => 'text',
			'label' => __('Video Height', 'mclang'),
			'desc' => __('Enter the video height', 'mclang')
		),
		'width' => array(
			'std' => '1200',
			'type' => 'text',
			'label' => __('Video Width', 'mclang'),
			'desc' => __('Enter the video width', 'mclang')
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __('Autoplay Video', 'mclang'),
			'desc' => __('Autoplay the video', 'mclang'),
			'options' => array(
				'true' => 'true',
				'false' => 'false'
			)
		),
		'color' => array(
			'std' => 'ff9933',
			'type' => 'text',
			'label' => __('Video controls color', 'mclang'),
			'desc' => __('Video controls color,  just for vimeo', 'mclang')
		),
	),
	'shortcode' => '[fullslider_video top="{{top}}" speed="{{speed}}" video="{{video}}" height="{{height}}" width="{{width}}" autoplay="{{autoplay}}"]',
	'popup_title' => __('Insert Full slider video Shortcode', 'mclang')
);
?>