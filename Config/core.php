<?php

Configure::write('debug', '2');
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
Configure::write('Security.salt', '&(mLC7j~vB_[VG{86C.P`kG@)JB8HmB5+6&M@K8uDG+H5n>zCt}~@bhbc<.^~eYK');
Configure::write('Security.wifi_salt', '*Tu=9825eaw!{k~>yJ5b5vW2HYuR<NQ6vDq^dL,sjD{8e-/n;BSY^W(Z,)k;=wC:.#d+Y}Zt{@t');
Configure::write('Security.cipherSeed', '386249583887726253973260121905');


Cache::config('default', array(
                              'engine' => 'Memcached', //[required]
                              'probability'=> 100, //[optional]
                              'servers' => array(
                                  'memcachedMaster:11211' // localhost, default port 11211
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
$prefix = 'rebadgeweb_';

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
Configure::write('Config.default_language', 'en_US');

//Setup the possible languges
Configure::write('Config.languages',
                 array(
                      'en' => 'English',
                      'fr' => 'Français'));
