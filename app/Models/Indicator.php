<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'indicators';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'indicator_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Indicator::select('indicators.*', 'indicators.id as id')
        
		->where('indicators.indicator_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("indicators.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Indicator::select('indicators.*', 'indicators.id as id')
        
		->where('indicators.indicator_name', 'like', $search)

        ->count();
    }
}
