<?php

acf_register_block(
	array(
		'name'				=> 'cms-special-text',
		'title'				=> __('Special Text', 'Dra'),
		'category'			=> 'cms',
		'keywords'		 => array('special', 'text'),
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
		'name'				=> 'cms-group',
		'title'				=> __('CMS Group', 'Dra'),
		'category'			=> 'cms',
		'keywords'		 => array('group'),
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
		'name'				=> 'cms-image-banner',
		'title'				=> __('Image Banner', 'Dra'),
		'category'			=> 'cms',
		'keywords'		 => array('image'),
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
