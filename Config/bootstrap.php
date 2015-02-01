<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));
CakePlugin::load('Crud');
CakePlugin::load('Linkable');
Configure::write('Dispatcher.filters', array(
                                            'AssetDispatcher',
                                            'CacheDispatcher'
                                       ));
App::uses('CakeLog', 'Log');
App::uses('CakeEmail', 'Network/Email');
if (Configure::read('debug') > 0) {
    CakeLog::config('debug', array(
                                  'engine' => 'File',
                                  'types' => array('notice', 'info', 'debug'),
                                  'file' => 'debug',
                             ));
}
CakeLog::config('error', array(
                              'engine' => 'File',
                              'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
                              'file' => 'error',
                         ));