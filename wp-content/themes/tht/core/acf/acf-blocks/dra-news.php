<?php

acf_register_block(
	array(
		'name'				=> 'news-featured-post',
		'title'				=> __('Featured Post', 'Dra'),
		'category'			=> 'news',
		'keywords'		 => array('featured', 'post'),
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
