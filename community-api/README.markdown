# Community API

The IMOMags community API is almost enitrely written in vanilla PHP with the exception that the Slim framework is used for URL routing and some error handling. When it comes to reading data, the API tries to be as RESTful as possible and many of the API calls for reading data are self explanatory.

## Troubleshooting
If you get a whitescreen when trying to access the API, check the logs. While Wordpress has it's own separate error log, the Community API just uses the regular Apache error log. You can access it on your dev with the following command:

`sudo tail -f /etc/httpd/logs/imomags.deva-error_log`

(Be sure to change the domain to your dev environment)



