<?php

return [
    'roles' => [
        'company' => 'company',
        'merchant' => 'merchant'
    ],
    'permissions'=>[
        ['label'=>'List Company', 'name'=>'company.index'],
        ['label'=>'Create Company', 'name'=>'company.create'],
        ['label'=>'Edit Company', 'name'=>'company.edit'],
        // Copany Permissions
        ['label'=>'List Merchant', 'name'=>'merchant.index'],
        ['label'=>'Create Merchant', 'name'=>'merchant.create'],
        ['label'=>'Edit Merchant', 'name'=>'merchant.edit'],
        ['label'=>'Delete Merchant', 'name'=>'merchant.delete'],
        // Order Permissions
        ['label'=>'List Order', 'name'=>'order.index'],
        ['label'=>'Create Order', 'name'=>'order.create'],
        ['label'=>'Edit Order', 'name'=>'order.edit'],
        ['label'=>'Delete Order', 'name'=>'order.delete']
    ],
    'order_status'=>[
        'created'=>'created',
        'picked'=>'picked',
        'on_delivery'=>'on_delivery', 
        'delivered'=>'delivered', 
        'returned'=>'returned'
    ],
    'contact_type'=>[
        'delivery'=>'delivery',
        'pickup'=>'pickup'
    ],
    'payment_type'=>[
        'cash'=>'cash',
        'bank'=>'bank',
        'cheque'=>'cheque',
        'bkash'=>'bkash',
        'rocket'=>'rocket'
    ]
];