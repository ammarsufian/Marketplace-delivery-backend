<?php

namespace App\Domains\ApplicationManagement\Actions;

use App\Domains\ApplicationManagement\Models\Category;
use App\Domains\Interfaces\Actionable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GetCategoriesListAction implements Actionable
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function execute()
    {
        return Category::query()
            ->ofParentCategories()
            ->ofShownOnHomePage()
            ->paginate($this->request->get('per_page', 10));
    }
}
