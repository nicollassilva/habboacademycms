<?php

/**
 * Para colocar as alterações do arquivo em evidência, acesse a pasta principal e execute o comando:
 * 
 * > php artisan academy:config
 */

return [
    'defaultProfileImagePath' => 'profiles/default.png',

    'site' => [
        'maintenance' => false,
        'defaultImagerUrl' => 'https://www.habbo.com.br/habbo-imaging/avatarimage?&user=',

        'register' => [
            'activated' => true,
            'accountsPerIp' => 4,
            'captchaActivated' => false,
        ]
    ]
];