<?php

namespace App\traits;

use Illuminate\Http\Request;

trait CanFilter
{

    /**
     * Filters the model by specific request values;
     * This method has to be called before any other model methods during use;
     * @param Request $request
     * @return mixed
     */
    public static function filterBy(Request $request)
    {
        $model = self::select('*');
        foreach (self::$filterFields as $filterField) {
            $filterField['_field'] = ($filterField['comparator'] === 'LIKE')
                ? "%{$request->{$filterField['field']}}%" : $filterField['field']; // As time goes on, the _field logic would be modified to fit more use cases.

            $model->when($request->{$filterField['field']}, function ($query) use ($request, $filterField) {
                return $query->where($filterField['column'], $filterField['comparator'], $filterField['_field']);
            });
        }
        return $model;
    }

}
