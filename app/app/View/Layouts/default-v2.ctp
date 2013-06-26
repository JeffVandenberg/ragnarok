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

$siteDescription  = __d('ragnarok_nyc', 'Ragnarok NYC');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $siteDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->script('jquery-1.9.1');
    echo $this->Html->script('jquery-ui-1.10.2.custom.min');
    echo $this->Html->css('humanity/jquery-ui-1.10.2.custom.min');
    echo $this->Html->script('gaming-sandbox');
    echo $this->Html->css('ragnorok');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <script src="http://gamingsandbox.api.oneall.com/socialize/library.js" type="text/javascript"></script>
</head>
<body>
<div id="header-bar">
    <div id="header-inner">
        <div id="header-logo">
            <a href="<?php echo $this->Html->url('/'); ?>" id="header-logo-nav">
                Logo
            </a>
        </div>
        <div id="header-games">
            <select id="game-selector">
                <option>Choose Your Game</option>
                <option value="www">Home</option>
                <option value="ragnarok">Ragnarok NYC</option>
                <option value="wantonwicked">Wanton Wicked</option>
            </select>
        </div>
        <div id="header-user">
            <?php //echo $this->Login->GetUserBox(); ?>
        </div>
    </div>
</div>
<div id="content">
    <div id="main-logo">
        <div id="main-logo-name">
        </div>
        <div id="main-logo-phrase">
        </div>
    </div>
    <?php echo $this->fetch('right-nav'); ?>
    <div id="content-area" class="<?php echo (in_array('right-nav', $this->Blocks->keys())) ? '' : 'wide-content';?>">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
</div>
<div id="footer-bar">
    <div id="footer-inner">
        Images by jarden
        Produced by Jeff Vandenberg
        Copyright <?php echo date('Y'); ?>
    </div>
</div>
<?php // echo $this->element('sql_dump'); ?>
<script type="text/javascript">
    $(function() {
        $(".button").button();
    });
</script>
<?php echo $this->fetch('javascript'); ?>
<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
