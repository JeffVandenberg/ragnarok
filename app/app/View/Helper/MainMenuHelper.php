<?php
class MainMenuHelper extends AppHelper {
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

        foreach($menu as $menuName => $menuItem)
        {
            if(count($menuItem) > 0)
            {
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

        $extra = <<<'EOQ'
<li>
    <a href="#">Database</a>
    <ul>
        <li><?php echo $this->Html->link('Skills', array('controller' => 'skills', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link('Stunts', array('controller' => 'stunts', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link('Templates', array('controller' => 'templates', 'action' => 'index')); ?></li>
    </ul>
</li>
<li>
    <a href="<?php echo $this->Html->url('/'); ?>forum">Forum</a>
</li>
EOQ;


        $renderedMenu .= "</ul></div></div>";
        return $renderedMenu;
    }

    private function BuildSubmenu($menu)
    {
        $subMenu = "<ul>";

        foreach($menu as $name => $menuItem)
        {
            $subMenu .= '<li>' . $this->Html->link($name, $menuItem) . '</li>';
        }

        $subMenu .= "</ul>";
        return $subMenu;
    }
}