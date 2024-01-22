<?php

use gm\humhub\modules\converter\Module;
use gm\humhub\modules\converter\Events;
use humhub\widgets\TopMenu;

return [
    'id' => 'converter',
    'class' => Module::class,
    'namespace' => 'gm\humhub\modules\converter',
    'events' => [
        ['class' => TopMenu::class, 'event' => TopMenu::EVENT_INIT, 'callback' => [Events::class, 'onTopMenuInit']],
    ],
];