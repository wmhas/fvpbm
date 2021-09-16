<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SalesPerson;
use App\Models\Purchase;
use App\Models\Item;
use App\Models\Location;
use App\Models\Stock;
use Carbon\Carbon;


class PurchaseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:purchase', ['only' => ['index','search','history','purchase','export']]);
    }

    public function index()
    {
        $items = Item::paginate(15);
        $roles= DB::table('model_has_roles')->join('users','model_has_roles.model_id', '=', 'users.id')->where("users.id", auth()->id())->first();
        return view('purchase.index' , [ 
            'items' => $items ,
            'roles' => $roles ,
        ]);
    }
    public function search(Request $request) 
    {
        $keyword = $request->keyword;
        $keyword = preg_replace("/[^a-zA-Z0-9 ]/", "", $keyword);

        if($keyword != null)
        {
            $items = Item::where('item_code', 'like', '%'. strtoupper($keyword). '%')
                ->orwhere('brand_name', 'like', '%'. strtoupper($keyword). '%')
                ->orderBy('item_code', 'asc')->limit(500)->paginate(15);
        }
        else
        {
            $items = Item::paginate(15);
        }
        $roles = DB::table('model_has_roles')->join('users', 'model_has_roles.model_id', '=', 'users.id')->where("users.id", auth()->id())->first();
        return view('purchase.index', compact('roles','keyword', 'items'));
    }
    public function purchase($item)
    {
        $items=Item::where('id',$item)->first();
        $salesperson=SalesPerson::all();
        $roles = DB::table('model_has_roles')->join('users', 'model_has_roles.model_id', '=', 'users.id')->where("users.id", auth()->id())->first();
        return view('purchase.purchase', compact('roles','salesperson','items'));
    }

    public function getDetails($item_id = 0)
    {     
        $empData['data'] = DB::table('items as a')
            ->select('a.id', 'a.purchase_price as purchase_price', 'a.purchase_uom as purchase_uom')
            ->where('a.id', $item_id)
            ->get()->toArray();
        return response()->json($empData);
    }
    
    public function store_purchase(Request $request)
    {   
        $items=Item::paginate(15);

        $item_buy = Item::where('id', $request->input('ItemID'))->first();
        $quantity_buy = $request->input('quantity');
        $price_buy = $item_buy->purchase_price;
        $quantity_item = $item_buy->purchase_quantity;
        $total_price = $quantity_buy*$price_buy;
        $total_quantity = $quantity_buy*$quantity_item;

        $purchase = new Purchase();
        $purchase->ItemID =  $request->input('ItemID');
        $purchase->po_number = $request->input('po_number');
        $purchase->purchase_price = $total_price;
        $purchase->purchase_uom = $request->input('purchase_uom');
        $purchase->quantity= $request->input('quantity');
        $purchase->salesperson= $request->input('salesperson');   
        $purchase->save();

        $stock = new Stock();
        $stock->item_id = $request->input('ItemID');
        $stock->quantity = $total_quantity;
        $stock->balance = 0;
        $stock->source = 'purchase';
        $stock->source_id = $purchase->id;
        $stock->source_date = Carbon::now()->format('Y-m-d');
        $stock->save();

        $location = Location::where('item_id', $request->input('ItemID'))->first();
        $current_store = $location->store;
        $location->store = $current_store + $total_quantity;
        $location->save();
        $roles = DB::table('model_has_roles')->join('users', 'model_has_roles.model_id', '=', 'users.id')->where("users.id", auth()->id())->first();
        return redirect()->action('PurchaseController@history',['roles'=> $roles,
                                                            'purchase'=> $purchase,
                                                            'items'=> $items]);
    }

    public function history()
    {
        $purchases=Purchase::paginate(15);
        $roles = DB::table('model_has_roles')->join('users', 'model_has_roles.model_id', '=', 'users.id')->where("users.id", auth()->id())->first();
        return view('purchase.history', [ 
            'purchases' => $purchases ,
            'roles' => $roles ,
        ]);
    }
}
