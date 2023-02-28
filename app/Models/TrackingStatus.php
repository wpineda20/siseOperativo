<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class TrackingStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tracking_statuses';

    public $incrementing = true;

    protected $data = ['deleted_at'];

    protected $fillable = [
        'id', 'status_name', 'deleted_at', 'created_at', 'updated_at', 
    ];

    public $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = true;

    public static function allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage)
    {
        return TrackingStatus::select('tracking_statuses.*', 'tracking_statuses.id as id')
        
		->where('tracking_statuses.status_name', 'like', $search)

        ->skip($skip)
        ->take($itemsPerPage)
        ->orderBy("tracking_statuses.$sortBy", $sort)
        ->get();
    }

    public static function counterPagination($search)
    {
        return TrackingStatus::select('tracking_statuses.*', 'tracking_statuses.id as id')
        
		->where('tracking_statuses.status_name', 'like', $search)

        ->count();
    }
}
