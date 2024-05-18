@extends('layouts.admin')
@section('header','Transaction')

@push('css')
<style type="text/css">

</style>
@endpush

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection


@section('content')
<div id="controller">
    <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <a href="/transactions/create" class="btn btn-sm btn-primary pull-right">Create New Transaction</a>
                    </div>
                    <form>
                        <div class="form-group row  pull-right">
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value="0">Status</option>
                                    <option value="S">Sudah dikembalikan</option>
                                    <option value="B">Belum dikembalikan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="status">
                                    <option value="0">Tanggal</option>
                                    <option value="TP">Tanggal Pinjam</option>
                                    <option value="TK">Tanggal Kembali</option>
                                </select>
                            </div>    
                        </div>
                    </form>
                </div>
                <div class="card-body" >
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th witdh="30px"></th>
                                <th class="text-center">Tanggal Pinjam</th>
                                <th class="text-center">Tanggal Kembali</th>
                                <th class="text-center">Nama Peminjam</th>
                                <th class="text-center">Lama Pinjam (hari)</th>
                                <th class="text-center">Total Buku</th>
                                <th class="text-right">Total Bayar</th>
                                <th class="text-right">Status</th>
                                <th class="text-right">Action</th>
                            </tr>

                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" :action="actionUrl" autocomplete="off" @submit="submitForm($event, data.id)">
                    <div class="modal-header">

                        <h4 class="modal-title">Tambah/Edit Anggota</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                    </div>   
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

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
                </form>
        </div>
    </div>
</div>
    

@endsection

@section('js')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <!-- Page specific script -->
    <script>
        $(function () {
            $("#datatable").DataTable();
            // ({"responsive": true, "lengthChange": false, "autoWidth": false,
            // // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // $('#example2').DataTable({
            // "paging": true,
            // "lengthChange": false,
            // "searching": false,
            // "ordering": true,
            // "info": true,
            // "autoWidth": false,
            // "responsive": true,
            // });
        });
    </script>

<script "text/javascript">
        var actionUrl='{{url('transactions')}}';
        var apiUrl='{{url('api/transactions')}}';

        var columns = [
            {data: 'DT_RowIndex', class: 'text-center', orderable: true},
            {data: 'date_start', class: 'text-center', orderable: true},
            {data: 'date_end', class: 'text-center', orderable: true},
            {data: 'name', class: 'text-center', orderable: true},
            {data: 'lama', class: 'text-center', orderable: true},
            {data: 'qty', class: 'text-center', orderable: true},
            {data: 'total', class: 'text-center', orderable: true},
            {data: 'status', class: 'text-center', orderable: true},
            {render: function (index, row, data, meta) {
                return`
                <a href ="/transactions/${data.id}/edit" class="btn btn-warning btn-sm">
                    Edit
                </a>
                <a class ="btn btn-danger btn-sm" onclick="controller.deleteData(event, ${data.id})">
                    Delete
                </a>`;
            }, orderable: false, width: '200px', class: 'text-center'},
        ];
        var controller = new Vue({
            el:'#controller',
            data:{
                datas:[],
                data : {},
                actionUrl,
                apiUrl,
                editStatus:false,

            },
            mounted: function () {
                this.datatable();
            },
            methods:{
                datatable() {
                    const _this = this;
                    _this.table = $('#datatable').DataTable({
                        ajax: {
                            url: _this.apiUrl,
                            type:'GET',
                        },
                        columns:columns
                    }).on('xhr', function () {
                        _this.datas = _this.table.ajax.json().data;
                    });
                },
                addData( ) {
                    this.data = {};
                    this.actionUrl='{{url('transactions')}}';
                    this.editStatus=false;
                    $('#modal-default').modal();
                },
                editData(event, row) {
                    this.data = this.datas[row];
                    this.editStatus=true;
                    $('#modal-default').modal();
                },
                deleteData(event, id) {
                    if(confirm("Are you sure?")){
                        // $(event.target).parents('tr').remove();
                        axios.post(this.actionUrl+'/'+id, {_method:'DELETE'}).then(response => {
                            alert('Data has been removed');
                        });
                    }
                },
                SubmitForm(event, id){
                    event.preventDefault();
                    const _this = this;
                    var actionUrl = ! this.editStatus ? this.actionUrl : this.actionUrl+'/'+id;
                    axios.post(actionUrl, new FormData($(event.target)[0])).then(response => {
                        $('#modal-default').modal('hide');
                        _this.table.ajax.reload();
                    });
                },
            }
        });
    </script>
    
        <script type="text/javascript">
            $('select[name=status]').on('change',function(){
                status = $('select[name=status]').val();

                if (status == 0){
                    controller.table.ajax.url(actionUrl).load();
                }
                else {
                    controller.table.ajax.url(actionUrl+'?status='+status).load();
                }
            });

            $('select[name=tanggal]').on('change',function(){
                tanggal = $('select[name=tanggal]').val();

                if (tanggal == 0){
                    controller.table.ajax.url(actionUrl).load();
                }
                else {
                    controller.table.ajax.url(actionUrl+'?tanggal='+tanggal).load();
                }
            }); 
        </script>

         
    <!-- <script src="{{ asset('js/data.js') }}"></script> -->

@endsection

