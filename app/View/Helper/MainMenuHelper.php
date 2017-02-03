<?php

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
                            $link = $this->Html->url($menuItem['link']);
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
                        $link = $this->Html->url($link);
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
