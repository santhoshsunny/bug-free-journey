<?php
acf_register_block(
	array(
		'name'				=> 'investment-portfolio-chart',
		'title'				=> __(' Portfolio Chart', 'Dra'),
		'category'			=> 'investment',
		'keywords'		 => array('portfolio', 'chart'),
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
