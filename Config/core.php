<?php

Configure::write('debug', '[*CORE_DEBUG_LEVEL*]');
Configure::write('Error', array(
                               'handler' => 'ErrorHandler::handleError',
                               'level' => E_ALL & ~E_DEPRECATED,
                               'trace' => true
                          ));

Configure::write('Exception', array(
                                   'handler' => 'ErrorHandler::handleException',
                                   'renderer' => 'ExceptionRenderer',
                                   'log' => true
                              ));
Configure::write('App.encoding', 'UTF-8');

/**
 * A random string used in security hashing methods.
 */
Configure::write('Security.salt', '[*CORE_SECURITY_SALT*]');
Configure::write('Security.wifi_salt', '[*CORE_SECURITY_WIFI_SALT*]');
Configure::write('Security.cipherSeed', '[*CORE_SECURITY_CIPHERSEED*]');

Configure::write('Wirecard.case','[*WC_BUSINESS_CASE*]');
Configure::write('Wirecard.password','[*WC_PASSWORD*]');
Configure::write('Wirecard.signature','[*WC_BUSINESS_SIGNATURE*]');

Cache::config('default', array(
                              'engine' => 'Memcached', //[required]
                              'probability'=> 100, //[optional]
                              'servers' => array(
                                  '[*CORE_CACHE_STRING*]' // localhost, default port 11211
                              ), //[optional]
                         ));

Configure::write('Session', array(
                                 'defaults' => 'php'
                            ));

// In development mode, caches should expire quickly.
$duration = '+999 days';
if (Configure::read('debug') > 0) {
    $duration = '+10 seconds';
}

// Prefix each application on the same server with a different string, to avoid Memcache and APC conflicts.
$prefix = '[*CORE_APP_PREFIX*]';

Cache::config('_cake_core_', array(
                                  'prefix' => $prefix . 'cake_core_',
                                  'path' => CACHE . 'persistent' . DS,
                                  'serialize' => false,
                                  'duration' => $duration
                             ));
Cache::config('_cake_model_', array(
                                   'prefix' => $prefix . 'cake_model_',
                                   'path' => CACHE . 'models' . DS,
                                   'serialize' => false,
                                   'duration' => $duration
                              ));

//Setup the default language
Configure::write('Config.default_language', '[*CORE_APP_DEFAULT_LANG*]');
Configure::write('Email.bcc_email', '[*EMAIL_FROM_EMAIL*]');