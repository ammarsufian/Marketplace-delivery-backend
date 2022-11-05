<?php

namespace App\Domains\ApplicationManagement\Actions;

use App\Domains\ApplicationManagement\Models\Package;
use App\Domains\Interfaces\Actionable;
use App\Domains\ApplicationManagement\Models\UserPackage;
use App\Domains\Authentication\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CreateUserPackageAction implements Actionable
{
    protected User $user;
    protected Package $package;

    public function __construct(Package $package)
    {
        $this->user = Auth::user();
        $this->package = $package;
    }

    public function execute(): Collection
    {
        return UserPackage::create([
            'user_id' => $this->user->id,
            'package_id' => $this->package->id,
            'covered_order_counts' => $this->package->covered_order_counts,
            'expiration_date' => Carbon::now()->addMonths($this->package->covered_month_counts),
            'status' => 'active',
        ]);
    }
}
