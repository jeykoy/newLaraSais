@extends('layouts.main')

@section('content')
    <div class="container mt-5">
       
    <h1 class="display-4 text-center">Payments Details of Transaction #{{$transaction->id}}</h1>
        <div class="row">
            <div class="col">
                <table class="table table-custom table-hover table-bordered rounded">
                    <thead class="thead">
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $a =$transaction->payments->count();                           
                        @endphp
                        @if ($a == 0)                            
                                <tr>
                                    <td colspan="3">
                                        <h3 class="text-center">no payments made</h3>
                                    </td>
                                </tr>
                         @endif

                        @foreach ($transaction->payments as $trans)                            
                                <tr>    
                                    <td>
                                        {{$i}}
                                    </td>
                                    <td>
                                        {{$trans->payment}}
                                    </td>
                                    <td>
                                        {{$trans->paymentDate}}
                                    </td>
                                </tr>

                            @php
                                $i++;                                
                            @endphp
                           
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
@endsection