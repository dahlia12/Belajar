@extends('layouts.admin')
@section('header','catalog')

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
                        <a href="#" @click ="addData()" class="btn btn-sm btn-primary pull-right">Create New catalog</a>
                    </div>
                    <!-- <div class="col-md-2">
                        <select class="form-control" name="gender">
                            <option value="0">Semua Jenis Kelamin</option>
                            <option value="P">Perempuan</option>
                            <option value="L">Laki-laki</option>
                        </select>
                    </div> -->
                </div>
            </div>
                <div class="card-body" >
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th witdh="30px"></th>
                                <th class="text-center">ID Catalog</th>
                                <th class="text-center">Name</th>
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

                        <h4 class="modal-title">catalog</h4>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                    </div>   
                    <div class="modal-body">
                        @csrf

                        <input type="hidden" name="_method" value="PUT" v-if="editStatus">

                        <div class="form-group">
                            <label>ID catalog</label>
                            <input type="text" class="form-control" name="id_catalog" :value="data.id_catalog" required="">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" :value="data.name" required="">
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
        var actionUrl='{{url('catalogs')}}';
        var apiUrl='{{url('api/catalogs')}}';

        var columns = [
            {data: 'DT_RowIndex', class: 'text-center', orderable: true},
            {data: 'id_catalog', class: 'text-center', orderable: true},
            {data: 'name', class: 'text-center', orderable: true},
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
                    this.actionUrl='{{url('catalogs')}}';
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

