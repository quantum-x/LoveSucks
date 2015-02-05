<?php
/**
 *
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
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'ReBadge');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __($cakeDescription) ?>:
		<?php echo __($this->fetch('custom_title', __($title_for_layout))) ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('AdminLTE');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="/bower_components/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="/bower_components/morrisjs/morris.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="/bower_components/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="/bower_components/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<?php //Blue skin for users, black skin for admins ?>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="/" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        ReBadge
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
            <?php if (count($languages['available']) > 1) { ?>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-language"></i>
                        <span><i><?php echo $languages['available'][$languages['current']] ?></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li class="user-footer">

                                <?php $locales = array_flip($locales); ?>
                                <?php foreach($languages['available'] as $code => $lang) { ?>
                                    <?php echo $this->Form->create(null, array('url' => array('controller' => 'users', 'action' => 'edit', AuthComponent::user()['id']) )); ?>
                                    <?php echo $this->Form->input('User.id', ['type' => 'hidden', 'value' => AuthComponent::user()['id']]); ?>
                                    <?php echo $this->Form->input('User.language_id', ['type' => 'hidden', 'value' => $locales[$code]]); ?>
                                    <?php echo $this->Form->input('CRUD.redirect_url', ['type' => 'hidden', 'value' => $this->request->here()]); ?>
                                    <?php echo $this->Form->end([ 'label' => $lang , 'class' => 'btn btn-default']); ?>
                                <?php } ?>

                        </li>
                    </ul>
                </li>
            <?php } ?>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bar-chart-o"></i>
                        <?php if ($this->Session->read('Notifications.total') !== 0) { ?>
                            <span class="label label-success"><?php echo $this->Session->read('Notifications.total')?></span>
                        <?php } ?>
                    </a>
                    <?php if ($this->Session->read('Notifications.total') !== 0) { ?>
                    <ul class="dropdown-menu">
                        <li class="header"><?php echo __('You have %s notifications',$this->Session->read('Notifications.total'))?></li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php
                                    //Fetch our notifications
                                    foreach($this->Session->read('Notifications') as $notification => $count) {
                                        switch($notification) {
                                            case 'scans':
                                            ?>
                                                <li>
                                                    <a href="<?php echo $this->Html->url(['controller' => 'scans', 'action' => 'index'])?>">
                                                       <i class="fa fa-tags info"></i> <?php echo __('%s new scans today',$count)?>
                                                    </a>
                                                </li>
                                            <?php
                                                break;
                                            case 'keys':
                                            ?>
                                                <li>
                                                    <a href="<?php echo $this->Html->url(['controller' => 'keys', 'action' => 'index'])?>">
                                                       <i class="fa fa-key success"></i> <?php echo __('%s new keys today',$count)?>
                                                    </a>
                                                </li>
                                            <?php
                                                break;
                                            case 'overdue':
                                            ?>
                                                <li>
                                                    <a href="<?php echo $this->Html->url(['controller' => 'invoices', 'action' => 'index'])?>">
                                                       <i class="fa fa-file-text-o warning"></i> <?php echo __('%s overdue invoices',$count)?>
                                                    </a>
                                                </li>
                                            <?php
                                                break;
                                        }
                                    }
                                ?>
                            </ul>
                        </li>
                        <!--<li class="footer"><a href="#">View all</a></li>//-->
                    </ul>
                    <?php } ?>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span><i class="fa fa-life-ring"> </i> <?php echo __('Help')?></span>
                    </a>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>

                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/avatar3.png" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p><?php echo __('Hi')?></p>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li <?php echo (($this->params['controller']=='pages')?'class="active"':'') ?>>
                    <a href="<?php echo $this->Html->url( '/', true ) ?>">
                        <i class="fa fa-dashboard"></i> <span><?php echo __('Dashboard')?></span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">
        <!-- Content Header (Page header) -->

        <?php echo $this->Session->flash(); ?>

                <section class="content-header">
                    <h1>
                        <?php echo $this->fetch('custom_title', __($title_for_layout)) ?>
                        <?php echo $this->fetch('custom_buttons') ?>
                    </h1>
                    <ol class="breadcrumb">
                        <?php echo $this->fetch('custom_breadcrumb', $this->element('breadcrumb')) ?>
                    </ol>
                    <?php echo $this->fetch('custom_tools') ?>
                    <!-- Other custom shit may go here.. -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <?php echo $this->fetch('content') ?>
                </section><!-- /.main content -->

            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal -->


        <!-- jQuery 2.0.2 -->
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/bower_components/moment/moment.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="/bower_components/raphael/raphael-min.js"></script>
        <script src="/bower_components/morrisjs/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <!-- daterangepicker -->
        <script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="/bower_components/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- query-string -->
        <script src="/bower_components/query-string/min/query-string-min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="/js/AdminLTE/app.js" type="text/javascript"></script>
        <script type="text/javascript">
        <?php
            echo $this->fetch('js_bottom');
        ?>
        </script>
        <?php echo $this->element('date_picker') ?>

    </body>
</html>