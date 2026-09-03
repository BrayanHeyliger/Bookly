<?php

return [
    'name' => 'Bookly',
    'currency' => 'USD',
    'currency_symbol' => '$',
    'booking' => [
        'slot_interval_minutes' => 15,
        'min_lead_time_minutes' => 60,
        'reminder_hours' => [24, 1],
    ],
    'roles' => [
        'superadmin' => 'Super Admin',
        'owner'      => 'Owner',
        'manager'    => 'Manager',
        'staff'      => 'Staff',
        'client'     => 'Client',
    ],
];
