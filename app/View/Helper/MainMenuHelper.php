<?php

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
                    $link = (isset($menuItem['link']))
                        ? $this->Html->url($menuItem['link'])
                        : "#";
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
        $subMenu = "<ul>";

        foreach ($menu as $name => $menuItem) {
            $subMenu .= '<li>' . $this->Html->link($name, $menuItem) . '</li>';
        }

        $subMenu .= "</ul>";
        return $subMenu;
    }

    public function foundationMenu($menu)
    {
        /*
        <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
            <li class="active">
                <a href="/forum">Forum</a>
            </li>
            <li>
                <a href="/">News</a>
            </li>
        </ul>

        */
        $renderedMenu = <<<EOQ
<ul class="menu" data-responsive-menu="drilldown medium-dropdown">
EOQ;

        foreach ($menu as $menuName => $menuItem) {
            if (count($menuItem) > 0) {
                $link = (isset($menuItem['link']))
                    ? $this->Html->url($menuItem['link'])
                    : "#";
                $link .= $menuItem['append'] ?: "";

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

        $renderedMenu .= "</ul></div></div>";
        return $renderedMenu;
    }
}