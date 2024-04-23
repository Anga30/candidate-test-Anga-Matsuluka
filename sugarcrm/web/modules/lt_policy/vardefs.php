<?php 

//This file was generated for you with lots of love from teamgeek

$moduleVardefs['lt_policy'] = [

    'label' => 'Policy',
    'detail_view_class' => 'PolicyDetailView',
    'edit_view_class' => 'PolicyEditView',
    'related_modules' => [],
    /* Add all the fields for your module/table below */
    'fields' => [
        /*Any definitions added to the `id` field will be ignored, leave it as an empty array*/
        'id' => [],
        'customer_id' => [
            'type' => 'integer',
            'null' => true,
            'length' => null,
            'default' => ''
        ],
        'active' => [
            'type' => 'boolean',
            'null' => false,
            'length' => null,
            'default' => true
        ]
    ],
    'detail_view_fields' => [
        ['name', 'description'],
        ['active'],
    ],
    'edit_view_fields' => [
        ['name', 'description'],
        ['active'],
    ],
    'list_view_fields' => ['name', 'description']
];