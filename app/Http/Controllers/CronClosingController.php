<?php

namespace App\Http\Controllers;

use App\Models\CronClosing;
use Illuminate\Http\Request;

use Encrypt;

class CronClosingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cron = CronClosing::all();
        $cron = Encrypt::encryptObject($cron, "id");

        return response()->json(['message' => 'success', 'cron' => $cron]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CronClosing::insert($request->all());

        return response()->json([
            "status" => 200,
            "message" => "Registro creado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CronClosing  $cronClosing
     * @return \Illuminate\Http\Response
     */
    public function show(CronClosing $cronClosing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CronClosing  $cronClosing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = Encrypt::decryptArray($request->all(), 'id');

        CronClosing::where('id', $data['id'])->update($data);

        return response()->json([
            "status" => 200,
            "message" => "Registro modificado correctamente.",
            "success" => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CronClosing  $cronClosing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Encrypt::decryptValue($id);

        CronClosing::where('id', $id)->delete();

        return response()->json(["message" => "success"]);
    }
}
