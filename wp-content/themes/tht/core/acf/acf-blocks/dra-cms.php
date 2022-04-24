<?php

acf_register_block(
	array(
		'name'				=> 'cms-special-links',
		'title'				=> __('Special Links', 'tht'),
		'category'			=> 'cms',
		'keywords'		 => array('special', 'links'),
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
		'name'				=> 'cms-text-group',
		'title'				=> __('Text Group', 'tht'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);

acf_register_block(
	array(
		'name'				=> 'cms-image-banner',
		'title'				=> __('Image Banner', 'tht'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);

acf_register_block(
	array(
		'name'				=> 'cms-paragraph',
		'title'				=> __('Paragraph Block', 'tht'),
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
		'render_callback'	=> 'wptht_acf_block_render_callback',
	)
);