<!-- Sportsman channel finder widget  Start-->
<script>
function popwin(loc,winname,w,h,scroll,resize) {
	var newwin = window.open( loc, winname, "width="+w+",height="+h+",top="+((screen.height - h) / 2)+",left="+((screen.width - w) / 2)+",location=no,scrollbars="+scroll+",menubar=no,toolbar=no,resizable="+resize);
} // function..popwin
</script>

<div id="locateChannel">
    <div id="channelControlsContainer">
	    <span>Find it in your area!</span>
	    <div class="tv-finder-logo"></div>
<!--     	<img src="/wp-content/themes/imo-mags-parent/images/logos/sc-finder-logo.png" alt="sportsman chanel logo"> -->
		<div id="channelControls">
		    <input type="text" name="zip" id="zip" onfocus="if(this.value == this.defaultValue) this.value = '';" value="Your ZIP" class="searchbox" />
		    <a href="#" onclick="javascript:popwin('http://thesportsmanchannel.viewerlink.tv/?zip='+document.getElementById('zip').value,'indicator',615,550,'yes','yes');"><input type="submit" value="GET SPORTSMAN!" class="button" /></a>
		</div>
    </div>
</div>
<!-- Sportsman channel finder widget  End-->