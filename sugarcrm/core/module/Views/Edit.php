<?php

namespace Module\Views;

use App\Models\SugarBean;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class Edit extends View {
    
    public function __construct(SugarBean $bean) {
        parent::__construct($bean);
        $moduleVardefs = $bean->moduleVardefs;
        $this->smarty->assign('viewFieldDefs', $moduleVardefs['edit_view_fields']);
        $this->smarty->assign('csrf_token', csrf_token());

        $oldData = [];
        foreach($moduleVardefs['edit_view_fields'] as $rowFields) {
            foreach($rowFields as $rowField) {
                $value = Request::old($rowField);
                if ( !is_null($value) ) {
                    $oldData[$rowField] = $value;
                }
            }
        }
        $errors = [];
        $viewErrorsBag = session()->get('errors');
        if ( $viewErrorsBag ) {
            $errors = $viewErrorsBag->toArray();
        }
        
        $this->smarty->assign('oldData', $oldData);
        $this->smarty->assign('errors', $errors);

    }

    public function display() {
        $this->smarty->display(base_path("../core/general/module/views/templates/edit.tpl"));
    }
}

