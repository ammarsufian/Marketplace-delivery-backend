<?php

namespace App\Domains\AccountManagement\Actions;

use App\Domains\AccountManagement\Http\Requests\IndexBranchesRequest;
use App\Domains\AccountManagement\Models\Address;
use App\Domains\AccountManagement\Models\Branch;
use App\Domains\AccountManagement\Models\Brand;
use App\Domains\Interfaces\Actionable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use function App\Helpers\activeAddress;

class IndexBranchAction implements Actionable
{
    protected Request $request;
    protected int $zone;
    protected Address $address;

    public function __construct(IndexBranchesRequest $request)
    {
        $this->request = $request;
        $this->address = activeAddress();
        $this->zone = 8;
    }

    public function execute()
    {
        return Branch::select('*')
            ->selectRaw('( 3959 * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance', [$this->address->latitude, $this->address->longitude, $this->address->latitude])
            ->havingRaw("distance < ?", [$this->zone])
            ->when($this->request->has('type'), function (Builder $query) {
                return $query->where('type', $this->request->get('type'));
            })
            ->when($this->request->has('category_id'), function (Builder $query) {
                return $query->whereHas('categories', function (Builder $query) {
                    return $query->whereIn('id', collect($this->request->get('category_id'))->toArray());
                });
            })
            ->where('status', Branch::ACTIVE_STATUS_BRANCH)
            ->paginate($this->request->get('per_page'));
    }
}
