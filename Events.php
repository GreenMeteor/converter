<?php

namespace gm\humhub\modules\converter;

use Yii;
use yii\base\Event;
use yii\helpers\Url;
use humhub\widgets\TopMenu;
use humhub\modules\ui\menu\MenuLink;
use humhub\modules\user\models\Group;

/**
 * Class Events
 *
 * Handles events for the SQL Converter module.
 */
class Events
{
    /**
     * Event handler for the "TopMenuInit" event.
     *
     * @param Event $event
     */
    public static function onTopMenuInit($event)
    {
        /** @var TopMenu $menu */
        $menu = $event->sender;

        // If currently logged-in user is in admin group
        $isAdmin = Group::getAdminGroup()->isMember(Yii::$app->user->identity);

        // Only show the menu for users in admin group
        if ($isAdmin) {
            $menu->addEntry(new MenuLink([
                'label' => Yii::t('FaqModule.base', '<strong>SQL</strong> Converter'),
                'icon' => 'fa-database',
                'url' => Url::to(['/converter/sql-converter/index']),
                'sortOrder' => 92000,
            ]));
        }
    }
}
