<?php 

$moduleVardefs['lt_case'] = [
    'label' => 'Case',
    'detail_view_class' => 'CaseDetailView',
    'edit_view_class' => 'CaseEditView',
    'related_modules' => [
        'lt_customer' => [
            'relationship_type' => 'many-to-many',
            'module' => 'LtCustomer',
            'bean_name' => 'LtCustomer',
            'source' => 'non-db',
            'vname' => 'LBL_CUSTOMERS_CASES',
        ],
        'lt_policy' => [
            'relationship_type' => 'many-to-many',
            'module' => 'LtPolicy',
            'bean_name' => 'LtPolicy',
            'source' => 'non-db',
            'vname' => 'LBL_CASES_POLICIES',
        ],
    ],
    /* Add all the fields for your module/table below */
    'fields' => [
        'id' => [],
        'case_id' => [
            'type' => 'integer',
            'null' => true,
            'length' => null,
            'default' => null,
        ],
        'policy_id' => [
            'type' => 'integer',
            'null' => true,
            'length' => null,
            'default' => null,
        ],
        'type' => [
            'type' => 'string',
            'null' => true,
            'length' => 20,
            'default' => null,
        ],
        'status' => [
            'type' => 'string',
            'null' => false,
            'length' => 6,
            'default' => '',
        ],
        'name' => [
            'type' => 'string',
            'null' => true,
            'length' => 255,
            'default' => null,
        ],
        'description' => [
            'type' => 'text',
            'null' => true,
            'length' => null,
            'default' => null,
        ],
    ],
    'detail_view_fields' => [
        ['name', 'description'],
        ['type', 'status'],
    ],
    'edit_view_fields' => [
        ['name', 'description'],
        ['type', 'status'],
    ],
    'list_view_fields' => ['name', 'description', 'type', 'status'],
];