@extends('layouts.main')


@section('content')
    
        <div class="container mt-5">
            <h1 class="display-4 text-center">Balance</h1>
            <div class="row">
                <div class="col">
                    <table class="table table-custom table-hover table-bordered  table-light">
                        <thead class="thead">
                            <tr>
                                <th>Transaction #</th>
                                <th>Balance</th>
                                <th>Transaction Date</th>
                            </tr>
                        </thead>
                        <tbody>                                  
                            @foreach ($collections as $item)
                               <tr>
                                <td>
                                    <a href="/transactions/{{$item['transaction_Id']}}">
                                        {{$item['transaction_Id']}}
                                    </a>
                                </td>
                                 <td>
                                     PHP {{$item['total']}}.00
                                </td>
                                 <td>
                                     {{$item['date']}}
                                </td>
                                                                
                               </tr>
                            @endforeach                            
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>


@endsection