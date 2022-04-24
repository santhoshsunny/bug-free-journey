<?php
acf_register_block(
	array(
		'name'				=> 'testimonial',
		'title'				=> __('Testimonial', 'tht'),
		'category'			=> 'common_blocks',
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);
acf_register_block(
	array(
		'name'				=> 'image-content-section',
		'title'				=> __('Image Content Section', 'tht'),
		'category'			=> 'common_blocks',
		'keywords'		 => array('image', 'content', 'section'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);


acf_register_block(
	array(
		'name'				=> 'background-image-banner',
		'title'				=> __(' Background Image Banner', 'tht'),
		'category'			=> 'common_blocks',
		'keywords'		 => array('backgroundimage', 'background'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);


acf_register_block(
	array(
		'name'				=> 'backgroundimage-content-banner',
		'title'				=> __('Background Image Content Banner', 'tht'),
		'category'			=> 'common_blocks',
		'keywords'		 => array('backgroundimage', 'content'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);


acf_register_block(
	array(
		'name'				=> 'backgroundcolor-content',
		'title'				=> __(' Background Color Content', 'tht'),
		'category'			=> 'common_blocks',
		'keywords'		 => array('backgroundcolor', 'content'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);

acf_register_block(
	array(
		'name'                => 'intro',
		'title'                => __('Intro', 'tht'),
		'category'            => 'common_blocks',
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
		'render_callback'    => 'wptht_acf_block_render_callback',
	)
);
