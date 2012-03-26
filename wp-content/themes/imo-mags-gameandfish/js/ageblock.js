/*/////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////

Author     : Jordan Prybylski, JRD89
Name      : AGE BLOCK
Created   : SEP 5th 2011
Version    : 1.0
Help File  : For More information and help please read the help file
	            supplied with this file. If after reading the help file
	            you still need technical help. Please feel free to 
                email me via codecanyon.com
				
NOTICE    : YOU MAY NOT USE THIS SCRIPT WITH OUT THE PROPER LICENSE/PERMISSION				
			 
///////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////*/

(function($){
    $.fn.extend({
		
        ageBlock: function(options) {
			//LETS SET SOME DEFAULTS
            var defaults = {
				title: "Hello, one second please.",
				subtitle: "In order to view our awesome content we need to verify your age",
				button: 'Let me in',
				age: '18',
				showError: false,
				error: '',
				opacity: 1,
				process: ''
            }
                 
            var options =  $.extend(defaults, options);
 
            return this.each(function() {
                var obj = $(this);
				var o = options;
				
				//CHECK COOKIE TO SEE IF WE HAVE TO ASK FOR AGE
				var cookie = checkCookie();
				
				//IF WE DONT HAVE ONE WE BEGIN BUILDING OUR MODAL
				if(!cookie)
				{
					//AUTOMATICALLY SCROLL PAGE TO THE TOP
					$("html:not(:animated),body:not(:animated)").animate({ scrollTop: 0}, 20 );
					
					//THIS IS THE OVERLAY, CONTAINERS, AND FORM
					var modal = '<div id="block-container">\
												<div id="overlay"></div>\
												<div id="modal-container">\
												<div id="modal-inner">\
													<h1>'+o.title+'</h1>\
													<p>'+o.subtitle+'</p>\
													<br/>\
													<form name="verify" id="verify" action="" method="post">\
														<div class="field">\
															<label>Month</label>\
															<select name="month">\
																<option value="" selected="selected"></option>\
																<option>01</option>\
																<option>02</option>\
																<option>03</option>\
																<option>04</option>\
																<option>05</option>\
																<option>06</option>\
																<option>07</option>\
																<option>08</option>\
																<option>09</option>\
																<option>10</option>\
																<option>11</option>\
																<option>12</option>\
															</select> / \
														</div>\
														<div class="field">\
															<label>Day</label>\
															<select name="day">\
																<option value="" selected="selected"></option>\
																<option>01</option>\
																<option>02</option>\
																<option>03</option>\
																<option>04</option>\
																<option>05</option>\
																<option>06</option>\
																<option>07</option>\
																<option>08</option>\
																<option>09</option>\
																<option>10</option>\
																<option>11</option>\
																<option>12</option>\
																<option>13</option>\
																<option>14</option>\
																<option>15</option>\
																<option>16</option>\
																<option>17</option>\
																<option>18</option>\
																<option>19</option>\
																<option>20</option>\
																<option>21</option>\
																<option>22</option>\
																<option>23</option>\
																<option>24</option>\
																<option>25</option>\
																<option>26</option>\
																<option>27</option>\
																<option>28</option>\
																<option>29</option>\
																<option>30</option>\
																<option>31</option>\
															</select> / \
														</div>\
														<div class="field">\
															<label>Year</label>\
															<select name="year">\
																<option value="" selected="selected"></option>';
																
																//LETS BUILD A LIST OF VALID YEARS BASED ON TODAY'S YEAR
																//THIS WILL MAKE IT BETTER WHEN YEAR'S CHANGE
																modal = modal + getYearList();
																
															modal = modal + '</select>\
														</div>\
														<div class="spacer"></div>\
														<input type="submit" class="grey" value="'+o.button+'"/>\
														</form>\
												</div>\
											   </div>';
					
					//APPEND THE OVERLAY AND MODAL TO THE BODY
					//APPLY ANY TYPE OF OPACITY TO THE OVERLAY						   
					$('body').append(modal).addClass('o-hidden');
					$('#overlay').css('opacity',o.opacity);
					
				}
				
				//WHEN THE FORM IS SUBMITTED
				//LETS CATCH IT AND APPLY SOME VALIDATION
				//CHECK THE FIELDS AND MAKE SURE THEY'RE NOT EMPTY
				//IF VALID SET COOKIE AND FADE OUT MODAL AND OVERLAY
				//IF NOT VALID APPLY ERROR SHAKE AND/OR PROMPT
				$('#verify').submit(function(e){
					var formData = $(this).serializeArray();
					var error = 0;
					for(var i in formData)
					{
						if(!formData[i].value)
						{
							error = 1;
						}
					}
					if(!error)
					{
						var valid = checkAge(formData);
						if(valid)
						{
							//IF PROCESSING IS ENTERED
							//LETS SEND THE FORM DATA TO THE PROCESSING PAGE FOR SAVING
							if(o.process)
							{
								$.ajax({url: o.process, data: formData, type: 'post'});
							}
							$('#block-container').fadeOut('medium',function(){
								$('body').removeClass('o-hidden');
								setCookie('v_age',true,10);
								$(this).remove();
							});
						}else
						{
							throwError()
						}
					}else
					{
						throwError()
					}
					e.preventDefault();
				});
				
				//FUNCTION USED TO GET YEAR LIST BASED ON CURRENT YEAR
				function getYearList()
				{
					var date = new Date();
					var x=1900;
					var str = '';
					now = parseInt(date.getFullYear());
					for(var i = now; i > x; i--)
					{
						str = str + "<option>"+i+"</option>";
					}
					
					return str;
					
				}
				
				//FUNCTION USED TO CHECK THE AGE OF THE USER
				//BASED ON MONTH,DAY, YEAR
				//GET VALUES FROM FORM, SEPERATE, THEN CHECK AGAINST VALID AGE
				function checkAge(age)
				{
					var day = age[0].value;
					var month = age[1].value
					var year = age[2].value;
					
					var strAge = day+"/"+month+"/"+year;
					var check = new Date();
					check.setFullYear(check.getFullYear() - o.age);
					return (new Date(strAge).getTime() - check.getTime() < 0)?true:false;
				}
				
				//IF THERE IS AN ERROR
				//LETS DO A LITTLE SHAKE
				//LOOP THROW THREE TIMES MOVING THE MODAL TO THE LEFT THEN BACK
				//IF WE HAVE MESSAGE TRUE, ALERT THE USER WHY IT'S WRONG
				function throwError()
				{
					for(var i = 0; i < 2; i++)
					{
							$('#modal-container').animate({left: '33%'},30).animate({left: '35%'},30);
					}
					setTimeout(function(){
						if(o.showError && o.error != '')
						{
									alert(o.error);
						}
					},800);
				}
				
				//FUNCTION USED TO SET THE COOKIE FOR THE USER
				function setCookie(c_name,value,exdays)
				{
					var exdate=new Date();
					exdate.setDate(exdate.getDate() + exdays);
					var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
					document.cookie=c_name + "=" + c_value;
				}
				
				//FUNCTION USED TO GET COOKIE
				function getCookie(c_name)
				{
					var i,x,y,ARRcookies=document.cookie.split(";");
					for (i=0;i<ARRcookies.length;i++)
					{
						x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
						y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
						x=x.replace(/^\s+|\s+$/g,"");
						if (x==c_name)
						{
							return unescape(y);
						}
					}
				}
				
				//FUNCTION USED TO CHECK COOKIE
				function checkCookie()
				{
					return getCookie("v_age");
				}
					
				 
				});
			}
    });
     
})(jQuery);