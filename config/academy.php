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
            'accountsPerIp' => 2,
            'captchaActivated' => false,
        ]
    ],

    'panel' => [
        /**
         * Coloque o nome de pessoas confiáveis e que fazem parte da equipe do seu site,
         * as funções em que são habilitadas para esses usuários podem ser críticas em mãos erradas.
         **/ 
        'superAdmins' => [
            'Admin'
        ]
    ]
];