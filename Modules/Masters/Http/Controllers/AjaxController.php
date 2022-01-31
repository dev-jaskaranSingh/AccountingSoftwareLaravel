<?php

namespace Modules\Masters\Http\Controllers;

use App\Models\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Masters\Entities\AccountMaster;
use Modules\Masters\Entities\ItemMaster;

class AjaxController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getStateByCountry(Request $request): JsonResponse
    {
        $country_id = $request->country_id;
        $states = State::where('country_id', $country_id)->get(['id', 'name as text', 'tin', 'state_code']);
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

    /**
     * @param $id
     * @return JsonResponse
     */

    public function getItemByID($id = null): JsonResponse
    {
        if (is_null($id)) {
            return response()->json(['status' => false, 'message' => 'Item ID is required'], 422);
        }
        $item = ItemMaster::select('id', 'name', 'sale_price', 'unit_id', 'hsn_id')
            ->with(['unit:id,name', 'hsn'])
            ->find($id);
        return response()->json(['status' => true, 'item' => $item], 200);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getAccountById($id = null): JsonResponse
    {
        if (is_null($id)) {
            return response()->json(['status' => false, 'message' => 'Account ID is required'], 422);
        }
        $account = AccountMaster::with(['city:id,name', 'state:id,name', 'country:id,name'])->find($id);
        return response()->json(['status' => true, 'message' => 'Account details fetched successfully!', 'account' => $account], 200);
    }
}
