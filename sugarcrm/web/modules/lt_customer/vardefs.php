<?php 

$moduleVardefs['lt_customer'] = [
    'label' => 'Customer',
    'detail_view_class' => 'CustomerDetailView',
    'edit_view_class' => 'CustomerEditView',
    'related_modules' => [
        'lt_case' => [
            'relationship_type' => 'many-to-many',
            'module' => 'LtCase',
            'bean_name' => 'LtCase',
            'source' => 'non-db',
            'vname' => 'LBL_CUSTOMERS_CASES',
        ],
        'lt_policy' => [
            'relationship_type' => 'one-to-many',
            'relation_key_lhs' => 'id',
            'relation_key_rhs' => 'customer_id',
            'module' => 'LtPolicy',
            'bean_name' => 'LtPolicy',
            'source' => 'non-db',
            'vname' => 'LBL_POLICIES',
        ],
    ],
    /* Add all the fields for your module/table below */
    'fields' => [
        'id' => [],
        'first_name' => [
            'type' => 'string',
            'null' => false,
            'length' => 55,
            'default' => '',
        ],
        'last_name' => [
            'type' => 'string',
            'null' => false,
            'length' => 55,
            'default' => '',
        ],
        'id_number' => [
            'type' => 'string',
            'null' => false,
            'length' => 15,
            'default' => '',
        ],
        'phone' => [
            'type' => 'string',
            'null' => true,
            'length' => 15,
            'default' => null,
        ],
        'id_number_status' => [
            'type' => 'string',
            'null' => true,
            'length' => 9,
            'default' => null,
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
        ['first_name', 'last_name'],
        ['id_number', 'phone'],
        ['id_number_status'],
    ],
    'edit_view_fields' => [
        ['first_name', 'last_name'],
        ['id_number', 'phone'],
        ['id_number_status'],
    ],
    'list_view_fields' => ['first_name', 'last_name', 'id_number'],
];