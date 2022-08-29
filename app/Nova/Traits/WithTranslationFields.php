<?php

namespace App\Nova\Traits;

use Laravel\Nova\Fields\Text;
use R64\NovaFields\JSON;

trait WithTranslationFields
{
    public function getTranslationFields($fieldName,array $data):array
    {
        $languages = env('SUPPORTED_LANGUAGES','ar,en');

        return [
            JSON::make($fieldName,collect(explode(',',$languages))
                ->map(function ($language) use($data){
                    return Text::make($language,$language)
                        ->default(function ()use($data,$language){
                            return $data[$language]??'';
                        })->resolveUsing(function ($value, $resource, $attribute) use($data,$language){
                            return $value =  $data[$language]??'';
                        });
                })->toArray())
        ];
    }
}
