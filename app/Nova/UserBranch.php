<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Domains\Authentication\Models\User as UserModel;

class UserBranch extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $model = \App\Domains\AccountManagement\Models\UserBranch::class;

    public static $displayInNavigation = false;
    
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
        'id',
    ];

    public static function label()
    {
        return 'Provider Branch';
    }


    public static function relatableUsers(NovaRequest $request, $query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', UserModel::PROVIDER_ROLE);
        })->get('id');
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
            ID::make('ID', 'id')->sortable(),
            BelongsTo::make('User'),
            BelongsTo::make('Branch', 'branch', Branch::class),
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
