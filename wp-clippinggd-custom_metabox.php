<?php
global $meta_boxes_clippinggd;

$prefix = 'wp_clippinggd_';

$meta_boxes_clippinggd = array();

$meta_boxes_clippinggd[] = array(
		'id' => $prefix.'info_geral',
		'title' => 'Informações Gerais',
		'pages' => array('audiencia_govesc'),
		'context'=> 'normal',
		'priority'=> 'high',
		'fields' => array(
				array(
						'name'		=> 'FONTE',
						'id'		=> $prefix . 'fonte',
						'desc'		=> 'Fonte do clipping',
						'type'		=> 'text'
				),
				array(
						'name'		=> 'URL',
						'id'		=> $prefix . 'url',
						'desc'		=> 'Url do clipping',
						'type'		=> 'text'
				),
				array(
						'name'	=> 'Anexo',
						'id'	=> $prefix . 'anexo',
						'desc'	=> '',
						'type'	=> 'file'
				)
		)
);


function wp_clippinggd_register_meta_boxes()
{
	global $meta_boxes_clippinggd;

	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes_clippinggd as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action('admin_init', 'wp_clippinggd_register_meta_boxes' );

?>