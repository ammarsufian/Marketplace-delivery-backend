<?php

namespace App\Nova\Actions;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;

class ChangeNewJoinerStatusAction extends Action
{
    use InteractsWithQueue, Queueable;
    public $name = 'Change Status';
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    { 
        $models->first()->update([
            'status' => $fields->status,
            'comment' => $fields->comment
        ]);
        return Action::message('User status '.$fields->status);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Status', 'status')->options([
                'approved' => 'Approved',
                'rejected' => 'Rejected',
            ])->displayUsingLabels()->rules('required'),
            Text::make('Comment', 'comment')->rules(['required_if:status,rejected']),
        ];
    }
}
