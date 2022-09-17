<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Traits\WithTranslationFields;
use App\Domains\ApplicationManagement\Models\Package as PackageModel;

class Package extends Resource
{
    use WithTranslationFields;


    public static $model = PackageModel::class;
    public static $title = 'name';
    public static $group='Application Management';
    public static $search = [
        'id','name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),
            Text::make('Name')->exceptOnForms(),
            Panel::make('Name', $this->getTranslationFields('name', $this->translations['name'])),
            Panel::make('Description', $this->getTranslationFields('description', $this->translations['description'])),
            Number::make('Covered Order Counts', 'covered_order_counts'),
            Number::make('Covered Month Counts', 'covered_month_counts'),
            Number::make('Price', 'price'),
            Boolean::make('Is Active', 'is_active'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
