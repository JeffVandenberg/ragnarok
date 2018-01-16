<?php

/**
 * Created by PhpStorm.
 * User: jvandenberg
 * Date: 12/27/13
 * Time: 1:51 PM
 * @property HtmlHelper Html
 */
namespace App\View\Helper;

use Cake\View\Helper\HtmlHelper;


/**
 * @property HtmlHelper Html
 */
class MainMenuHelper extends AppHelper
{
    public $helpers = array(
        'Html'
    );

    public function Create($menu)
    {
        $renderedMenu = <<<EOQ
<div id="vbar">
    <div id="vnav">
        <ul>
EOQ;

        if ($menu) {
            foreach ($menu as $menuName => $menuItem) {
                if (count($menuItem) > 0) {
                    $link = '#';
                    if(isset($menuItem['link'])) {
                        if(is_array($menuItem['link'])) {
                            $link = $this->Html->Url->build($menuItem['link']);
                        } else {
                            $link = $menuItem['link'];
                        }
                    }
                    $link .= (isset($menuItem['append'])) ? $menuItem['append'] : "";

                    $target = isset($menuItem['target'])
                        ? "target='$menuItem[target]'"
                        : "";

                    $submenu = isset($menuItem['menu'])
                        ? $this->BuildSubmenu($menuItem['menu'])
                        : '';

                    $renderedMenu .= <<<EOQ
    <li>
        <a href="$link" $target>
            $menuName
        </a>
        $submenu
    </li>
EOQ;
                }
            }
        }

        $renderedMenu .= "</ul></div></div>";
        return $renderedMenu;
    }

    private function BuildSubmenu($menu)
    {
        $menuLevel = <<<EOQ
<ul class="menu">
EOQ;

        foreach($menu as $label => $item) {
            if($item !== 'break') {
                if(is_array($item)) {
                    $link = (isset($item['link'])) ? $item['link'] : '#';
                    if(is_array($link)) {
                        $link = $this->Html->Url->build($link);
                    }
                    $icon = (isset($item['icon'])) ? '<img src="' . $item['icon'] . '" />' : '';
                    $id = (isset($item['id'])) ? $item['id'] : null;
                    $class = (isset($item['class'])) ? $item['class'] : null;
                    $target = isset($item['target']) ? 'target="' . $item['target'] . '"': '';

                    $liTag = "<li ";
                    if($id !== null) {
                        $liTag .= "id=\"$id\" ";
                    }

                    if($class !== null) {
                        $liTag .="class=\"$class\"";
                    }
                    $liTag .= ">";

                    $menuLevel .= $liTag . '<a href="' . $link. '" ' . $target . '>' . $icon . $label . '</a>';

                    if(isset($item['submenu'])) {
                        $menuLevel .= $this->BuildSubmenu($item['menu']);
                    }

                    $menuLevel .= '</li>';
                }
                else {
                    $menuLevel .= '<li><a href="' . $item . '">' . $label . '</a></li>';
                }
            }
            else {
                $menuLevel .= "<li style=\"height: 4px;\"><hr style=\"height:4px;background-color:#003388;border:none;\"/></li>";
            }
        }

        $menuLevel .= "</ul>";

        return $menuLevel;
    }

    public function foundationMenu($menu)
    {
        if (!is_array($menu)) {
            return '';
        }

        $renderedMenu = <<<EOQ
<ul class="vertical medium-horizontal menu" data-responsive-menu="drilldown medium-dropdown">
EOQ;

        $renderedMenu .= $this->AppendLevel($menu, true);
        $renderedMenu .= <<<EOQ
</ul>
EOQ;
        return $renderedMenu;
    }

    private function AppendLevel($menu, $firstLayer)
    {
        $menuLevel = '';

        if (!$firstLayer) {
            $menuLevel .= '<ul class="vertical menu">';
        }

        foreach ($menu as $label => $item) {
            if ($item !== 'break') {
                if (is_array($item)) {
                    if (isset($item['visible']) && $item['visible'] === false) {
                        continue;
                    }
                    $link = "#";
                    if (isset($item['link'])) {
                        if (is_array($item['link'])) {
                            $link = $this->Html->Url->build($item['link']);
                        } else {
                            $link = $item['link'];
                        }
                    }
                    $icon = (isset($item['icon'])) ? '<img src="' . $item['icon'] . '" />' : '';

                    $liTag = "<li";
                    if (isset($item['id'])) {
                        $liTag .= ' id="' . $item['id'] . '" ';
                    }

                    if (isset($item['class'])) {
                        $liTag .= ' class="' . $item['class'] . '" ';
                    }
                    $liTag .= ">";

                    $menuLevel .= $liTag;

                    $text = '<span>' . $icon . $label . '</span>';

                    $link = '<a href="' . $link . '" ';

                    if (isset($item['target'])) {
                        $link .= ' target="' . $item['target'] . '" ';
                    }
                    $link .= '>';
                    $link .= $text . '</a>';

                    $menuLevel .= $link;

                    if (isset($item['submenu'])) {
                        $menuLevel .= $this->AppendLevel($item['submenu'], false);
                    }
                    $menuLevel .= '</li>';
                } else {
                    $menuLevel .= '<li><a href="' . $item . '">' . $label . '</a></li>';
                }
            } else {
                $menuLevel .= "<li style=\"height: 4px;\"><hr style=\"height:4px;background-color:#003388;border:none;\"/></li>";
            }
        }

        if (!$firstLayer) {
            $menuLevel .= '</ul>';
        }

        return $menuLevel;
    }
}
