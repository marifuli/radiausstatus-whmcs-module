<?php
/**
 * NAME: radiusstatus
 * WHMCS SDK Sample Addon Module
 *
 * An addon module allows you to add additional functionality to WHMCS. It
 * can provide both client and admin facing user interfaces, as well as
 * utilise hook functionality within WHMCS.
 *
 * This sample file demonstrates how an addon module for WHMCS should be
 * structured and exercises all supported functionality.
 *
 * Addon Modules are stored in the /modules/addons/ directory. The module
 * name you choose must be unique, and should be all lowercase, containing
 * only letters & numbers, always starting with a letter.
 *
 * Within the module itself, all functions must be prefixed with the module
 * filename, followed by an underscore, and then the function name. For this
 * example file, the filename is "radiusstatus" and therefore all functions
 * begin "radiusstatus_".
 *
 * For more information, please refer to the online documentation.
 *
 * @see https://developers.whmcs.com/addon-modules/
 *
 * @copyright Copyright (c) WHMCS Limited 2017
 * @license http://www.whmcs.com/license/ WHMCS Eula
 */

/**
 * Require any libraries needed for the module to function.
 * require_once __DIR__ . '/path/to/library/loader.php';
 *
 * Also, perform any initialization required by the service's library.
 */

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

/**
 * Define addon module configuration parameters.
 *
 * Includes a number of required system fields including name, description,
 * author, language and version.
 *
 * Also allows you to define any configuration parameters that should be
 * presented to the user when activating and configuring the module. These
 * values are then made available in all module function calls.
 *
 * Examples of each and their possible configuration parameters are provided in
 * the fields parameter below.
 *
 * @return array
 */
function radiusstatus_config()
{
    return [
        // Display name for your module
        'name' => 'Radius status by AVC',
        // Description displayed within the admin interface
        'description' => 'This module provides an easy way to check up your Radius status by using it\'s AVC ID',
        // Module author name
        'author' => 'Md Ariful Islam (arifdev.com)',
        // Default language
        'language' => 'english',
        // Version number
        'version' => '1.0.0',
        'fields' => [
            // a text field type allows for single line text input
            'avc_id' => [
                'FriendlyName' => 'AVC ID',
                'Type' => 'text',
                'Default' => '',
                'Description' => 'Enter your AVC ID which will be used in the API',
            ],
        ]
    ];
}

/**
 * Activate.
 *
 * Called upon activation of the module for the first time.
 * Use this function to perform any database and schema modifications
 * required by your module.
 *
 * This function is optional.
 *
 * @see https://developers.whmcs.com/advanced/db-interaction/
 *
 * @return array Optional success/failure message
 */
function radiusstatus_activate()
{
    // Create custom tables and schema required by your module
    try {
        Capsule::schema()
            ->create(
                'mod_radiusstatus',
                function ($table) {
                    /** @var \Illuminate\Database\Schema\Blueprint $table */
                    $table->increments('id');
                    $table->text('demo');
                }
            );

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success or instruct a '
                    . 'user how to get started with it here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            'status' => "error",
            'description' => 'Unable to create mod_radiusstatus: ' . $e->getMessage(),
        ];
    }
}

/**
 * Deactivate.
 *
 * Called upon deactivation of the module.
 * Use this function to undo any database and schema modifications
 * performed by your module.
 *
 * This function is optional.
 *
 * @see https://developers.whmcs.com/advanced/db-interaction/
 *
 * @return array Optional success/failure message
 */
function radiusstatus_deactivate()
{
    // Undo any database and schema modifications made by your module here
    try {
        Capsule::schema()
            ->dropIfExists('mod_radiusstatus');

        return [
            // Supported values here include: success, error or info
            'status' => 'success',
            'description' => 'This is a demo module only. '
                . 'In a real module you might report a success here.',
        ];
    } catch (\Exception $e) {
        return [
            // Supported values here include: success, error or info
            "status" => "error",
            "description" => "Unable to drop mod_radiusstatus: {$e->getMessage()}",
        ];
    }
}

/**
 * Upgrade.
 *
 * Called the first time the module is accessed following an update.
 * Use this function to perform any required database and schema modifications.
 *
 * This function is optional.
 *
 * @see https://laravel.com/docs/5.2/migrations
 *
 * @return void
 */
function radiusstatus_upgrade($vars)
{
    $currentlyInstalledVersion = $vars['version'];
}

/**
 * Admin Area Output.
 *
 * Called when the addon module is accessed via the admin area.
 * Should return HTML output for display to the admin user.
 *
 * This function is optional.
 *
 * @see radiusstatus\Admin\Controller::index()
 *
 * @return string
 */
function radiusstatus_output($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. radiusstatuss.php?module=radiusstatus
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $avc_id = $vars['avc_id']; 

    // Dispatch and handle request here. What follows is a demonstration of one
    // possible way of handling this using a very basic dispatcher implementation.

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    echo generate_html($avc_id);
}

/**
 * Admin Area Sidebar Output.
 *
 * Used to render output in the admin area sidebar.
 * This function is optional.
 *
 * @param array $vars
 *
 * @return string
 */
function radiusstatus_sidebar($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $_lang = $vars['_lang'];

    // Get module configuration parameters
    $configTextField = $vars['avc_id'];

    $sidebar = '<p>Sidebar output HTML goes here</p>';
    return '';
}

/**
 * Client Area Output.
 *
 * Called when the addon module is accessed via the client area.
 * Should return an array of output parameters.
 *
 * This function is optional.
 *
 * @see radiusstatus\Client\Controller::index()
 *
 * @return array
 */
function radiusstatus_clientarea($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink']; // eg. index.php?m=radiusstatus
    $version = $vars['version']; // eg. 1.0
    $_lang = $vars['_lang']; // an array of the currently loaded language variables

    // Get module configuration parameters
    $avc_id = $vars['avc_id']; 

    /**
     * Dispatch and handle request here. What follows is a demonstration of one
     * possible way of handling this using a very basic dispatcher implementation.
     */

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

    $sidebar = '<p>radiusstatus_clientarea output HTML goes here</p>';
    return [];
}

function generate_html($avc_id) 
{
    $apiKey = "5l8rpK7bk9xOZhfNXdeQ0ZcyQLjcmkOw";
    $apiSecret = "3tXrMEzaBBqjXNgrLwSDisvBb8N2PX88";
    $url = "https://rev3.kinetix.net.au/api/v2/nbn/provisioning/radius/avc/" . $avc_id;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        "X-Apikey: $apiKey",
        "X-ApiSecret: $apiSecret"
    ));
    $response = curl_exec($ch);
    $err = "<span style='color: red'>API Error: Something went wrong in the ApI call. Try checking the AVC ID</span>";
    if ($response === false || !(strpos($response, '{"avcId": "') !== false)) 
    {
        return $err;
    }
    curl_close($ch);
    $res = json_decode($response);

    // Define the two date strings
    $start_date_str = $res->recentDropouts->recentPeriod->startDateTime;
    $end_date_str = $res->recentDropouts->recentPeriod->endDateTime;
    $start_date = new DateTime($start_date_str);
    $end_date = new DateTime($end_date_str); 
    $interval = $start_date->diff($end_date); 
    $dropoutDays = $interval->days;
    try {
        $myresponse = '
        <hr>
        <div class="card flex-fill">
            <div class="card-header">
                <h3 style="font-size: 1.5em"> 
                    <i class="fas fa-heartbeat"></i>
                    Radius Status
                </h3>
            </div>
            <div class="card-body">
                <div class="form-group" style="min-height: 65px;">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <th scope="row" width="110px">Status</th>
                                <td>
                                    <i class="fa fa-check-circle" 
                                        style="color: '. ($res->status == 'Active' ? 'green' : 'yellow') .'"    
                                    ></i>
                                    '.$res->status.'
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Session Start</th>
                                <td>
                                    <svg
                                        class="svg-inline--fa fa-calendar-alt fa-w-14"
                                        aria-hidden="true"
                                        focusable="false"
                                        data-prefix="far"
                                        data-icon="calendar-alt"
                                        role="img"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 448 512"
                                        data-fa-i2svg="" style="width: 0.83em"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M148 288h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm108-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 96v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96-260v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48zm-48 346V160H48v298c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z"
                                        ></path>
                                    </svg>
                                    <!-- <i class="far fa-calendar-alt"></i> -->
                                    <span class="date_to_locale dtl_done">'.(
                                        DateTime::createFromFormat("Y-m-d\TH:i:s\Z", $res->currentSession->startDateTime) 
                                    )->format('d/m/Y h:i a T').'</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Duration</th>
                                <td>'.( ($res->currentSession->sessionDuration) ).'</td>
                            </tr>
                            <tr>
                                <th scope="row">Data</th>
                                <td>
                                '.$res->currentSession->dataTransfer->download->amount.' 
                                '.$res->currentSession->dataTransfer->download->units.'
                                down / 
                                '.$res->currentSession->dataTransfer->upload->amount.' 
                                '.$res->currentSession->dataTransfer->upload->units.'
                                up</td>
                            </tr>
                            <tr>
                                <th scope="row">IP Address</th>
                                <td>
                                '.(
                                    !$res->currentSession->ipAddress->address->dhcp ? '<span class="badge badge-primary">Static</span>' : ''
                                ).
                                ' '.$res->currentSession->ipAddress->address.'</td>
                            </tr>
                            <tr>
                                <th scope="row">Dropouts</th>
                                <td>'.$res->recentDropouts->count.' occurred in the last '.(
                                    $dropoutDays > 1 ? $dropoutDays . ' Days' : $dropoutDays . ' Day'
                                ).'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
        ';    
    } catch (\Throwable $th) {
        $myresponse = $err;
    }
    return $myresponse ?? $err;
}