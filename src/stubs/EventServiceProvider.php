<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Call the parent method
        parent::boot();

        // Register the event listeners
        $this->registerEventListeners();

        // Register the event listeners
        $this->registerSubscribers();
    }

    /**
     * Registers the event / listener mapping.
     *
     * @return void
     */
    public function registerEventListeners()
    {
        // Determine the event / listener mapping
        $listen = $this->getEventListeners();

        // Iterate through each mapping
        foreach($listen as $event => $listeners) {

            // Iterate through each listener
            foreach($listeners as $listener) {

                // Listen to each event
                Event::listen($event, $listener);

            }

        }
    }

    /**
     * Registers the subscribers.
     *
     * @return void
     */
    public function registerSubscribers()
    {
        // Determine the subscribers
        $subscribers = $this->getSubscribers();

        // Iterate through each subscriber
        foreach($subscribers as $subscriber) {

            // Register each subscriber
            Event::subscribe($subscriber);

        }
    }

    /**
     * Returns the application's event / listener mapping.
     *
     * @return array
     */
    public function getEventListeners()
    {
    	return $this->app->config->get('events.listen', []);
    }

    /**
     * Returns the application's subscribers.
     *
     * @return array
     */
    public function getSubscribers()
    {
    	return $this->app->config->get('events.subscribers', []);
    }

}
