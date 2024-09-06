jQuery(document).on('click','.column_section .inner_col',function(){	jQuery('.column_section .inner_col').removeClass('active');	jQuery(".column_section input[name='option']").attr("checked", false);	 jQuery(this).addClass('active');	jQuery(this).find("input[name='option']").attr("checked", "checked");
	var selectedLayout = jQuery(this).find("input[name='option']:checked").attr('data-id');
	if(selectedLayout != 4){
		jQuery('.rows_stacked').hide();
	jQuery("#formsitemap .allcolums .collaps_box").show();
		jQuery("#formsitemap .allcolums").each(function () {
			jQuery(this).children(":gt("+selectedLayout+")").hide();
		});
	}else{
		jQuery('.column_box').hide();
		jQuery('.rows_stacked').show();
	}
	
})
jQuery(document).ready( function() {
	//console.log(ajaxurl);
	jQuery(".savesitemap").click( function(e) {	
	e.preventDefault(); 
	var data = jQuery('#formsitemap').serialize();
	var layout = $('.inner_col input[name="option"]:checked').val();
	var pageSelected = $('select[name="sitemappage"]').val();
	jQuery.ajax({
		type : "post",
		dataType : "json",
		url : ajaxurl,
		data : {action: "siteMapDataSave", layout : layout, pageSelected: pageSelected,data:data},
		success: function(response) {
			console.log(response.success);
			if(response.success == true) {
				//jQuery("#vote_counter").html(response.vote_count)
				//alert("data updated successfully");
				location.reload();
			}
			else {
				alert("data could not be added");
			}
		}
	}) })})

	/** Add more **/
	jQuery(document).ready(function(){
		// Add new element
		jQuery(".add").click(function(){
			var pid = jQuery(this).parents('div').parents().attr('id');	
			var id = jQuery(this).parents('div').parents().data('id');	
			// Finding total number of elements added
			var total_element = $("#"+pid+" .element").length;						
			// last <div> with element class id
			var lastid = $("#"+pid+" .element:last").attr("id");
			var split_id = lastid.split("_");
			var nextindex = Number(split_id[1]) + 1;
	
			var max = 50;
			// Check total number elements
			jQuery.ajax({
				type : "post",
				dataType : "json",
				url : ajaxurl,
				data : {action: "getAllPostType"},
				success: function(response) {
					// /console.log(response.data);		
			if(total_element < max ){
				// Adding new div container after last occurance of element class
				jQuery("#"+pid+" .element:last").after("<div class='element draggable' id='"+pid+"_"+ nextindex +"'></div>");
				var html = '<div class="list_option1"> <div class="heading_icon"> <div class="heading"> <h1>List '+nextindex+'</h1> </div> <div class="icon"> <i class="far fa-trash-alt remove" id="'+pid+'-remove_'+nextindex+'"></i> <i class="fas fa-arrows-alt"></i> <i class="fas fa-caret-up callapseheading collapsed" data-toggle="collapse" data-target="#list_'+nextindex+'"></i> </div> </div> <div class="layout_row-12" id="list_'+nextindex+'"> <div class="first_col-6"> <div class="inner_col"> <label for="post">Post Type</label> <select id="post" name="'+pid+'[col-'+id+']['+ nextindex +'][post_type_col-1]"> <option value="">Post Type </option>'+response.data+'</select> <br> </div> <div class="inner_col"> <label for="list_heading">List Heading</label> <input type="text" id="lhead" name="'+pid+'[col-'+id+']['+ nextindex +'][title_list1]" value=""> </div> </div> <div class="pto"> <h2 ><span class="caret listoption " > <i class="fas fa-caret-right callapseheading collapsed" data-toggle="collapse" data-target="#option_section"></i> Option</span> </h2> <div class="optionbox collapse" id="option_section"> <div class="inner_col"> <div class="option"> <div class="option_orderby"> <label for="orderby">Order By </label> <select id="orderby" name="'+pid+'[col-'+id+']['+ nextindex +'][orderby_col-1]"> <option value="">Order By </option>  <option value="title">Title</option><option value="id">ID</option> <option value="date">Date</option></select> <br> </div> <div class="option_order"> <label for="oder">Order</label> <select type="Oder" id="order" name="'+pid+'[col-'+id+']['+ nextindex +'][order_col-1]"> <option value="">Order </option> <option value="asc">Ascending </option><option value="desc">Descending</option> </select> <br> </div> </div> <div class="option_commas"><label for="order">Exclude IDs(Separate with Commas)</label> <textarea rows="4" cols="50" name="'+pid+'[col-'+id+']['+ nextindex +'][exclude_col-1]" form="usrform">Enter text here...</textarea> </div> </div> </div> </div> </div>';			
				// Adding element to <div>
				console.log("#"+pid+"_" + nextindex);
				jQuery("#"+pid+"_" + nextindex).append(html);
						
			}
		}
		});		
		});
	
		// Remove element
		jQuery(document).on('click','.remove',function(){	
			var pid = jQuery(this).parents('div').parents().parents().parents().parents().attr('id');					
			var id = this.id;
			console.log(pid);
			var split_id = id.split("_");
			var deleteindex = split_id[1];	
			// Remove <div> with id
			jQuery("#"+pid+"_" + deleteindex).remove();
		});                
	});

	jQuery(document).ready(function() {	
		jQuery(".droppable").sortable({
		  update: function( event, ui ) {
			var pid = jQuery(this).attr('id');
			console.log(pid);
			Dropped(event, ui, pid);
		  }
		});	
	  });		
	function Dropped(event, ui ,pid){
		jQuery("#"+pid+" .draggable").each(function(index){
			var pid = jQuery(this).parents('div').attr('id');	
			var myIndex = index + 1;	
			jQuery(this).find('h1').html('List '+myIndex);
			jQuery(this).attr('id',pid+'_'+myIndex);			
		});
		//refresh();
	}

	jQuery(document).ready(function(){
		var selectedLayout = jQuery(".inner_col input[name='option']:checked").attr('data-id');
		//alert(selectedLayout);
		jQuery("#formsitemap .allcolums").each(function () {
			jQuery(this).children(":gt("+selectedLayout+")").hide();
		});
		var selectedLayout = jQuery(this).find("input[name='option']:checked").attr('data-id');
		console.log(selectedLayout);
		if(selectedLayout == null){
			jQuery('.column_box').hide();
			jQuery('.rows_stacked').hide();
		}else if(selectedLayout != 4){
			jQuery('.rows_stacked').hide();
			jQuery("#formsitemap .allcolums").each(function () {
				jQuery(this).children(":gt("+selectedLayout+")").hide();
			});
		}else{
			jQuery('.column_box').hide();
			jQuery('.rows_stacked').show();
		}
	})