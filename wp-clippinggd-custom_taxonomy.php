<?php

add_action( 'init', 'wp_clippinggd_taxonomy_categoria' );

function wp_clippinggd_taxonomy_categoria() {
	$labels = array(
			'name' => _x( 'Categorias Clipping', 'categorias' ),
			'singular_name' => _x( 'Categoria', 'categorias' ),
			'search_items' => _x( 'Pesquisar Categorias', 'categorias' ),
			'popular_items' => _x( 'Categorias populares', 'categorias' ),
			'all_items' => _x( 'Todos as Categorias', 'categorias' ),
			'parent_item' => _x( 'Categoria Pai', 'categorias' ),
			'parent_item_colon' => _x( 'Categoria Pai:', 'categorias' ),
			'edit_item' => _x( 'Editar Categoria', 'categorias' ),
			'update_item' => _x( 'Atualizar Categoria', 'categorias' ),
			'add_new_item' => _x( 'Adicionar Nova Categoria', 'categorias' ),
			'new_item_name' => _x( 'Nova Categoria', 'categorias' ),
			'separate_items_with_commas' => _x( 'Separar categorias por virgulas', 'categorias' ),
			'add_or_remove_items' => _x( 'Adicionar ou Remover Categorias', 'categorias' ),
			'choose_from_most_used' => _x( 'Selecionar Categorias mais utilizadas', 'categorias' ),
			'menu_name' => _x( 'Categorias Clipping', 'Categorias' ),
	);
	$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => true,
			'query_var' => true
	);
	register_taxonomy('categoria_clippinggd', array('clippinggd_clipping'), $args );
}

?>