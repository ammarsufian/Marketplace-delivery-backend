<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use OptimistDigital\MultiselectField\Multiselect;
use R64\NovaFields\JSON;
use SadekD\NovaOpeningHoursField\NovaOpeningHoursField;

class Branch extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domains\AccountManagement\Models\Branch::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'brand.name';
    public static $group ='Account Management';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id'
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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Latitude'),
            Text::make('Longitude'),
            Select::make('Type')->options([
                'cafe' => 'cafe',
                'roaster' => 'roaster',
            ]),
            Select::make('Status')->options([
                1 => 'Active'
            ]),
            BelongsTo::make('Brand', 'brand', Brand::class),
            Text::make('Delivery Time'),
            DateTime::make('Created At')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
            Multiselect::make('Categories', 'categories')
                ->belongsToMany(Category::class, false)
                ->onlyOnForms()
                ->required(),

            BelongsToMany::make('Categories', 'categories', Category::class)
                ->exceptOnForms(),

            JSON::make('Contact Us', [
                Number::make('Mobile','mobile_number')->rules(['min:10','max:13','required']),
                Text::make('Email','email')->rules(['required']),
            ]),
            NovaOpeningHoursField::make('Schedule'),
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
