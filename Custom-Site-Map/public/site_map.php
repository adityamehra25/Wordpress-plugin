<?php
class siteMap {

    public function __construct() {

		add_action('admin_menu', [$this,'registerSiteMapMenu']);
		add_action( 'admin_enqueue_scripts', [$this,'includeStyleScript'] );
		add_action( 'admin_footer', [$this,'includeStyleScriptFooter'] );
		add_action("wp_ajax_siteMapDataSave", [$this,'siteMapDataSave']);
		add_action("wp_ajax_nopriv_siteMapDataSave", [$this,'siteMapDataSave']);
		add_action("wp_ajax_getAllPostType", [$this,'getAllPostType']);
		add_action("wp_ajax_nopriv_getAllPostType", [$this,'getAllPostType']);
		add_filter('the_content', [$this,'siteMapDisplay']);
		add_shortcode('bl-site-map', [$this,'siteMapShortcode']);
	}
	// register menu under setting
	function registerSiteMapMenu() {
		add_submenu_page( 'options-general.php', 'Site Map', 'Site Map', 'administrator', 'site-map', [$this,'siteMapPage'],0 );
	}
	// include admin setting html
	public function siteMapPage() {  
		if ( file_exists( __DIR__ . '/inc/admin/admin-main.php' ) ) {
            $file =  __DIR__ . '/inc/admin/admin-main.php';
			require_once($file);
        }
	}
	// add drag drop js
	public function includeStyleScriptFooter(){
		echo '<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
		<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>';
		
	}
	// Include js and css
	public function includeStyleScript(){
		if(isset($_GET['page']) && $_GET['page']=='site-map'):
		wp_enqueue_style( 'admin-bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), '1.0' );
		wp_enqueue_style( 'admin-style-css', plugin_dir_url( __FILE__ ) . 'css/admin_style.css', array(), '1.0' );
		wp_enqueue_style( 'admin-all-css',  'https://use.fontawesome.com/releases/v5.15.4/css/all.css', array(), '1.0' );
    	//wp_enqueue_script( 'admin-jsmin-js', plugin_dir_url( __FILE__ ) . 'https://code.jquery.com/jquery-3.6.0.js', array(), '1.0' );		
		//wp_enqueue_script( 'admin-ui-js', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.min.js', array(), '1.0' );				
		wp_enqueue_script( 'admin-him-script', plugin_dir_url( __FILE__ ) . 'js/admin_script.js', array(), '1.0' );
				
    	wp_enqueue_script( 'admin-bundle-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.bundle.min.js', array(), '1.0' );
		wp_localize_script( 'site_map_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
		wp_enqueue_script( 'site_map_script' );	
		endif;
	}
	// save site map data
	public function siteMapDataSave(){
		parse_str($_POST['data'], $params);
		if(isset($_POST['action']) || $_POST['action']=='siteMapDataSave'):
		if(isset($_POST['pageSelected']) || !empty($_POST['pageSelected'])):
			update_option('site_map_page',$_POST['pageSelected']);
		endif;
		if(isset($_POST['layout']) || !empty($_POST['layout'])):
			update_option('site_map_layout',$_POST['layout']);
		endif;
		if(isset($params['column1']) || !empty($params['column1'])):
			update_option('data_col-1',maybe_serialize($params['column1']));
		endif;
		if(isset($params['column2']) || !empty($params['column2'])):
			update_option('data_col-2',maybe_serialize($params['column2']));
		endif;
		if(isset($params['column3']) || !empty($params['column3'])):
			update_option('data_col-3',maybe_serialize($params['column3']));
		endif;
		if(isset($params['column4']) || !empty($params['column4'])):
			update_option('data_col-4',maybe_serialize($params['column4']));
		endif;
		if(isset($params['row-1']) || !empty($params['row-1'])):
			update_option('data_col-5',maybe_serialize($params['row-1']));
		endif;
		if(isset($params['row-2']) || !empty($params['row-2'])):
			update_option('data_col-6',maybe_serialize($params['row-2']));
		endif;
		$return = array(
			'message' => __( 'Saved', 'textdomain' )
		);
		wp_send_json_success( $return );
	endif;
	}
	// ajax get all post type
	public function getAllPostType(){
		// Get post types
		$args       = array(
			'public' => true,
		);
		$post_types = get_post_types( $args, 'objects' );	
		$html = "";
		foreach ( $post_types as $post_type_obj ):
			$labels = get_post_type_labels( $post_type_obj );
			$html .='<option value="'.esc_attr( $post_type_obj->name ).'">'.esc_html( $labels->name ).'</option>';
		 endforeach;
		$return = array(
			'data' => $html
		);
		echo json_encode( array('data' => $html ));	
		exit;
	}
	// append frontend layout according to page
	function siteMapDisplay( $content ) {
		@$pageID = get_option('site_map_page');		   
		// Check if we're inside the main loop in a single Post.
		if ( is_page($pageID) && !empty($pageID)) {
			$file =  __DIR__ . '/inc/front/front-template.php';
			@$layout = get_option('site_map_layout');
		 	$html = "";  
			 $html .= '<div class="column_section"><div class="grid-container"><div class="main_section_column '.$layout.'">';
		   if(isset($layout) && !empty($layout)){		   
			   $layoutnumber = explode("-",$layout);
			   if($layoutnumber[1]=='stacked'){$minx= 5; $layoutnumber[1] = 6; }else{  $minx= 1; $layoutnumber[1] = $layoutnumber[1];}
			   for ($x = $minx; $x <=  $layoutnumber[1]; $x++) {				  
				$html .= '<div class="series_section">';
				@$col_data = get_option('data_col-'.$x); 
					if(isset($col_data) && !empty($col_data)):
					$unserializeData = maybe_unserialize($col_data); 
					foreach($unserializeData['col-'.$x] as $col1): 
						$html .= '<div class="listbox"><h2>'.@$col1['title_list1'].'</h2>';
						$args = array(
							'post_type' => @$col1['post_type_col-1'],
							'posts_per_page' => -1,
							'orderby' => @$col1['orderby_col-1'],
            				'order'   =>@$col1['order_col-1'],
							'post__not_in' => array(@$col1['exclude_col-1']),
						);
					$query = new WP_Query($args);
					if ($query->have_posts() ) : 
						$html .= '<ul class="bl-sm-ul">';
						while ( $query->have_posts() ) : $query->the_post();
						$html .= '<li data-id="'.get_the_ID().'"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
						endwhile;
						$html .= '</ul>';
						wp_reset_postdata();
					endif;
					$html .= "</div>";
					endforeach;	
					endif;
					$html .= "</div>";
			  } 		 
		   }
		   $html .= "</div> </div> </div>";
		$content .= $html;
			wp_enqueue_style( 'sitemap-front', plugin_dir_url( __FILE__ ) . 'css/front_style.css', array(), '1.0' );
		}
	
		return $content;
	}
	/** Shortcode */
	function siteMapShortcode( $content ) {
			@$layout = get_option('site_map_layout');
		 	$html = "";  
			 $html .= '<div class="column_section"><div class="grid-container"><div class="main_section_column '.$layout.'">';
		   if(isset($layout)){		   
			   $layoutnumber = explode("-",$layout);
			   if($layoutnumber[1]=='stacked'){$minx= 5; $layoutnumber[1] = 6; }else{  $minx= 1; $layoutnumber[1] = $layoutnumber[1];}
			   for ($x = $minx; $x <=  $layoutnumber[1]; $x++) {				  
				$html .= '<div class="series_section">';
				@$col_data = get_option('data_col-'.$x); 
					if(isset($col_data) && !empty($col_data)):
					$unserializeData = maybe_unserialize($col_data); 
					foreach($unserializeData['col-'.$x] as $col1): 
						$html .= '<div class="listbox"><h2>'.@$col1['title_list1'].'</h2>';
						$args = array(
							'post_type' => $col1['post_type_col-1'],
							'posts_per_page' => -1,
							'orderby' => @$col1['orderby_col-1'],
            				'order'   => @$col1['order_col-1'],
							'post__not_in' => array(@$col1['exclude_col-1']),
						);
					$query = new WP_Query($args);
					if ($query->have_posts() ) : 
						$html .= '<ul class="bl-sm-ul">';
						while ( $query->have_posts() ) : $query->the_post();
						$html .= '<li data-id="'.get_the_ID().'"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
						endwhile;
						$html .= '</ul>';
						wp_reset_postdata();
					endif;
					$html .= "</div>";
					endforeach;	
					endif;
					$html .= "</div>";
			  } 		 
		   }
		   $html .= "</div> </div> </div>";
		$content .= $html;
			wp_enqueue_style( 'sitemap-front', plugin_dir_url( __FILE__ ) . 'css/front_style.css', array(), '1.0' );

		return $content;
	}
}
$siteMap  = new siteMap();
?>