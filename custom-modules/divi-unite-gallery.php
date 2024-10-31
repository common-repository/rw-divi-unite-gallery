<?php
function rdug_divi_unite_gallery_setup() {

  if ( class_exists('ET_Builder_Module')) {

    // this is where your new module class will go
	class RWDUG_Builder_Module_Unite_Gallery extends ET_Builder_Module {
		function init() {
			$this->name       = esc_html__( 'Unite Gallery', RDUG_TD );
			$this->slug       = 'rdug_et_pb_unite_gallery';
			$this->fb_support = true;
	
			$this->whitelisted_fields = array(
				'src',
				'gal_theme',		
				'tiles_type',		
				'theme_navigation_type',
				'theme_enable_text_panel',
				'theme_enable_text_panel',
				'theme_panel_position',
				'theme_panel_position2',
				'gallery_skin',
				
				'gallery_ids',
				'gallery_orderby',
				
				'admin_label',
				'module_id',
				'module_class',
				
			);
	
			$this->fields_defaults = array(
				'gal_theme' 			=> array('default'),
				'tiles_type' 			=> array('columns'),
				'theme_navigation_type' => array('bullets'),
				'theme_enable_text_panel' => array( 'on' ),
				'theme_panel_position' => array( 'bottom' ),
				'theme_panel_position2' => array( 'bottom' ),
				'gallery_skin' => array('default'),
								
			);
	
			$this->main_css_element = '%%order_class%%.rdug_pb_unite_gallery';
			
		}
	
		function get_fields() {
			$fields = array(
				'src' => array(
					'label'           => esc_html__( 'Gallery Images', RDUG_TD ),
					'renderer'        => 'et_builder_get_gallery_settings',
					'option_category' => 'basic_option',
					'overwrite'       => array(
						'ids'         => 'gallery_ids',
						'orderby'     => 'gallery_orderby',
					),
				),
				'gallery_ids' => array(
					'type'  => 'hidden',
					'class' => array( 'et-pb-gallery-ids-field' ),
					'computed_affects'   => array(
						'__gallery',
					),
				),
				'gallery_orderby' => array(
					'label' => esc_html__( 'Gallery Images', RDUG_TD ),
					'type'  => 'hidden',
					'class' => array( 'et-pb-gallery-ids-field' ),
					'computed_affects'   => array(
						'__gallery',
					),
				),
				'gal_theme' => array(
					'label'             => esc_html__( 'Theme', RDUG_TD ),
					'type'              => 'select',
					'option_category'   => 'layout',
					'options'           => array(
						'default' => esc_html__( 'Default', RDUG_TD ),
						'tiles'  => esc_html__( 'Tiles', RDUG_TD ),
						'tilesgrid' => esc_html__( 'Tiles Grid', RDUG_TD ),
						'carousel' => esc_html__( 'Carousel', RDUG_TD ),
						'compact' => esc_html__( 'Compact', RDUG_TD ),
						'grid' => esc_html__( 'Grid', RDUG_TD ),
						'slider' => esc_html__( 'Slider', RDUG_TD ),
					),
					'description'       => esc_html__( 'Toggle between the various themes of unite gallery.', RDUG_TD ),
					'affects'           => array(
						'tiles_type',
						'theme_navigation_type',
						'theme_enable_text_panel',
						'theme_panel_position',
						'theme_panel_position2',
					),
				),
				'tiles_type'  => array(
					'label'             => esc_html__( 'Tiles Type', RDUG_TD ),
					'type'              => 'select',
					'option_category'   => 'layout',
					'options'           => array(
						'columns' => esc_html__( 'Columns', RDUG_TD ),			
						'justified' => esc_html__( 'Justified', RDUG_TD ),			
		            	'nested' => esc_html__( 'Nested', RDUG_TD ),			
					),
					'depends_show_if'   => 'tiles',
					'description'       => esc_html__( 'Toggle between the various tiles types. Tiles types will work with only tiles theme.', RDUG_TD ),
				),
				'theme_navigation_type'  => array(
					'label'             => esc_html__( 'Navigation Type', RDUG_TD ),
					'type'              => 'select',
					'option_category'   => 'layout',
					'options'           => array(
						'bullets' => esc_html__( 'Bullets', RDUG_TD ),			
						'arrows' => esc_html__( 'Arrows', RDUG_TD ),
					),
					'depends_show_if'   => 'tilesgrid',
					'description'       => esc_html__( 'Toggle between navigation types.  Navigation type will work with only tiles grid theme.', RDUG_TD ),
				),
				'theme_enable_text_panel' => array(
					'label'              => esc_html__( 
'Show Text Panel', RDUG_TD ),
					'type'               => 'yes_no_button',
					'option_category'    => 'configuration',
					'options'            => array(
						'on'  => esc_html__( 'Yes', RDUG_TD ),
						'off' => esc_html__( 'No', RDUG_TD ),
					),
					'description'        => esc_html__( 'Whether or not to show the text panel. This Option will work only with default theme.', RDUG_TD ),
					'depends_show_if'    => 'default',
				),
				'theme_panel_position'  => array(
					'label'             => esc_html__( 'Panel Position', RDUG_TD ),
					'type'              => 'select',
					'option_category'   => 'layout',
					'options'           => array(
						'bottom' => esc_html__( 'Bottom', RDUG_TD ),
						'top' => esc_html__( 'Top', RDUG_TD ),
						'left' => esc_html__( 'Left', RDUG_TD ),			
						'right' => esc_html__( 'Right', RDUG_TD ),
					),
					'depends_show_if'   => 'compact',
					'description'       => esc_html__( 'Toggle between panel positions.  Navigation type will work with only compact grid theme.', RDUG_TD ),
				),
				'theme_panel_position2'  => array(
					'label'             => esc_html__( 'Panel Position', RDUG_TD ),
					'type'              => 'select',
					'option_category'   => 'layout',
					'options'           => array(
						'bottom' => esc_html__( 'Bottom', RDUG_TD ),
						'top' => esc_html__( 'Top', RDUG_TD ),
						'left' => esc_html__( 'Left', RDUG_TD ),			
						'right' => esc_html__( 'Right', RDUG_TD ),
					),
					'depends_show_if'   => 'grid',
					'description'       => esc_html__( 'Toggle between panel positions.  Navigation type will work with only grid theme.', RDUG_TD ),
				),
				'gallery_skin' => array(
					'label'             => esc_html__( 'Skins', RDUG_TD ),
					'type'              => 'select',
					'option_category'   => 'layout',
					'options'           => array(
						'default' => esc_html__( 'Default', RDUG_TD ),
						'alexis' => esc_html__( 'Alexis', RDUG_TD ),
					),
					'description'       => esc_html__( 'Toggle between the various skins of unite gallery.', RDUG_TD ),
				),
				
				
				'disabled_on' => array(
					'label'           => esc_html__( 'Disable on', RDUG_TD ),
					'type'            => 'multiple_checkboxes',
					'options'         => array(
						'phone'   => esc_html__( 'Phone', RDUG_TD ),
						'tablet'  => esc_html__( 'Tablet', RDUG_TD ),
						'desktop' => esc_html__( 'Desktop', RDUG_TD ),
					),
					'additional_att'  => 'disable_on',
					'option_category' => 'configuration',
					'description'     => esc_html__( 'This will disable the module on selected devices', RDUG_TD ),
				),
				'admin_label' => array(
					'label'       => esc_html__( 'Admin Label', RDUG_TD ),
					'type'        => 'text',
					'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', RDUG_TD ),
				),
				'module_id' => array(
					'label'           => esc_html__( 'CSS ID', RDUG_TD ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'tab_slug'        => 'custom_css',
					'option_class'    => 'et_pb_custom_css_regular',
				),
				'module_class' => array(
					'label'           => esc_html__( 'CSS Class', RDUG_TD ),
					'type'            => 'text',
					'option_category' => 'configuration',
					'tab_slug'        => 'custom_css',
					'option_class'    => 'et_pb_custom_css_regular',
				),
				'__gallery' => array(
					'type' => 'computed',
					'computed_callback' => array( 'RWDUG_Builder_Module_Unite_Gallery', 'get_gallery' ),
					'computed_depends_on' => array(
						'gallery_ids',
						'gallery_orderby',
					),
				),
			);
			return apply_filters('rdug_fileds', $fields);
		}
	
		/**
		 * Get attachment data for gallery module
		 *
		 * @param array $args {
		 *     Gallery Options
		 *
		 *     @type array  $gallery_ids     Attachment Ids of images to be included in gallery.
		 *     @type string $gallery_orderby `orderby` arg for query. Optional.
		 *   
		 *     @type string $orientation     Orientation of thumbnails (landscape|portrait).
		 * }
		 * @param array $conditional_tags
		 * @param array $current_page
		 *
		 * @return array Attachments data
		 */
		static function get_gallery( $args = array(), $conditional_tags = array(), $current_page = array() ) {
			$attachments = array();
	
			$defaults = array(
				'gallery_ids'     => array(),
				'gallery_orderby' => '',
			);
	
			$args = wp_parse_args( $args, $defaults );
	
			$attachments_args = array(
				'include'        => $args['gallery_ids'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => 'ASC',
				'orderby'        => 'post__in',
			);
	
			if ( 'rand' === $args['gallery_orderby'] ) {
				$attachments_args['orderby'] = 'rand';
			}
	
			
			$width  = 1080;
			$height = 9999;
			
			$width  = (int) apply_filters( 'rdug_pb_unite_gallery_image_width', $width );
			$height = (int) apply_filters( 'rdug_pb_unite_gallery_image_height', $height );
	
			$_attachments = get_posts( $attachments_args );
	
			foreach ( $_attachments as $key => $val ) {
				$attachments[$key] = $_attachments[$key];
				$attachments[$key]->image_src_full  = wp_get_attachment_image_src( $val->ID, 'full' );
				$attachments[$key]->image_src_thumb = wp_get_attachment_image_src( $val->ID, array( $width, $height ) );
			}
	
			return $attachments;
		}
	
		function shortcode_callback( $atts, $content = null, $function_name ) {
			
			$module_id              = $this->shortcode_atts['module_id'];
			$module_class           = $this->shortcode_atts['module_class'];
			$gallery_ids            = $this->shortcode_atts['gallery_ids'];
			$gal_theme            	= apply_filters('rdug_gallery_theme', $this->shortcode_atts['gal_theme']);
			$theme_navigation_type = $this->shortcode_atts['theme_navigation_type'];
			$theme_enable_text_panel = $this->shortcode_atts['theme_enable_text_panel'];
			$theme_panel_position = $this->shortcode_atts['theme_panel_position'];
			$theme_panel_position2 = $this->shortcode_atts['theme_panel_position2'];
			$gallery_skin = apply_filters('rdug_gallery_skin', $this->shortcode_atts['gallery_skin']);
			
			$gallery_orderby        = $this->shortcode_atts['gallery_orderby'];
			
			$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );
			
			
			// Get gallery item data
			$attachments = self::get_gallery( array(
				'gallery_ids'     => $gallery_ids,
				'gallery_orderby' => $gallery_orderby,
			) );
	
			if ( empty( $attachments ) ) {
				return '';
			}
	
			wp_enqueue_script( 'hashchange' );
	
			$output = sprintf(
				'<div%1$s class="et_pb_module rdug_pb_unite_gallery%2$s clearfix">
					<div class="rdug_pb_unite_gallery_items et_post_gallery" >',
				( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
				( '' !== $module_class ? sprintf( ' %1$s', esc_attr( ltrim( $module_class ) ) ) : '' )
			);
	
			
			
			if( isset( $GLOBALS['rdug_gal_count'] ) )
				$GLOBALS['rdug_gal_count']++;
			else
				$GLOBALS['rdug_gal_count'] = 0;
				
			$inline_js = "
                jQuery(document).ready(function(){
					var api_".$GLOBALS['rdug_gal_count'].";
                    api_".$GLOBALS['rdug_gal_count']." =  jQuery('#gallery-".$GLOBALS['rdug_gal_count']
					."')
					.unitegallery(
						{
							gallery_theme:'".$gal_theme."',";
							if( $gal_theme == 'tiles' && !empty($tiles_type) )
							{	
								$inline_js .= "'tiles_type' : '".$tiles_type."',";
							}
							
							if( $gal_theme == 'tilesgrid' && !empty($theme_navigation_type) )
							{
								$inline_js .= "'theme_navigation_type' : '".$theme_navigation_type."',";
							}
							
							if( $gal_theme == 'default' &&  !empty($theme_enable_text_panel) &&  $theme_enable_text_panel == 'off'  )
							{	
								$inline_js .= "'theme_enable_text_panel' : false,";
							}
							
							if( $gal_theme == 'compact' &&  !empty($theme_panel_position) )
							{	
								$inline_js .= "'theme_panel_position' : '".$theme_panel_position."',";
							}
							elseif( $gal_theme == 'grid' &&  !empty($theme_panel_position2) )
							{	
								$inline_js .= "'theme_panel_position' : '".$theme_panel_position2."',";
							}
							
							$inline_js .= "
							'gallery_skin' : '".$gallery_skin."'
							
						}
					);
                });";
				rdug_enqueue_ug_assets($gal_theme, $gallery_skin ,apply_filters('rdug_inline_js',  $inline_js));


				
			
			ob_start();
			do_action('rdug_before_slider'); 
			?>
			<div id="gallery-<?php echo $GLOBALS['rdug_gal_count'];?>" style="display:none;">
            <?php
			foreach ( $attachments as $id => $attachment ) {
			?>
        		<img alt="<?php echo $attachment->post_title;?>"
                         src="<?php echo $attachment->image_src_thumb[0];?>"
                         data-image="<?php echo $attachment->image_src_full[0];?>"
                         data-title="<?php echo $attachment->post_title;?>"
                         data-description="<?php echo $attachment->post_title;?>" />    
            
            <?php
			}
			?>
			</div>
	
			<?php 
			do_action('rdug_after_slider'); 
			$output .=  ob_get_clean();
			
			
			$output .= "</div><!-- .rdug_pb_unite_gallery_items -->";
			$output .= "</div><!-- .rdug_pb_unite_gallery -->";
			
			return $output;
		}
	}
	$et_builder_module_gallery2 = new RWDUG_Builder_Module_Unite_Gallery();
	add_shortcode( 'rdug_et_pb_unite_gallery', array($et_builder_module_gallery2, '_shortcode_callback') );

  }

}
add_action('et_builder_ready', 'rdug_divi_unite_gallery_setup');