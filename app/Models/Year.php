<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'years';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'year_name', 'period_id', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Year::select('years.*', 'periods.*', 'years.id as id')
        ->join('periods', 'years.period_id', '=', 'periods.id')

		->where('years.year_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("years.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Year::select('years.*', 'periods.*', 'years.id as id')
        ->join('periods', 'years.period_id', '=', 'periods.id')

		->where('years.year_name', 'like', $search)

        ->count();
    }
}
