<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CrudControllerTrait', 'Crud.Lib');
App::uses('CakeTime', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    use CrudControllerTrait;

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                'index', 'add', 'edit', 'view', 'delete'
            )
        ),
        'Session',
        'Security' => ['csrfExpires' => '+1 hour']
    );

    public function beforeFilter() {
        $this->Security->requirePost('delete');
        $this->Security->requirePost('add');
        $this->Security->requirePost('edit');
        $this->Security->requirePost('purchase');

        //Set the language
        //checking the browsers language when there's no language session
        //Set the language variables
        $this->_setupLanguage();

    }

    protected function _setupLanguage() {
        //Check to see if we've got a cached version of languages.
        //If no, throw one in.
        if (!$this->Session->check('Config.available_languages') || !$this->Session->check('Config.available_locales')) {
            $this->loadModel('Language');
            $all_locales = $this->Language->find('list',['recursive' => -1, 'fields' => ['id','locale', 'language']]);

            foreach ((array_values($all_locales)) as $id => $locale) $locales[key($locale)] = reset($locale);
            foreach ((array_values($all_locales)) as $id => $locale) $all_languages[reset($locale)] = array_keys($all_locales)[$id];

            $this->Session->write('Config.available_languages',$all_languages);
            $this->Session->write('Config.available_locales',$locales);

        }

        //Set the language for this session / these pages etc
        $this->_setLanguage();

        //Setup the vairables for the view template(s)
        $languages['available'] = $this->Session->read('Config.available_languages');
        $languages['current'] = $this->_getCurrentLang();
        $this->set('languages', $languages);
        $this->set('locales', $this->Session->read('Config.available_locales'));

    }

    /**
     * Read the browser language and sets the website language to it if available.
     * If there's a language set in the URL, we'll use that by preference
     * If the language provided / detected doesn't exist.. default language, yo.
     *
     */
    protected function _setLanguage($_language = false){
        //Check to see if we have a language provided in the URL.
        $targetLang = false;
        if (isset($this->request['language']) && $this->_checkLanguageAvailable($this->request['language'])) {
            $targetLang = $this->request['language'];
        } else {
            //We're going to go via detection or sessions, or default..
            if(!$this->Session->check('Config.language')){
                //checking the 1st favorite language of the user's browser
                $browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
                if ($this->_checkLanguageAvailable) {
                    $targetLang = $browserLanguage;
                } else {
                    $targetLang = Configure::read('Config.default_language');
                }

                //User's profile setting overrules most things
                if (isset($this->Auth->user()['Language']['locale'])) {
                    $targetLang = $this->Auth->user()['Language']['locale'];
                }
            } else {
                $targetLang = $this->Session->read('Config.language');
            }

        }

        //A specific language will trump everything
        if ($_language !== false) {
            $targetLang = $_language;
        }

        if(!$this->Session->check('Config.language') ||
           $targetLang != $this->Session->read('Config.language')) {
            $this->Session->write('Config.language', $targetLang);
            //Send out the headers for the language we're currently using
            //Sends out a header w/ the current language in it
            setcookie("LANG", $this->_getCurrentLang(), time()+86400, '/');
        }
    }

    /**
     * Returns the currently set language
     * @return void
     */
    protected function _getCurrentLang() {
        return (!$this->Session->check('Config.language'))?Configure::read('Config.default_language'):$this->Session->read('Config.language');
    }

    /**
     * Checks if a supplied language is available or not.
     * Language array provided from the config.
     * @param $lang
     * @return bool
     */
    protected function _checkLanguageAvailable($lang) {
        if (in_array($lang, $this->Session->read('Config.available_locales'))) {
            return true;
        } else {
            return false;
        }
    }

    public function add() {
        $this->Crud->on('setFlash', function(CakeEvent $event) {
            //Check to see if we've got errors
            if (isset($event->subject->params['class']))    {
                if (strpos($event->subject->params['class'],'error') !== false)    {
                    //The error is set - now we set our custom class.
                    $event->subject->element = 'alert_error';
                } elseif (strpos($event->subject->params['class'],'success') !== false)    {
                    $event->subject->element = 'alert_success';
                }
            }
        });

        return $this->Crud->execute();
    }

    public function edit($id) {
        $this->Crud->on('setFlash', function(CakeEvent $event) {
            //Check to see if we've got errors
            if (isset($event->subject->params['class']))    {
                if (strpos($event->subject->params['class'],'error') !== false)    {
                    //The error is set - now we set our custom class.
                    $event->subject->element = 'alert_error';
                } elseif (strpos($event->subject->params['class'],'success') !== false)    {
                    $event->subject->element = 'alert_success';
                }
            }
        });

        return $this->Crud->execute();
    }
    public function delete($id) {
        $this->Crud->on('setFlash', function(CakeEvent $event) {
            //Check to see if we've got errors
            if (isset($event->subject->params['class']))    {
                if (strpos($event->subject->params['class'],'error') !== false)    {
                    //The error is set - now we set our custom class.
                    $event->subject->element = 'alert_error';
                } elseif (strpos($event->subject->params['class'],'success') !== false)    {
                    $event->subject->element = 'alert_success';
                }
            }
        });

        return $this->Crud->execute();
    }

}