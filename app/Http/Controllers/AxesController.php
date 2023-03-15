<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\Objective;
use App\Models\Axis;
use App\Models\User;

use Illuminate\Http\Request;
use Encrypt;

class AxesController extends Controller
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
            $itemsPerPage =  Axis::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $axes = Axis::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $axes = Encrypt::encryptObject($axes, "id");

        $total = Axis::counterPagination($search);

        return response()->json([
            "status" => 200,
            "message" => "Registros obtenidos correctamente.",
            "records" => $axes,
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
        $axes = new Axis;

        $axes->axis_name = $request->axis_name;
        $axes->objective_id = Objective::where('objective_name', $request->objective_name)->first()->id;
        $axes->institution_id = Institution::where('institution_name', $request->institution_name)->first()->id;
        $axes->user_id = User::where('user_name', $request->user_name)->first()->id;
        // dd($axes);
        $axes->deleted_at = $request->deleted_at;

        $axes->save();

        return response()->json([
            "status" => 200,
            "message" => "Registro creado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Axes  axes
     * @return \Illuminate\Http\Response
     */
    public function show(Axis $axes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Axes  $axes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $axes = Axis::where('id', $data['id'])->first();
        $axes->axis_name = $request->axis_name;
        $axes->objective_id = Objective::where('objective_name', $request->objective_name)->first()->id;
        $axes->institution_id = Institution::where('institution_name', $request->institution_name)->first()->id;
        $axes->user_id = User::where('user_name', $request->user_name)->first()->id;
        $axes->deleted_at = $request->deleted_at;

        $axes->save();

        return response()->json([
            "status" => 200,
            "message" => "Registro modificado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Axes  $axes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = isset($request->selected) ? $request->selected : [];

        if (count($data) > 0) {
            foreach ($data as $item) {
                $item = json_decode($item);

                Axis::where('id', $id)->delete();
            }

            return response()->json([
                "status" => 200,
                "message" => "Registro eliminado correctamente.",
                "success" => true,
            ]);
        }

        $id = Encrypt::decryptValue($request->id);

        Axis::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Registro eliminado correctamente.",
            "success" => true,
        ]);
    }
}
