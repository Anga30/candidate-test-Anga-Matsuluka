<?php

namespace Module\Views;

use App\Models\SugarBean;

class View {

    var $smarty;
    var $bean;
    var $moduleLabel;
    var $moduleVardefs;

    public function __construct(SugarBean $bean) {
        $this->bean = $bean;
        $moduleVardefs = $bean->moduleVardefs;
        $this->moduleLabel = $moduleVardefs['label'];
        $this->moduleVardefs = $moduleVardefs;

        $this->smarty = new \Smarty();
        $this->smarty->assign('beanName', get_class($this->bean));
        $this->smarty->assign('beanArray', $bean->toArray());
        $this->smarty->assign('moduleLabel', $this->moduleLabel);
        $fieldDefs = $this->moduleVardefs['fields'];
        $this->smarty->assign('fieldDefs', array_merge($fieldDefs, [
            'name' => ['type'=>'string', 'length' => 255, 'default' => null, 'null' => true],
            'description' => ['type'=>'text', 'length' => 255, 'default' => null, 'null' => true]
        ]));
    }

    public function display() {
        $this->smarty->display(base_path("../core/general/views/templates/content.tpl"));
    }

    public function displayRelatedBeans() {
        global $moduleVardefs;
        $groupedRelatedModuleBeans = $this->bean->get_all_linked_beans();
        
        $this->smarty->assign('moduleVardefs', $moduleVardefs);
        $this->smarty->assign('groupedRelatedModuleBeans', $groupedRelatedModuleBeans);
        $this->smarty->display(base_path("../core/general/module/views/templates/relatedBeans.tpl"));
    }
}

