<?php
include ("../../../inc/includes.php");

Html::header(__("Additionnal fields", "fields"), $_SERVER['PHP_SELF'], "plugins", "fields", "container");

PluginFieldsContainer::titleList();
Search::show("PluginFieldsContainer");

Html::footer();
