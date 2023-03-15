<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'results';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'result_description',
        'axis_id',
        'user_id',
        'indicator_id',
        'organizational_units_id',
        'year_id',
        'period_id',
        'unit_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Result::select('results.*', 'axes.*', 'users.*', 'indicators.*', 'organizational_units.*', 'years.*', 'periods.*', 'units.*', 'results.id as id')
            ->join('axes', 'results.axis_id', '=', 'axes.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('indicators', 'results.indicator_id', '=', 'indicators.id')
            ->join('organizational_units', 'results.organizational_units_id', '=', 'organizational_units.id')
            ->join('years', 'results.year_id', '=', 'years.id')
            ->join('periods', 'results.period_id', '=', 'periods.id')
            ->join('units', 'results.unit_id', '=', 'units.id')

            ->where('results.result_description', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("results.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Result::select('results.*', 'axes.*', 'users.*', 'indicators.*', 'organizational_units.*', 'years.*', 'periods.*', 'units.*', 'results.id as id')
            ->join('axes', 'results.axis_id', '=', 'axes.id')
            ->join('users', 'results.user_id', '=', 'users.id')
            ->join('indicators', 'results.indicator_id', '=', 'indicators.id')
            ->join('organizational_units', 'results.organizational_units_id', '=', 'organizational_units.id')
            ->join('years', 'results.year_id', '=', 'years.id')
            ->join('periods', 'results.period_id', '=', 'periods.id')
            ->join('units', 'results.unit_id', '=', 'units.id')

            ->where('results.result_description', 'like', $search)

            ->count();
    }
}
