<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'months';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'month_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Month::select('months.*', 'months.id as id')
        
		->where('months.month_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("months.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Month::select('months.*', 'months.id as id')
        
		->where('months.month_name', 'like', $search)

        ->count();
    }
}
