<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periods';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'period_name', 'start_year', 'end_year', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Period::select('periods.*', 'periods.id as id')
        
		->where('periods.period_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("periods.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Period::select('periods.*', 'periods.id as id')
        
		->where('periods.period_name', 'like', $search)

        ->count();
    }
}
