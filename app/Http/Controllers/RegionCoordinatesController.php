<?php

namespace App\Http\Controllers;

use App\Models\RegionCoordinates;
use Illuminate\Http\Request;

class RegionCoordinatesController extends Controller
{
    public function index()
    {
        $data = RegionCoordinates::all();
        $ret = [];
        foreach ($data as $d) {
            $out = [$d->name => ["latitude" => $d->latitude, "longitude" => $d->longitude]];
            array_push($ret, $out);
        }

        return response()->json([
            "status" => 'success',
            "data" => $ret
        ], 200);
    }
}
