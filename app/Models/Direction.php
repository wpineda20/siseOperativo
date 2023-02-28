<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'directions';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'direction_name', 'institution_id', 'deleted_at', 'created_at', 'updated_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Direction::select('directions.*', 'institutions.*', 'directions.id as id')
            ->join('institutions', 'directions.institution_id', '=', 'institutions.id')

            ->where('directions.direction_name', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("directions.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Direction::select('directions.*', 'institutions.*', 'directions.id as id')
            ->join('institutions', 'directions.institution_id', '=', 'institutions.id')

            ->where('directions.direction_name', 'like', $search)

            ->count();
    }
}
