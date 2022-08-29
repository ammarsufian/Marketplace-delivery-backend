<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;

class EntityProduct extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domains\ProductManagement\Models\EntityProduct::class;


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static $with = ['product', 'branch.brand'];

    public static $group ='Product Management';


    public function title(): string
    {
        return $this->product->name . ' - ' . $this->branch->brand->name;
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Product', 'product', Product::class)->searchable()->required(),
            BelongsTo::make('Branch', 'branch', Branch::class)->required(),
            Number::make('unit_price')->step(0.001)->required(),
            Number::make('Discount')->placeholder('Fill it as Percentage without %'),
            Number::make('Vat')->placeholder('Fill it as Percentage without %'),
            Select::make('Status')->options(\App\Domains\ProductManagement\Models\EntityProduct::ENTITY_PRODUCT_STATUS),
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
            BelongsToMany::make('Variants', 'variants', Variant::class)
                ->fields(function () {
                    return [
                        Number::make('Price', 'price')->step(0.01)->showOnIndex()->rules(['required']),
                    ];
                })->required(),

            BelongsToMany::make('Additional Items', 'additional', AdditionalItem::class)
                ->fields(function () {
                    return [
                        Number::make('Price', 'price')->step(0.01)->showOnIndex()->rules(['required']),
                    ];
                })->required(),

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
