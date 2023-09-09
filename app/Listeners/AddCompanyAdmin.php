<?php

namespace App\Listeners;

use App\Events\CompanyCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddCompanyAdmin
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //  dd($event);

    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CompanyCreatedEvent  $event
     * @return void
     */
    public function handle(CompanyCreatedEvent $event)
    {

        $event->user->companies()->sync([
            $event->company->id => [
                "status" => 5
            ]
        ], false);
    }
}
