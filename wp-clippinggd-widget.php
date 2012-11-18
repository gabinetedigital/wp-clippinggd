<?php

/********************************************
 * WIDGET PARA MONTAR UMA LISTA DE CLIPPING
 ********************************************/
class ListaClippingGDWidget extends WP_Widget
{
	function ListaClippingGDWidget()
	{
		$widget_ops = array('classname' => 'ListaClippingGDWidget', 'description' => 'Lista de Clipping do Gabinete Digital, custom post type.' );
		$this->WP_Widget('ListaClippingGDWidget', 'Gabinete Digital - Clipping Lista', $widget_ops);

	}

	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'titulo' => '', 'colunas' => '3', 'qtd' => '1', 'css_class' => '' ) );
		$titulo = $instance['titulo'];
		$colunas = $instance['colunas'];
		$qtd = $instance['qtd'];
		$css_class = $instance['css_class'];

		?>
  		<p><label for="<?php echo $this->get_field_id('titulo'); ?>">Titulo: <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo attribute_escape($titulo); ?>" /></label></p>  		
  		<p><label for="<?php echo $this->get_field_id('qtd'); ?>">Quantidade: <input class="widefat" id="<?php echo $this->get_field_id('qtd'); ?>" name="<?php echo $this->get_field_name('qtd'); ?>" type="text" value="<?php echo attribute_escape($qtd); ?>" /></label></p>
  		<p><label for="<?php echo $this->get_field_id('colunas'); ?>">Colunas: <input class="widefat" id="<?php echo $this->get_field_id('colunas'); ?>" name="<?php echo $this->get_field_name('colunas'); ?>" type="text" value="<?php echo attribute_escape($colunas); ?>" /></label></p>
  		<p><label for="<?php echo $this->get_field_id('css_class'); ?>">Classe CSS: <input class="widefat" id="<?php echo $this->get_field_id('css_class'); ?>" name="<?php echo $this->get_field_name('css_class'); ?>" type="text" value="<?php echo attribute_escape($css_class); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['titulo'] = $new_instance['titulo'];
    $instance['colunas'] = $new_instance['colunas'];
    $instance['qtd'] = $new_instance['qtd'];
    $instance['css_class'] = $new_instance['css_class'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);

	global $wpdb;
    $args_query_post = '';
	$txtreturn = '';

    $titulo  = empty($instance['titulo']) ? ' ' : apply_filters('widget_titulo', $instance['titulo']);
    $colunas = $instance['colunas'];
    $qtd 	 = $instance['qtd'];
    $custom_post = 'clippinggd_clipping';
	
    if (empty($qtd))
		$qtd = 4;

    if (!empty($custom_post))
    {
    	if ($args_query_post == '')
    		$args_query_post = $args_query_post . "post_type=" . $custom_post;
    	else 
    		$args_query_post = $args_query_post . "&post_type=" . $custom_post;
    }
   
    $args_query_post .= "&posts_per_page=-1"; //para vir todos os posts
   
    query_posts($args_query_post);

	$txtreturn .= "<div class='clipping ".$instance['css_class']."'>";
	if (!empty($titulo))
		$txtreturn .= "<h3>".$titulo."</h3>";

	$txtreturn .= "<input name='clipping-perpage' type='hidden' id='clipping-perpage' value='$qtd' />";
	$txtreturn .= "<div id='clipping-itemsclipping'>";
	if (have_posts()) : 
		while (have_posts()) : the_post(); 
			$fonte  = get_post_meta(get_the_ID(),'wp_clippinggd_fonte', true);
			$anexo   = get_post_meta(get_the_ID(),'wp_clippinggd_anexo', true);
			$url    = get_post_meta(get_the_ID(),'wp_clippinggd_url', true);
			
			if (!empty($anexo)){
				$url = wp_get_attachment_url( $anexo );
			}
			
			$txtreturn .= "<blockquote class='pull-right'>";
			$txtreturn .= "<p class='Lead'>".get_the_title()."</p>";
			$txtreturn .= "<small><a href='".$url."'>".$fonte."</a></small>";
			$txtreturn .= "</blockquote>";
			
		endwhile;
	endif; 
	wp_reset_query();

	$txtreturn .= "</div>";
	$txtreturn .= "</div>";
	
	echo $txtreturn;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("ListaClippingGDWidget");') );

/******************************************
 *WIDGET PARA MONTAGEM DE UM CLIPPING EM ESPECIFICO PELO POST_ID
 *****************************************/
class ClippingGDWidget extends WP_Widget
{
	function ClippingGDWidget()
	{
		$widget_ops = array('classname' => 'ClippingGDWidget', 'description' => 'Clipping do Gabinete Digital, custom post type.' );
		$this->WP_Widget('ClippingGDWidget', 'Gabinete Digital - Clipping Único', $widget_ops);
	}

	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'titulo' => '', 'colunas' => '3', 'post_id' => '', 'css_class' => '' ) );
		$titulo = $instance['titulo'];
		$colunas = $instance['colunas'];
		$post_id = $instance['post_id'];
		$css_class = $instance['css_class'];

		?>
  		<p><label for="<?php echo $this->get_field_id('titulo'); ?>">Titulo: <input class="widefat" id="<?php echo $this->get_field_id('titulo'); ?>" name="<?php echo $this->get_field_name('titulo'); ?>" type="text" value="<?php echo attribute_escape($titulo); ?>" /></label></p>  		
  		<p><label for="<?php echo $this->get_field_id('post_id'); ?>">ID do post: <input class="widefat" id="<?php echo $this->get_field_id('post_id'); ?>" name="<?php echo $this->get_field_name('post_id'); ?>" type="text" value="<?php echo attribute_escape($post_id); ?>" /></label></p>
  		<p><label for="<?php echo $this->get_field_id('colunas'); ?>">Colunas: <input class="widefat" id="<?php echo $this->get_field_id('colunas'); ?>" name="<?php echo $this->get_field_name('colunas'); ?>" type="text" value="<?php echo attribute_escape($colunas); ?>" /></label></p>
  		<p><label for="<?php echo $this->get_field_id('css_class'); ?>">Classe CSS: <input class="widefat" id="<?php echo $this->get_field_id('css_class'); ?>" name="<?php echo $this->get_field_name('css_class'); ?>" type="text" value="<?php echo attribute_escape($css_class); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['titulo'] = $new_instance['titulo'];
    $instance['colunas'] = $new_instance['colunas'];
    $instance['post_id'] = $new_instance['post_id'];
    $instance['css_class'] = $new_instance['css_class'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    $args_query_post = '';

    echo "<li class='span".$instance['colunas']."'><div class='thumbnail clipping_unico ".$instance['css_class']."'>";
    $titulo = empty($instance['titulo']) ? ' ' : apply_filters('widget_titulo', $instance['titulo']);
    $colunas = $instance['colunas'];
    $post_id = $instance['post_id'];
    $custom_post = 'clippinggd_clipping';
 
    if (!empty($titulo))
      echo $before_title . $titulo . $after_title;;
	        
    if (!empty($post_id))
    	$args_query_post = $args_query_post . "p=" . $post_id;
    
    if (!empty($custom_post))
    {
    	if ($args_query_post == '')
    		$args_query_post = $args_query_post . "post_type=" . $custom_post;
    	else 
    		$args_query_post = $args_query_post . "&post_type=" . $custom_post;
    }
   
    query_posts($args_query_post);
	if (have_posts()) : 
		echo "<ul>";
		while (have_posts()) : the_post(); 
			$fonte = get_post_meta(get_the_ID(),'wp_clippinggd_fonte', true);
			$url = get_post_meta(get_the_ID(),'wp_clippinggd_url', true);
			
			echo "<li><a href='".$url."' target='_blank'>".get_the_title()."</a><br>Fonte: " . $fonte . "</li>";
	 		
		endwhile;
		echo "</ul>";
	endif; 
	wp_reset_query();
	
	echo "</div></li>";
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ClippingGDWidget");') );

?>