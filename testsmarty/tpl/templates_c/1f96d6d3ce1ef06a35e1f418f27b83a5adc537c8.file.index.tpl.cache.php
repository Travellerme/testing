<?php /* Smarty version Smarty-3.1.13, created on 2013-04-23 16:42:46
         compiled from "tpl/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59294840351768b6da067e4-31200600%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f96d6d3ce1ef06a35e1f418f27b83a5adc537c8' => 
    array (
      0 => 'tpl/templates/index.tpl',
      1 => 1366723801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59294840351768b6da067e4-31200600',
  'function' => 
  array (
  ),
  'cache_lifetime' => 1,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51768b6dbdcc28_88868796',
  'variables' => 
  array (
    'Name' => 0,
    'row' => 0,
    'item' => 0,
    'FirstName' => 0,
    'LastName' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51768b6dbdcc28_88868796')) {function content_51768b6dbdcc28_88868796($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config('test.conf', $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars('setup', 'local'); ?>
<?php echo $_smarty_tpl->getConfigVariable('title');?>

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array('title'=>'foo'), 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['Name']->value)){?>
	<?php echo $_smarty_tpl->tpl_vars['Name']->value;?>

<?php }else{ ?>
	empty
<?php }?>
<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['row']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
	<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
<br>
	<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
<br>
	<hr>
<?php } ?>
<?php echo $_smarty_tpl->tpl_vars['FirstName']->value[0];?>

<?php echo $_smarty_tpl->tpl_vars['LastName']->value['Doe'];?>


<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>


<?php }} ?>