<?php



acf_register_block(
	array(
		'name'				=> 'what-we-do-slider',
		'title'				=> __('What We Do Slider', 'Dra'),
		'category'			=> 'what_we_do',
		'keywords'		 => array( 'Slider'),
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
        'name'                => 'what-we-do-set-apart',
        'title'                => __('Set Apart', 'Dra'),
        'category'            => 'what_we_do',
        'keywords'         => array('set', 'apart'),
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
        'render_callback'    => 'wpbfm_acf_block_render_callback',
    )
);
