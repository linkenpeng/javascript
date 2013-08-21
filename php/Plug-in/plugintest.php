<?php
// http://www.blueidea.com/tech/program/2009/7153.asp
define(STPATH, dirname(__FILE__).'/');
include 'PluginManager.php';
$pluginManager = new PluginManager();
$pluginManager->trigger('demo','');
?>