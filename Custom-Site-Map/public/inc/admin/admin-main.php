<section id="sidemape">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="heading">
               <h1>Site Map</h1>
            </div>
         </div>
         <div class="col-md-9">
            <div class="main_section">
               <?php @$layout = get_option('site_map_layout'); ?>
               <div class='layout_main'>
                  <h2 class="border-bottom">Layout</h2>
               </div>
               <div class="column_section">
                  <div class="inner_col <?php if(isset($layout) && $layout=='col-1'): echo "active"; else: ""; endif; ?>">                        
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column1.png'; ?>' class='column_img normal_img'>
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column1Active.png'; ?>' class='column_img active_img'>
                     <span>1 Column</span>
                     <input type="radio" name="option" id="Col-1" value="col-1" data-id="0" name="col-1" <?php if(isset($layout) && $layout=='col-1'): echo "checked"; else: ""; endif; ?>>
                  </div>
                  <div class="inner_col <?php if(isset($layout) && $layout=='col-2'): echo "active"; else: ""; endif; ?>">
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column2.png'; ?>' class='column_img normal_img'>
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column2Active.png'; ?>' class='column_img active_img'>
                     <span>2 Column</span>
                     <input type="radio" name="option" id="col-2" value="col-2" name="col-2" data-id="1" <?php if(isset($layout) && $layout=='col-2'): echo "checked"; else: ""; endif; ?>>
                  </div>
                  <div class="inner_col <?php if(isset($layout) && $layout=='col-3'): echo "active"; else: ""; endif; ?>">
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column3.png'; ?>' class='column_img normal_img'>
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column3Active.png'; ?>' class='column_img active_img'>
                     <span>3 Column</span>
                     <input type="radio" name="option" id="col-3" value="col-3" data-id="2" name="col-3" <?php if(isset($layout) && $layout=='col-3'): echo "checked"; else: ""; endif; ?>>
                  </div>
                  <div class="inner_col <?php if(isset($layout) && $layout=='col-4'): echo "active"; else: ""; endif; ?>">
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column4.png'; ?>' class='column_img normal_img'>
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/column4Active.png'; ?>' class='column_img active_img'>
                     <span>4 Column</span>
                     <input type="radio" name="option" id="col-4" value="col-4" data-id="3" name="col-4" <?php if(isset($layout) && $layout=='col-4'): echo "checked"; else: ""; endif; ?>>
                  </div>
                  <div class="inner_col <?php if(isset($layout) && $layout=='row-stacked'): echo "active"; else: ""; endif; ?>">
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/row2.png'; ?>' class='column_img normal_img'>
                     <img src='<?php  echo MY_PLUGIN_PATH . 'public/img/row2Active.png'; ?>' class='column_img active_img'>
                     <span>2 Rows Stacked</span>
                     <input type="radio" name="option" id="col-5" value="row-stacked" data-id="4" name="row-stacked" <?php if(isset($layout) && $layout=='row-stacked'): echo "checked"; else: ""; endif; ?>>  
                  </div>
               </div>
            </div>
            <form action="" method="post" id="formsitemap"> 
            <div class="allcolums mt-5">
               <div class="collaps_box right_box mt-2 column_box">
                  <h2 class="border-bottom">column1
                     <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#column1"></i>
                  </h2>
                
                  <div id="column1" class="panel-collapse collapse droppable" data-id="1">                 
                  <?php 
                      @$col_data = get_option('data_col-1');
                      $slug = 'column1';
                      $slugid = '1';
                      $col1html = ""; 
                      if(isset($col_data) && !empty($col_data)):
                        $unserializeData = maybe_unserialize($col_data);                       
                        $i = 1;
                       foreach($unserializeData['col-1'] as $col1):                      
                        $post_types = getAllPostType(); // get all pages based on supplied args 
                        @$pageID = $col1['post_type_col-1'];   
                        $pagesHtml = "";                        
                        $pagesHtml .= '<select id="post" name="'.$slug.'[col-'.$slugid.']['.$i.'][post_type_col-1]"> <option value="">Post Type</option>';                        
                        foreach ( $post_types as $post_type_obj ){ // $pages is array of object                        
                        $labels = get_post_type_labels( $post_type_obj );
                        if($post_type_obj->name==$pageID): $selected = "selected"; else: $selected = ""; endif;
			               $pagesHtml .='<option value="'.esc_attr( $post_type_obj->name ).'" '.$selected.'>'.esc_html( $labels->name ).'</option>';                       
                        }
                        $pagesHtml .= " </select>";
                        $orderby = ['title'=>'Title','id'=>'ID','date'=>'Date'];
                        @$SelectedOrederBy = $col1['orderby_col-1'];   
                        $orderByHtml = "";                        
                        $orderByHtml .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][orderby_col-1]"> <option value="">Order By </option>';            
                        foreach ( $orderby as $key=>$orderbys ){                            
                        if($key==$SelectedOrederBy): $selected = "selected"; else: $selected = ""; endif;
			               $orderByHtml .='<option value="'.esc_attr( $key ).'" '.$selected.'>'.esc_html($orderbys ).'</option>';                       
                        }
                        $orderByHtml .= " </select>";
                        $order = ['asc'=>'Ascending','desc'=>'Descending'];
                        @$SelectedOreder = $col1['order_col-1'];   
                        $orderHtml = "";                        
                        $orderHtml .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][order_col-1]"> <option value="">Select Order</option>';            
                        foreach ( $order as $orderkey=>$orders ){                            
                        if($orderkey==$SelectedOreder): $selected = "selected"; else: $selected = ""; endif;
			               $orderHtml .='<option value="'.esc_attr( $orderkey ).'" '.$selected.'>'.esc_html($orders ).'</option>';                       
                        }
                        $orderHtml .= " </select>";
                        $col1html .= '<div class="element draggable" id="'.$slug.'_'.$i.'"><div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '.$i.'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'.$slug.'-remove_'.$i.'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'.$i.'"></i> </div> </div> <div class="layout_row-12" id="list_'.$i.'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> '.$pagesHtml.' <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'.$slug.'[col-'.$slugid.']['.$i.'][title_list1]" value="'.@$col1['title_list1'].'"> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#'.$slug.'_option_section'.$i.'"></i> Option</span> </h2> <div class="optionbox collapse" id="'.$slug.'_option_section'.$i.'"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label>'.$orderByHtml.' <br> </div> <div class="option_order"> <label for="oder">Order</label> '.$orderHtml.' <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'.$slug.'[col-'.$slugid.']['.$i.'][exclude_col-1]" placeholder="Enter text here...">'.@$col1['exclude_col-1'].'</textarea> </div> </div> </div> </div></div></div></div>';		
                        $i++;endforeach;
                       else:
                        $col1html .= "<div class='element' id='".$slug."_0'></div>";
                     endif;   
                     echo  $col1html;
                  ?>                                   
                     <div class="add_btn">
                        <button type="button" class="add">Add List</button>                     
                     </div>                     
                  </div>
               </div>
               <div class="collaps_box right_box mt-2 column_box">
                  <h2 class="border-bottom " >column2
                     <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#column2"></i>
                  </h2>
                  <div id="column2" class="panel-collapse collapse droppable" data-id="2">
                  <?php 
                      @$col_data2 = get_option('data_col-2');
                      $slug = 'column2';
                      $slugid = '2';
                      $col2html = ""; 
                      if(isset($col_data2) && !empty($col_data2)):
                        $unserializeData2 = maybe_unserialize($col_data2);                       
                        $i = 1;
                       foreach($unserializeData2['col-2'] as $col2):                      
                        $post_types2 = getAllPostType(); // get all pages based on supplied args 
                        @$pageID2 = $col2['post_type_col-1'];   
                        $pagesHtml2 = "";                        
                        $pagesHtml2 .= '<select id="post" name="'.$slug.'[col-'.$slugid.']['.$i.'][post_type_col-1]"> <option value="">Post Type</option>';                        
                        foreach ( $post_types2 as $post_type_obj2 ){ // $pages is array of object                        
                        $labels2 = get_post_type_labels( $post_type_obj2 );
                        if($post_type_obj2->name==$pageID2): $selected = "selected"; else: $selected = ""; endif;
			               $pagesHtml2 .='<option value="'.esc_attr( $post_type_obj2->name ).'" '.$selected.'>'.esc_html( $labels2->name ).'</option>';                       
                        }
                        $pagesHtml2 .= " </select>";
                        $orderby2 = ['title'=>'Title','id'=>'ID','date'=>'Date'];
                        @$SelectedOrederBy = $col2['orderby_col-1'];   
                        $orderByHtml2 = "";                        
                        $orderByHtml2 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][orderby_col-1]"> <option value="">Order By </option>';            
                        foreach ( $orderby2 as $key2=>$orderbys2 ){                            
                        if($key2==$SelectedOrederBy): $selected2 = "selected"; else: $selected2 = ""; endif;
			               $orderByHtml2 .='<option value="'.esc_attr( $key2 ).'" '.$selected.'>'.esc_html($orderbys2 ).'</option>';                       
                        }
                        $orderByHtml2 .= " </select>";
                        $order2 = ['asc'=>'Ascending','desc'=>'Descending'];
                        @$SelectedOreder2 = $col2['order_col-1'];   
                        $orderHtml2 = "";                        
                        $orderHtml2 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][order_col-1]"> <option value="">Order</option>';            
                        foreach ( $order2 as $orderkey2=>$orders2 ){                            
                        if($orderkey2==$SelectedOreder2): $selected2 = "selected"; else: $selected2 = ""; endif;
			               $orderHtml2 .='<option value="'.esc_attr( $orderkey2 ).'" '.$selected2.'>'.esc_html($orders2 ).'</option>';                       
                        }
                        $orderHtml2 .= " </select>";
                        $col2html .= '<div class="element" id="'.$slug.'_'.$i.'"><div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '.$i.'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'.$slug.'-remove_'.$i.'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'.$i.'"></i> </div> </div> <div class="layout_row-12" id="list_'.$i.'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> '.$pagesHtml2.' <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'.$slug.'[col-'.$slugid.']['.$i.'][title_list1]" value="'.@$col2['title_list1'].'"> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#'.$slug.'_option_section'.$i.'"></i> Option</span> </h2> <div class="optionbox collapse" id="'.$slug.'_option_section'.$i.'"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label>'.$orderByHtml2.' <br> </div> <div class="option_order"> <label for="oder">Order</label> '.$orderHtml2.' <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'.$slug.'[col-'.$slugid.']['.$i.'][exclude_col-1]" placeholder="Enter text here...">'.@$col2['exclude_col-1'].'</textarea> </div> </div> </div> </div></div></div></div>';		
                        $i++;endforeach;
                       else:
                        $col2html .= "<div class='element' id='".$slug."_0'></div>";
                     endif;   
                     echo  $col2html;
                  ?>                                   
                     <div class="add_btn">
                        <button type="button" class="add">Add List</button>                     
                     </div> 
                  </div>
               </div>
               <div class="collaps_box right_box mt-2 column_box">
                  <h2 class="border-bottom " >column3
                     <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#column3" ></i>
                  </h2>
                  <div id="column3" class="panel-collapse droppable collapse" data-id="3">
                  <?php 
                      @$col_data3 = get_option('data_col-3');
                      $slug = 'column3';
                      $slugid = '3';
                      $col3html = ""; 
                      if(isset($col_data3) && !empty($col_data3)):
                        $unserializeData3 = maybe_unserialize($col_data3);                       
                        $i = 1;
                       foreach($unserializeData3['col-3'] as $col3):                      
                        $post_types3 = getAllPostType(); // get all pages based on supplied args 
                        @$pageID3 = $col3['post_type_col-1'];   
                        $pagesHtml3 = "";                        
                        $pagesHtml3 .= '<select id="post" name="'.$slug.'[col-'.$slugid.']['.$i.'][post_type_col-1]"> <option value="">Post Type</option>';                        
                        foreach ( $post_types3 as $post_type_obj3 ){ // $pages is array of object                        
                        $labels3 = get_post_type_labels( $post_type_obj3 );
                        if($post_type_obj3->name==$pageID3): $selected = "selected"; else: $selected = ""; endif;
			               $pagesHtml3 .='<option value="'.esc_attr( $post_type_obj3->name ).'" '.$selected.'>'.esc_html( $labels3->name ).'</option>';                       
                        }
                        $pagesHtml3 .= " </select>";
                        $orderby3 = ['title'=>'Title','id'=>'ID','date'=>'Date'];
                        @$SelectedOrederBy3 = $col3['orderby_col-1'];   
                        $orderByHtml3 = "";                        
                        $orderByHtml3 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][orderby_col-1]"> <option value="">Order By </option>';            
                        foreach ( $orderby3 as $key3=>$orderbys3 ){                            
                        if($key3==$SelectedOrederBy3): $selected3 = "selected"; else: $selected3 = ""; endif;
			               $orderByHtml3 .='<option value="'.esc_attr( $key3 ).'" '.$selected.'>'.esc_html($orderbys3 ).'</option>';                       
                        }
                        $orderByHtml3 .= " </select>";
                        $order3 = ['asc'=>'Ascending','desc'=>'Descending'];
                        @$SelectedOreder3 = $col3['order_col-1'];   
                        $orderHtml3 = "";                        
                        $orderHtml3 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][order_col-1]"> <option value="">Order</option>';            
                        foreach ( $order3 as $orderkey3=>$orders3 ){                            
                        if($orderkey3==$SelectedOreder3): $selected3 = "selected"; else: $selected3 = ""; endif;
			               $orderHtml3 .='<option value="'.esc_attr( $orderkey3 ).'" '.$selected3.'>'.esc_html($orders3 ).'</option>';                       
                        }
                        $orderHtml3 .= " </select>";
                        $col3html .= '<div class="element" id="'.$slug.'_'.$i.'"><div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '.$i.'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'.$slug.'-remove_'.$i.'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'.$i.'"></i> </div> </div> <div class="layout_row-12" id="list_'.$i.'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> '.$pagesHtml3.' <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'.$slug.'[col-'.$slugid.']['.$i.'][title_list1]" value="'.@$col3['title_list1'].'"> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#'.$slug.'_option_section'.$i.'"></i> Option</span> </h2> <div class="optionbox collapse" id="'.$slug.'_option_section'.$i.'"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label>'.$orderByHtml3.' <br> </div> <div class="option_order"> <label for="oder">Order</label> '.$orderHtml3.' <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'.$slug.'[col-'.$slugid.']['.$i.'][exclude_col-1]" placeholder="Enter text here...">'.@$col3['exclude_col-1'].'</textarea> </div> </div> </div> </div></div></div></div>';		
                        $i++;endforeach;
                       else:
                        $col3html .= "<div class='element' id='".$slug."_0'></div>";
                     endif;   
                     echo  $col3html;
                  ?>                                   
                     <div class="add_btn">
                        <button type="button" class="add">Add List</button>                     
                     </div>
                  </div>
               </div>
               <div class="collaps_box right_box mt-2 column_box">
                  <h2 class="border-bottom">column4
                     <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#column4"></i>
                  </h2>
                  <div id="column4" class="panel-collapse droppable collapse" data-id="4">
                  <?php 
                      @$col_data4 = get_option('data_col-4');
                      $slug = 'column4';
                      $slugid = '4';
                      $col4html = ""; 
                      if(isset($col_data4) && !empty($col_data4)):
                        $unserializeData4 = maybe_unserialize($col_data4);                       
                        $i = 1;
                       foreach($unserializeData4['col-4'] as $col4):                      
                        $post_types4 = getAllPostType(); // get all pages based on supplied args 
                        @$pageID4 = $col4['post_type_col-1'];   
                        $pagesHtml4 = "";                        
                        $pagesHtml4 .= '<select id="post" name="'.$slug.'[col-'.$slugid.']['.$i.'][post_type_col-1]"> <option value="">Post Type</option>';                        
                        foreach ( $post_types4 as $post_type_obj4 ){ // $pages is array of object                        
                        $labels4 = get_post_type_labels( $post_type_obj4 );
                        if($post_type_obj4->name==$pageID4): $selected = "selected"; else: $selected = ""; endif;
			               $pagesHtml4 .='<option value="'.esc_attr( $post_type_obj4->name ).'" '.$selected.'>'.esc_html( $labels4->name ).'</option>';                       
                        }
                        $pagesHtml4 .= " </select>";
                        $orderby4 = ['title'=>'Title','id'=>'ID','date'=>'Date'];
                        @$SelectedOrederBy4 = $col4['orderby_col-1'];   
                        $orderByHtml4 = "";                        
                        $orderByHtml4 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][orderby_col-1]"> <option value="">Order By </option>';            
                        foreach ( $orderby4 as $key4=>$orderbys4 ){                            
                        if($key4==$SelectedOrederBy4): $selected4 = "selected"; else: $selected4 = ""; endif;
			               $orderByHtml4 .='<option value="'.esc_attr( $key4 ).'" '.$selected.'>'.esc_html($orderbys4 ).'</option>';                       
                        }
                        $orderByHtml4 .= " </select>";
                        $order4 = ['asc'=>'Ascending','desc'=>'Descending'];
                        @$SelectedOreder4 = $col4['order_col-1'];   
                        $orderHtml4 = "";                        
                        $orderHtml4 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][order_col-1]"> <option value="">Order</option>';            
                        foreach ( $order4 as $orderkey4=>$orders4 ){                            
                        if($orderkey4==$SelectedOreder4): $selected4 = "selected"; else: $selected4 = ""; endif;
			               $orderHtml4 .='<option value="'.esc_attr( $orderkey4 ).'" '.$selected4.'>'.esc_html($orders4 ).'</option>';                       
                        }
                        $orderHtml4 .= " </select>";
                        $col4html .= '<div class="element" id="'.$slug.'_'.$i.'"><div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '.$i.'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'.$slug.'-remove_'.$i.'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'.$i.'"></i> </div> </div> <div class="layout_row-12" id="list_'.$i.'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> '.$pagesHtml4.' <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'.$slug.'[col-'.$slugid.']['.$i.'][title_list1]" value="'.@$col4['title_list1'].'"> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#'.$slug.'_option_section'.$i.'"></i> Option</span> </h2> <div class="optionbox collapse" id="'.$slug.'_option_section'.$i.'"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label>'.$orderByHtml4.' <br> </div> <div class="option_order"> <label for="oder">Order</label> '.$orderHtml4.' <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'.$slug.'[col-'.$slugid.']['.$i.'][exclude_col-1]" placeholder="Enter text here...">'.@$col1['exclude_col-1'].'</textarea> </div> </div> </div> </div></div></div></div>';		
                        $i++;endforeach;
                       else:
                        $col4html .= "<div class='element' id='".$slug."_0'></div>";
                     endif;   
                     echo  $col4html;
                  ?>                                   
                     <div class="add_btn">
                        <button type="button" class="add">Add List</button>                     
                     </div>
                  </div>
               </div>
               <div class="collaps_box right_box mt-2 rows_stacked">
                  <h2 class="border-bottom">1 Rows Stacked
                     <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#row-1"></i>
                  </h2>
                  <div id="row-1" class="panel-collapse droppable collapse" data-id="5">
                  <?php 
                      @$col_data5 = get_option('data_col-5');
                      $slug = 'row-1';
                      $slugid = '5';
                      $col5html = ""; 
                      if(isset($col_data5) && !empty($col_data5)):
                        $unserializeData5 = maybe_unserialize($col_data5);                   
                        $i = 1;
                       foreach($unserializeData5['col-5'] as $col5):                      
                        $post_types5 = getAllPostType(); // get all pages based on supplied args 
                        @$pageID5 = $col5['post_type_col-1'];   
                        $pagesHtml5 = "";                        
                        $pagesHtml5 .= '<select id="post" name="'.$slug.'[col-'.$slugid.']['.$i.'][post_type_col-1]"> <option value="">Post Type</option>';                        
                        foreach ( $post_types5 as $post_type_obj5 ){ // $pages is array of object                        
                        $labels5 = get_post_type_labels( $post_type_obj5 );
                        if($post_type_obj5->name==$pageID5): $selected = "selected"; else: $selected = ""; endif;
			               $pagesHtml5 .='<option value="'.esc_attr( $post_type_obj5->name ).'" '.$selected.'>'.esc_html( $labels5->name ).'</option>';                       
                        }
                        $pagesHtml5 .= " </select>";
                        $orderby5 = ['title'=>'Title','id'=>'ID','date'=>'Date'];
                        @$SelectedOrederBy5 = $col5['orderby_col-1'];   
                        $orderByHtml5 = "";                        
                        $orderByHtml5 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][orderby_col-1]"> <option value="">Order By </option>';            
                        foreach ( $orderby5 as $key5=>$orderbys5 ){                            
                        if($key5==$SelectedOrederBy5): $selected5 = "selected"; else: $selected5 = ""; endif;
			               $orderByHtml5 .='<option value="'.esc_attr( $key5 ).'" '.$selected.'>'.esc_html($orderbys5 ).'</option>';                       
                        }
                        $orderByHtml5 .= " </select>";
                        $order5 = ['asc'=>'Ascending','desc'=>'Descending'];
                        @$SelectedOreder5 = $col5['order_col-1'];   
                        $orderHtml5 = "";                        
                        $orderHtml5 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][order_col-1]"> <option value="">Order</option>';            
                        foreach ( $order5 as $orderkey5=>$orders5 ){                            
                        if($orderkey5==$SelectedOreder5): $selected5 = "selected"; else: $selected5 = ""; endif;
			               $orderHtml5 .='<option value="'.esc_attr( $orderkey5 ).'" '.$selected5.'>'.esc_html($orders5 ).'</option>';                       
                        }
                        $orderHtml5 .= " </select>";
                        $col5html .= '<div class="element" id="'.$slug.'_'.$i.'"><div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '.$i.'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'.$slug.'-remove_'.$i.'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'.$i.'"></i> </div> </div> <div class="layout_row-12" id="list_'.$i.'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> '.$pagesHtml5.' <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'.$slug.'[col-'.$slugid.']['.$i.'][title_list1]" value="'.@$col5['title_list1'].'"> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#'.$slug.'_option_section'.$i.'"></i> Option</span> </h2> <div class="optionbox collapse" id="'.$slug.'_option_section'.$i.'"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label>'.$orderByHtml5.' <br> </div> <div class="option_order"> <label for="oder">Order</label> '.$orderHtml5.' <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'.$slug.'[col-'.$slugid.']['.$i.'][exclude_col-1]" placeholder="Enter text here...">'.@$col5['exclude_col-1'].'</textarea> </div> </div> </div> </div></div></div></div>';		
                        $i++;endforeach;
                       else:
                        $col5html .= "<div class='element' id='".$slug."_0'></div>";
                     endif;   
                     echo  $col5html;
                  ?>                                   
                     <div class="add_btn">
                        <button type="button" class="add">Add List</button>                     
                     </div>
                  </div>
               </div>
               <div class="collaps_box right_box mt-2 rows_stacked">
                  <h2 class="border-bottom">2 Rows Stacked
                     <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#row-2"></i>
                  </h2>
                  <div id="row-2" class="panel-collapse droppable collapse" data-id="6">
                  <?php 
                      @$col_data6 = get_option('data_col-6');                    
                      $slug = 'row-2';
                      $slugid = '6';
                      $col6html = ""; 
                      if(isset($col_data6) && !empty($col_data6)):
                        $unserializeData6 = maybe_unserialize($col_data6);                  
                        $i = 1;
                      
                       foreach($unserializeData6['col-6'] as $col6):                      
                        $post_types6 = getAllPostType(); // get all pages based on supplied args 
                        @$pageID6 = $col6['post_type_col-1'];   
                        $pagesHtml6 = "";                        
                        $pagesHtml6 .= '<select id="post" name="'.$slug.'[col-'.$slugid.']['.$i.'][post_type_col-1]"> <option value="">Post Type</option>';                        
                        foreach ( $post_types6 as $post_type_obj6 ){ // $pages is array of object                        
                        $labels6 = get_post_type_labels( $post_type_obj6 );
                        if($post_type_obj6->name==$pageID6): $selected = "selected"; else: $selected = ""; endif;
			               $pagesHtml6 .='<option value="'.esc_attr( $post_type_obj6->name ).'" '.$selected.'>'.esc_html( $labels6->name ).'</option>';                       
                        }
                        $pagesHtml6 .= " </select>";
                        $orderby6 = ['title'=>'Title','id'=>'ID','date'=>'Date'];
                        @$SelectedOrederBy6 = $col6['orderby_col-1'];   
                        $orderByHtml6 = "";                        
                        $orderByHtml6 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][orderby_col-1]"> <option value="">Order By </option>';            
                        foreach ( $orderby6 as $key6=>$orderbys6 ){                            
                        if($key6==$SelectedOrederBy6): $selected6 = "selected"; else: $selected6 = ""; endif;
			               $orderByHtml6 .='<option value="'.esc_attr( $key6 ).'" '.$selected.'>'.esc_html($orderbys6 ).'</option>';                       
                        }
                        $orderByHtml6 .= " </select>";
                        $order6 = ['asc'=>'Ascending','desc'=>'Descending'];
                        @$SelectedOreder6 = $col6['order_col-1'];   
                        $orderHtml6 = "";                        
                        $orderHtml6 .= '<select id="orderby" name="'.$slug.'[col-'.$slugid.']['. $i .'][order_col-1]"> <option value="">Order</option>';            
                        foreach ( $order6 as $orderkey6=>$orders6 ){                            
                        if($orderkey6==$SelectedOreder6): $selected6 = "selected"; else: $selected6 = ""; endif;
			               $orderHtml6 .='<option value="'.esc_attr( $orderkey6 ).'" '.$selected6.'>'.esc_html($orders6 ).'</option>';                       
                        }
                        $orderHtml6 .= " </select>";
                        $col6html .= '<div class="element" id="'.$slug.'_'.$i.'"><div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '.$i.'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'.$slug.'-remove_'.$i.'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'.$i.'"></i> </div> </div> <div class="layout_row-12" id="list_'.$i.'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> '.$pagesHtml6.' <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'.$slug.'[col-'.$slugid.']['.$i.'][title_list1]" value="'.@$col6['title_list1'].'"> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#'.$slug.'_option_section'.$i.'"></i> Option</span> </h2> <div class="optionbox collapse" id="'.$slug.'_option_section'.$i.'"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label>'.$orderByHtml6.' <br> </div> <div class="option_order"> <label for="oder">Order</label> '.$orderHtml6.' <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'.$slug.'[col-'.$slugid.']['.$i.'][exclude_col-1]" placeholder="Enter text here...">'.@$col6['exclude_col-1'].'</textarea> </div> </div> </div> </div></div></div></div>';		
                        $i++;endforeach;
                       else:
                        $col6html .= "<div class='element' id='".$slug."_0'></div>";
                     endif;   
                     echo  $col6html;
                  ?>                                   
                     <div class="add_btn">
                        <button type="button" class="add">Add List</button>                     
                     </div>
                  </div>
               </div>
            </div>
            <div class="btn-main mt-3">
               <input type="button" class="savesitemap" name="savesitemap" value="Save Site Map Settings">
            </div>
            </form>
         </div>
         <div class="col-md-3">
            <div class="right_box">
               <h2 class="border-bottom">Save Site Map</h2>
               <div class="save_sitemap">
                  <h3>Choose Page Display Site Map</h3>
                  <p>Select the page you wish to display the site map. The CSS will be added only  to this page to support best practices for site speed optimization.</p>
                  <?php 
                     $pages = getAllpage(); // get all pages based on supplied args 
                     @$pageID = get_option('site_map_page');   
                     $pagesHtml = "";
                     
                     $pagesHtml .= '<select name="sitemappage"> <option value="">Select Page</option>';
                     
                     foreach($pages as $page){ // $pages is array of object
                     if($page->ID==$pageID): $selected = "selected"; else: $selected = ""; endif;
                     $pagesHtml .= '<option value="'.$page->ID.'" '.$selected.'>'.$page->post_title.'</option>';
                     
                     }
                     
                     $pagesHtml .= " </select>";
                     
                     echo $pagesHtml;
                     
                     ?>
                  <input type="button" name="savesitemap" class="savesitemap" value="Save Site Map Settings">
               </div>
            </div>
            <div class="right_box mt-4">
               <h2 class="border-bottom " >Note
                  <i class="fas fa-caret-up callapseheading " data-toggle="collapse" data-target="#note"></i>
               </h2>
               <div id="note" class="panel-collapse collapse in save_sitemap show">
                  <h3>Shortcode</h3>
                  <p>If you wish to add the site map manually to your page, select Shortcode in the page menu above. Then, copy and paste the shortcode below into your site map page.</p>
                  <strong>[bl-site-map]</strong>
                  <h3 class="mt-4">CSS Styling</h3>
                  <p>The CSS below is added to your website's design automatically. If you want to modify the styles associated with these classes, copy and paste the CSS below into the main CSS file of your theme and modify as you wish.</p>
                  <ul>
                     <li>bl-sm-ul {}</li>
                     <li>bl-sm-ul li {}</li>
                     <li>bl-sm-ul li a {}</li>
                     <li>bl-sm-ul ul.indent {}</li>
                     <li>bl-sm-ul ul.indent li {}</li>
                     <li>bl-sm-ul ul.indent li a {}</li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>