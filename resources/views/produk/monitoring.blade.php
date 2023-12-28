@extends('layouts.master')
    @section('content')
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Monitoring Produk Toko Vangrosir Indonesia</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="example2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{asset('jquery.min.js')}}"></script>
        <script>
            $(document).ready(function(){
                fill_datatable();

                function fill_datatable(){
                    var dataTable = $('#example2').DataTable({
                        processing : true,
                        ajax: {
                            url: "{{ url('/product/monitoring')}}",
                        },
                        columns: [
                            {
                                data:'product_code',
                                name:'product_code'
                            },
                            {
                                data:'description',
                                name:'description',
                            },
                            {
                                data:'date_create',
                                name:'date_create',
                            },
                            {
                                data:'date_update',
                                name:'date_update'
                            },
                            {
                                render:function(data,type,row) {
                                    var button = 
                                    "<button style='margin:5px' class='btn btn-sm btn-outline-danger' data-id='"+ row.product_id +"' data-toggle='modal' data-target='#modal-detail-plu-"+ row.id +"'>Hapus <i class='fa fa-trash'></i></button>"
                                    return button
                                }
                            }
                        ],
                        dom: 'lBfrtip',
                        buttons: [
                            {
                                extend: 'copy',
                            },
                            {
                                extend: 'collection',
                                text: 'Export',
                                buttons: [
                                    {
                                        extend: 'csv',
                                        text: 'CSV',
                                        filename: function() {
                                            var d = new Date();

                                            return 'Laporan Data Produk ' + d; 
                                        }
                                    },
                                    {
                                        extend: 'excel',
                                        text: 'Excel',
                                        filename: function() {
                                            var d = new Date();

                                            return 'Laporan Data Produk ' + d; 
                                        },
                                        exportOptions: {
                                            modifier: {
                                                order: 'index',
                                                page: 'all',
                                                search: 'none',
                                                selected: 'null'
                                            }
                                        }
                                    },
                                ],
                            },
                            {
                                extend: 'print'
                            }
                        ]
                    });

                    $('#filter').click(function(){
                        $("#example2").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                        // var filter_branch = $('#filter_branch').val();

                        // if(filter_branch != '')
                        // {
                        //     $('#example2').DataTable().destroy();
                        //     fill_datatable(filter_branch);
                        // }
                        // else {
                        //     alert('Isi Data Filter Dengan Lengkap!');
                        // }
                    });

                    $('#reset').click(function(){
                        $('#filter_branch').val('');
                        $('#filter_type').val('');
                        $('#example2').DataTable().destroy();
                        fill_datatable();
                    });

                }
            });
        </script>
    @endsection