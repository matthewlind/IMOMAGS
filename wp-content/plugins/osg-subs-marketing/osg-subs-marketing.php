<?php
/**
 * Plugin Name: OSG Subs Marketing
 * Plugin URI: http://
 * Description: Adds various elements for displaying subs offers
 * Version: 1.0.0
 * Author: Jeff Burrows
 * Author URI: http:/
 * License: GPL2
 */
add_action( 'init', array ( 'osgSubsMarketing', 'init' ) );

class osgSubsMarketing {
 
	private $ssdata; 
	 
	public static function init() {
        new self;
    }

    public function __construct() {

        add_action( 'wp_head', array ( $this, 'osgmarketing_setVariables' ) );

		add_action( 'wp_footer', array ( $this, 'osgsubsmarketing_writeModal' ) );

		add_action('wp_enqueue_scripts', array ( $this, 'osgsubsmarketing_custom_scripts' ) );

    }
    
    public function osgsubsmarketing_custom_scripts() {
	 
	    wp_register_style( 'subsmarketing', plugin_dir_url( __FILE__ ) . 'css/subsmarketing.css');
	    wp_enqueue_style( 'subsmarketing' );
	    
	    wp_register_script( 'popupoverlay', get_template_directory_uri() . '/js/plugins/jquery.popupoverlay.min.js', array('jquery'));
	    wp_enqueue_script( 'popupoverlay' );
	   
	    wp_register_script( 'osgsubsmodal', plugin_dir_url( __FILE__ ) . 'js/subsmodal.js', array('jquery'));
	    wp_enqueue_script( 'osgsubsmodal' );
	
		$osgsubsdata = array(
	    	'homedir'	=> get_stylesheet_directory_uri(),
			'ishome'	=> is_home(),
			'pagename'	=> get_query_var('pagename'),
			'posttype'	=> get_post_type()
		);
		wp_localize_script( 'osgsubsmodal', 'subsmkt_vars', $osgsubsdata );
	    
	}

	public function osgsubsmarketing_writeModal() {
		
		if(!is_object($this->ssdata)) return;
		$ssdata = $this->ssdata;
		
		$p = PHP_EOL.PHP_EOL;
		$p.= '<div id="subs_popinst" style="display:none;">'.PHP_EOL;
		
		$p.= '<div class="subsmodalback">'.PHP_EOL
		   . '	<div class="subs_popinst_close"><img src="'.get_template_directory_uri().'/images/close_popup.png" /></div>'.PHP_EOL
		   . '	<div class="subsmodaltitle"><strong>'.$ssdata->headline.'</strong></div>'.PHP_EOL
		   . '	<div class="subsmodaloffer">'.$ssdata->offertxt.'</div>'.PHP_EOL
		   . '	<div class="subsmodalcover"><img src="'.$ssdata->coverimg.'" /></div>'.PHP_EOL
		   . '	<div class="subsmodaltriangle-container"><div class="subsmodaltriangle"></div></div>'.PHP_EOL
		   
		   . '	<div class="subsmodalbtnarea">'
		   . '    <div class="subsmodalbtn" id="subsmodalbtn">'
		   . '<a href="'.$ssdata->orderpage.$ssdata->pkey.'" target="_blank">'
		   .      $ssdata->buttontxt.'</a></div>'
		   . '  </div>'.PHP_EOL	   
		   
		   . '</div>'.PHP_EOL;
		
		$p.= '</div><!-- close subs_popinst -->';
		$p.= PHP_EOL.PHP_EOL;
		
		print $p;
		
	}

	public function osgmarketing_setVariables() {
		
		// load remote data from SS
		$surl = "https://securesubs.osgimedia.com/api/mkt/brandedsitePopup";
		$sdata = "key=gh3vd45&blogid=".get_current_blog_id();
		$screate = array(
			'http' => array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $sdata
			)
		);
		$context = stream_context_create($screate);
		$contents = file_get_contents($surl, false, $context);	
		
		if($contents=="") return;
		
		$this->ssdata = json_decode($contents);
		
		$p = PHP_EOL.'<script type="text/javascript">'.PHP_EOL;
		$p.= 'var blogid = '.get_current_blog_id().';'.PHP_EOL; 
		$p.= 'var subsmarketing = '.$contents.";".PHP_EOL;
		$p.= '</script>'.PHP_EOL.PHP_EOL;
		
		print $p;

	}
	
}
?>