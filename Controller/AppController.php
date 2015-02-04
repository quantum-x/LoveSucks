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


    public $components = array(
        'Session'
    );

    public function beforeFilter() {
        //Set the language
        //checking the browsers language when there's no language session
        //Set the language variables
        $this->_setupLanguage();
        $this->_setupLocale();

        $this->loadModel('Size');
        $this->set('sizes', $this->Size->find('list') );

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
        $currency = $this->_getCurrency();
        $this->set('currency', $currency['Currency']);

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
                $availLang = $this->_checkLanguageAvailable($browserLanguage);
                if ($availLang !== false) {
                    $targetLang = $availLang;
                } else {
                    $targetLang = Configure::read('Config.default_language');
                }
                //User's profile setting overrules most things
                if (isset($this->User)) {
                    $targetLang = $this->User['Language']['locale'];
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
            return $lang;
        } else {
            //Check for partial matches
            foreach ($this->Session->read('Config.available_locales') as $locale) {
                if (strtoupper($lang) == substr(strtoupper($locale), 0, 2)) {
                    return $locale;
                }
            }
            return false;
        }
    }

    protected function _setupLocale() {
        $this->set('months_list', $this->_getMonths($this->_getCurrentLang()));

        $years = range(date('Y'), date('Y')+10);
        $this->set('years_list', array_combine($years,$years));
    }

    protected function _getMonths($locale)
    {
        /**
         *  Return the localized name of the given month
         *
         *  @author Lucas Malor
         *  @param string $locale The locale identifier (for example 'en_US')
         *  @param int $monthnum The month as number
         *  @return string The localized string
         */

        $fmt = new IntlDateFormatter($locale, IntlDateFormatter::LONG,
                                     IntlDateFormatter::NONE);

        $fmt->setPattern('MMMM');
        foreach (range(1,12) as $month) $returnArray[$month] =  $fmt->format(mktime(1, 1, 1, $month, 5, 1970));
        return $returnArray;
    }

    protected function _getCurrency() {
        //Relies on a country code coming from cloud-flare.
        $europe = array('AD', 'AL', 'AT', 'AX', 'BA', 'BE', 'BG', 'BY', 'CH', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FO', 'FR', 'GG', 'GI', 'GR', 'HR', 'HU', 'IE', 'IM', 'IS', 'IT', 'JE', 'LI', 'LT', 'LU', 'LV', 'MC', 'MD', 'ME', 'MK', 'MT', 'NL', 'NO', 'PL', 'PT', 'RO', 'RS', 'RU', 'SE', 'SI', 'SJ', 'SK', 'SM', 'UA', 'VA');
        $uk = array('GB');

        $this->loadModel('Currency');
        $hasMatch = false;
        if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
            //See if we're using euros
            $hasMatch = false;
            if(in_array($_SERVER["HTTP_CF_IPCOUNTRY"], $europe)) {
                $currency = $this->Currency->find('first',['recursive' => -1, 'conditions' => ['currency' => 'EUR']]);
                $result = $currency;
                $hasMatch = true;
            } elseif (in_array($_SERVER["HTTP_CF_IPCOUNTRY"], $uk)) {
                $currency = $this->Currency->find('first',['recursive' => -1, 'conditions' => ['currency' => 'GBP']]);
                $result = $currency;
                $hasMatch = true;
            }
        }

        if (!$hasMatch) {
            $result = $this->Currency->find('first',['recursive' => -1, 'conditions' => ['currency' => Configure::read('Currency.default')]]);
        }

        if(!isset($_COOKIE['CURRENCY']) || (isset($_COOKIE['cookie']) && $_COOKIE['CURRENCY'] != $result['Currency']['currency'])) {
            setcookie("CURRENCY", $result['Currency']['currency'], time()+86400, '/');
        }
        return $result;

    }

}