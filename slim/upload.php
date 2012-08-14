<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/jquery.form.js"></script>
    <script type="text/javascript">
        $(function() {            
          $('#fileUploadForm').ajaxForm({                 
            beforeSubmit: ShowRequest,
            success: SubmitSuccesful,
            error: AjaxError                               
          });                                    
        });            

        function ShowRequest(formData, jqForm, options) {
          var queryString = $.param(formData);
          alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
          return true;
        }

        function AjaxError() {
          alert("An AJAX error occured.");
        }

        function SubmitSuccesful(responseText, statusText) {        
          alert("SuccesMethod:\n\n" + responseText);
        }    
    </script>
</head>
<body>
    <form id="fileUploadForm" method="POST" action="/api/animals" enctype="multipart/form-data">
      <input type="text" name="caption" />
      <input type="file" id="photo-upload" name="photo-upload" />
      <input type="submit" value="Submit" />
    </form>
</body>
</html>