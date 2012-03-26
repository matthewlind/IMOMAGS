<?php


/**
 * SVPollWidget
 *
 * Creates the store wdiget for a page. 
 */
class SVAdWidget extends WP_Widget {

    function __construct()
    {
        parent::__construct("sv-ad-widget", "SV Ad Widget");
    }

    /**
     * renders administrative form for the widget
     */
    function form($instance) {
	/* Set up some default widget settings. */
	$defaults = array( '' => __('0', 'example'),);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Video ID: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'issueFamID' ); ?>"><?php _e('Issue Fam ID:', 'example'); ?></label>


    <?php
      $famID = $instance['issueFamID'];
      $selected[$famID] = "selected";

    ?>
    <select id="<?php echo $this->get_field_id( 'issueFamID' ); ?>" name="<?php echo $this->get_field_name( 'issueFamID' ); ?>" >
      <option <?php echo $selected[0]; ?> value=0>All</option>
      <option <?php echo $selected[1]; ?> value=1>Hunting</option>
      <option <?php echo $selected[2]; ?> value=2>Fishing</option>
      <option <?php echo $selected[3]; ?> value=3>Shooting</option>
      <option <?php echo $selected[4]; ?> value=4>Conservation</option>
    </select>



	</p>

<?php
    }

    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
	
		$instance = $old_instance;


		$instance['issueFamID'] = $new_instance['issueFamID'];

		return $instance;
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
	

	   $issueFamID = $instance['issueFamID'];
	
        print $before_widget;
?>

<div class="sv-ad-container" style="width:298px;height:248px;border:1px solid #ddd;font-family:Helvetica,Arial,sans-serif;color:black;background-color:white;">
  <!-- Load jQuery if we don't already have it -->
  <script type="text/javascript">

  //***********************************************************************************************
  //*************************************CHOOSE AN ISSUE TYPE**************************************
  //***********************************************************************************************
  
  // hunting       = 1
  // fishing       = 2
  // shooting      = 3
  // conservation  = 4
  // ALL ISSUES    = 0

  var issueType = <?php echo $issueFamID; ?>; //Set this from 0-4 according to above chart.
  //***********************************************************************************************
  //***********************************************************************************************
  //***********************************************************************************************


  if (typeof jQuery == 'undefined') {//Load jQuery if we don't have it.
      var script = document.createElement('script');
      script.type = "text/javascript";
      script.src = "https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js";
      document.getElementsByTagName('head')[0].appendChild(script);
  }

  jQuery(document).ready(function($) {
        
    var hunting = 1;
    var fishing = 2;
    var shooting = 3;
    var conservation = 4;

    var candidates = new Array();
    candidates[0] = "Barack Obama";
    candidates[1] = "Mitt Romney";
    candidates[2] = "Newt Gingrich";
    candidates[3] = "Rick Santorum";
    candidates[4] = "Ron Paul";



    var conservationIssues = new Array();

    var conservationIssue1 = new Object();
    conservationIssue1.issueName = "Lead Ban";
    conservationIssue1.url = "http://www.sportsmenvote.com/issues/lead-ban/";
    conservationIssue1.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-conserve.png";

    var conservationIssue2 = new Object();
    conservationIssue2.issueName = "Energy Development";
    conservationIssue2.url = "http://www.sportsmenvote.com/issues/energy-development/";
    conservationIssue2.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-conserve.png";

    conservationIssues.push(conservationIssue1);
    conservationIssues.push(conservationIssue2);

    var huntingIssues = new Array();

    var huntingIssue1 = new Object();
    huntingIssue1.issueName = "the Conservation Reserve Program";
    huntingIssue1.url = "http://www.sportsmenvote.com/issues/conservation-reserve-program/";
    huntingIssue1.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-hunt.png";

    var huntingIssue2 = new Object();
    huntingIssue2.issueName = "Public Lands Access";
    huntingIssue2.url = "http://www.sportsmenvote.com/issues/public-lands-access/";
    huntingIssue2.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-hunt.png";

    huntingIssues.push(huntingIssue1);
    huntingIssues.push(huntingIssue2);

    var fishingIssues = new Array();

    var fishingIssue1 = new Object();
    fishingIssue1.issueName = "the Clean Water Act";
    fishingIssue1.url = "http://www.sportsmenvote.com/issues/clean-water-act/";
    fishingIssue1.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-fish.png";

    var fishingIssue2 = new Object();
    fishingIssue2.issueName = "Invasive Species";
    fishingIssue2.url = "http://www.sportsmenvote.com/issues/invasive-species/";
    fishingIssue2.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-fish.png";

    fishingIssues.push(fishingIssue1);
    fishingIssues.push(fishingIssue2);

    var shootingIssues = new Array();

    var shootingIssue1 = new Object();
    shootingIssue1.issueName = "Concealed Carry";
    shootingIssue1.url = "http://www.sportsmenvote.com/issues/concealed-carry/";
    shootingIssue1.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-shoot.png";

    var shootingIssue2 = new Object();
    shootingIssue2.issueName = "Gun Control";
    shootingIssue2.url = "http://www.sportsmenvote.com/issues/gun-control/";
    shootingIssue1.logoURL = "http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-shoot.png";

    shootingIssues.push(shootingIssue1);
    shootingIssues.push(shootingIssue2);

    var allIssues = new Array();
    allIssues[hunting] = huntingIssues;
    allIssues[fishing] = fishingIssues;
    allIssues[conservation] = conservationIssues;
    allIssues[shooting] = shootingIssues;



    //*********************************************

    var randomCandidateID = Math.floor(Math.random()*candidates.length);

    var currentCandidate = candidates[randomCandidateID];

    $(".sv-ad-teaser").text("Where does " + currentCandidate + " stand on the Clean Water Act.");

    if (issueType == 0) {

        var randomIssueTypeID = Math.floor(Math.random()*4) + 1;
        console.log(randomIssueTypeID);

        issueType = randomIssueTypeID;

    }

    currentIssueType = allIssues[issueType];
    var randomIssueID = Math.floor(Math.random()*currentIssueType.length);
    currentIssue = currentIssueType[randomIssueID];

    //change text
    $(".sv-ad-teaser").text("Where does " + currentCandidate + " stand on " + currentIssue.issueName + "?");

    //Change logo icon
    $("#sv-icon-logo").attr("src",currentIssue.logoURL);

    //Change the URLs
    $(".sv-ad-link a, .sv-ad-action a").attr("href",currentIssue.url);

  });

  </script>


  <div class="sv-ad-content" style="margin:10px;text-align:center;">
    <div class="sv-ad-header">
      <a href="http://www.sportsmenvote.com"><img src="http://www.sportsmenvote.com/wp-content/themes/sv/images/sv-logo-fish.png" id="sv-icon-logo" border=0></a>
    </div>
    <div class="sv-ad-teaser" style="padding:15px auto 15px auto;font-size:16px;font-weight:bold;line-height:17px;">
      What is Rick Stantorum's stance on public land access?
    </div>
    <div class="sv-ad-action" style="padding:5px;margin:20px auto 14px auto;width:105px;font-weight:bold;color:white;background-color:#c72a1f;box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.80);-moz-box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.80);-webkit-box-shadow: 0px 1px 8px rgba(0, 0, 0, 0.80);">
      <a href="" style="color:white">FIND OUT NOW!</a>
    </div>
    <div class="sv-ad-link" style="margin-top:15px;">
        <a href="" style="color:#095FAA">or find out where the other canidates stand</a>
    </div>
  </div>
</div>



<?php
        print $after_widget;
    }
}


add_action("widgets_init", function() {
    return register_widget("SVAdWidget");
});

