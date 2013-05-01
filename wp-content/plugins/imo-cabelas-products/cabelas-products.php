<?php
/*
 * Plugin Name: IMO Cabela's Products
 * Plugin URI: http://github.com/imoutdoors
 * Description: Provides an admin page for managing Cabela's products
 * Version: 0.1
 * Author: aaron baker
 * Author URI: http://imomags.com
 */


add_action( 'admin_menu', 'cabelas_products_menu' );
add_action( 'admin_enqueue_scripts', 'cabelas_products_scripts' );

function cabelas_products_menu() {
	add_options_page( 'Cabela\'s Products', 'Cabela\'s Products', 'manage_options', 'cabelas-products-manager', 'cabelas_products_options' );
}

function cabelas_products_scripts($hook) {


	//If we're on the right page, enqueue some styles and scripts
	if ($hook == "settings_page_cabelas-products-manager") {

		wp_enqueue_style('twitter-bootstrap',"http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/css/bootstrap.css");
		wp_enqueue_style('backgrid-style', plugins_url('/css/backgrid.min.css', __FILE__),array("twitter-bootstrap") );


	}


}


function cabelas_products_options() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

//*********************************************************************************************************************
//*********************************************************************************************************************
//*****************************************   ADMIN PAGE DISPLAY   ************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
?>


	<div style="padding:10px 20px 20px 10px">

		<h1 style="padding-bottom:10px;">Cabela's Products</h1>


		<!-- Button to trigger modal -->
		<div style="margin-bottom:10px;">
			<a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal"><i class="icon-plus icon-white"></i> Add Product</a>
		</div>



		<div id="app">

		</div>


		<!-- Modal -->
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="myModalLabel">Add New Product</h3>
		  </div>
		  <div class="modal-body">

		  	<form id="new-product-form">
			  	<input type="text" name="product_name" placeholder="Product Name" style="height: auto;width: 50%;"><br>
			  	<input type="text" name="product_url" placeholder="Product URL" style="height: auto;width: 50%;"><br>
			  	<input type="text" name="product_img" placeholder="Product Image URL" style="height: auto;width: 50%;"><br>
			  	<input type="text" name="slug" placeholder="Category Slug (e.g. freshwater,saltwater)" style="height: auto;width: 50%;"><br>
			  	<input type="text" name="weight" placeholder="Order (A Number from 1 to 10)" style="height: auto;width: 50%;"><br>
		  	</form>

		  </div>
		  <div class="modal-footer">
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button class="btn btn-primary save-product" data-dismiss="modal">Save changes</button>
		  </div>
		</div>

	</div>


	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.9/backbone-min.js"></script>
	<script src="/wp-content/plugins/imo-cabelas-products/js/backgrid.min.js"></script>
	<script src="/wp-content/plugins/imo-cabelas-products/js/formParams.min.js"></script>

	<script type="text/javascript">
	//Main App Script

	var Product = Backbone.Model.extend({
		urlRoot:"/wpdb/products",
		initialize: function(){

			this.set(userIMO);

			this.on("change",function(model){
				model.save();
			});
		}
	});

	var Products = Backbone.Collection.extend({
		url:"/wpdb/products",
		model: Product
	});

	var products = new Products();


	var deleteCell = Backgrid.BooleanCell.extend({
		editor: _.template("<a href='' class='btn btn-danger'><i class='icon-remove icon-white'></a>"),
		events: {
		    "click": "deleteRow",
		    },
		deleteRow: function(ev) {
			ev.preventDefault();

			if (confirm("Really?")) {
				this.model.destroy({
					data: JSON.stringify(userIMO),
					wait: true,
					error: function(model, xhr, options) {
						alert("Delete failed! Try reloading the page to get a new permissions token.");


						console.log(model);
						console.log(xhr);
						console.log(options);
					}
				});
			}
		}
	});


	var columns = [{
		name:"product_name",
		label:"Product Name",
		cell: "string"
	},{
		name:"product_url",
		label:"Product URL",
		cell: "string"
	},{
		name:"product_img",
		label:"Product Image URL",
		cell: "string"
	},{
		name:"slug",
		label:"Wordpress Slug",
		cell: "string"
	},{
		name:"weight",
		label:"Weight (order)",
		cell: "string"
	},{
		name:"delete",
		label:"Delete",
		cell: deleteCell
	}];

	var grid = new Backgrid.Grid({
		columns: columns,
		collection: products
	});

	$("#app").append(grid.render().$el);

	products.fetch();


	$(".save-product").on("click",function(ev){

		var newProductData = $("#new-product-form").formParams();
		var newProduct = new Product(newProductData);

		newProduct.save(null,{success:function(){
			alert("SUCCESS");
		}});
		products.add(newProduct);

	});

	</script>

<?php

//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************
//*********************************************************************************************************************

}




