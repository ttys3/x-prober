<?php

namespace InnStudio\Prober\Components\Fetch;

use InnStudio\Prober\Components\Events\EventsApi;
use InnStudio\Prober\Components\Restful\RestfulResponse;

class Fetch
{
    public function __construct()
    {
        EventsApi::on('init', [$this, 'filter'], 100);
    }

    public function filter($action)
    {
        if ('fetch' === $action) {
            EventsApi::emit('fetchBefore');
            (new RestfulResponse(EventsApi::emit('fetch', [])))->dieJson();
        }

        return $action;
    }
}
