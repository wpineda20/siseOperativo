<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'institutions';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'institution_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return Institution::select('institutions.*', 'institutions.id as id')
        
		->where('institutions.institution_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("institutions.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return Institution::select('institutions.*', 'institutions.id as id')
        
		->where('institutions.institution_name', 'like', $search)

        ->count();
    }
}
