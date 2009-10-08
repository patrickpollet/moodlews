<?php

/**
 * admin setting to be included in admin/settings/misc.php by
 *  //OK Tech wxb services
 *   require("$CFG->dirroot/wspp/admin/wspp.php");
 *   and not require_once (why ?)
 */
 //OK tech web services
    $temp = new admin_settingpage('webservices', get_string('webservices', 'wspp'));
    $temp->add(new admin_setting_configcheckbox('ws_disable',
                   get_string('ws_disable', 'wspp'),
                   get_string('config_ws_disable', 'wspp'), 0));
    $temp->add(new admin_setting_configcheckbox('ws_enforceipcheck',
                   get_string('ws_enforceipcheck', 'wspp'),
                   get_string('ws_config_enforceipcheck', 'wspp'), 0));


    $temp->add(new admin_setting_configcheckbox('ws_logoperations',
                   get_string('ws_logoperations', 'wspp'),
                   get_string('config_ws_logoperations', 'wspp'), 1));
    $temp->add(new admin_setting_configcheckbox('ws_logdetailedoperations',
                   get_string('ws_logdetailedoperations', 'wspp'),
                   get_string('config_ws_logdetailedoperations', 'wspp'), 1));
    $temp->add(new admin_setting_configcheckbox('ws_logerrors',
                   get_string('ws_logerrors', 'wspp'),
                   get_string('config_ws_logerrors', 'wspp'), 1));
    $temp->add(new admin_setting_configcheckbox('ws_debug',
                   get_string('ws_debug', 'wspp'),
                   get_string('config_ws_debug', 'wspp'), 0));
     $temp->add(new admin_setting_configtext('ws_sessiontimeout',
                 get_string('ws_sessiontimeout','wspp'),
                 get_string('config_ws_sessiontimeout', 'wspp'),1800,PARAM_INT));
    $ADMIN->add('misc', $temp);


?>
