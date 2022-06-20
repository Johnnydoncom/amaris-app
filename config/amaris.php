<?php
return [
    'orderstatus' => [
        'pending' => 'Pending',
        'processing' => 'Order in Progress',
        'completed' => 'Completed',
        'canceled' => 'Canceled',
    ],

    'verification_types' => [
        'nin'=>'National Identity Number',
        'passport'=>'International Passport',
        'drivers_license'=>"Drivers' License",
        'voters_card'=>"Voter's Card"
    ],

    'delivery_types' => [
        'email'=>[
            'title' => 'Send By Email',
            'description' => 'Instant Delivery'
        ],
        'sms'=> [
            'title' => 'Send By SMS',
            'description' => 'Instant Delivery'
        ],
        'delivery'=> [
            'title' => 'Home Delivery',
            'description' => 'Delivery takes 2-3 business days'
        ]
    ],

    'message_categories' => [
        'Graduation',
        'We Miss You',
        'House Warming',
        'Baby Shower',
        'Christmas',
        'Birthday',
        'Congrats',
        'Eid',
        'Father\'s Day',
        'Love',
        'Thank You',
        'Valentine',
        'Custom'
    ],
];
