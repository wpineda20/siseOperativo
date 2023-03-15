<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Axis;
use App\Models\User;
use App\Models\Indicator;
use App\Models\OrganizationalUnit;
use App\Models\Year;
use App\Models\Period;
use App\Models\Unit;

use Illuminate\Http\Request;
use Encrypt;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->itemsPerPage;
        $skip = ($request->page - 1) * $request->itemsPerPage;

        // Getting all the records
        if (($request->itemsPerPage == -1)) {
            $itemsPerPage =  Result::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $results = Result::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $results = Encrypt::encryptObject($results, "id");

        $total = Result::counterPagination($search);

        return response()->json([
            "status" => 200,
            "message" => "Registros obtenidos correctamente.",
            "records" => $results,
            "total" => $total,
            "success" => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $results = new Result;

        $results->result_description = $request->result_description;
        $results->axis_id = Axis::where('axis_name', $request->axis_name)->first()->id;
        $results->user_id = User::where('user_name', $request->user_name)->first()->id;
        $results->indicator_id = Indicator::where('indicator_name', $request->indicator_name)->first()->id;
        $results->organizational_units_id = OrganizationalUnit::where('ou_name', $request->ou_name)->first()->id;
        $results->year_id = Year::where('year_name', $request->year_name)->first()->id;
        $results->period_id = Period::where('period_name', $request->period_name)->first()->id;
        $results->unit_id = Unit::where('unit_name', $request->unit_name)->first()->id;
        $results->deleted_at = $request->deleted_at;

        $results->save();

        return response()->json([
            "status" => 200,
            "message" => "Registro creado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Results  results
     * @return \Illuminate\Http\Response
     */
    public function show(Result $results)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Results  $results
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $results = Result::where('id', $data['id'])->first();
        $results->result_description = $request->result_description;
        $results->axis_id = Axis::where('axis_name', $request->axis_name)->first()->id;
        $results->user_id = User::where('user_name', $request->user_name)->first()->id;
        $results->indicator_id = Indicator::where('indicator_name', $request->indicator_name)->first()->id;
        $results->organizational_units_id = OrganizationalUnit::where('ou_name', $request->ou_name)->first()->id;
        $results->year_id = Year::where('year_name', $request->year_name)->first()->id;
        $results->period_id = Period::where('period_name', $request->period_name)->first()->id;
        $results->unit_id = Unit::where('unit_name', $request->unit_name)->first()->id;
        $results->deleted_at = $request->deleted_at;

        $results->save();

        return response()->json([
            "status" => 200,
            "message" => "Registro modificado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Results  $results
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = isset($request->selected) ? $request->selected : [];

        if (count($data) > 0) {
            foreach ($data as $item) {
                $item = json_decode($item);

                Result::where('id', $id)->delete();
            }

            return response()->json([
                "status" => 200,
                "message" => "Registro eliminado correctamente.",
                "success" => true,
            ]);
        }

        $id = Encrypt::decryptValue($request->id);

        Result::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Registro eliminado correctamente.",
            "success" => true,
        ]);
    }
}
