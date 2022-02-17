<?php

return [
  'default_user' => [
      'name' => env('DEFAULT_USER_NAME','Ferran Munoz Zafra'),
      'email' => env('DEFAULT_USER_EMAIL','fmunoz@iesebre.com'),
      'password' => env('DEFAULT_USER_PASSWORD','12345678'),
  ],
    'admins' => [
        'fmunoz@iesebre.com'
    ]
];
