<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\OrganizationalUnit;

use Illuminate\Http\Request;
use Encrypt;

class OrganizationalUnitsController extends Controller
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
            $itemsPerPage =  OrganizationalUnit::count();
            $skip = 0;
        }

        $sortBy = (isset($request->sortBy[0])) ? $request->sortBy[0] : 'id';
        $sort = (isset($request->sortDesc[0])) ? "asc" : 'desc';

        $search = (isset($request->search)) ? "%$request->search%" : '%%';

        $organizationalunits = OrganizationalUnit::allDataSearched($search, $sortBy, $sort, $skip, $itemsPerPage);
        $organizationalunits = Encrypt::encryptObject($organizationalunits, "id");

        $total = OrganizationalUnit::counterPagination($search);

        return response()->json([
            "status" => 200,
            "message" => "Registros obtenidos correctamente.",
            "records" => $organizationalunits,
            "total" => $total,
            "success" => true,
        ]);
    }

    /**
     * Get all Organizational Units for select
     *
     * @return \Illuminate\Http\Response
     */
    public function allOrganizationalUnits(Request $request)
    {
        $organizationalUnits = OrganizationalUnit::all();

        $organizationalUnits = Encrypt::encryptObject($organizationalUnits, "id");

        return response()->json(['message' => 'success', 'organizationalUnits' => $organizationalUnits]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $organizationalunits = new OrganizationalUnit;

        $organizationalunits->ou_name = $request->ou_name;
        $organizationalunits->direction_id = Direction::where('direction_name', $request->direction_name)->first()->id;

        $organizationalunits->save();

        return response()->json([
            "status" => 200,
            "message" => "Registro creado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationalUnits  organizationalunits
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationalUnit $organizationalunits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrganizationalUnits  $organizationalunits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        $organizationalunits = OrganizationalUnit::where('id', $data['id'])->first();
        $organizationalunits->ou_name = $request->ou_name;
        $organizationalunits->direction_id = Direction::where('direction_name', $request->direction_name)->first()->id;

        $organizationalunits->save();

        return response()->json([
            "status" => 200,
            "message" => "Registro modificado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationalUnits  $organizationalunits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = isset($request->selected) ? $request->selected : [];

        if (count($data) > 0) {
            foreach ($data as $item) {
                $item = json_decode($item);

                OrganizationalUnit::where('id', $id)->delete();
            }

            return response()->json([
                "status" => 200,
                "message" => "Registro eliminado correctamente.",
                "success" => true,
            ]);
        }

        $id = Encrypt::decryptValue($request->id);

        OrganizationalUnit::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Registro eliminado correctamente.",
            "success" => true,
        ]);
    }
}
