@extends('layouts.admin')
@section('header','Publisher')

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
                    <div class="col-md-10">
                        <a href="#" @click ="addData()" class="btn btn-sm btn-primary pull-right">Create New Member</a>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="gender">
                            <option value="0">Semua Jenis Kelamin</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                    </div>
                </div>
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

                        <h4 class="modal-title">Publisher</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                    </div>   
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                            <label>ID Publisher</label>
                            <input type="text" class="form-control" name="id_publisher" :value="data.id_publisher" required="">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" :value="data.name" required="">
                        </div>
                        <div class="form group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" :value="data.email" required="">
                        </div>
                        <div class="form group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" :value="data.phone_number" required="">
                        </div>
                        <div class="form group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="address" :value="data.address" required="">
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
        var actionUrl='{{url('publishers')}}';
        var apiUrl='{{url('api/publishers')}}';

        var columns = [
            {data: 'id', class: 'text-center', orderable: true},
            {data: 'id_publisher', class: 'text-center', orderable: true},
            {data: 'name', class: 'text-center', orderable: true},
            {data: 'email', class: 'text-center', orderable: true},
            {data: 'phone_number', class: 'text-center', orderable: false},
            {data: 'address', class: 'text-center', orderable: true},
            {render: function (index, row, data, meta) {
                return`
                <a href ="#" class="btn btn-warning btn-sm" onclick="controller.editData(event, ${meta.row})">
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
                    this.actionUrl='{{url('publishers')}}';
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
     <!-- <script src="{{ asset('js/data.js') }}"></script> -->
        <script type="text/javascript">
            $('select[name=gender]').on('change',function(){
                gender = $('select[name=gender]').val();

                if (gender == 0){
                    controller.table.ajax.url(actionUrl).load();
                }
                else {
                    controller.table.ajax.url(actionUrl+'?gender='+gender).load();
                }
            });
        </script>
    <!-- <script src="{{ asset('js/data.js') }}"></script> -->

@endsection
