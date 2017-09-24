# Analytics & AdSense Management API
# Generate Reports and Store it in Database (Removing Duplicate Datas)

This sample runs a number of different requests against the AdSense & Analytics Management API.
Adsense API Base : https://github.com/googleads/googleads-adsense-examples/tree/master/php-clientlib-1.x/v1.x

## Prerequisites

* PHP version 5.2.1 or greater
* The JSON PHP extension

## Files Overview
* adsense.php -- Generate Adsense Reports
* analytics.php -- Generate Analytics Reports (including Adsense Revenue)
* Note : You have to integrate adsense in your analytics account get combined data
* config/database.php -- database credentials
* client_secrets_analytics.json -- Analytics Client Secret Key
* client_secrets_adsense.json -- Adsense Client Secret Key

## Installation

* Download Files
* Change the include path in analytics.php / adsense.php to your files installation.
* Get client_secrets.json (https://console.developers.google.com/flows/enableapi?apiid=analytics&credential=client_key&pli=1)

* Modify `client_secrets_adsense.json` with your client ID, client secret and redirect (For Adsense Data)
* Modify `client_secrets_analytics.json` with your client ID, client secret and redirect (For Analytics Data)

* (Optional) If you want to store credentials between runs to avoid authorizing
  more than once, change `STORE_ON_DISK` in adsense.php to `true`.
  * You may have to give your PHP installation write permissions to the token
    file. One easy way of doing this is creating an empty `tokens.dat` file in
    the installation directory and making it writeable by your web server.

* Open the sample (`http://your/path/adsense.php`) in your browser.
* Open the sample (`http://your/path/analytics.php`) in your browser.

This will start an authentication flow, redirect back to your server, and then
print data about your AdSense & Analytics account.

## Future Developement
* Adding Compatibility for Refresh Token

## For any help
* `mail-me-at : gadadarshan[at]gmail[dot]com`
