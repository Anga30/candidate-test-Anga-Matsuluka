<?php
/* Smarty version 4.3.4, created on 2023-10-09 19:19:12
  from '/var/www/sugarcrm/core/general/module/views/templates/listview.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_652452308348c2_21953183',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51d02fbb97c789d7f4cca832a66ced90d8e9200a' => 
    array (
      0 => '/var/www/sugarcrm/core/general/module/views/templates/listview.tpl',
      1 => 1696879119,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652452308348c2_21953183 (Smarty_Internal_Template $_smarty_tpl) {
?><table class="table table-striped">
    <tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['columnDefs']->value, 'fieldName');
$_smarty_tpl->tpl_vars['fieldName']->index = -1;
$_smarty_tpl->tpl_vars['fieldName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldName']->value) {
$_smarty_tpl->tpl_vars['fieldName']->do_else = false;
$_smarty_tpl->tpl_vars['fieldName']->index++;
$_smarty_tpl->tpl_vars['fieldName']->first = !$_smarty_tpl->tpl_vars['fieldName']->index;
$__foreach_fieldName_0_saved = $_smarty_tpl->tpl_vars['fieldName'];
?>
            <th><?php echo $_smarty_tpl->tpl_vars['fieldName']->value;?>
</th>
        <?php
$_smarty_tpl->tpl_vars['fieldName'] = $__foreach_fieldName_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tr>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['beans']->value, 'bean');
$_smarty_tpl->tpl_vars['bean']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bean']->value) {
$_smarty_tpl->tpl_vars['bean']->do_else = false;
?>
        <tr>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['columnDefs']->value, 'fieldName');
$_smarty_tpl->tpl_vars['fieldName']->index = -1;
$_smarty_tpl->tpl_vars['fieldName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldName']->value) {
$_smarty_tpl->tpl_vars['fieldName']->do_else = false;
$_smarty_tpl->tpl_vars['fieldName']->index++;
$_smarty_tpl->tpl_vars['fieldName']->first = !$_smarty_tpl->tpl_vars['fieldName']->index;
$__foreach_fieldName_2_saved = $_smarty_tpl->tpl_vars['fieldName'];
?>
                <?php if ($_smarty_tpl->tpl_vars['fieldName']->first) {?>
                    <td><a href="/module/<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['bean']->value['id'];?>
/detail"><?php echo $_smarty_tpl->tpl_vars['bean']->value[$_smarty_tpl->tpl_vars['fieldName']->value];?>
</a></td>
                <?php } else { ?>
                    <td><?php echo $_smarty_tpl->tpl_vars['bean']->value[$_smarty_tpl->tpl_vars['fieldName']->value];?>
</td>
                <?php }?>
            <?php
$_smarty_tpl->tpl_vars['fieldName'] = $__foreach_fieldName_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table><?php }
}
