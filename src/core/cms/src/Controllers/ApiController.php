<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cms\Models\District;
use Cms\Models\Block;

class ApiController extends Controller
{

    public function index(Request $request) {
        return response()->json(['name' => 'Abigail', 'state' => 'CA'], 200);
    }

    public function getDistricts(Request $request) {
        $city = $request->city;
        $districts = District::query()->where('matp', $city)->get();
        return response()->json($districts, 200);
    }

    public function getBlocks(Request $request) {
        $district = $request->district;
        $blocks = Block::query()->where('maqh', $district)->get();
        return response()->json($blocks, 200);
    }
}
