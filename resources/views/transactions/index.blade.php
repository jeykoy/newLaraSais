@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h1 class="display-4">My Transactions</h1>
            <?php
                $printNewHeader = true;
                $printNewBody = true;

                $subtotal = 0;
                $index = 0;
                $accordionId = 0;
                $total =0;
                $lastKey = $transactions->keys()->last();
                $count=0;
               // dd($lastKey);
             ?>
            <div class="accordion" id="accordionExample">
            @if ($transactions->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <h4>no records found</h4>
                    </div>                    
                </div>
            @endif

             @foreach ($transactions as $trans)
                {{--if same ng order Id add new table entry--}}
                @if ($index == $trans->orderlist_id && $printNewBody==false)
                    <?php 
                        $subtotal = $trans->price * $trans->orderQuantity; 
                        $total = $total + $subtotal;
                    ?>
                    <tr>
                        <td>{{$trans->itemName}}</td>
                        <td>{{$trans->price}}</td>
                        <td>{{$trans->orderQuantity}}</td>
                        <td>{{$subtotal.'.00'}}</td>                        
                     </tr>
                     @if ($lastKey == $count)
                                 <tr>
                                    <td class="text-right display-4" colspan="4">PHP{{$total}}.00</td>
                               </tr>
                         </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                     @endif
                @elseif($index != $trans->orderlist_id && $printNewBody==false) {{--Close body, table, and div--}}
                               <tr>
                                    <td class="text-right display-4" colspan="4">PHP{{$total}}.00</td>
                               </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <?php $index = $trans->orderlist_id;
                    $printNewBody = true;
                    $printNewHeader = true;
                     $accordionId++;?>
                @endif    
                
                @if ($printNewHeader == true)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-custom" type="button" data-toggle="collapse" data-target="#collapse{{$accordionId}}"
                                    aria-expanded="true" aria-controls="collapseOne">
                                     Transaction #{{$trans->orderlist_id}} : {{$trans->created_at}}
                                </button>
                            </h2>
                        </div>
                @endif

                @if ($printNewBody == true)
                    <div id="collapse{{$accordionId}}" class="collapse" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table table-custom  table-hover table-bordered ">
                                <thead class="thead table-custom">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity Ordered</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php    
                                    $total = 0;                                   
                                        $subtotal = $trans->price * $trans->orderQuantity;
                                        $total = $total + $subtotal;
                                    ?>
                                    <tr>
                                        <td>{{$trans->itemName}}</td>
                                        <td>{{$trans->price}}</td>
                                        <td>{{$trans->orderQuantity}}</td>
                                        <td>{{$subtotal}}</td>
                                    </tr>
                @endif

                <?php
                    $index = $trans->orderlist_id;
                    $printNewBody = false;
                    $printNewHeader = false;
                     $count++;
                ?>
               
             @endforeach
              
        </div>{{--end of col--}}
    </div>{{--end of row--}}
</div>{{--end of container--}}



    
@endsection