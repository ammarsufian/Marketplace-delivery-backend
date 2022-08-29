<?php

namespace App\Domains\Interfaces;

use Illuminate\Http\Request;

interface Exportable
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function export(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function getRows(Request $request);
}