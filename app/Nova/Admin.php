<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphToMany;
use Vyuldashev\NovaPermission\Permission;
use Vyuldashev\NovaPermission\RoleSelect;

class Admin extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domains\Authentication\Models\Admin::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group ='Authentication';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name','email'
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
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name', 'name'),
            Password::make('Password')
                        ->onlyOnForms()
                        ->creationRules('required', 'string', 'min:6')
                        ->updateRules('nullable', 'string', 'min:6'),
            Text::make('Email', 'email'),
            RoleSelect::make('Role', 'roles'),
            DateTime::make('Created At', 'created_at')->exceptOnForms(),
            DateTime::make('Updated At', 'updated_at')->exceptOnForms(),
            MorphToMany::make('Permissions', 'permissions', Permission::class)
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
