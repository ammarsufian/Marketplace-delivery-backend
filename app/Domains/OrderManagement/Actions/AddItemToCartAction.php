<?php

namespace App\Domains\OrderManagement\Actions;

use App\Domains\Interfaces\Actionable;
use App\Domains\OrderManagement\Http\Requests\AddItemToCartRequest;
use App\Domains\OrderManagement\Models\Cart;
use App\Domains\OrderManagement\Models\CartItem;
use App\Domains\ProductManagement\Models\EntityProduct;
use App\Domains\ProductManagement\Models\EntityProductVariants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AddItemToCartAction implements Actionable
{
    protected Request $request;
    protected Cart $cart;
    protected Model $model;
    protected Collection $variants;

    public function __construct(Model $model, Cart $cart, AddItemToCartRequest $request)
    {
        $this->request = $request;
        $this->model = $model;
        $this->cart = $cart;
        $this->variants = EntityProductVariants::whereIn('id', $this->request->get('variants'))->get();
    }

    public function execute(): CartItem
    {
        $item = $this->cart->Items()->updateOrCreate([
            'buyable_id' => $this->model->id,
            'buyable_type' => class_basename($this->model),
            'branch_id' => $this->model->branch_id
        ], [
            'quantity' => $this->request->get('quantity'),
        ]);

        if ($this->model instanceof EntityProduct && $this->request->filled('variants')) {
            $this->variants->each(function (EntityProductVariants $entityProductVariants) use ($item) {
                $item->variants()->attach(
                    $entityProductVariants->id,
                    ['price' => $entityProductVariants->price]
                );
            });

        }

        return $item;
    }
}
