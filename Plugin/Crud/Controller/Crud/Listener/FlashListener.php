<?php
namespace Crud\Listener;

class FlashListener extends \Crud\Listener\Base {
    /**
     * Returns a list of all events that will fire in the controller during its lifecycle.
     * You can override this function to add you own listener callbacks
     *
     * We attach at priority 10 so normal bound events can run before us
     *
     * @return array
     */
    public function implementedEvents() {
        return array(
            'Crud.setFlash' => array('callable' => 'setFlash', 'priority' => 5),
        );
    }
    /**
     * setFlash
     *
     * An API request doesn't need flash messages - so stop them being processed
     *
     * @param CakeEvent $event
     */
    public function setFlash(CakeEvent $event) {
        $event->stopPropagation();
    }

}