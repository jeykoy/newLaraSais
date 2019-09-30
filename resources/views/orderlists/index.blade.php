@extends('layouts.main')

@section('content')
    <div class="container-fluid mt-3" id="itemList">
        <div class="row mx-5">           
            <div class="col border rounded">
                <h1 class="display-4 text-center">One Page Order Sheet</h1>
                <table class="table table-custom table-hover  bordered table-sm" >
                    <thead class="thead">
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Order Pcs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="/orderlists" method="POST">
                            @csrf
                        @foreach ($items as $item)
                            <tr>
                                <td>{{$item->itemName}}</td>
                                <td>
                                    <label id="itemPrice" class="price">
                                        {{$item->price}}
                                    </label>
                                    
                                </td>                             
                                <td>
                                    <input class="form-control qtyInput" onclick="computeQty()" onkeyup="computeQty()" type="number" name="{{$item->id}}" id="id{{$item->id}}" min="0">
                                </td>
                                
                            </tr>
                        @endforeach  
                    </tbody>
                    
                </table>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header card-custom">
                        Order Summary
                    </div>
                    <div class="card-body">
                        <table class="table table-light ">
                            <tbody>
                                <tr>
                                    <td># of Items</td>
                                    <td> 
                                        <input class="form-control" type="text" name="totalQty" id="qty" min="1" required readonly>
{{--                                         <input type="text" id="qtyHidden" name="qtyHidden" min="1" hidden>
 --}}                                    </td>
                                </tr>
                                <tr>
                                    <td>total</td>
                                    <td> 
                                        <input class="form-control" type="text" id="subTotal" readonly>
{{--                                         <input type="hidden" name="totalSumHidden" id="subTotalHidden">                                        
 --}}                                    </td>
                                </tr>
                                <tr>                                    
                                    <td class="text-right" colspan="2">
                                        <button class="btn btn-custom " type="button" onclick="computeQty()">Compute Summary</button>
                                        <button class="btn btn-custom ml-4 my-4" data-toggle="modal" data-target="#exampleModal" type="button" onclick="computeQty()">Submit Orders</button>
                                        <button class="btn btn-custom ml-4" type="reset">Reset Fields</button>
                                    </td>
                                </tr>   
                            </tbody> 
                          
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Submit Order Confirmation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to continue?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-custom">Submit</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>                                        
                                    </div>
                                    </div>
                                </div>
                            </div> 
                            </form>                         
                        </table>
                          @if ($errors->any())
                                    
                                        <div class="alert alert-danger" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{$error}}
                                                    </li>
                                                @endforeach                                                
                                            </ul>
                                        </div>
                                   
                                @endif
                    </div>                    
                </div>
            </div>
        </div>
    </div>   
    
    <!-- Button trigger modal -->


<!-- Modal -->





{{-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
 --}}

{{--  <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}

    <script>  
       function computeQty(){
            var orderedQty, i, itemPrice;
            var sum = 0,totalAmount =0.00;
            orderedQty = document.getElementsByClassName("qtyInput");       
            itemPrice = document.getElementsByClassName("price");

            console.log(itemPrice[17].textContent);
            
             for (i = 0; i < orderedQty.length; i++) {
                sum = Number(sum)+Number(orderedQty[i].value);
                totalAmount = Number(totalAmount) + Number(Number(orderedQty[i].value * itemPrice[i].textContent));
                console.log(sum);
            }   

            //document.getElementById("qtyHidden").value=sum;
            //document.getElementById("subTotalHidden").value=totalAmount;

            document.getElementById("qty").value =formatNumber(sum);
            document.getElementById("subTotal").value =formatNumber(totalAmount)+".00";
            

        } 
        function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
    
        
        /* let data = {
            messages: 1+1
        };


        new Vue({
            el: "#itemList",
            data: data
        }) */
    </script> 


@endsection