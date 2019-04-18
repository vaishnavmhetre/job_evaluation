<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    public function getHospitalsFromLocation(Request $request)
    {

        /**
         * Check for validation of parameters passed by user
         */

        $hospitalSearchValidator = Validator::make($request->all(), [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'distance' => 'numeric|between:1,10'
        ]);


        /**
         * If validation failed, send errors with 400 BAD REQUEST status
         */

        if ($hospitalSearchValidator->fails())
            return response()->json($hospitalSearchValidator->errors(), Response::HTTP_BAD_REQUEST);


        // Search for hospitals in given/default distance from given location (latitude,longitude)
        $hospitals = Hospital::geoFence($request->latitude, $request->longitude, 0, $request->input('distance', Hospital::$defaultSearchDistanceFromOrigin))->get();

        // return hospitals
        return response()->json($hospitals);
    }
}
