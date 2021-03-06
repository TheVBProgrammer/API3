<?php
/**
 * Pluggable themes for Yii2
 *
 * @link      https://github.com/hiqdev/yii2-thememanager
 * @package   yii2-thememanager
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015-2017, HiQDev (http://hiqdev.com/)
 */

namespace hiqdev\thememanager\menus;

use yii\bootstrap\Nav;

/**
 * Navbar Menu.
 * @author Andrii Vasyliev <sol@hiqdev.com>
 */
class NavbarMenu extends \hiqdev\yii2\menus\Menu
{
    public function items()
    {
        return [
            'nav' => [
                'label' => AbstractMainMenu::widget([], [
                    'class' => Nav::class,
                    'options' => ['class' => 'nav navbar-nav navbar-right'],
                ]),
            ],
        ];
    }
}
