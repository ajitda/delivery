<?php

return [
    'roles' => [
        'company' => 'company'
    ],
    'permissions'=>[
        ['label'=>'List Company', 'name'=>'company.index'],
        ['label'=>'Create Company', 'name'=>'company.create'],
        ['label'=>'Edit Company', 'name'=>'company.edit'],
        // Copany Roles
        ['label'=>'List Merchant', 'name'=>'merchant.index'],
        ['label'=>'Create Merchant', 'name'=>'merchant.create'],
        ['label'=>'Edit Merchant', 'name'=>'merchant.edit'],
        ['label'=>'Delete Merchant', 'name'=>'merchant.delete']
    ]
];