<?php

namespace Module\Views;

use App\Models\SugarBean;

class Detail extends View {

    var $smarty;

    public function __construct(SugarBean $bean) {
        parent::__construct($bean);
        $moduleVardefs = $bean->moduleVardefs;
        $this->smarty->assign('viewFieldDefs', $moduleVardefs['detail_view_fields']);
    }

    public function display() {
        $this->smarty->display(base_path("../core/general/module/views/templates/detail.tpl"));
    }
}

