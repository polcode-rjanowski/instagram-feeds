<?php
/**
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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('main');
    echo $this->Html->css('lightview');
    echo $this->Html->css('jquery-ui.min');
    echo $this->Html->script('jquery-1.11.3.min');
    echo $this->Html->script('jquery-ui.min');
    echo $this->Html->script('lightview');
    echo $this->Html->script('bootstrap.min');
    if ($this->params['controller'] == 'admin') {
        echo $this->Html->script('admin');
    } else {
        echo $this->Html->script('main');
    }
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>
<div id="container">
    <div id="header">
        <h1 class="pull-right" style="padding-right: 25px">BRANDNATION
            <?php if ($loggedIn && $this->params['controller'] == 'admin') { ?>
                <button style="margin: 8px;" class="btn btn-primary pull-right"
                        onclick="window.location.href='<?php echo $loginUrl; ?>'">
                    Join
                </button>
                <button style="margin: 8px;" class="btn btn-primary pull-right"
                        onclick="window.location.href='/admin/logout'">
                    Logout
                </button>
            <?php } ?>
        </h1>
    </div>
    <div id="content">


        <?php echo $this->Flash->render(); ?>

        <?php echo $this->fetch('content'); ?>
        <div id="footer">
        </div>
    </div>
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
