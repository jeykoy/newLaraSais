<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Illuminate\Support\Facades\DB;
use App\Transaction;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->id);
        //$orderlist = Orderlist::where('customer_id',auth()->user()->id)->;        
        $payments = DB::table('orderlists')
        ->leftJoin('transactions', 'orderlists.id', '=', 'transactions.orderlist_id')
        ->leftJoin('items','items.id','=','orderlists.item_Id')
        ->select('transactions.id','transactions.orderlist_id','orderlists.item_Id',
                  'orderlists.orderQuantity as qty',
                'items.price','transactions.created_At as date') 
        ->where('orderlists.customer_id','=',auth()->user()->id)
        ->get();

        
        //dd($payments);
        $total =0;
        $index =0;
        $collections = collect([]);
        $i=0;        
        $balance =0;
        //dd($payments->count() -1);
        foreach ($payments as $value) {   
            if($i == 0){
                $index = $value->id;
                $id = $index;
                $date = $value->date;
                $price = $value->price;
            }
            if($i == ($payments->count())){ //if end of loop save last
                //dd($value->id);
                //dd($value->price . ' ' . $value->item_Id);
                $total = $total + ($value->price * $value->qty);
                $price = $value->price;
                $index = $value->id;
                $sum = DB::table('payments')->where('transaction_id','=',$index)->sum('payment');
                //dd('index is: '.$index.' '.$sum);
                $total = $total - $sum;

                $collections->push(['transaction_Id' => $index, 'total' => $total, 'date' => $date, 'times' => $i]);
            }           
            elseif($index == $value->id){ //if same ang index sa value ng current itireation, compute for total
                 $total = $total + ($value->price * $value->qty);                 
                 $price = $value->price;
                 
            }     
            else{ //if nagnew TransaactionId
                $sum = DB::table('payments')->where('transaction_id', '=', $id)->sum('payment');
                //dd('index is: ' . $id . ' ' . $sum[0]);
                $total = $total - $sum;
                $collections->push(['transaction_Id' => $id, 'total' => $total, 'date' => $date, 'times' => $i]);
                $total = 0;

                $total = $total + ($value->price * $value->qty);
                $price = $value->price;
                $index = $value->id;
                $id = $index;
            }        
        $i++;
        }        
        //dd($i);
        //dd($collections);
        
        return view('payments.index',compact('collections'));
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
    public function show(Transaction $transaction)
    {

        return view('payments.show',compact('transaction'));
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
