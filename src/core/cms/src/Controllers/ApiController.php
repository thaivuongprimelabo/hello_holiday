<?php

namespace Cms\Controllers;

use App\Http\Controllers\Controller;
use Cms\Models\Block;
use Cms\Models\District;
use Cms\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(['name' => 'Abigail', 'state' => 'CA'], 200);
    }

    public function getDistricts(Request $request)
    {
        $city = $request->city;
        $districts = District::query()->where('matp', $city)->get();
        return response()->json($districts, 200);
    }

    public function getBlocks(Request $request)
    {
        $district = $request->district;
        $blocks = Block::query()->where('maqh', $district)->get();
        return response()->json($blocks, 200);
    }

    public function selectProducts(Request $request)
    {
        $keyword = $request->query('keyword');
        $ids = explode(',', $keyword);
        $products = Product::query()
                ->active()
                ->select('id', 'name', 'price')
                ->where(function($query) use ($ids, $keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $query->orWhereIn('id', $ids);
                })->get();
                
        return response()->json($products, 200);
    }
}
