<?php

acf_register_block(
	array(
		'name'				=> 'homepage-banner',
		'title'				=> __('Homepage  Banner', 'tht'),
		'category'			=> 'homepage',
		'keywords'		 => array( 'banner'),
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
		'name'				=> 'homepage-our-investments',
		'title'				=> __('Our Investments', 'tht'),
		'category'			=> 'homepage',
		'keywords'		 => array('investment'),
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
		'name'				=> 'homepage-company-culture',
		'title'				=> __('Company culture', 'tht'),
		'category'			=> 'homepage',
		'keywords'		 => array('company', 'culture'),
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
		'name'				=> 'homepage-gallery',
		'title'				=> __('Gallery', 'tht'),
		'category'			=> 'homepage',
		'keywords'		 => array('gallery', 'homepage'),
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
		'name'				=> 'homepage-statistics',
		'title'				=> __(' Statistics', 'tht'),
		'category'			=> 'homepage',
		'keywords'		 => array( 'statistics'),
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

