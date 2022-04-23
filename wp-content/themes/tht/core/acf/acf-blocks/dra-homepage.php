<?php

acf_register_block(
	array(
		'name'				=> 'homepage-banner',
		'title'				=> __('Homepage  Banner', 'Dra'),
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
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);
acf_register_block(
	array(
		'name'				=> 'homepage-our-investments',
		'title'				=> __('Our Investments', 'Dra'),
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
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);

acf_register_block(
	array(
		'name'				=> 'homepage-company-culture',
		'title'				=> __('Company culture', 'Dra'),
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
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);

acf_register_block(
	array(
		'name'				=> 'homepage-statistics',
		'title'				=> __(' Statistics', 'Dra'),
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
		'render_callback'	=> 'wpbfm_acf_block_render_callback',
	)
);

