<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

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
        ]
    ];
}

function radiusstatus_activate()
{
    // Create custom tables and schema required by your module

}

function radiusstatus_deactivate()
{
    // Undo any database and schema modifications made by your module here
    
}

function radiusstatus_upgrade($vars)
{
    $currentlyInstalledVersion = $vars['version'];
}

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

    // $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    // echo generate_html($avc_id);
}

function radiusstatus_sidebar($vars)
{
    // Get common module parameters
    $modulelink = $vars['modulelink'];
    $version = $vars['version'];
    $_lang = $vars['_lang'];
    return '';
}

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
