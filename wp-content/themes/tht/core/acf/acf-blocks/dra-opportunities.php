<?php

acf_register_block(
	array(
		'name'				=> 'acquisition-criteria',
		'title'				=> __('Acquisition Criteria', 'tht'),
		'category'			=> 'opportunities',
		'keywords'		 => array('criteria', 'block'),
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
		'name'				=> 'acquisition-details',
		'title'				=> __('Acquisition Details', 'tht'),
		'category'			=> 'opportunities',
		'keywords'		 => array('details', 'block'),
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
		'name'				=> 'opportunities-intro',
		'title'				=> __('Opportunities Intro', 'tht'),
		'category'			=> 'opportunities',
		'keywords'		 => array('intro', 'block'),
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
);acf_register_block(
	array(
		'name'				=> 'opportunities-links',
		'title'				=> __('Opportunities Links', 'tht'),
		'category'			=> 'opportunities',
		'keywords'		 => array('tabs', 'block'),
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
