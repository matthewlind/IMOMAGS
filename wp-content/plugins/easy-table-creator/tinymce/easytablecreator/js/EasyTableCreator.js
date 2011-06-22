var EasyTableCreatorDialog = {
	preInit : function() {
		var url;
              
		tinyMCEPopup.requireLangPack();
              
		if (url = tinyMCEPopup.getParam("external_image_list_url"))
			document.write('<script language="javascript" type="text/javascript" src="' + tinyMCEPopup.editor.documentBaseURI.toAbsolute(url) + '"></script>');
	},

        
        
        init : function(ed) {
		var f = document.forms[0], nl = f.elements, ed = tinyMCEPopup.editor, dom = ed.dom, n = ed.selection.getNode();
                
		tinyMCEPopup.resizeToInnerSize();
                
              

                
		
	
                TinyMCE_EditableSelects.init();
                  
                if (jQuery(n).parents("table.easy-table-creator").length) { //its an edit
                     var table = jQuery(n).parents("table.easy-table-creator").clone();

                    //set the hidden field to editable //1
                    jQuery("#EasyTableCreator_form").find("#is_edit").val(1)
                  


                    //begin thead updaet
                    //remove the default header
                    jQuery("#EasyTableCreator_table").find("thead tr").remove();
                    //recreate the head row
                     var thead_tr = jQuery("<tr></tr>");
                     if (jQuery(table).find("thead tr th").length>0) {


                     jQuery(thead_tr).append("<th>Header</th>")
                     var row_i = 1 ;
                     jQuery(table).find("thead tr th").each(function(){

                         jQuery(thead_tr).append('<td>Col. '+row_i+'<br /><input type="text" class="th" value="'+jQuery(this).html()+'" name="th[]" /></td>')
                         row_i++;
                     })
                     jQuery("#EasyTableCreator_table").find("thead").append(thead_tr);
                     //end head update
                     } else {
                         //uncheck the header input
                         $("#header").attr("checked",false)
                     }

                      //begin table row update
                      //remove all the rows
                      jQuery("#EasyTableCreator_table").find("tbody").remove();

                      var tbody = jQuery("<tbody></tbody>");

                       jQuery(table).find("tbody tr").each(function(){
                           //each row tr
                           //loop through each td
                           if ( jQuery(this).children("td").length) {


                            var tbody_tr = jQuery("<tr></tr>");
                            jQuery(tbody_tr).append("<th>Row</th>")
                           jQuery(this).children("td").each(function(){
                               jQuery(tbody_tr).append('<td><input type="text" class="td" value="'+jQuery(this).html()+'" name="td[][]" /></td>')
                           })
                           
                           jQuery(tbody).append(tbody_tr)
                           
                           }
                       });
                       jQuery("#EasyTableCreator_table").append(tbody)
                       //end table row update
                    
                   
                    //begin thead updaet
                    //remove the default header
                    jQuery("#EasyTableCreator_table").find("tfoot tr").remove();
                    //recreate the head row
                     var tfoot_tr = jQuery("<tr></tr>");

                     if (jQuery(table).find("tfoot tr td").length>0) {


                     jQuery(tfoot_tr).append("<th>Footer</th>")
                     jQuery(table).find("tfoot tr td").each(function(){
                         jQuery(tfoot_tr).append('<td><input type="text" class="tf" value="'+jQuery(this).html()+'" name="tf[]" /></td>')

                     })
                     jQuery("#EasyTableCreator_table").find("tfoot").append(tfoot_tr);
                     //end head update

                     } else {
                         //uncheck the header input
                         $("#footer").attr("checked",false)
                     }

                   
                    
                    
                } 

                

                if (n.nodeName == 'IMG') {
			nl.src.value = dom.getAttrib(n, 'src');
                       	nl.alt.value = dom.getAttrib(n, 'alt');
			nl.title.value = dom.getAttrib(n, 'title');
                }

                // Setup browse button
		document.getElementById('srcbrowsercontainer').innerHTML = getBrowserHTML('srcbrowser','src','image','theme_advanced_image');
		if (isVisible('srcbrowser'))
			document.getElementById('src').style.width = '260px';

		

		
	},

        borderColorHex: function(border)
        {
            var re = new RegExp("rgb\((.*)\)")

           var m = re.exec(border);
           var rgb = m[2].split(",")

           var red = rgb[0].replace("(","");
           var green = rgb[1];
           var blue = rgb[2].replace(")","")

               return "#"+this.toHex(red) + this.toHex(green)+this.toHex(blue)
        },

         toHex: function(N) {
         if (N==null) return "00";
         N=parseInt(N); if (N==0 || isNaN(N)) return "00";
         N=Math.max(0,N); N=Math.min(N,255); N=Math.round(N);
         return "0123456789ABCDEF".charAt((N-N%16)/16)
              + "0123456789ABCDEF".charAt(N%16);
        },


        insert : function(file, title) {
		var ed = tinyMCEPopup.editor, t = this, f = document.forms[0];
             
               
          
		

                if (jQuery("#is_edit").attr("value")==1) {
                    //its edit, remove it
                    ed.dom.remove(jQuery(ed.selection.getNode()).parents("table.easy-table-creator"));

                }

               

		t.insertAndClose();
	},

        insertAndClose : function() {
		var ed = tinyMCEPopup.editor, f = document.forms[0], nl = f.elements, v, args = {}, el;

            

		tinyMCEPopup.restoreSelection();

		// Fixes crash in Safari
		if (tinymce.isWebKit)
			ed.getWin().focus();

		if (!ed.settings.inline_styles) {
			args = {
				vspace : nl.vspace.value,
				hspace : nl.hspace.value,
				border : nl.border.value,
				align : getSelectValue(f, 'align')
			};
		} else {
			// Remove deprecated values
			args = {
				vspace : '',
				hspace : '',
				border : '',
				align : ''
			};
		}

		tinymce.extend(args, {
			//src : nl.src.value,
			//alt : nl.alt.value,

                        //width: '200px'
		});

		

		el = ed.selection.getNode();
               
                
		if (el && el.nodeName == 'IMG') {
			ed.dom.setAttribs(el, args);
                        
		} else {
                   
                  
                    //console.log(nl);
                    //build the table

                    var td = '';
                    var th = '';
                    var tf = '';

                    var thead = jQuery("<thead><tr></tr></thead>");
                    var tbody = jQuery("<tbody><tr></tr></tbody>");
                    var tfoot = jQuery("<tfoot><tr></tr></tfoot>");

                       if (jQuery("input[name=th\[\]]").length>0) {


                           jQuery("input[name=th\[\]]").each(function(){
                               th += '<th>'+jQuery(this).val()+'</th>';
                           });
                           //add the cells
                           jQuery(thead).children("tr").append(th);
                       }


                       var i = 0

                       jQuery("input.td").each(function(){
                      
                         var count_tr = jQuery("tbody tr").length
              
                         if (i %  (jQuery("tbody td").length/count_tr) == 0) {
                             //new row
                             td+='<tr>';
                             
                         }

                           td += '<td>'+jQuery(this).val()+'</td>';
                         i++;
                         if (i % (jQuery("tbody td").length/count_tr) == 0) {
                             //new row
                             td+='</tr>';
                         }

                         
                       });

                  
                      
                       //add the cells
                       jQuery(tbody).append(td);
                       
                       
                       jQuery("input[name=tf\[\]]").each(function(){
                           tf += '<td>'+jQuery(this).val()+'</td>';
                       });
                       jQuery(tfoot).children("tr").append(tf);
                       var width = jQuery("input[name=width]").val();
                       //create the table
                       var table = jQuery('<table class="easy-table-creator tablesorter"></table>');
                       
                  

                       if (jQuery("input[name=th\[\]]").length>0) {
                      
                           jQuery(table).append(thead);
                       }

                       jQuery(table).append(tbody);
                       
                       if (jQuery("input[name=tf\[\]]").length>0) {
                           jQuery(table).append(tfoot);
                       }
                       
                       
                       var wrapper = jQuery("<div></div>");

                        jQuery(table).css({"width":width})
                        jQuery(wrapper).append(table)
                   
                       
                       if (jQuery("#is_edit").val()==0) {
                            jQuery(wrapper).append('<div class="polyvision_credit_link"> <!--POLYVISION_CREDIT--></div><br>')
                     
                       }
                       
                      
                       

                      
                        
                        
                        ed.execCommand('mceInsertContent', false, jQuery(wrapper).html(), {skip_undo : 1});
			

			ed.undoManager.add();
		}

		tinyMCEPopup.close();
	},



      

      
	getAttrib : function(e, at) {
		var ed = tinyMCEPopup.editor, dom = ed.dom, v, v2;

		if (ed.settings.inline_styles) {
			switch (at) {
				case 'align':
					if (v = dom.getStyle(e, 'float'))
						return v;

					if (v = dom.getStyle(e, 'vertical-align'))
						return v;

					break;

				case 'hspace':
					v = dom.getStyle(e, 'margin-left')
					v2 = dom.getStyle(e, 'margin-right');

					if (v && v == v2)
						return parseInt(v.replace(/[^0-9]/g, ''));

					break;

				case 'vspace':
					v = dom.getStyle(e, 'margin-top')
					v2 = dom.getStyle(e, 'margin-bottom');
					if (v && v == v2)
						return parseInt(v.replace(/[^0-9]/g, ''));

					break;

				case 'border':
					v = 0;

					tinymce.each(['top', 'right', 'bottom', 'left'], function(sv) {
						sv = dom.getStyle(e, 'border-' + sv + '-width');

						// False or not the same as prev
						if (!sv || (sv != v && v !== 0)) {
							v = 0;
							return false;
						}

						if (sv)
							v = sv;
					});

					if (v)
						return parseInt(v.replace(/[^0-9]/g, ''));

					break;
			}
		}

		if (v = dom.getAttrib(e, at))
			return v;

		return '';
	},

      

        deleteTable : function() {
             var ed = tinyMCEPopup.editor;
             var table = jQuery(ed.selection.getNode()).parents("table.easy-table-creator")
             ed.dom.remove(jQuery(table).parent().find(".polyvision_credit_link"))
             ed.dom.remove(table);
             tinyMCEPopup.close();
             
        },

        addColumn : function() {
            var col_count = jQuery("#EasyTableCreator_table thead tr td").length +1

            jQuery("#EasyTableCreator_table thead tr").append('<td>Col. '+col_count+'<br /><input type="text" class="th" name="th[]" /></td>');
            jQuery("#EasyTableCreator_table tbody tr").append('<td><input type="text" class="td" name="td[][]" /></td>');
            jQuery("#EasyTableCreator_table tfoot tr").append('<td><input type="text" class="tf" name="tf[]" /></td>');
            
        },

        addRow : function() {

                var num_cols = jQuery("#EasyTableCreator_table tbody tr:first td").length;
                var td       = '';
         
                
                for(i=0;i<num_cols;i++) {
                    td+='<td><input type="text" class="td" name="td[][]" /></td>';

                }
               
                 var tr = jQuery('<tr><th>Row</th>'+td+'</tr>');
                
                
                jQuery("#EasyTableCreator_table tbody").append(tr);
               
        },

        deleteColumn : function() {
      
                 jQuery("#EasyTableCreator_table thead tr td:last").remove();
                 jQuery("#EasyTableCreator_table tbody tr").each(function(){
                     $(this).children("td:last").remove();
                 });
                 jQuery("#EasyTableCreator_table tfoot tr td:last").remove();



        },


        deleteRow : function() {
              jQuery("#EasyTableCreator_table tbody tr:last").remove();

        }
       

        

}


EasyTableCreatorDialog.preInit();
tinyMCEPopup.onInit.add(EasyTableCreatorDialog.init, EasyTableCreatorDialog);