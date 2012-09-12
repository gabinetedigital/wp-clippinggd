<?php


class ClippingGDWidget extends WP_Widget
{
	function ClippingGDWidget()
	{
		$widget_ops = array('classname' => 'ClippingGDWidget', 'description' => 'Clipping do Gabinete Digital, custom post type.' );
		$this->WP_Widget('ClippingGDWidget', 'Gabinete Digital - Clipping', $widget_ops);		
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
 
    $args_query_post = '';
    
    echo $before_widget;
    $titulo = empty($instance['titulo']) ? ' ' : apply_filters('widget_titulo', $instance['titulo']);
    $colunas = $instance['colunas'];
    $qtd = $instance['qtd'];
    $custom_post = 'clippinggd_clipping';
 
    if (!empty($titulo))
      echo $before_title . $titulo . $after_title;;
	        
    if (!empty($qtd))
    	$args_query_post = $args_query_post . "posts_per_page=" . $qtd;
    
    if (!empty($custom_post))
    {
    	if ($args_query_post == '')
    		$args_query_post = $args_query_post . "post_type=" . $custom_post;
    	else 
    		$args_query_post = $args_query_post . "&post_type=" . $custom_post;
    }
    /*
    echo 'COLUNAS: ' . $colunas;
    echo '<br>';
    echo 'QUANTIDADE: ' . $qtd;
    echo '<br>';
    echo 'CUSTOM POST: ' . $custom_post;
    echo '<br>';
    echo 'ARGUMENTOS: ' . $args_query_post;
    */
    query_posts($args_query_post);
	if (have_posts()) : 
		echo "<ul>";
		while (have_posts()) : the_post(); 
			echo "<li><a href='".get_permalink()."'>".get_the_title()."</a></li>";
	 		
		endwhile;
		echo "</ul>";
	endif; 
	wp_reset_query();
 
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ClippingGDWidget");') );


?>