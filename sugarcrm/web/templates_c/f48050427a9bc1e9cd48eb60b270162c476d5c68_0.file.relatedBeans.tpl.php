<?php
/* Smarty version 4.3.4, created on 2023-10-12 14:53:07
  from '/var/www/sugarcrm/core/general/module/views/templates/relatedBeans.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6528085359beb8_72957761',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f48050427a9bc1e9cd48eb60b270162c476d5c68' => 
    array (
      0 => '/var/www/sugarcrm/core/general/module/views/templates/relatedBeans.tpl',
      1 => 1697122308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6528085359beb8_72957761 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="accordion accordion-flush" id="accordionFlushExample">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groupedRelatedModuleBeans']->value, 'relatedModuleBeans', false, 'beanName');
$_smarty_tpl->tpl_vars['relatedModuleBeans']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['beanName']->value => $_smarty_tpl->tpl_vars['relatedModuleBeans']->value) {
$_smarty_tpl->tpl_vars['relatedModuleBeans']->do_else = false;
?>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
" aria-expanded="false" aria-controls="flush-collapse<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
">
          [<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
]
        </button>
      </h2>
      <div id="flush-collapse<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
          <?php if (count($_smarty_tpl->tpl_vars['relatedModuleBeans']->value)) {?>
              <table class="table">
                <tr>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['moduleVardefs']->value[$_smarty_tpl->tpl_vars['beanName']->value]['list_view_fields'], 'fieldName');
$_smarty_tpl->tpl_vars['fieldName']->index = -1;
$_smarty_tpl->tpl_vars['fieldName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldName']->value) {
$_smarty_tpl->tpl_vars['fieldName']->do_else = false;
$_smarty_tpl->tpl_vars['fieldName']->index++;
$_smarty_tpl->tpl_vars['fieldName']->first = !$_smarty_tpl->tpl_vars['fieldName']->index;
$__foreach_fieldName_1_saved = $_smarty_tpl->tpl_vars['fieldName'];
?>
                    <th><?php echo $_smarty_tpl->tpl_vars['fieldName']->value;?>
</th>
                  <?php
$_smarty_tpl->tpl_vars['fieldName'] = $__foreach_fieldName_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tr>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['relatedModuleBeans']->value, 'relatedModuleBean');
$_smarty_tpl->tpl_vars['relatedModuleBean']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['relatedModuleBean']->value) {
$_smarty_tpl->tpl_vars['relatedModuleBean']->do_else = false;
?>
                  <tr>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['moduleVardefs']->value[$_smarty_tpl->tpl_vars['beanName']->value]['list_view_fields'], 'fieldName');
$_smarty_tpl->tpl_vars['fieldName']->index = -1;
$_smarty_tpl->tpl_vars['fieldName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fieldName']->value) {
$_smarty_tpl->tpl_vars['fieldName']->do_else = false;
$_smarty_tpl->tpl_vars['fieldName']->index++;
$_smarty_tpl->tpl_vars['fieldName']->first = !$_smarty_tpl->tpl_vars['fieldName']->index;
$__foreach_fieldName_3_saved = $_smarty_tpl->tpl_vars['fieldName'];
?>
                      <?php if ($_smarty_tpl->tpl_vars['fieldName']->first) {?>
                          <td><a href="/module/<?php echo $_smarty_tpl->tpl_vars['beanName']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['relatedModuleBean']->value['id'];?>
/detail"><?php echo $_smarty_tpl->tpl_vars['relatedModuleBean']->value[$_smarty_tpl->tpl_vars['fieldName']->value];?>
</a></td>
                      <?php } else { ?>
                          <td><?php echo $_smarty_tpl->tpl_vars['relatedModuleBean']->value[$_smarty_tpl->tpl_vars['fieldName']->value];?>
</td>
                      <?php }?>
                    <?php
$_smarty_tpl->tpl_vars['fieldName'] = $__foreach_fieldName_3_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </table>
            <?php } else { ?>
              <div class="alert alert-warning">No records here!</div>
            <?php }?>
          </div>
      </div>
    </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
