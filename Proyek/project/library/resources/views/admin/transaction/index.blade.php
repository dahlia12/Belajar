@extends('layouts.admin')
@section('header','Transaction')
@section('content')

ini adalah halaman Transaction
<br><br>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-20">
                    <div class="card">
                        <div class="card-header">            
                            <a href="{{url('transactions/create')}}" class="btn btn-sm btn-primary pull-right">Create New Publisher</a>
                        </div>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                        </div>    
                    </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 20px">Number</th>
                                <th class="text-center">ID Transaction</th>
                                <th class="text-center">ID Member</th>
                                <th class="text-center">Date Start</th>
                                <th class="text-center">Date End</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Action</th>
                                <!-- <th style="width: 40px">Label</th> -->
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($transactions as $key =>  $transaction)
                                <tr>
                                    <td>{{$key +1}}</td>
                                    <td>{{ $transaction->id_transaction}}</td>
                                    <td>{{ $transaction->member_id}}</td>
                                    <td>{{ $transaction->date_start}}</td>
                                    <td>{{ $transaction->date_end}}</td>
                                    <td>{{ date ('d/m/y',strtotime ($transaction->created_at))}}</td>
                                    <td>{{ date('d/m/y', strtotime ($transaction->updated_at))}}</td>
                                    <td> 
                                        <a href="{{url('transactions/'.$transaction->id.'/edit') }}" class="btn btn-sm btn-primary pull-right">Edit</a>
                                        
                                        <form action="{{ url('transactions', ['id' => $transaction->id]) }}" method="post">
                                            <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                                            @method('delete')
                                            @csrf
                                        </form>
                                    </td>
                                    <!-- <td><span class="badge bg-danger"></span></td> -->
                                </tr>
                                @endforeach
                        
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection