<?php


/**
Moodle 2.0 if this file is present as local/xxx/settings.php
These configuration items will be automatically added to admin tree
the approriate lang file must be added ...
 * */
 //OK tech web services
    $temp = new admin_settingpage('webservices', get_string('webservices', 'local_wspp'));
    $temp->add(new admin_setting_configcheckbox('ws_disable',
                   get_string('ws_disable','local_wspp'),
                   get_string('config_ws_disable','local_wspp'), 0));
    $temp->add(new admin_setting_configcheckbox('ws_enforceipcheck',
                   get_string('ws_enforceipcheck','local_wspp'),
                   get_string('ws_config_enforceipcheck','local_wspp'), 0));


    $temp->add(new admin_setting_configcheckbox('ws_logoperations',
                   get_string('ws_logoperations','local_wspp'),
                   get_string('config_ws_logoperations','local_wspp'), 1));
    $temp->add(new admin_setting_configcheckbox('ws_logdetailedoperations',
                   get_string('ws_logdetailedoperations','local_wspp'),
                   get_string('config_ws_logdetailedoperations','local_wspp'), 1));
    $temp->add(new admin_setting_configcheckbox('ws_logerrors',
                   get_string('ws_logerrors','local_wspp'),
                   get_string('config_ws_logerrors','local_wspp'), 1));
    $temp->add(new admin_setting_configcheckbox('ws_debug',
                   get_string('ws_debug','local_wspp'),
                   get_string('config_ws_debug','local_wspp'), 0));
    $temp->add(new admin_setting_configtext('ws_sessiontimeout',
                 get_string('ws_sessiontimeout','local_wspp'),
                 get_string('config_ws_sessiontimeout','local_wspp'),1800,PARAM_INT));
    $temp->add(new admin_setting_configcheckbox('ws_uselocalwsdl',
                   get_string('ws_uselocalwsdl','local_wspp'),
                   get_string('config_ws_uselocalwsdl','local_wspp'), 0));


    $ADMIN->add('development', $temp);




?>
