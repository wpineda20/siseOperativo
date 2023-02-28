<?php

namespace App\Http\Controllers;

use App\Models\MonthlyClosing;
use Illuminate\Http\Request;

use Encrypt;

class MonthlyClosingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monthlyClosings = MonthlyClosing::select('monthly_closings.id', 'closing_date', 'year_name')
            ->join('years as y', 'monthly_closings.year_id', '=', 'y.id')
            ->get();

        $monthlyClosings = Encrypt::encryptObject($monthlyClosings, "id");

        return response()->json(['message' => 'success', 'monthlyClosings' => $monthlyClosings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MonthlyClosing  $monthlyClosing
     * @return \Illuminate\Http\Response
     */
    public function show(MonthlyClosing $monthlyClosing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MonthlyClosing  $monthlyClosing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MonthlyClosing $monthlyClosing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MonthlyClosing  $monthlyClosing
     * @return \Illuminate\Http\Response
     */
    public function destroy(MonthlyClosing $monthlyClosing)
    {
        //
    }
}
