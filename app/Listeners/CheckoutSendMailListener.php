<?php


namespace CodeCommerce\Listeners;

use Mail;
use CodeCommerce\Events\CheckoutEvent;

class CheckoutSendMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        //

        Mail::send('checkout.email', ['user' => $event->getUser(), 'order'=>$event->getOrder()], function ($m) use ($event) {

            $m->from('hello@app.com', 'Code Commerce');

            $m->to($event->getUser()->email, $event->getUser()->name)->subject('Code Commerce - Seu pedido #' . $event->getOrder()->id . ' foi criado');

        });


    }
}
