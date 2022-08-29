<?php

namespace App\Nova;

use App\Nova\Traits\WithTranslationFields;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class Category extends Resource
{
    use WithTranslationFields;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Domains\ApplicationManagement\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group ='Application Management';
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
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
            Panel::make('Name', $this->getTranslationFields('name', $this->translations['name'])),
            Text::make('Name', 'name')->onlyOnIndex(),
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Parent category', 'parents', self::class)->nullable(),
            Boolean::make('Show On homePage', 'is_shown_on_home_page'),
            Images::make('Image', 'categories')->rules('required'),
            Select::make('Type')->options([
                'cafe' => 'cafe',
                'roaster' => 'roaster'
            ])->rules(['required'])
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
