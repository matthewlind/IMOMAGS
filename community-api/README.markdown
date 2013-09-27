# Community API

The IMOMags community API is almost enitrely written in vanilla PHP with the exception that the Slim framework is used for URL routing and some error handling. When it comes to reading data, the API tries to be as RESTful as possible and many of the API calls for reading data are self explanatory.

## Troubleshooting
If you get a whitescreen when trying to access the API, check the logs. While Wordpress has it's own separate error log, the Community API just uses the regular Apache error log. You can access it on your dev with the following command:

`sudo tail -f /etc/httpd/logs/imomags.deva-error_log`

(Be sure to change the domain to your dev environment)

## Posting & Editing Data
POSTing new data to the API also conforms somehwat closely to the REST standard. However, the API uses a custom system to determine if the user as the necessary privledges to post and modify content. By default, the API allows authenticated users to post new content, edit their own content, and delete their own content. In addition, Wordpress users with Admin or Editor privledges can edit and delete all content.

When making a POST or PUT request to the API, a userIMO variable must also be included with the request or authenitcation will fail. The userIMO variable is created by the IMO User Auth wordpress plugin. This plugin will add the userIMO javascript variable to every Wordpress page. Using the variable in a post request looks like this:

```
var newPostData = $.extend(userIMO,postData); //Combine the new post data and user data into one object
$.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

  var postData = $.parseJSON(data);

  if (postData)
    alert("New Post created!");
  else
    alert("Could not post photo. Are you logged in?");
});
```

