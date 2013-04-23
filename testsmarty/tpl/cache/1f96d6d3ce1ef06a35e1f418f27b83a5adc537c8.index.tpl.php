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
    '05c4447b22f75952732d36195ff1b0566bb22451' => 
    array (
      0 => 'tpl/configs/test.conf',
      1 => 1366724563,
      2 => 'file',
    ),
    '04a731858933de81b2f0702f8a5dba0835f4af64' => 
    array (
      0 => 'tpl/templates/header.tpl',
      1 => 1358297178,
      2 => 'file',
    ),
    'b08a5bbedbbe3e73633176841678f32b299fd28b' => 
    array (
      0 => 'tpl/templates/footer.tpl',
      1 => 1358297178,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59294840351768b6da067e4-31200600',
  'cache_lifetime' => 120,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517696a62807c2_32237153',
  'has_nocache_code' => true,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517696a62807c2_32237153')) {function content_517696a62807c2_32237153($_smarty_tpl) {?>Welcome to Smarty!
<HTML>
<HEAD>
<TITLE>foo - <?php echo $_smarty_tpl->tpl_vars['Name']->value;?>
</TITLE>
</HEAD>
<BODY bgcolor="#ffffff">

	testing smarty
	1<br>
	name_1<br>
	<hr>
	2<br>
	name_2<br>
	<hr>
	3<br>
	name_3<br>
	<hr>
John
123

</BODY>
</HTML>


<?php }} ?>