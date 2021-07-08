<?php

namespace App\Observers;

use App\Models\Dashboard\Slide;

class SlideObserver
{
    /**
     * Handle the Slide "creating" event.
     *
     * @param  \App\Models\Dashboard\Slide  $slide
     * @return void
     */
    public function creating(Slide $slide)
    {
        //
    }

    /**
     * Handle the Slide "updating" event.
     *
     * @param  \App\Models\Dashboard\Slide  $slide
     * @return void
     */
    public function updating(Slide $slide)
    {
        //
    }
}
