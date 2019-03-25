
# Simple Php Firebase Panel with Auth0 Example for Your Apps that using Firebase DB*

 Created to update Cineworld23 mobile apps' firebase DB. 
 Used auth0 from > https://auth0.com
 Used php-firebase sdk from > https://github.com/kreait/firebase-php

 Step 1 : 
Create new profile and app on Auth0 Management Panel, set your configuration by following docs of Auth0. Download your pre-packed php files from QuickStart step and move them to "adminpanel" folder..
Or create step by step manuelly. You need to be check configurations on settings section and you need to update your changes both two side on your local files(especially .env file) and on settings page(auth0.com)
.. 
 Step 2:
Go to "sender" folder in main directory  and install composer from kreait's php-firebase admin sdk. Update your firebase api info in google-services.json or download json file change with mine.
```
composer install
```
Check my db.json , compare with your firebase db. Just it :)  
If you will use this  on a public server, dont forget to care security and privacy settings 



