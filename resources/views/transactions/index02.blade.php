@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-4">Current Orders</h1>

               
            <div class="accordion" id="accordionExample">
                    <?php
                        $exit = null;
                        $index = -1;
                        $accordionId = 0;
                    ?>
             @foreach ($transactions as $transaction)
                @if ($loop->first)
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$accordionId}}"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    Transaction #{{$transaction->order_id}}
                                </button>
                            </h2>
                        </div>                   
                
                @endif

                {{--checks if previous id is the same, means add new collapse body--}}
                @if ($index == $transaction->order_id)
                    <?php $exit = false; ?>

                @else {{--if new and order_id close everything.--}}
                <?php
                    $accordionId++;
                ?>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
                <?php $exit = true;  ?> {{--creates new body--}}
                @endif

                <?php
                        $index = $transaction->order_id;
                    ?>
                @if ($exit == true)
                    <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$accordionId}}"
                                aria-expanded="true" aria-controls="collapseOne">
                                Transaction #{{$transaction->order_id}}
                            </button>
                        </h2>
                    </div>
                    <?php $exit = null;  ?>
                @endif

                    
                {{--if same and index create new body--}}                
                @if ($index == $transaction->order_id && $exit == null)
                    <div id="collapse{{$accordionId}}" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <?php
                                $exit = false;
                            ?>
                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>   
                                    <tr>                                 
                @else          
                @endif
                
                {{--insert new body--}}
                @if ($exit==false)                   
                    <td> {{$transaction->item_Id}}</td>                  
                   
                @endif
                        
            @endforeach
            </div>
        </div>{{--End of accordion--}}




    </div>
@endsection