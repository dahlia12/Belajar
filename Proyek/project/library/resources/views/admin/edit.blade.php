@extends('layouts.admin')
@section('header','Transaction')
@section('content')

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Transaction</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ url('transactions/'.$transaction->id)}}" method="post">
                        @csrf

        
                        <div class="card-body">
                                
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Anggota</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="member" :value="data.member" required="" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label class="col-sm-1 col-form-label">Tanggal</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control" name="date_start" :value="data.date_start" required="">
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control" name="date_end" :value="data.date_end" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Buku</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="book" :value="data.isbn" required="">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                <div class="form group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Sudah dikembalikan
                                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Belum dikembalikan
                                            </label>
                                    </div>
                                </div>
                            </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>    



                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</section>
            





@endsection