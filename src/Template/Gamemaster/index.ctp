<?php

use App\View\AppView;

/* @var AppView $this */

$this->set('title_for_layout', "Game Master Tools");
?>

<h3>Tools</h3>
<ul>
    <li>
        <?php echo $this->Html->link('Update/View Character', array(
            'controller' => 'characters',
            'action' => 'gmView'
        )); ?>
        <br/>
        <br/>
    </li>
    <li>
        <?php echo $this->Html->link('Chat Login', '/chat/?gm_login'); ?>
        <br/>
        <br/>
    </li>
</ul>
