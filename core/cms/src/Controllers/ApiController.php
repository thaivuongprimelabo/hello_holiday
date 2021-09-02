<?php

namespace Cms\Controllers;

use App\Http\Controllers\Controller;
use Cms\Models\City;
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

    public function getCities(Request $request)
    {
        $cities = City::query()->get();
        return response()->json($cities, 200);
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
        $searchList = Product::query()
                ->active()
                ->select('id', 'name', 'price')
                ->where(function($query) use ($ids, $keyword) {
                    $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
                    $query->orWhereIn('id', $ids);
                })->paginate(5);

        $result = [
            'searchList' => $searchList,
            'pagination' => $searchList->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $searchList->total(),
        ];
                
        return response()->json($result, 200);
    }
}
