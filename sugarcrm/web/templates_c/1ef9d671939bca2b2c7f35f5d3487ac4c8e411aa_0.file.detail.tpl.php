<?php
/* Smarty version 4.3.4, created on 2023-10-10 06:35:44
  from '/var/www/sugarcrm/core/general/module/views/templates/detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6524f0c06a9032_69846174',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1ef9d671939bca2b2c7f35f5d3487ac4c8e411aa' => 
    array (
      0 => '/var/www/sugarcrm/core/general/module/views/templates/detail.tpl',
      1 => 1696919553,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6524f0c06a9032_69846174 (Smarty_Internal_Template $_smarty_tpl) {
?><h3><?php echo $_smarty_tpl->tpl_vars['moduleLabel']->value;?>
</h3>
<a class="btn btn-outline-secondary" href="/module/<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['beanArray']->value['id'];?>
/edit" role="button">Edit</a><br><br>
<table class="table table-module-detail table-striped-columns">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['viewFieldDefs']->value, 'rowDefs');
$_smarty_tpl->tpl_vars['rowDefs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rowDefs']->value) {
$_smarty_tpl->tpl_vars['rowDefs']->do_else = false;
?>
        <tr>
            <?php if ((isset($_smarty_tpl->tpl_vars['rowDefs']->value[0]))) {?>
                <th><?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[0];?>
:</th><td>
                    <?php if ($_smarty_tpl->tpl_vars['fieldDefs']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]['type'] == "boolean") {?>
                        <div class="form-check">
                            <input class="form-check-input" disabled="disabled" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]) {?>checked<?php }?>>
                        </div>
                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]];?>

                    <?php }?>
                </td>
            <?php } else { ?>
                <th></th><td></td>
            <?php }?>

            <?php if ((isset($_smarty_tpl->tpl_vars['rowDefs']->value[1]))) {?>
                <th><?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[1];?>
:</th><td>
                    <?php if ($_smarty_tpl->tpl_vars['fieldDefs']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]['type'] == "boolean") {?>
                        <div class="form-check">
                            <input class="form-check-input" disabled="disabled" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]) {?>checked<?php }?>>
                        </div>
                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]];?>

                    <?php }?>
                </td>
            <?php } else { ?>
                <th></th><td></td>
            <?php }?>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table><?php }
}
