<?php
/**
 * Created by JetBrains PhpStorm.
 * User: JeffVandenberg
 * Date: 4/6/13
 * Time: 8:15 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome to Gaming Sandbox!</title>
    <link rel="stylesheet" href="dresden.css" media="screen" type="text/css" />
</head>
<body>
<div id="header-bar">
    <div id="header-inner">
        <div id="header-logo">
            <a href="http://www.gamingsandbox.com/" id="header-logo-nav">
                Logo
            </a>
        </div>
        <div id="header-games">
            <select>
                <option>Choose Your Game</option>
                <option>Dresden Files</option>
                <option>Wanton Wicked</option>
            </select>
            <!--<input type="button" class="button" value="Create Your Own Game">-->
        </div>
        <div id="header-user">
            <a href="#">Login</a>
        </div>
    </div>
</div>
<div id="main-logo">
    <div id="main-logo-name">
    </div>
    <div id="main-logo-phrase">
    </div>
</div>
<div id="content">
    <div id="right-nav">
        <div class="right-box">
            <div class="title">
                Chat Login
            </div>
            <form method="post" action="chat_demo.php">
                <div class="input">
                    <label>Name:</label>
                    <input type="text" name="name" class="text" />
                </div>
                <div class="input">
                    <input type="submit" value="Login" class="submit button" />
                </div>
            </form>
        </div>
        <div class="right-box">
            <div class="paragraph">
                There can be more text here.
            </div>
            <div class="paragraph">
                I bet it will be awesome!
            </div>
            <div class="paragraph">
                Or not
            </div>
        </div>
    </div>
    <div id="content-area">
        <div class="paragraph">
            Welcome to the home of the Gaming Sandbox. The goal of Gaming Sandbox is to be a central location
            for multiple online chat game services.
        </div>
        <div class="paragraph">
            On the list of initial offerings includes:
            <ul>
                <li>Dresden Files</li>
                <li>New World of Darkness</li>
                <li>Classic world of Darkness</li>
                <li>Legend of the Five Rings</li>
            </ul>
        </div>
        <div class="paragraph">
            Stay tuned for more details.
        </div>
	</div>
</div>
<div id="footer-bar">
    <div id="footer-inner">
        Images by jarden
        Produced by Jeff Vandenberg
        Copyright <?php echo date('Y'); ?>
    </div>
</div>
</body>
</html>