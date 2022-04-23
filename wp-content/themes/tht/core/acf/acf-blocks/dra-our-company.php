<?php



acf_register_block(
	array(
		'name'				=> 'our-company-our-team',
		'title'				=> __('Our Team ', 'Dra'),
		'category'			=> 'our_company',
		'keywords'		 => array('our', 'team'),
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
		'name'				=> 'our-company-our-culture',
		'title'				=> __('Our Culture', 'Dra'),
		'category'			=> 'our_company',
		'keywords'		 => array('our', 'culture'),
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

