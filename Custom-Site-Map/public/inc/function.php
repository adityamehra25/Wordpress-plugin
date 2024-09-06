<?php 
function getAllPostType(){
    // Get post types
    $args       = array(
        'public' => true,
    );
    return $post_types = get_post_types( $args, 'objects' );		
}

function getAllpage(){
    $args = array(
        'sort_order' => 'asc',        
        'sort_column' => 'post_title',        
        'hierarchical' => 1,        
        'exclude' => '',        
        'include' => '',        
        'meta_key' => '',        
        'meta_value' => '',        
        'authors' => '',        
        'child_of' => 0,        
        'parent' => -1,        
        'exclude_tree' => '',        
        'number' => '',        
        'offset' => 0,        
        'post_type' => 'page',        
        'post_status' => 'publish'        
        );         
        return $pages = get_pages($args);
}
?>