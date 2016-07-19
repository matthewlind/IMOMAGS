<?php
/**
 * Template Name: Mobile Newsletter Template
 * Description: A Page Template for the mobile newsletter signup.
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
get_header();
imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	            	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
					<div class="mobile-newsletter">	
<script type="text/javascript">
	/***********************************************
	* Textarea Maxlength script- © Dynamic Drive (www.dynamicdrive.com)
	* This notice must stay intact for legal use.
	* Visit http://www.dynamicdrive.com/ for full source code
	***********************************************/
	function ismaxlength(obj, mlength)
	{
	  if (obj.value.length > mlength)
	    obj.value = obj.value.substring(0, mlength)
	}
	</script>
	
	
	
	<form method="post" name="profileform" action="https://intermediaoutdoors.informz.net/clk/remote_post.asp">
	      
		<SCRIPT LANGUAGE="JavaScript">
		function moveCaret(event, objThisField, objNextField, objPrevField, nSize)
		{
			var keynum;
			if(window.event) // IE	
				keynum = event.keyCode;	
			else if(event.which) // Netscape/Firefox/Opera	
				keynum = event.which;				
			if (keynum == 37 || keynum == 39 || keynum == 38 || keynum == 40 || keynum == 8) //left, right, up, down arrows, backspace
			{		
				var nCaretPosition = getCaretPosition(objThisField);		
				if (keynum == 39 && nCaretPosition == nSize)
					moveToNextField(objNextField);		   
				if ((keynum == 37 || keynum == 8) && nCaretPosition == 0)			
					moveToPrevField(objPrevField);		   
				return;
			}
			if (keynum == 9) //Tab
			return;
		if (objThisField.value.length >= nSize && objNextField != null)
			moveToNextField(objNextField);
	}  
	function moveToNextField(objNextField)
	{
		if (objNextField == null)
			return;
		objNextField.focus();
		if (document.selection) //IE
		{
			oSel = document.selection.createRange ();
			oSel.moveStart ('character', 0);
			oSel.moveEnd ('character', objNextField.value.length);
			oSel.select();							
		}
		else
		{
		   objNextField.selectionStart = 0;
	       objNextField.selectionEnd = objNextField.value.length;
		}
	}
	function moveToPrevField(objPrevField)
	{
		if (objPrevField == null)
			return;
		objPrevField.focus();
		if (document.selection) //IE
		{		
			oSel = document.selection.createRange ();
			oSel.moveStart ('character', 0);
			oSel.moveEnd ('character', objPrevField.value.length);
			oSel.select ();					
		}
		else
		{
		   objPrevField.selectionStart = 0;
	       objPrevField.selectionEnd = objNextField.value.length;
		}
	}
	function getCaretPosition(objField)
	{
		var nCaretPosition = 0;
		if (document.selection) //IE
		{
		   var oSel = document.selection.createRange ();
		   oSel.moveStart ('character', -objField.value.length);
		   nCaretPosition = oSel.text.length;
		}	
		if (objField.selectionStart || objField.selectionStart == '0')
	       nCaretPosition = objField.selectionStart;
		return nCaretPosition;
	}
	</script>
	
	
	   <div class="signup-box jq-custom-form">
	        <fieldset>

				 	<h3>Get the Newsletter</h3>

	            <div class="signup-mdl">
	                <p class="intro-text">Sign up to receive the latest updates from In-Fisherman</p>
	                <div class="f-row">
						<input alt="Email Address" type="text" name="email" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
	                </div>
	                <script type="text/javascript">
						function ShowDescriptions(SubDomain,val, brid) {
							myWindow = window.open(SubDomain + '/description.asp?brid=' + brid + '&id=' + val, 'Description', 'location=no,height=180,width=440,resizeable=no,scrollbars=yes,dependent=yes');
							myWindow.focus()
						}
					</script>
	                <div class="f-row check-row">
	                    <input alt="Third Party" type="checkbox" value="22697" name="interests" id="receive" />
	                    <input type="hidden" name="OptoutInfo" value="">
	                    <label for="receive">Yes, I'd like to receive offers from your partners</label>
	                </div>
	             </div>
	                <div class="signup-btn-row"><span class="btn-base"><input type="submit" value="Sign Up" name="update" ></span></div>
	                <input type=hidden name=fid value=2493>
					<input type=hidden name=b value=4038>
					<input type=hidden name=returnUrl value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/?zmsg=1">  
	            
			</fieldset>
	    
		</div>
	</form>
</div>
					
					
            	</div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					<a href="#" class="go-top jq-go-top">go top</a>
				</div>

				<div class="foot-social clearfix">
                    <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                    <div class="fb-like" data-href="http://www.facebook.com/InFisherman" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
                     <?php social_networks(); ?>
                </div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <a href="#" class="subscribe-banner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>

		 	</div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
