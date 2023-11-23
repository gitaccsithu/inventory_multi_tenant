<?php

namespace App\Listeners;

use App\Mail\SendTenantProjCredsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendProjCredsMailToTenant
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $tenant = $event->tenant;
        Mail::to($tenant->user->email)->send(new SendTenantProjCredsMail($tenant));
    }
}
