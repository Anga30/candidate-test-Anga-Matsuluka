<?php
/* Smarty version 4.3.4, created on 2023-10-10 06:34:46
  from '/var/www/sugarcrm/core/general/module/views/templates/edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6524f086ce75f1_42548343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89897e24c49e5fd8a349b2db551dee851362a4b8' => 
    array (
      0 => '/var/www/sugarcrm/core/general/module/views/templates/edit.tpl',
      1 => 1696919668,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6524f086ce75f1_42548343 (Smarty_Internal_Template $_smarty_tpl) {
?><h3><?php echo $_smarty_tpl->tpl_vars['moduleLabel']->value;?>
</h3>
<br><br>
<form method="post" action="/module/<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['beanArray']->value['id'];?>
">
    <input type="hidden" name="_token" value="<?php echo $_smarty_tpl->tpl_vars['csrf_token']->value;?>
" />
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
:</th>
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['fieldDefs']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]['type'] == "boolean") {?>
                            <div class="form-check">
                                <input class="form-check-input" name="<?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[0];?>
" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]) {?>checked<?php }?>/>
                            </div>
                        <?php } else { ?>
                            <input type="text" class="form-control <?php if ((isset($_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]))) {?>is-invalid<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[0];?>
" value="<?php if ((isset($_smarty_tpl->tpl_vars['oldData']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]))) {
echo $_smarty_tpl->tpl_vars['oldData']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]];
} else {
echo $_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]];
}?>" />
                        <?php }?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]]))) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[0]], 'errorMessage');
$_smarty_tpl->tpl_vars['errorMessage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['errorMessage']->value) {
$_smarty_tpl->tpl_vars['errorMessage']->do_else = false;
?>
                                <div class="invalid-feedback">
                                    <?php echo $_smarty_tpl->tpl_vars['errorMessage']->value;?>

                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </td>
                <?php } else { ?>
                    <th></th><td></td>
                <?php }?>

                <?php if ((isset($_smarty_tpl->tpl_vars['rowDefs']->value[1]))) {?>
                    <th><?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[1];?>
:</th>
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['fieldDefs']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]['type'] == "boolean") {?>
                            <div class="form-check">
                                <input class="form-check-input" name="<?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[1];?>
" type="checkbox" value="1" <?php if ($_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]) {?>checked<?php }?>/>
                            </div>
                        <?php } else { ?>
                            <input type="text"class="form-control <?php if ((isset($_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]))) {?>is-invalid<?php }?>" name="<?php echo $_smarty_tpl->tpl_vars['rowDefs']->value[1];?>
" value="<?php if ((isset($_smarty_tpl->tpl_vars['oldData']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]))) {
echo $_smarty_tpl->tpl_vars['oldData']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]];
} else {
echo $_smarty_tpl->tpl_vars['beanArray']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]];
}?>" />
                        <?php }?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]]))) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value[$_smarty_tpl->tpl_vars['rowDefs']->value[1]], 'errorMessage');
$_smarty_tpl->tpl_vars['errorMessage']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['errorMessage']->value) {
$_smarty_tpl->tpl_vars['errorMessage']->do_else = false;
?>
                                <div class="invalid-feedback">
                                    <?php echo $_smarty_tpl->tpl_vars['errorMessage']->value;?>

                                </div>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php }?>
                    </td>
                <?php } else { ?>
                    <th></th><td></td>
                <?php }?>
            </tr>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table>
    <button class="btn btn-outline-secondary" type="submit">Save</a>
</form><?php }
}
