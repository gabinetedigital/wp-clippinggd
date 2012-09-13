<?php

function wp_clippinggd_clipping() {
	$labels = array(
			'name' => _x( 'Clipping', 'clipping' ),
			'singular_name' => _x( 'Clipping', 'clipping' ),
			'add_new' => _x( 'Novo Clipping', 'clipping' ),
			'all_items' => _x('Clipping', 'clipping'),
			'add_new_item' => _x( 'Adicionar Novo Clipping', 'clipping' ),
			'edit_item' => _x( 'Editar Clipping', 'clipping' ),
			'new_item' => _x( 'Novo Clipping', 'clipping' ),
			'view_item' => _x( 'Visualizar Clipping', 'clipping' ),
			'search_items' => _x( 'Pesquisar Clipping', 'clipping' ),
			'not_found' => _x( 'Nenhum clipping encontrado', 'clipping' ),
			'not_found_in_trash' => _x( 'Nenhum clipping encontrado na lixeira', 'clipping' ),
			'parent_item_colon' => _x( 'Clipping pai:', 'clipping' ),
			'menu_name' => _x( 'Clipping GD', 'clipping'),
	);
	$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'author', 'comments', 'revisions'),
			'taxonomies' => array('categoria_clippinggd'),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 80,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'capability_type' => 'post'
	);
	register_post_type( 'clippinggd_clipping', $args );
}

add_action( 'init', 'wp_clippinggd_clipping' );

?>