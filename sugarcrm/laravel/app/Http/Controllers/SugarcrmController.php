<?php

namespace App\Http\Controllers;

use App\Models\LtCase;
use Illuminate\Http\Request;
use App\Models\SugarBean;
use App\Utils\GeneralUtils;
use Illuminate\Support\Facades\Validator;
use lt_policy;
use Module\Views\Detail as SugarDetailView;
use Module\Views\Edit as SugarEditView;
use App\Models\LtCustomer;

class SugarcrmController extends Controller
{

    public function moduleView($moduleName = null, $id = null, $view = null): void {

        $base = new \Smarty();
        $base->display(base_path("../core/general/views/templates/header.tpl"));

        if ( empty($moduleName) && empty($id) && empty($view) ) {

            $lastCreatedPolicy = lt_policy::latest()->first();
            $lastCreatedPolicyName = $lastCreatedPolicy->name;
            $totalNumOfDecreaseCoverCases = LtCase::where('type', 'decrease_cover')->count();
            $totalNumOfCancelCoverCases = LtCase::where('type', 'cancel_cover')->count();

            $base->assign('totalNumOfDecreaseCoverCases', $totalNumOfDecreaseCoverCases);
            $base->assign('totalNumOfCancelCoverCases', $totalNumOfCancelCoverCases);
            $base->assign('lastCreatedPolicyName', $lastCreatedPolicyName);

            $base->display(base_path("../core/general/views/templates/content.tpl"));
        } else {
            $bean = $this->getBeanByModuleAndId($moduleName, $id);
            $this->processModuleView($bean, $view);
        }

        $base->display(base_path("../core/general/views/templates/footer.tpl"));
    }

    public function getBeanByModuleAndId(String $moduleName, String $id) {
        $className = "{$moduleName}";
        $bean = new $className();
        if ( class_exists($className) ) {
            $bean = new $className();
            $bean->retrieve($id);
            if ( empty($bean->id) ) {
                abort(404, "Not found!");
            }
            
        } else {
            abort(500, "Bean class not found!");
        }

        return $bean;
    }

    public function moduleSave(Request $request, $moduleName = null, $id = null) {

        $bean = $this->getBeanByModuleAndId($moduleName, $id);

        $fieldsToValidate = [];
        $fields = $bean->moduleVardefs['fields'];
        foreach( $bean->moduleVardefs['edit_view_fields'] as $fieldNames ) {
            foreach($fieldNames as $fieldName) {
                if ( $fields[$fieldName]['type'] == "boolean" || $fields[$fieldName]['type'] == "bool" ) {
                    $fieldsToValidate[$fieldName] = 'sometimes|in:1';
                } else {
                    $fieldsToValidate[$fieldName] = 'required';
                }
            }
        }
        $data = $request->all();
        unset($data['_token']);
        $validator = Validator::make($data, $fieldsToValidate);

        if ( $validator->fails() ) {
            return redirect("module/{$moduleName}/{$bean->id}/edit")
                    ->withErrors($validator)
                    ->withInput();
        } else {

            foreach($data as $fieldName => $fieldValue) {
                $bean->{$fieldName} = $fieldValue;
            }
            
            //Checkboxes wont be submitted if unchecked therefore if a field is in the validation list
            //...but not in the submitted data then its an unchecked checkbox
            $checkBoxFields = array_diff_key($fieldsToValidate, $data);
            foreach($checkBoxFields as $fieldName => $fieldValue) {
                $bean->{$fieldName} = false;
            }

            $bean->save();
        }

        return redirect("module/{$moduleName}/{$bean->id}/detail");
    }

    public function processModuleView(SugarBean $bean, String $view) {
        switch ($view) {
            case "detail":
                $this->processModuleDetailView($bean);
                break;
            case "edit":
                $this->processModuleEditView($bean);
                break;
        }
    }

    public function processModuleDetailView(SugarBean $bean): void {
        $moduleVardefs = $bean->moduleVardefs;
        $detailViewClassName = "\\" . $moduleVardefs['detail_view_class'];
        $detail = new $detailViewClassName($bean);

        $detail->display();
        $detail->displayRelatedBeans();
    }

    public function processModuleEditView(SugarBean $bean): void {
        $moduleVardefs = $bean->moduleVardefs;
        $editViewClassName = "\\" . $moduleVardefs['edit_view_class'];
        $edit = new $editViewClassName($bean);

        $edit->display();
    }

    public function moduleListView($moduleName = null): void {
        global $moduleVardefs;
        $className = "{$moduleName}";
        $beans = $className::all()->toArray();
        
        $base = new \Smarty();//
        $base ->assign('beans', $beans);
        $base ->assign('beanName', $moduleName);
        $base ->assign('columnDefs', $moduleVardefs[$moduleName]['list_view_fields']);
        $base->display(base_path("../core/general/views/templates/header.tpl"));
        $base->display(base_path("../core/general/module/views/templates/listview.tpl"));
        $base->display(base_path("../core/general/views/templates/footer.tpl"));
    }

}
