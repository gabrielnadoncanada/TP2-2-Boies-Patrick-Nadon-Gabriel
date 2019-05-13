<?php

namespace App\Listeners;

use App\Events\NameSaving as EventNameSaving;

class NameSaving
{
    public function handle(EventNameSaving $event)
    {
        $event->model->slug = str_slug($event->model->name, '-');
    }
}





















// namespace App\Listeners;

// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Contracts\Queue\ShouldQueue;

// class NameSaving
// {
//     /**
//      * Create the event listener.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Handle the event.
//      *
//      * @param  object  $event
//      * @return void
//      */
//     public function handle($event)
//     {
//         //
//     }
// }
