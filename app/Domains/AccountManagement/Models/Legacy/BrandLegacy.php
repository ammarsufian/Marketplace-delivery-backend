<?php

namespace App\Domains\AccountManagement\Models\Legacy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BrandLegacy extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $connection = 'legacy';

    protected $table = 'brands';

    public function branches():HasMany
    {
        return $this->hasMany(BranchLegacy::class,'brand_id');
    }
}
