<?php
/*
Plugin Name: Ninja Forms
Plugin URI: http://ninjaforms.com
Description: Ninja Forms is a webform builder with unparalleled ease of use and features.
Version: 2.1.9
Author: The WP Ninjas
Author URI: http://wpninjas.net
*/

/*
Copyright 2011 WP Ninjas/Kevin Stover.
/*

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Ninja Forms also uses the following jQuery plugins. Their licenses can be found in their respective files.

	jQuery TipTip Tooltip v1.3
	code.drewwilson.com/entry/tiptip-jquery-plugin
	www.drewwilson.com
	Copyright 2010 Drew Wilson

	jQuery MaskedInput v.1.3
	http://digitalbush.co
	Copyright (c) 2007-2011 Josh Bush

	jQuery Tablesorter Plugin v.2.0.5
	http://tablesorter.com
	Copyright (c) Christian Bach 2012

	jQuery AutoNumeric Plugin v.1.7.4-B
	http://www.decorplanit.com/plugin/
	By: Bob Knothe And okolov Yura aka funny_falcon

*/
global $wpdb, $wp_version;

define("NINJA_FORMS_DIR", WP_PLUGIN_DIR."/ninja-forms");
define("NINJA_FORMS_URL", plugins_url()."/ninja-forms");
define("NINJA_FORMS_VERSION", "2.1.9");
define("NINJA_FORMS_TABLE_NAME", $wpdb->prefix . "ninja_forms");
define("NINJA_FORMS_FIELDS_TABLE_NAME", $wpdb->prefix . "ninja_forms_fields");
define("NINJA_FORMS_FAV_FIELDS_TABLE_NAME", $wpdb->prefix . "ninja_forms_fav_fields");
define("NINJA_FORMS_SUBS_TABLE_NAME", $wpdb->prefix . "ninja_forms_subs");
/*
// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'NINJA_FORMS_EDD_SL_STORE_URL', 'http://wpninjas.com' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system

// the name of your product. This is the title of your product in EDD and should match the download title in EDD exactly
define( 'NINJA_FORMS_EDD_SL_ITEM_NAME', 'Ninja Forms Alpha' ); // IMPORTANT: change the name of this constant to something unique to prevent conflicts with other plugins using this system
*/

/* Require Core Files */
require_once(NINJA_FORMS_DIR."/includes/database.php");
require_once(NINJA_FORMS_DIR."/includes/activation.php");
require_once(NINJA_FORMS_DIR."/includes/register.php");
require_once(NINJA_FORMS_DIR."/includes/shortcode.php");
require_once(NINJA_FORMS_DIR."/includes/widget.php");
require_once(NINJA_FORMS_DIR."/includes/field-type-groups.php");

require_once(NINJA_FORMS_DIR."/includes/admin/scripts.php");
require_once(NINJA_FORMS_DIR."/includes/display/scripts.php");
require_once(NINJA_FORMS_DIR."/includes/admin/sidebar.php");
require_once(NINJA_FORMS_DIR."/includes/admin/tabs.php");
require_once(NINJA_FORMS_DIR."/includes/admin/post-metabox.php");

require_once(NINJA_FORMS_DIR."/includes/admin/ajax.php");
require_once(NINJA_FORMS_DIR."/includes/admin/admin.php");
require_once(NINJA_FORMS_DIR."/includes/admin/sidebar-fields.php");
require_once(NINJA_FORMS_DIR."/includes/admin/display-screen-options.php");
require_once(NINJA_FORMS_DIR."/includes/admin/register-screen-options.php");
require_once(NINJA_FORMS_DIR."/includes/admin/register-screen-help.php");
require_once(NINJA_FORMS_DIR."/includes/admin/export-subs.php");
require_once(NINJA_FORMS_DIR."/includes/admin/output-tab-metabox.php");
require_once(NINJA_FORMS_DIR."/includes/admin/form-preview.php");

//Processing Functions
require_once(NINJA_FORMS_DIR."/includes/display/processing/class-ninja-forms-processing.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/pre-process.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/process.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/post-process.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/save-sub.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/filter-msgs.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/error-test.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/email-admin.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/email-user.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/email-add-fields.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/attachment-test.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/fields-pre-process.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/fields-process.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/fields-post-process.php");
require_once(NINJA_FORMS_DIR."/includes/display/processing/req-fields-pre-process.php");

//Edit Field Functions
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/edit-field.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/label.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/hr.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/req.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/custom-class.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/help.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/li.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/remove-button.php");
require_once(NINJA_FORMS_DIR."/includes/admin/edit-field/save-button.php");

//Display Form Functions
require_once(NINJA_FORMS_DIR."/includes/display/form/display-form.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/display-fields.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/response-message.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/label.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/help.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/form-title.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/process-message.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/field-error-message.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/form-wrap.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/required-label.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/open-form-tag.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/close-form-tag.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/hidden-fields.php");
require_once(NINJA_FORMS_DIR."/includes/display/form/form-visibility.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/restore-progress.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/inside-label-hidden.php");
require_once(NINJA_FORMS_DIR."/includes/display/fields/field-type.php");

/* Require Pre-Registered Tabs and their sidebars */

/* * * * ninja-forms - Main Form Editing Page

/* Tabs */

/* Form List */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/form-list/form-list.php");

/* Form Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/form-settings/form-settings.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/form-settings/help.php");

/* Field Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/field-settings.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/empty-rte.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/edit-field-ul.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/help.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/sidebars/def-fields.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/sidebars/fav-fields.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/sidebars/template-fields.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/field-settings/sidebars/layout-fields.php");

/* Form Preview */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms/tabs/form-preview/form-preview.php");


/* * * * ninja-forms-settings - Settings Page

/* Tabs */

/* General Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-settings/tabs/general-settings/general-settings.php");

/* Favorite Field Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-settings/tabs/favorite-fields/favorite-fields.php");

/* Label Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-settings/tabs/label-settings/label-settings.php");

/* Ajax Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-settings/tabs/ajax-settings/ajax-settings.php");

/* License Settings */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-settings/tabs/license-settings/license-settings.php");

//require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-settings/tabs/conversion-test/conversion-test.php");

/* * * * ninja-forms-impexp - Import / Export Page

/* Tabs */

/* Import / Export Forms */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-impexp/tabs/impexp-forms/impexp-forms.php");

/* Import / Export Fields */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-impexp/tabs/impexp-fields/impexp-fields.php");

/* Import / Export Submissions */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-impexp/tabs/impexp-subs/impexp-subs.php");

/* Backup / Restore */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-impexp/tabs/impexp-backup/impexp-backup.php");

/* * * * ninja-forms-subs - Submissions Review Page

/* Tabs */

/* View Submissions */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-subs/tabs/view-subs/view-subs.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-subs/tabs/view-subs/fields-pre-process.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-subs/tabs/view-subs/fields-process.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-subs/tabs/view-subs/fields-post-process.php");
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-subs/tabs/view-subs/sidebars/select-subs.php");

/* * * ninja-forms-addons - Addons Manager Page

/* Tabs */

/* Manage Addons */
require_once(NINJA_FORMS_DIR."/includes/admin/pages/ninja-forms-addons/tabs/addons/addons.php");


/* Require Pre-Registered Fields */
require_once(NINJA_FORMS_DIR."/includes/fields/textbox.php");
require_once(NINJA_FORMS_DIR."/includes/fields/checkbox.php");
require_once(NINJA_FORMS_DIR."/includes/fields/list.php");
require_once(NINJA_FORMS_DIR."/includes/fields/hidden.php");
require_once(NINJA_FORMS_DIR."/includes/fields/organizer.php");
require_once(NINJA_FORMS_DIR."/includes/fields/submit.php");
require_once(NINJA_FORMS_DIR."/includes/fields/spam.php");
require_once(NINJA_FORMS_DIR."/includes/fields/hr.php");
require_once(NINJA_FORMS_DIR."/includes/fields/desc.php");
require_once(NINJA_FORMS_DIR."/includes/fields/textarea.php");
require_once(NINJA_FORMS_DIR."/includes/fields/password.php");

require_once(NINJA_FORMS_DIR."/includes/admin/save.php");

if(session_id() == '') {
	session_start();
}
$_SESSION['NINJA_FORMS_DIR'] = NINJA_FORMS_DIR;
$_SESSION['NINJA_FORMS_URL'] = NINJA_FORMS_URL;

function ninja_forms_load_lang() {
	$plugin_dir = basename(dirname(__FILE__));
	$lang_dir = $plugin_dir.'/lang/';
	load_plugin_textdomain( 'ninja-forms', false, $lang_dir );
}
add_action('init', 'ninja_forms_load_lang');
/*
$plugin_settings = get_option( 'ninja_forms_settings' );

// retrieve our license key from the DB
if( isset( $plugin_settings['license_key'] ) ){
	$license_key = $plugin_settings['license_key'];
}else{
	$license_key = '';
}


// setup the updater
$edd_updater = new EDD_SL_Plugin_Updater( NINJA_FORMS_EDD_SL_STORE_URL, __FILE__, array(
		'version' 	=> NINJA_FORMS_VERSION, 		// current version number
		'license' 	=> $license_key, 	// license key (used get_option above to retrieve from DB)
		'item_name'     => NINJA_FORMS_EDD_SL_ITEM_NAME, 	// name of this plugin
		'author' 	=> 'WP Ninjas'  // author of this plugin
	)
);
*/

register_activation_hook( __FILE__, 'ninja_forms_activation' );

function ninja_forms_return_echo($function_name){
	$arguments = func_get_args();
    array_shift($arguments); // We need to remove the first arg ($function_name)
    ob_start();
    call_user_func_array($function_name, $arguments);
	$return = ob_get_clean();
	return $return;
}

function ninja_forms_activate_license() {
	$plugin_settings = get_option('ninja_forms_settings');
	$license = trim($plugin_settings['license_key']);

	if($license != ''){
		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( NINJA_FORMS_EDD_SL_ITEM_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, NINJA_FORMS_EDD_SL_STORE_URL ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		return $license_data->license;
	}
}

function ninja_forms_random_string($length = 10){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}

function ninja_forms_remove_from_array($arr, $key, $val, $within = FALSE) {
    foreach ($arr as $i => $array)
            if ($within && stripos($array[$key], $val) !== FALSE && (gettype($val) === gettype($array[$key])))
                unset($arr[$i]);
            elseif ($array[$key] === $val)
                unset($arr[$i]);

    return array_values($arr);
}