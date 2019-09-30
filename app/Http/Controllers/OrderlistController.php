<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Items;
use App\Orderlist;
use App\Transaction;
class OrderlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $items = Items::all();


        return view('orderlists.index',compact(('items')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Orderlist $orderlist, Request $request)
    {
        
        //dd(Orderlist::whereRaw('id = (select max(id) from orderlists')->get());
        //dd(DB::raw('select max(id) from orderlists')->get());
        $orderlist = DB::table('orderlists')
            ->select(DB::raw('max(id) as id'))
            ->get();

        $maxId = DB::table('orderlists')->max('id');
        $maxId++;
       
        $collection = $request->all();

        /* $filtered = $collection->reject(function($value,$key){
            return $value =null;
        }); 

        dd($filtered); */
        $i = 0;
        foreach ($collection as $key => $value) {
            if($i===0){
                unset($collection[$key]);
            }
            if($value === null){
                unset($collection[$key]);
            }
            $i++;
        }

        //dd($collection);
        $messages = [
            'min' => "You can't submit an empty order",
        ];

        $validation = request()->validate([
            'totalQty'=>'min:1|numeric'
             
        ],$messages);        
        
        $i = $collection['totalQty'];
        unset($collection['totalQty']);
        //dd($collection);
        $index = 0;
        
        foreach ($collection as $key => $value) {
            if($index < $i){
                Orderlist::create([
                    'id'=> $maxId,
                    'item_Id' => $key,
                    'orderQuantity' => $value,
                    'customer_Id' => auth()->user()->id
                ]);
            }            
            $index++;
        }
       
        Transaction::create([
            'order_id' => $maxId,
            'transactionDate' => now()
        ]);


        return redirect('/');        
    } 

    public function getLatestId(){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
