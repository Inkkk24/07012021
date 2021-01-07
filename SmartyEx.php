
<?php

require_once 'config/config.inc.php';
require_once('components/smarty/libs/Smarty.class.php');

$prenom = "Bob";

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

$smarty->assign('prenom','Ned');

//** un-comment the following line to show the debug console
//$smarty->debugging = true;

$smarty->display('SmartyTPL.tpl');


