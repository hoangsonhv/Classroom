<?php

namespace App\Http\ViewComposer;
use Illuminate\Support\Facades\Cache;

class WebComposer
{
    public function compose($view)
    {
        $view->with([
            'settings' => setting()->all(),
        ]);
    }
}
