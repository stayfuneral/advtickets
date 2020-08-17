<?php

define('PLUGIN_ADVTICKETS_VERSION', '1.0.0');
define('PLUGIN_ADVTICKETS_NAME', 'advtickets');

/**
 * Init hooks of the plugin.
 * REQUIRED
 *
 * @return void
 */
function plugin_init_advtickets() {
   global $PLUGIN_HOOKS;

   Plugin::registerClass(PluginAdvticketsEvent::class);

   $PLUGIN_HOOKS['csrf_compliant'][PLUGIN_ADVTICKETS_NAME] = true;

   $PLUGIN_HOOKS['pre_item_add'][PLUGIN_ADVTICKETS_NAME] = [
       Ticket::class => 'plugin_advtickets_pre_item_add'
   ];
}


/**
 * Get the name and the version of the plugin
 * REQUIRED
 *
 * @return array
 */
function plugin_version_advtickets() {
   return [
      'name'           => 'Adv Tickets',
      'version'        => PLUGIN_ADVTICKETS_VERSION,
      'author'         => 'Roman Gonyukov',
      'license'        => '',
      'homepage'       => 'https://github.com/stayfuneral/advtickets',
      'requirements'   => [
         'glpi' => [
            'min' => '9.2',
         ]
      ]
   ];
}

/**
 * Check pre-requisites before install
 * OPTIONNAL, but recommanded
 *
 * @return boolean
 */
function plugin_advtickets_check_prerequisites() {

   //Version check is not done by core in GLPI < 9.2 but has to be delegated to core in GLPI >= 9.2.
   $version = preg_replace('/^((\d+\.?)+).*$/', '$1', GLPI_VERSION);
   if (version_compare($version, '9.2', '<')) {
      echo "This plugin requires GLPI >= 9.2";
      return false;
   }
   return true;
}

/**
 * Check configuration process
 *
 * @param boolean $verbose Whether to display message on failure. Defaults to false
 *
 * @return boolean
 */
function plugin_advtickets_check_config($verbose = false) {
   if (true) { // Your configuration check
      return true;
   }

   if ($verbose) {
      echo __('Installed / not configured', 'advtickets');
   }
   return false;
}
