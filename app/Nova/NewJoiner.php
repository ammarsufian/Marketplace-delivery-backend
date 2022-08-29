<?php

namespace App\Nova;

use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\ChangeNewJoinerStatusAction;

class NewJoiner extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domains\AccountManagement\Models\NewJoiner::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $group = 'Account Management';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name','type'
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
            Text::make('Name')->hideWhenUpdating(),
            Text::make('Mobile Number', 'mobile_number')->hideWhenUpdating(),
            Text::make('Type', 'type')->hideWhenUpdating(), // type enum('partner','rider')
            BelongsTo::make('City','city',City::class)->hideWhenUpdating(),
            Select::make('Status', 'status')->options([
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ])->displayUsingLabels()->rules('required'),
            Text::make('Comment', 'comment')->rules(['required_if:status,rejected']),
            DateTime::make('Created At')->Format('YYYY-MM-DD HH:mm')->exceptOnForms(),
            DateTime::make('Updated At')->exceptOnForms(),
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
        return [
            ChangeNewJoinerStatusAction::make()->onlyOnTableRow(),
        ];
    }
}
