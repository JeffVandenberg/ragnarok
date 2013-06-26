<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/* @var View $this */
/* @var string $title_for_layout */

$cakeDescription = __d('ragnarok', 'Ragnarok NYC');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->script('jquery-1.9.1');
    echo $this->Html->script('jquery-ui-1.10.2.custom.min');
    echo $this->Html->css('humanity/jquery-ui-1.10.2.custom.min');
    echo $this->Html->script('gaming-sandbox');
    echo $this->Html->css('ragnarok-v2');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <script type="text/javascript">
        var baseUrl = '<?php echo $this->Html->url('/'); ?>';
    </script>
    <script src="http://gamingsandbox.api.oneall.com/socialize/library.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
    <div id="header-bar">
        <div id="header-inner">
            <div id="header-logo">
                <a href="<?php echo $this->Html->url('/'); ?>" id="header-logo-nav">
                    Logo
                </a>
            </div>
            <div id="header-games">
                <select id="game-selector">
                    <option value="www">Home</option>
                    <option value="ragnarok" selected>Ragnarok NYC</option>
                    <option value="wantonwicked">Wanton Wicked</option>
                </select>
            </div>
            <div id="header-user">
                <?php if (isset($_SESSION['session_id']) && ($_SESSION['session_id'] != null)): ?>
                    <?php echo $this->Session->read('username'); ?>
                    <a href="<?php echo $this->Html->url('/'); ?>forum/ucp.php?mode=logout&sid=<?php echo $this->Session->read('session_id'); ?>">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="main-logo">
    </div>
    <?php echo $this->MainMenu->Create($menu); ?>
    <div id="content">
        <?php if (in_array('context-navigation', $this->blocks())): ?>
            <div id="context-navigation-wrapper">
                <div id="context-navigation">
                    <?php echo $this->fetch('context-navigation'); ?>
                </div>
                <div class="right-logo"></div>
            </div>
        <?php endif; ?>
        <?php echo $this->Session->flash(); ?>
        <div id="content-body">
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
</div>
<?php /*echo $this->element('sql_dump');*/ ?>
<?php echo $this->fetch('javascript'); ?>
<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
