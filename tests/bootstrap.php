<?php
// fix empty CFG_GLPI on boostrap; see https://github.com/sebastianbergmann/phpunit/issues/325
global $CFG_GLPI;

/*class UnitTestAutoload
{

   public static function register() {
      spl_autoload_register(array('UnitTestAutoload', 'autoload'));
   }

   public static function autoload($className) {
      $file = __DIR__ . "/inc/$className.php";
      if (is_readable($file) && is_file($file)) {
         include_once(__DIR__ . "/inc/$className.php");
         return true;
      }
      return false;
   }

}

UnitTestAutoload::register();*/

//define plugin paths
define("PLUGINFIELDS_DOC_DIR", __DIR__ . "/generated_test_data");

if (!file_exists(PLUGINFIELDS_DOC_DIR)) {
   //create data dir
   mkdir(PLUGINFIELDS_DOC_DIR);
} else {
   //cleanup data dir
   $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator(
         PLUGINFIELDS_DOC_DIR,
         RecursiveDirectoryIterator::SKIP_DOTS
      ),
      RecursiveIteratorIterator::CHILD_FIRST
   );

   foreach ($files as $fileinfo) {
      $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
      $todo($fileinfo->getRealPath());
   }
}


define('GLPI_ROOT', dirname(dirname(dirname(__DIR__))));
define("GLPI_CONFIG_DIR", GLPI_ROOT . "/tests");
include GLPI_ROOT . "/inc/includes.php";
include_once GLPI_ROOT . '/tests/DbTestCase.php';

//install plugin
$plugin = new Plugin();
//FIXME: get plugin id from DB
call_user_func([$plugin, 'install'], '24');
call_user_func([$plugin, 'activate'], '24');
