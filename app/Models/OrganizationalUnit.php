<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrganizationalUnit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'organizational_units';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'ou_name', 'direction_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return OrganizationalUnit::select('organizational_units.*', 'directions.*', 'organizational_units.id as id')
            ->join('directions', 'organizational_units.direction_id', '=', 'directions.id')

            ->where('organizational_units.ou_name', 'like', $search)

            ->skip($skip)
            ->take($itemsPerPage)
            ->orderBy("organizational_units.$sortBy", $sort)
            ->get();
    }

    public static function counterPagination($search)
    {
        return OrganizationalUnit::select('organizational_units.*', 'directions.*', 'organizational_units.id as id')
            ->join('directions', 'organizational_units.direction_id', '=', 'directions.id')

            ->where('organizational_units.ou_name', 'like', $search)

            ->count();
    }
}
