<?php
namespace app\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
 
class MenuComponent extends Component
{
    /**
     * Checks if a menu has submenus
     */
    public static function hasSubmenu($menu)
    {
        return isset($menu['items']) && is_array($menu['items']) && !empty($menu['items']);
    }

    /**
     * Checks if a menu or one of its items is active
     */
    public static function isActive($menu, $requestUrl)
    {
        $emptyUrl = Yii::$app->urlManager->createUrl('');

        if ($requestUrl != $emptyUrl && $requestUrl == Yii::$app->urlManager->createUrl($menu['url'])) {
            return true;
        } else if (self::hasSubmenu($menu)) {
            foreach ($menu['items'] as $submenu) {
                if (self::isActive($submenu, $requestUrl)) {
                    return true;
                }
            }
        }
        
        return false;
    }

    /**
     * Generates the menu tags
     * @return array The array of li tags
     */
    public static function getMenu($menuList, $params)
    {
        $response = [];

        if (!empty($menuList)) {
            foreach ($menuList as $menu) {
                $hasSubmenu = self::hasSubmenu($menu);

                //Anchor content
                $aContent = Html::tag('i', '', [
                    'class' => ($menu['options'] && isset($menu['options']['faIcon'])) ? $menu['options']['faIcon'] : 'far fa-circle',
                ]) . Html::tag('span', $menu['label']);

                $treeviewMenu = '';

                if ($hasSubmenu) {
                    $aContent .= Html::tag('span',
                        Html::tag('i', '', ['class' => 'fa fa-angle-left pull-right']),
                        ['class' => 'pull-right-container']
                    );

                    $submenuItems = self::getMenu($menu['items'], $params);

                    $treeviewMenu = Html::ul($submenuItems, [
                        'class' => 'treeview-menu',
                        'encode' => false
                    ]);
                }

                $activeClass = self::isActive($menu, $params['requestUrl']) ? 'active' : '';
                $treeviewClass = $hasSubmenu ? 'treeview' : '';

                $response[] = Html::tag('li', Html::a($aContent, $menu['url']) . $treeviewMenu, [
                    'class' => implode(' ', [$activeClass, $treeviewClass]),
                ]);
            }
        }

        return $response;
    }
 
}