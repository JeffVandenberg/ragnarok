<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/* @var View $this */
/* @var string $title_for_layout */

$siteDescription = __d('gaming_sandbox', 'Gaming Sandbox');
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php echo $siteDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('foundation');
//    echo $this->Html->css('app');
    //    echo $this->Html->css('gaming-sandbox');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    ?>
</head>
<body>
<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle></button>
    <div class="title-bar-title">
        <span style="color: #f26522; ">Dominium</span><span style="color: #00a99d; ">Fuego</span>
    </div>
</div>
<div class="top-bar" id="main-menu">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">
                Dominium Fuego
            </li>
        </ul>
    </div>
    <div class="top-bar-right">
        <?php echo $this->MainMenu->foundationMenu($menu); ?>
    </div>
</div>
<?php if (isset($breadcrumbs)): ?>
    <div class="top-bar" id="breadcrumbs">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    <?php foreach ($breadcrumbs as $breadcrumb => $params): ?>
                        <li>
                            <?php if ($params['current']): ?>
                                <span class="show-for-sr">Current: </span>
                            <?php endif; ?>
                            <?php echo $this->Html->link(
                                $breadcrumb,
                                $params['url']
                            );
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
    </div>
<?php endif; ?>
<div class="row" id="breadcrumbs">
    <div class="small-12 columns">
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
</div>
<footer class="footer">
    <div class="row">
        <div class="small-12 columns">
            <p class="copywrite">GamingSandbox © <?php echo date('Y'); ?></p>
        </div>
    </div>
</footer>
<?php
// echo $this->element('sql_dump');
echo $this->Html->script('jquery-1.9.1');
echo $this->Html->script('jquery-ui-1.10.2.custom');
echo $this->Html->script('foundation');
echo $this->Html->script('gaming-sandbox');
echo $this->fetch('script');
?>
<?php
echo $this->fetch('javascript');
?>
</body>
</html>
