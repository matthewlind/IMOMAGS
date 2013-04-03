<?php
/*  Copyright 2012 IMO FOX */
/*
Plugin Name: IMO Expandable Header Ad
Plugin URI: http://imomags.com
Description: An expandanle ad for promoting content or advertisers.
Author: IMO FOX
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/

add_action('init', 'imo_expandable_scripts');
function imo_expandable_scripts() {
	//wp_deregister_script( 'jquery' );
	//wp_enqueue_script( 'jquery' );
    wp_enqueue_script('expandable',plugins_url('js/expandable.js', __FILE__));
    wp_enqueue_script('jquery-cookie',plugins_url('js/jquery.cookie.js', __FILE__));
    wp_enqueue_style('expandable-css',plugins_url('css/expandable.css', __FILE__));	
}


/**********************************************
*******PLACE THE EXPANDABLE IN THE HEADER******
***********************************************/

/***
*
* Load collapsed image into super-ad div
*

add_action('init', 'imo_collapsed_image');
function imo_collapsed_image() {
	global $collapsed_img;
	$collapsed_img = "http://gunsandammo.com/wp-content/themes/imo-mags-gunsandammo/img/ga-madness-super-header-collapsed.jpg";
}
***/

/***
*
* Load expanded image script into super-ad div
*

add_action('init', 'expanded_script');
function expanded_script() {
	global $expanded_script;

	$expanded_script = '<script type="text/javascript">
				  var ord = window.ord || Math.floor(Math.random() * 1e16);
				  document.write('<script type="text/javascript" src="http://ad.doubleclick.net/N4930/adj/imo.gunsandammo;sz=980x276;ord=' + ord + '?"></script>'));
				</script>
				<noscript>
				<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo;sz=980x276;ord=[timestamp]?"><img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo;sz=980x276;ord=[timestamp]?" width="980" height="276" /></a>
				</noscript>';

}***/



add_action('init', 'expanded_script');
function expanded_script() {
	global $expanded_script;

	$expanded_script = '<iframe id="poll-ad-iframe" src="'.$_SERVER['SERVER_NAME'].'/iframe-bracket-ad.php?ad_code=imo.gunsandammo&size=980x70&camp=" width=736 height=106></iframe>';

}

//add options for updating values
add_option( 'expandable_title', '', '', 'yes' );
add_option( 'expandable_collapsed_image', '', '', 'yes' );
add_option( 'expandable_expanded_image', '', '', 'yes' );
add_option( 'startDate', '', '', 'yes' );
add_option( 'expDate', '', '', 'yes' );


/***
*
* Set the dates for the expandable to run
*
***/

//Start Date
add_action('init', 'start_date');
function start_date() {
	global $startDate;
	$startDate = get_option('startDate');	
}

//End Date
add_action('init', 'exp_date');
function exp_date() {
	global $expDate;
	$expDate = get_option('expDate');	
}

/*********************************
*******CREATE THE ADMIN AREA******
**********************************/

$object = new expandable();

//add a hook into the admin header to check if the user has agreed to the terms and conditions.
add_action('admin_head',  array($object, 'adminHeader'));

//add footer code
//add_action( 'admin_footer',  array($object, 'adminFooter'));

// Hook for adding admin menus
add_action('admin_menu',  array($object, 'addMenu'));

class expandable{
	
    /**
     * This will create a menu item under the option menu
     * @see http://codex.wordpress.org/Function_Reference/add_options_page
     */
    public function addMenu(){
        add_options_page('Expandable Header Options', 'Expandable Header', 'manage_options', 'expandable-admin', array($this, 'optionPage'));
    }

    /**
     * This is where you add all the html and php for your option page
     * @see http://codex.wordpress.org/Function_Reference/add_options_page
     */
    public function optionPage(){ 
	  
		
		
		
		if(isset( $_POST['expandable-submit']) ){
	    	
	    	//update the title
	    	$title_name = 'expandable_title';
			$new_title = $_POST['title'];

			
			if ( get_option( $title_name ) != $new_title ) {
			    update_option( $title_name, $new_title );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $title_name, $new_title, $deprecated, $autoload );
			}


	    	//update the collapsed image
		    $collapsed_name = 'expandable_collapsed_image';
			$new_collapsed = $_POST['collapsed-img'];
			
			if ( get_option( $collapsed_name ) != $new_collapsed ) {
			    update_option( $collapsed_name, $new_collapsed );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $collapsed_name, $new_collapsed, $deprecated, $autoload );
			}
			
			
			//update the expanded image script
			$expanded_name = 'expandable_expanded_image';
			$new_expanded = htmlspecialchars($_POST['adscript']);
			
			
			if ( get_option( $expanded_name ) != $new_expanded ) {
			    update_option( $expanded_name, $new_expanded );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $expanded_name, $new_expanded, $deprecated, $autoload );
			}
			
			
			//Convert the dates from the selections to a string
			$sm = $_POST['start-month'];
			$sd = $_POST['start-day'];
			$sy = $_POST['start-year']; 
			
			$start_date = "startDate";
			$new_start_date = $sy.$sm.$sd;
			
			
			if ( get_option( $start_date ) != $new_start_date ) {
			    update_option( $start_date, $new_start_date );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $start_date, $new_start_date, $deprecated, $autoload );
			}
			
			$em = $_POST['exp-month'];
			$ed = $_POST['exp-day'];
			$ey = $_POST['exp-year']; 
			
			$exp_date = "expDate";
			$new_exp_date = $ey.$em.$ed;
			
			
			if ( get_option( $exp_date ) != $new_exp_date ) {
			    update_option( $exp_date, $new_exp_date );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $exp_date, $new_exp_date, $deprecated, $autoload );
			}
			
	   } 	
	   
	   
	   //convert the date string to something usefull for the dropdowns
		$startDate = get_option('startDate');
		$startDay = substr($startDate, -2);
		$startDate = get_option('startDate');
		$startMonth = substr($startDate, 4, 2);
		$startDate = get_option('startDate');
		$startYear = substr($startDate, 0, 4); 
		
		$expDate = get_option('expDate');
		$expDay = substr($expDate, -2);
		$expDate = get_option('expDate');
		$expMonth = substr($expDate, 4, 2);
		$expDate = get_option('expDate');
		$expYear = substr($expDate, 0, 4); 
	    ?>

    	<div class="wrap">
	    	<h2>Expandable Header Ad</h2>
	    	
	    	<form name="expandable-settings" action="/wp-admin/options-general.php?page=expandable-admin" method="post">
	    	
		    	<table class="form-table">
					<tr valign="top">
					</tr>
					<tr valign="top">
					<th scope="row">Expandable Campaign Title</th>
					<td><input type="text" name="title" id="title" value="<?php echo get_option('expandable_title'); ?>" /></input></td>
					</tr>
					
			        <tr valign="top">
			        <th scope="row">Expanded Image Script</th>
			        <td><textarea name="adscript" rows="3" cols="23" id="adscript" title="adscript"><?php echo get_option('expandable_expanded_image'); ?></textarea><p><strong>example:</strong> http://ad.doubleclick.net/N4930/adi/imo.gunsandammo;</p></td>
			        </tr>
			        
			        <tr valign="top">
					<th scope="row">Collapsed Image Url</th>
			        <td><input type="text" name="collapsed-img" id="collapsed-img" value="<?php echo get_option('expandable_collapsed_image'); ?>"/></input></td>
			        </tr>
			        
			        <tr valign="top">
			        <td><strong>Set Start Date</td>
			        </tr>	
			        
			        <tr valign="top">
					<th scope="row">Month</th>	     
					<td>
						<select name="start-month">
							<option value="<?php echo $startMonth; ?>" style="font-weight:bold"><?php echo $startMonth; ?></option>
							<?php for ($i=1; $i<=12; $i++){							
								//add the leading 0 to single digits
								$s_month = sprintf ("%02u", $i);
								
								echo '<option value="'.$s_month.'">'.$s_month.'</option>';
							} ?>
						</select>
					</td>
			        </tr>
			        
			        <tr valign="top">
					<th scope="row">Day</th>	     
			        <td>
				        <select name="start-day">
							<option value="<?php echo $startDay; ?>" style="font-weight:bold"><?php echo $startDay; ?></option>
							<?php for ($i=1; $i<=31; $i++){							
								//add the leading 0 to single digits
								$s_day = sprintf ("%02u", $i);
								
								echo '<option value="'.$s_day.'">'.$s_day.'</option>';
							} ?>
						</select>
			        </td>
			        </tr>
			        
			        <tr valign="top">
					<th scope="row">Year</th>	     
			        <td>
				        <select name="start-year">			
				        	<option value="<?php echo $startYear; ?>" style="font-weight:bold"><?php echo $startYear; ?></option>	
				        	<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>	
							<?php for ($i=1; $i<=3; $i++){	?>
								<option value="<?php echo date('Y') + $i; ?>"><?php echo date('Y') + $i; ?></option>
							<?php } ?>	
						</select>
			        </td>
			        </tr>
			        
			         <tr valign="top">
			        	<td><strong>Set Expiration Date</td>
			        </tr>	
			        
			        <tr valign="top">
					<th scope="row">Month</th>	     
					<td>
						<select name="exp-month">
							<option value="<?php echo $expMonth; ?>" style="font-weight:bold"><?php echo $expMonth; ?></option>
							<?php for ($i=1; $i<=12; $i++){							
								//add the leading 0 to single digits
								$e_month = sprintf ("%02u", $i);
								
								echo '<option value="'.$e_month.'">'.$e_month.'</option>';
							} ?>
						</select>
					</td>
			        </tr>
			        
			        <tr valign="top">
					<th scope="row">Day</th>	     
			        <td>
				        <select name="exp-day">
							<option value="<?php echo $expDay; ?>" style="font-weight:bold"><?php echo $expDay; ?></option>
							<?php for ($i=1; $i<=31; $i++){							
								//add the leading 0 to single digits
								$e_day = sprintf ("%02u", $i);
								
								echo '<option value="'.$e_day.'">'.$e_day.'</option>';
							} ?>
						</select>
			        </td>
			        </tr>
			        
			        <tr valign="top">
					<th scope="row">Year</th>	     
			        <td>
			        	<select name="exp-year">
			        		<option value="<?php echo $expYear; ?>" style="font-weight:bold"><?php echo $expYear; ?></option>							
							<option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
							<?php for ($i=1; $i<=3; $i++){	?>
								<option value="<?php echo date('Y') + $i; ?>"><?php echo date('Y') + $i; ?></option>
							<?php } ?>				
						</select>				      
			        </td>
			        </tr>
			        
			</table>
			
			    <p class="submit"><input type="submit" name="expandable-submit" class="button-primary"></input></p>
		</form>
	        
	    </div>
	    <?php
	    
	    
	    
    }

}
























