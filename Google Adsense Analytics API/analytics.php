<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);

// Load the Google API PHP Client Library.
require_once 'vendor/autoload.php';
require_once 'templates/base.php';
require_once 'config/database.php';

session_start();


$client = new Google_Client();
$client->setAccessType('online'); // default: offline
$client->setAuthConfig('client_secrets_analytics.json');
$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);


// Configure token storage on disk.
// If you want to store refresh tokens in a local disk file, set this to true.
define('STORE_ON_DISK', false, true);
define('TOKEN_FILENAME', 'tokens_analytics.dat', true);

// Create service.
$service = new Google_Service_Analytics($client);

// If we're logging out we just need to clear our local access token.
// Note that this only logs you out of the session. If STORE_ON_DISK is
// enabled and you want to remove stored data, delete the file.
if (isset($_REQUEST['logout'])) {
                unset($_SESSION['access_token']);
}


// If we have a code back from the OAuth 2.0 flow, we need to exchange that
// with the authenticate() function. We store the resultant access token
// bundle in the session (and disk, if enabled), and redirect to this page.
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    // Note that "getAccessToken" actually retrieves both the access and refresh
    // tokens, assuming both are available.
    $_SESSION['access_token'] = $client->getAccessToken();
    if (STORE_ON_DISK) {
        file_put_contents(TOKEN_FILENAME, $_SESSION['access_token']);
    }
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    exit;
}

// If we have an access token, we can make requests, else we generate an
// authentication URL.
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else if (STORE_ON_DISK && file_exists(TOKEN_FILENAME) && filesize(TOKEN_FILENAME) > 0) {
    // Note that "setAccessToken" actually sets both the access and refresh token,
    // assuming both were saved.
    $client->setAccessToken(file_get_contents(TOKEN_FILENAME));
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    // If we're doing disk storage, generate a URL that forces user approval.
    // This is the only way to guarantee we get back a refresh token.
    if (STORE_ON_DISK) {
        $client->setApprovalPrompt('force');
    }
    $authUrl = $client->createAuthUrl();
}

function combine_duplicates($array, $col)
{
    $index = array();
    foreach ($array as $row) {
        $key = $row[$col];
        if (!isset($index[$key])) {
            $index[$key] = $row;
        } else {
            for ($i = 0; $i < count($row); ++$i) {
                if ($i != $col) {
                    $index[$key][$i] += $row[$i];
                }
            }
        }
    }
    return array_values($index);
}

echo pageHeader('AdsenseAnalytics Management Reports');

echo '<div><div class="row"><div class="col-md-12 text-center">';
if (isset($authUrl)) {
    echo '<a class="btn btn-info text-center" href="' . $authUrl . '">Connect Me!</a>';
} else {
    echo '<a class="btn btn-success text-center" href="?logout">Logout</a>';
}
echo '</div></div>';

if ($client->getAccessToken()) {
    echo '<div class="row" style="margin-top:30px;"><div class="col-sm-12">';
    // Now we're signed in, we can make our requests.

    // Google Analytics account view ID
    $analytics_id = 'ga:159085335';

    // Get unique pageviews and average time on page.
    try {
        $optParams = array();

        // Required parameter https://developers.google.com/analytics/devguides/reporting/core/dimsmets
        $metrics    = 'ga:pageviews,ga:timeOnPage,ga:adsenseRevenue,ga:adsenseAdsViewed';
        $start_date = '2017-08-11';
        $end_date   = '2017-09-17';

        echo '<h4 class="text-center">Date range from ' . $start_date . ' to ' . $end_date . '</h4>';

        // Optional parameters https://developers.google.com/analytics/devguides/reporting/core/v3/reference#sort
        //$optParams['filters']     = 'ga:pagePath==/';
        $optParams['dimensions']  = 'ga:date,ga:pageTitle,ga:hostname,ga:pagePath';
        $optParams['sort']        = '-ga:pageviews';
        $optParams['max-results'] = '100';

        $result = $service->data_ga->get($analytics_id, $start_date, $end_date, $metrics, $optParams);
        $data   = array();
        if ($result->getRows()) {
            //print_r( $result->getRows() );
            $data = $result->getRows();
        }

    }
    catch (Exception $e) {
        echo 'There was an error : - ' . $e->getMessage();
    }
?>

<table class="table table-bordered table-hover table-responsive">
    <thead>
        <tr>
            <th>Page</th>
            <th>Page URL</th>
            <th>Page Views</th>
            <th>Time On Page</th>
            <th>Ad Revenue</th>
            <th>Ad Views </th>
        </tr>
    </thead>
    <tbody>

        <?php  foreach ($data as $analytics_data) {
            $pageTitle = $analytics_data[1];
            if($pageTitle == 'FreakOnMobile' && $analytics_data[2] == '0' && $analytics_data[3] == '0') {
                $pageUrl= $_SERVER['SERVER_NAME']."/";
            } else {
                $pageUrl = $analytics_data[2].$analytics_data[3];
            }
            $pageViews = $analytics_data[4];
            $timeOnPage = $analytics_data[5];
            $adsRevenue = 0 + ((string)$analytics_data[6]);
            $adsClicks = $analytics_data[7];
            $createdOn = date("Y-m-d");
        ?>
        <tr>
            <td><?= $pageTitle; ?></td>
            <td><?= $pageUrl; ?></td>
            <td><?= $pageViews; ?></td>
            <td><?= $timeOnPage; ?></td>
            <td><?= $adsRevenue; ?></td>
            <td><?= $adsClicks; ?></td>
        </tr>
        <?php
            $read = "SELECT page_url from analytics_reports WHERE page_url='".$pageUrl."'";
            //echo $read;
            $result = mysqli_query($conn, $read);
            if(mysqli_num_rows($result) > 0) {
                $updatedOn = date("Y-m-d");
                $update = "UPDATE analytics_reports SET page_title='$pageTitle', page_url='$pageUrl', page_views=$pageViews, time_on_page=$timeOnPage, ad_revenue=$adsRevenue, ad_views=$adsClicks, updated_on=CURDATE() WHERE page_url='".$pageUrl."'";
                //execute query
                if (mysqli_query($conn, $update)) {
                    echo "Existing Record Updated : ". $pageUrl ."<br/>";
                } else {
                    echo "Error: " . $update . "<br>" . mysqli_error($conn);
                }
            } else {
                $create = "INSERT INTO analytics_reports (page_title, page_url, page_views, time_on_page, ad_revenue, ad_views, created_on) VALUES ('$pageTitle', '$pageUrl', $pageViews, $timeOnPage, $adsRevenue, $adsClicks, CURDATE() )";
                //execute query
                if (mysqli_query($conn, $create)) {
                    echo "New Record Inserted : ". $pageUrl ."<br/>";
                } else {
                    echo "Error: " . $create . "<br>" . mysqli_error($conn);
                }
            }
        } 
		$data = combine_duplicates($data, 1);
		//end foreach
        ?>
   </tbody>
</table>

<?php
    // Note that we re-store the access_token bundle, just in case anything
    // changed during the request - the main thing that might happen here is the
    // access token itself is refreshed if the application has offline access.
    $_SESSION['access_token'] = $client->getAccessToken();
    echo '</div></div>';
}

echo '</div>';
echo pageFooter(__FILE__);

?>