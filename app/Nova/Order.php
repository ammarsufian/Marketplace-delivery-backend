<?php

namespace App\Nova;

use App\Nova\Actions\AssignOrderIntoShipmentHandlerAction;
use App\Nova\Actions\ChangeOrderStatusAction;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\MorphOne;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use \App\Domains\OrderManagement\Models\Order as OrderModel;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domains\OrderManagement\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $group = 'Order Management';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),
            BelongsTo::make('Address', 'address', Address::class)->hideWhenUpdating(),
            BelongsTo::make('User', 'user', User::class),
            BelongsTo::make('Branch', 'branch', Branch::class)->hideWhenUpdating(),
            Select::make('Status')->options(OrderModel::MAPPING_ORDER_STATUS)->displayUsingLabels(),
            BelongsTo::make('Cancel Reason', 'cancelReason', OrderCancelReason::class)->onlyOnIndex(),
            BelongsTo::make('Promo Code', 'promoCode', PromoCode::class)->hideWhenUpdating(),
            Number::make('SubTotal')->onlyOnDetail(),
            Number::make('discount')->onlyOnDetail(),
            Number::make('Total')->hideWhenUpdating(),
            Number::make('vat')->onlyOnDetail(),
            Number::make('delivery')->onlyOnDetail(),
            DateTime::make('Created At')->exceptOnForms(),
            BelongsTo::make('Reason', 'cancelReason', OrderCancelReason::class),
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
        return [
            ChangeOrderStatusAction::make()->onlyOnTableRow(),
            AssignOrderIntoShipmentHandlerAction::make()->onlyOnTableRow(),
        ];
    }
}
