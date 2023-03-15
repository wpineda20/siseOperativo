<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'objectives';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'objective_name', 'user_id', 'deleted_at', 'created_at', 'updated_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Objective::select('objectives.*', 'users.*', 'objectives.id as id')
            ->join('users', 'objectives.user_id', '=', 'users.id')

            ->where('objectives.objective_name', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("objectives.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return Objective::select('objectives.*', 'users.*', 'objectives.id as id')
            ->join('users', 'objectives.user_id', '=', 'users.id')

            ->where('objectives.objective_name', 'like', $search)

            ->count();
    }
}
