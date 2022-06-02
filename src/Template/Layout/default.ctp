<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Pacifica Continental';
?>

<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('site.css') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->script('jquery-3.6.0.min.js') ?>
    <?= $this->Html->script('popper.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('site.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <?=$this->Html->link('Navbar', '/', ['class' => 'navbar-brand'])?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php 
                    if($this->request->session()->read('Auth.User.IdUsuarios') == null){
                      ?>
                    <li class="nav-item">
                        <?=$this->Html->link('Iniciar sesion', '/login', ['class' => 'nav-link'])?>
                    </li>
                      <?php
                    }else{
                        ?>
                    <li class="nav-item">
                        <?=$this->Html->link('Cerrar sesion '.$this->request->session()->read('Auth.User.Nombres'), ['controller' => 'Home', 'action' => 'logout'], ['class' => 'nav-link'])?>
                    </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>

        <input type="hidden" id="UrlBase" name="UrlBase" value="<?=WWW_ROOT?>">
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>

    <script type="text/javascript">
        var csrfToken = <?= json_encode($this->request->getParam('_csrfToken')) ?>;
    </script>
</body>
</html>
