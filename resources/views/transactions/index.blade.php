@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <?php
                $printNewHeader = true;
                $printNewBody = true;

                $printBody = true;
                $index = -1;
                $accordionId = 0;
             ?>
            <div class="accordion" id="accordionExample">
             @foreach ($transactions as $trans)

                {{--if same ng order Id add new table entry--}}
                @if ($index == $trans->order_id && $printNewBody==false)
                    <tr>
                        <td>{{$trans->item_Id}}</td>
                                        <td></td>
                                        <td>{{$trans->orderQuantity}}</td>
                     </tr>
                @elseif($index != $trans->order_id && $printNewBody==false) {{--Close body, table, and div--}}
                                </tbody>
                            </table>
                        </div></div>
                    </div>
                    <?php $index = $trans->order_id;
                    $printNewBody = true;
                    $printNewHeader = true;
                     $accordionId++;?>
                @endif    
                
                @if ($printNewHeader == true)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$accordionId}}"
                                    aria-expanded="true" aria-controls="collapseOne">
                                     Transaction #{{$trans->order_id}}
                                </button>
                            </h2>
                        </div>
                @endif

                @if ($printNewBody == true)
                    <div id="collapse{{$accordionId}}" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table table-light table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity Ordered</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$trans->item_Id}}</td>
                                        <td></td>
                                        <td>{{$trans->orderQuantity}}</td>
                                    </tr>
                @endif

                <?php
                    $index = $trans->order_id;
                    $printNewBody = false;
                    $printNewHeader = false;
                ?>
             @endforeach
              
        </div>{{--end of col--}}
    </div>{{--end of row--}}
</div>{{--end of container--}}



    
@endsection