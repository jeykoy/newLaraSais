<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
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
        $transactions = DB::table('transactions')
        ->join('orderlists','transactions.order_id','=','orderlists.id')
        ->join('items', 'orderlists.item_Id','=','items.id')
        ->select('transactions.id','transactions.transactionDate','transactions.order_id',
        'orderlists.item_Id','orderlists.orderQuantity','items.itemName','items.price','transactions.created_at')
        ->where('orderlists.customer_id','=',auth()->user()->id)
        ->where('transactions.isCompleted','=','0')
        ->get();
        //dd($transactions);     

        return view('transactions.index', compact('transactions'));
    }

    public function completed(){
        $transactions = DB::table('transactions')
            ->join('orderlists', 'transactions.order_id', '=', 'orderlists.id')
            ->join('items', 'orderlists.item_Id', '=', 'items.id')
            ->select(
                'transactions.id',
                'transactions.transactionDate',
                'transactions.order_id',
                'orderlists.item_Id',
                'orderlists.orderQuantity',
                'items.itemName',
                'items.price',
                'transactions.created_at'
            )
            ->where('orderlists.customer_id', '=', auth()->user()->id)
            ->where('transactions.isCompleted', '=', '1')
            ->get();
            //dd($transactions);
        return view('transactions.completed',compact('transactions'));
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

    public function store(Request $request)
    {
        //
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
