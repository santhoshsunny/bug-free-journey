<?php
acf_register_block(
	array(
		'name'				=> 'testimonial',
		'title'				=> __('Testimonial', 'Dra'),
		'category'			=> 'general-blocks',
		'keywords'		 => array('testimonial'),
		'icon' => array(
			'src'        => 'format-image',
			'background' => '#7e70af',
			'foreground' => '#fff',
		),
		'post_types'     => array('page'),
		'mode'           => 'edit',
		'supports'       => array(
			'align'    => array('full'),
			'multiple' => false,
		),
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);
acf_register_block(
	array(
		'name'				=> 'image-content-section',
		'title'				=> __('Image Content Section', 'Dra'),
		'category'			=> 'general-blocks',
		'keywords'		 => array('image','content','section'),
		'icon' => array(
			'src'        => 'format-image',
			'background' => '#7e70af',
			'foreground' => '#fff',
		),
		'post_types'     => array('page'),
		'mode'           => 'edit',
		'supports'       => array(
			'align'    => array('full'),
			'multiple' => false,
		),
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);


acf_register_block(
	array(
		'name'				=> 'background-image-banner',
		'title'				=> __(' BackGround Image Banner', 'Dra'),
		'category'			=> 'general-blocks',
		'keywords'		 => array('bgimage', 'background'),
		'icon' => array(
			'src'        => 'format-image',
			'background' => '#7e70af',
			'foreground' => '#fff',
		),
		'post_types'     => array('page'),
		'mode'           => 'edit',
		'supports'       => array(
			'align'    => array('full'),
			'multiple' => true,
		),
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);


acf_register_block(
	array(
		'name'				=> 'bgimage-content-banner',
		'title'				=> __('BGImage Content Banner', 'Dra'),
		'category'			=> 'general-blocks',
		'keywords'		 => array( 'bgimage','content'),
		'icon' => array(
			'src'        => 'format-image',
			'background' => '#7e70af',
			'foreground' => '#fff',
		),
		'post_types'     => array('page'),
		'mode'           => 'edit',
		'supports'       => array(
			'align'    => array('full'),
			'multiple' => true,
		),
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);


acf_register_block(
	array(
		'name'				=> 'bgcolor-content',
		'title'				=> __(' BGColor Content', 'Dra'),
		'category'			=> 'general-blocks',
		'keywords'		 => array('bgcolor','content'),
		'icon' => array(
			'src'        => 'format-image',
			'background' => '#7e70af',
			'foreground' => '#fff',
		),
		'post_types'     => array('page'),
		'mode'           => 'edit',
		'supports'       => array(
			'align'    => array('full'),
			'multiple' => true,
		),
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);

acf_register_block(
    array(
        'name'                => 'intro',
        'title'                => __('Intro', 'Dra'),
        'category'            => 'general-blocks',
        'keywords'         => array('intro'),
        'icon' => array(
            'src'        => 'format-image',
            'background' => '#7e70af',
            'foreground' => '#fff',
        ),
        'post_types'     => array('page'),
        'mode'           => 'edit',
        'supports'       => array(
            'align'    => array('full'),
            'multiple' => true,
        ),
        'render_callback'    => 'wpbfm_acf_block_render_callback',
    )
);
