@extends('layouts.master')
    @section('content')
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Edit Data Produk Toko</h2>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-danger alert-block" role="alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="card-body">
                <div class="form-group mb-0 pb-0">
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">Upload Data Display CSV</label>
                    </div>
                </div>

                <div class="row">
                    <form class="form-horizontal" method="POST" action="{{ url('product/upload/preview')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-12">
                                <select class="form-control" id="filter_branch_import" name="filter_branch_import">
                                    <option value="" hidden>Pilih Cabang (KODE - NAMA)</option>
                                    <option value="1" style="font-weight:800;">SEMUA CABANG</option>
                                    @foreach($cabang as $cab)
                                        <option value="{{ $cab->code }}">{{$cab->code}} - {{$cab->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="csv_file" type="file" class="form-control" name="csv_file" required>
                                @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('csv_file') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <a href="{{ asset('template/template_csv.csv') }}" class="d-none d-sm-inline-block btn btn-sm btn-light shadow-sm float-right text-primary mr-3"><i class="fas fa-download fa-sm text-primary"></i> Download Template CSV</a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-md-offset-4 mb-3">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    Show Data CSV
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <br>

                <div class="form-group mb-0 pb-0">
                    <label for="formFile" class="form-label">Monitoring Data</label>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" id="filter_branch" name="filter_branch">
                                <option value="" hidden>Pilih Cabang (KODE - NAMA)</option>
                                <!-- <option value="1" style="font-weight:800;">SEMUA CABANG</option> -->
                                @foreach($cabang as $cab)
                                    <option value="{{ $cab->code }}">{{$cab->code}} - {{$cab->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <button type="submit" name="filter" id="filter" class="btn btn-primary">Filter</button>
                            <button class="btn btn-danger" type="button" name="reset" id="reset">Reset</button>
                        </div>
                    </div>                        
                </div>

                <div class="table-responsive">
                    <table class="table table-striped" id="example2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Min Order</th>
                                <th>Min Qty</th>
                                <th>Max Qty</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <br>

                @if($btn_update == 0)
                @else
                <div class="form-group">
                    <form action="">
                        <button name="update" id="update" class="btn btn-success btn-block">Simpan Perubahan</button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <script type="text/javascript" src="{{asset('jquery.min.js')}}"></script>
        <script>
            $(document).ready(function(){
                fill_datatable();

                function fill_datatable(filter_branch=''){
                    var dataTable = $('#example2').DataTable({
                        processing : true,
                        ajax: {
                            url: "{{ url('/product/edit')}}",
                            data: {
                                filter_branch:filter_branch
                            },
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
                                render: function(data,type,row){
                                    if(row.flag != null)
                                    {
                                        return "<input type='number' disabled='true' id='price"+ row.id +"' name='price"+ row.id +"' style='background-color: #EFEEEE; text-align: center; width:60px;' value='"+row.price+"' readonly>"

                                    }
                                    else
                                    {
                                        return "<input type='number' id='price"+ row.id +"' name='price"+ row.id +"' style='text-align: center; width:60px;' value='"+row.price+"'>"
                                    }
                                }
                            },
                            {
                                render: function(data,type,row){
                                    if(row.flag != null)
                                    {
                                        return "<input type='number' disabled='true' id='min_order"+ row.id +"' name='min_order"+ row.id +"' style='background-color: #EFEEEE; text-align: center; width:60px;' value='"+row.min_order+"' readonly>"

                                    }
                                    else
                                    {
                                        return "<input type='number' id='min_order"+ row.id +"' name='min_order"+ row.id +"' style='text-align: center; width:60px;' value='"+row.min_order+"'>"
                                    }
                                }
                            },
                            {
                                render: function(data,type,row){
                                    if(row.flag != null)
                                    {
                                        return "<input type='number' disabled='true' id='min_qty"+ row.id +"' name='min_qty"+ row.id +"' style='background-color: #EFEEEE; text-align: center; width:60px;' value='"+row.min_qty+"' readonly>"

                                    }
                                    else
                                    {
                                        return "<input type='number' id='min_qty"+ row.id +"' name='min_qty"+ row.id +"' style='text-align: center; width:60px;' value='"+row.min_qty+"'>"
                                    }
                                }
                            },
                            {
                                render: function(data,type,row){
                                    if(row.flag != null)
                                    {
                                        return "<input type='number' disabled='true' id='max_qty"+ row.id +"' name='max_qty"+ row.id +"' style='background-color: #EFEEEE; text-align: center; width:60px;' value='"+row.max_qty+"' readonly>"

                                    }
                                    else
                                    {
                                        return "<input type='number' id='max_qty"+ row.id +"' name='max_qty"+ row.id +"' style='text-align: center; width:60px;' value='"+row.max_qty+"'>"
                                    }
                                }
                            },
                            {
                                render:function(data,type,row) {
                                    var html = "";

                                    if(row.status == 1)
                                    {
                                        var html = "<select style='height:30px;' name='status' id='status"+ row.id+"'>"+
                                        "<option value='1' selected>WAJIB</option>"+
                                        "<option value='2'>SARAN</option>"+
                                        "<option value='3'>ARSIP</option>"+
                                        "</select>"
                                    }
                                    else if(row.status == 2)
                                    {
                                        var html = "<select style='height:30px;' name='status' id='status"+ row.id+"'>"+
                                        "<option value='1'>WAJIB</option>"+
                                        "<option value='2' selected>SARAN</option>"+
                                        "<option value='3'>ARSIP</option>"+
                                        "</select>"
                                    }
                                    else if(row.status == 3)
                                    {
                                        var html = "<select style='height:30px;' name='status' id='status"+ row.id +"'>"+
                                        "<option value='1'>WAJIB</option>"+
                                        "<option value='2'>SARAN</option>"+
                                        "<option value='3' selected>ARSIP</option>"+
                                        "</select>"
                                    }
                                    else
                                    {
                                        var html = "<select style='height:30px;' name='status' id='status"+ row.id +"'>"+
                                        "<option value='' selected></option>"+
                                        "<option value='1'>WAJIB</option>"+
                                        "<option value='2'>SARAN</option>"+
                                        "<option value='3'>ARSIP</option>"+
                                        "</select>"
                                    }

                                    return html;
                                }
                            },
                            {
                                render:function(data,type,row) {
                                    var html = "";

                                    if(row.flag != null)
                                    {
                                        var html =
                                        "<button data-id='" + row.id + "' id='tolak'  style='margin:5px' class='btn btn-sm btn-outline-danger batal tolak"+row.id+"'>Batal<i class='fa fa-trash'></i></button></td>" +
                                        "<button data-id='" + row.id + "' id='cart' style='margin:5px; display:none;' class='btn btn-sm btn-outline-success cart"+row.id+"'>Ubah<i class='fa fa-pen'></i></button></td>";
                                        // var updateID = '.cart' + row.id;
                                        // $(updateID).hide();
                                    }
                                    else
                                    {
                                        var html =

                                        "<button data-id='" + row.id + "' id='cart' style='margin:5px' class='btn btn-sm btn-outline-success cart"+row.id+"'>Ubah<i class='fa fa-pen'></i></button></td>" +
                                        "<button data-id='" + row.id + "' id='tolak' style='margin:5px; display:none;' class='btn btn-sm btn-outline-danger batal tolak"+row.id+"'>Batal<i class='fa fa-trash'></i></button></td>";

                                        
                                        // "<button data-id='" + row.id + "' id='tolak' style='margin:5px' class='btn btn-sm btn-danger batal tolak"+row.id+"'>Batal</button></td>";

                                        // var tolakID = '.tolak' + row.id;
                                        // $(tolakID).hide();
                                    }

                                    return html;
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
                                    'csv',
                                    {
                                        extend: 'excel',
                                        text: 'Excel',
                                        exportOptions: {
                                            modifier: {
                                                order: 'index',
                                                page: 'all',
                                                search: 'none',
                                                selected: 'null'
                                            }
                                        }
                                    },
                                    'pdf',
                                    'print'
                                ]
                            }
                        ]
                    });

                    var filter_branch = $('#filter_branch').val();

                    $('#filter').click(function(){
                        $("#example2").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                        if(filter_branch != '')
                        {
                            $('#example2').DataTable().destroy();
                            fill_datatable(filter_branch);
                        }
                        else {
                            alert('Isi Data Filter Dengan Lengkap!');
                        }
                    });

                    $('#reset').click(function(){
                        $('#filter_branch').val('');
                        $('#filter_type').val('');
                        $('#example2').DataTable().destroy();
                        fill_datatable();
                    });

                    //Declare field class and id
                    var cartClass = ".cart" + master_id;
                    var tolakClass = ".tolak" + master_id;

                    var master_id = $(this).data('id');

                    var priceClass = '#price' + master_id;
                    var orderClass = '#min_order' + master_id;
                    var minqtyClass = '#min_qty' + master_id;
                    var maxqtyClass = '#max_qty' + master_id;
                    var statusClass = '#status' + master_id;
                    
                    var price = $(priceClass).val();
                    price = parseInt(price);
                    var order = $(orderClass).val();
                    order = parseInt(order);
                    var min = $(minqtyClass).val();
                    min = parseInt(min);
                    var max = $(maxqtyClass).val();
                    max = parseInt(max);

                    var status = $(statusClass).val();

                    $(document).on('click','#cart',function(){
                        if(price != '' && order != '' && min != '' && max != '')
                        {
                            if(price < 1 || max < 1 || min < 1 || order < 1) 
                            {
                                alert('Nilai tidak boleh kurang dari 1');
                            }
                            else
                            {
                                if(min > max)
                                {
                                    alert('Nilai max quantity tidak boleh lebih kecil dari min quantity!');
                                }
                                else
                                {
                                    $.ajax({
                                        url : "",
                                        type: "post",
                                        data: {
                                            "_token" : "{{ csrf_token() }}",
                                            filter_branch : filter_branch,
                                            master_id : master_id,
                                            price : price,
                                            order : order,
                                            min : min,
                                            max : max,
                                            status : status
                                        },
                                        success:function(response) {
                                            alert("Data berhasil disimpan dalam keranjang!");

                                            $(cartClass).hide();
                                            $(tolakClass).show();
                                            $(priceClass).attr("readonly",true);
                                            $(orderClass).attr("readonly",true);
                                            $(minqtyClass).attr("readonly",true);
                                            $(maxqtyClass).attr("readonly",true);   
                                            $(statusClass).attr("readonly",true);
                                        }
                                    });
                                }
                            }
                        }
                        else
                        {
                            alert('Pastikan semua field telah terisi!');
                        }
                    });

                    $(document).on('click','#tolak',function(){
                        var branch_code = $('#filter_branch').val();

                        $.ajax({
                            url:"{{ url('')}}",
                            type: "post",
                            data: {
                                "_token" : "{{csrf_token()}}",
                                master_id : master_id,
                                price : price,
                                order : order,
                                min : min,
                                max : max,
                                status : status
                            },
                            success:function(response){
                                if(response['status'] == 1)
                                {
                                    alert("Data batal diubah dan berhasil dihapus dari keranjang!");

                                    $(tolakClass).hide();
                                    $(cartClass).show();
                                    $(priceClass).attr("readonly",false);
                                    $(orderClass).attr("readonly",false);
                                    $(minqtyClass).attr("readonly",false);
                                    $(maxqtyClass).attr("readonly",false);   
                                    $(statusClass).attr("readonly",false);
                                }
                                else
                                {
                                    alert(response['message']);
                                }
                            }
                        })
                    });
                }
            });
        </script>
    @endsection