<?php
/*
acf_register_block(
	
	array(
		'name'				=> 'careers-image-banner',
		'title'				=> __('Careers Image Banner', 'Dra'),
		'category'			=> 'careers',
		'keywords'		 => array('image', 'banner'),
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
	
);*/
acf_register_block(
	array(
		'name'				=> 'careers-intro',
		'title'				=> __('Careers Intro', 'Dra'),
		'category'			=> 'careers',
		'keywords'		 => array('intro', 'career'),
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
		'name'				=> 'careers-accordion',
		'title'				=> __('Accordion', 'Dra'),
		'category'			=> 'careers',
		'keywords'		 => array('accordion'),
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
