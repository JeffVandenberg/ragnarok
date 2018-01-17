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

use App\View\AppView;
use Cake\Core\Configure;

/* @var AppView $this */
/* @var string $title_for_layout */
/* @var array $currentUser */
/* @var string $buildNumber */

$cakeDescription = __d('ragnarok', 'Dominium Fuego');
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <?php echo $this->Html->meta('description', 'Dominum Fuego - A Dresden Files Online Game'); ?>
    <?php echo $this->Html->meta('keywords', 'Dresden Files, Game, Online, Chat, RPG'); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    if (Configure::read('debug')) {
        echo $this->Html->css([
            'df/jquery-ui.min',
            'ragnarok-v2'
        ]);
        echo $this->Html->script([
            'jquery.min',
            'jquery-ui.min',
            'tinymce/tinymce.min',
            'tinymce/jquery.tinymce.min',
            'ragnarok',
            'gaming-sandbox'
        ]);
    } else {
        $this->Shrink->css([
            'df/jquery-ui.min',
            'ragnarok-v2'
        ]);
        echo $this->Shrink->fetch('css');

        $this->Shrink->js([
            'jquery.min',
            'jquery-ui.min',
            'tinymce/tinymce.min',
            'tinymce/jquery.tinymce.min',
            'ragnarok',
            'gaming-sandbox'
        ]);
        echo $this->Shrink->fetch('js');
    }
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <script type="text/javascript">
        var baseUrl = '<?php echo $this->Url->build('/'); ?>';
    </script>
</head>
<body>
<div id="container">
    <div id="header-bar">
        <div id="header-inner">
            <div id="header-logo">
                <a href="<?php echo $this->Html->Url->build('/'); ?>" id="header-logo-nav">
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
                <?php if (isset($currentUser) && $currentUser['user_id'] != 1): ?>
                    <?php echo $currentUser['username']; ?>
                    <a href="<?php echo $this->Html->Url->build('/'); ?>forum/ucp.php?mode=logout&sid=<?php echo $currentUser['session_id']; ?>">Logout</a>
                <?php else: ?>
                    Guest
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
        <?php echo $this->Flash->render(); ?>
        <div id="content-body">
            <?php echo $this->fetch('content'); ?>
        </div>
    </div>
    <div id="footer-bar">
        <div id="footer-inner">
            Images by jarden
            Produced by Jeff Vandenberg
            Copyright <?php echo date('Y'); ?>
            Build # <?php echo $buildNumber; ?>
        </div>
    </div>
</div>
<?php echo $this->fetch('javascript'); ?>
</body>
</html>
