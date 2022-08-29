<?php

namespace App\Domains\ProductManagement\Actions;

use Illuminate\Http\Request;
use App\Domains\Interfaces\Actionable;
use App\Domains\ProductManagement\Models\Variant;


class GetVariantsByNameAction implements Actionable
{
    protected Request $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        //TODO::read data from meiliesearch
        return Variant::where('name', 'like', $this->request->get('name') . '%')
            ->paginate($this->request->get('per_page') ?? 10);
    }
}
