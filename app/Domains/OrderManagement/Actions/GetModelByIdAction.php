<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Models\CartItem;
use Illuminate\Database\Eloquent\Model;

class GetModelByIdAction implements Actionable
{
    protected string $type;
    protected int $id;

    public function __construct(string $type, int $id)
    {
        $this->type = $type;
        $this->id = $id;
    }

    public function execute(): ?Model
    {
        $model = data_get(CartItem::BUYABLE_MODELS, $this->type);
        return app($model)->query()->where('id', $this->id)->firstOrFail();
    }
}
