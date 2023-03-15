<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Axis extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'axes';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id',
        'axis_name',
        'objective_id',
        'institution_id',
        'user_id',
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
        return Axis::select('axes.*', 'objectives.*', 'institutions.*', 'users.*', 'axes.id as id')
            ->join('objectives', 'axes.objective_id', '=', 'objectives.id')
            ->join('institutions', 'axes.institution_id', '=', 'institutions.id')
            ->join('users', 'axes.user_id', '=', 'users.id')

            ->where('axes.axis_name', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("axes.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Axis::select('axes.*', 'objectives.*', 'institutions.*', 'users.*', 'axes.id as id')
            ->join('objectives', 'axes.objective_id', '=', 'objectives.id')
            ->join('institutions', 'axes.institution_id', '=', 'institutions.id')
            ->join('users', 'axes.user_id', '=', 'users.id')

            ->where('axes.axis_name', 'like', $search)

            ->count();
    }
}
