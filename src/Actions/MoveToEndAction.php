<?php

namespace Maize\NovaEloquentSortable\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class MoveToEndAction extends EloquentSortableAction
{
    public function name(): string
    {
        return __('Move to end');
    }

    public static function canRunSortable(NovaRequest $request, Model $model): bool
    {
        if ($model->isLastInOrder()) {
            return false;
        }

        return parent::canRunSortable($request, $model);
    }

    public function handle(ActionFields $fields, Collection $models): mixed
    {
        $models->each->moveToEnd();

        return Action::message(__('Order moved to end.'));
    }
}
