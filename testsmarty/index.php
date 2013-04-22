<?php
 /**
 * Example Application

 * @package Example-application
 */

require('libs/Smarty.class.php');

$smarty = new Smarty;
$smarty->template_dir='tpl/templates/';//путь к шаблонам
$smarty->compile_dir='tpl/templates_c/';
$smarty->config_dir='tpl/configs/';
$name = 'testing smarty';
$smarty->assign("Name",$name);
//$smarty->force_compile = true;
//$smarty->debugging = true;
$smarty->caching = true;
$smarty->cache_lifetime = 120;

$row[] = array('id'=>1,'name'=>'name_1');
$row[] = array('id'=>2,'name'=>'name_2');
$row[] = array('id'=>3,'name'=>'name_3');

$smarty->assign("row",$row);
$smarty->assign("FirstName",array("John","Mary","James","Henry"));
$smarty->assign("LastName",array("Doe"=>'123',"Smith"=>'124',"Johnson"=>'125',"Case"=>'126'));
$smarty->assign("Class",array(array("A","B","C","D"), array("E", "F", "G", "H"),
	  array("I", "J", "K", "L"), array("M", "N", "O", "P")));

$smarty->assign("contacts", array(array("phone" => "1", "fax" => "2", "cell" => "3"),
	  array("phone" => "555-4444", "fax" => "555-3333", "cell" => "760-1234")));

$smarty->assign("option_values", array("NY","NE","KS","IA","OK","TX"));
$smarty->assign("option_output", array("New York","Nebraska","Kansas","Iowa","Oklahoma","Texas"));
$smarty->assign("option_selected", "NE");

//$smarty->compile_check = false;
$smarty->display('index.tpl');
?>
