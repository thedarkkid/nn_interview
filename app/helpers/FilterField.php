<?php

namespace App\helpers;

class FilterField
{
    protected $column; // db column.
    protected $comparator; // Eloquent string Comparator.
    protected $field; // filter field to be passed in from query.
}
