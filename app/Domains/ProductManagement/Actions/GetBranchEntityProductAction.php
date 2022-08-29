<?php

namespace App\Domains\ProductManagement\Actions;

use App\Domains\AccountManagement\Models\Branch;
use App\Domains\Interfaces\Actionable;
use App\Domains\ProductManagement\Models\EntityProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GetBranchEntityProductAction implements Actionable
{
    protected Request $request;
    protected Branch $branch;

    public function __construct(Branch $branch, Request $request)
    {
        $this->branch = $branch;
        $this->request = $request;
    }

    public function execute()
    {
        return EntityProduct::with(['product', 'branch', 'branch.brand', 'variants', 'additional',
            'favorites' => function ($query) {
                return $query->where('user_id', Auth::user()->id);
            }])
            ->ofBranch($this->branch->id)
//            ->ofStatus(EntityProduct::ACTIVE_STATUS)
            ->whereHas('product', function (Builder $query) {
                return $query->when($this->request->has('category_id'), function (Builder $query) {
                    return $query->where('category_id', $this->request->get('category_id'));
                });
            })->paginate($this->request->get('per_page', 10));
    }
}
