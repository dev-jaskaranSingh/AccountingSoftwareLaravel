<?php

namespace Modules\Masters\Http\Controllers;

use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AjaxController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getStateByCountry(Request $request): JsonResponse
    {
        $country_id = $request->country_id;
        $states = State::where('country_id', $country_id)->get(['id', 'name as text','tin','state_code']);
        return response()->json(['status' => true, 'states' => $states]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getCityByState(Request $request): JsonResponse
    {
        $state_id = $request->state_id;
        $cities = State::find($state_id)->cities()->get(['id', 'name as text']);
        return response()->json(['status' => true, 'cities' => $cities]);
    }
}
