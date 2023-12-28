@extends('layouts.master')
@section('content')
<form class="form-horizontal" method="POST" action="{{ url('/product/upload/process')}}" enctype="multipart/form-data">
{{csrf_field()}}
<div class="card">
    <div class="card-header">
      <h2 class="card-title">Preview Upload Produk</h2>
    </div>
    <div class="card-body">
        <div class="form-group mb-0 pb-0">
            <div class="col-md-6">
                <label for="formFile" class="form-label">Data Display Akan Di Upload Ke</label>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <input type="hidden" id="tipe_upload" name="tipe_upload" class="col-sm-3 form-control" value="{{$tipe_upload}}" style="margin-left: 10px; margin-right: 10px" readonly>
                <input type="hidden" id="code_cab" name="code_cab" class="col-sm-3 form-control" value="{{$kode_cabang}}" style="margin-left: 10px; margin-right: 10px" readonly>
                @if($tipe_upload == 2)
                <input type="text" id="name_cab" name="name_cab" class="col-sm-3 form-control" value="{{$nama_cabang}}" style="margin-left: 10px; margin-right: 10px" readonly>
                @else
                <input type="text" id="name_cab" name="name_cab" class="col-sm-3 form-control" placeholder="SEMUA CABANG" style="margin-left: 10px; margin-right: 10px" readonly>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped"  id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th style="text-align:center;">Product Code</th>
                <th style="text-align:center;">Status Produk</th>
                <th style="text-align:center;">Price</th>
                <th style="text-align:center;">Min. Order</th>
                <th style="text-align:center;">Min. Quantity</th>
                <th style="text-align:center;">Max. Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td style="text-align:center;">{{$row[0]}}</td>
                    <td style="text-align:center;">
                    @if($row[1] == 1)
                    SARAN
                    @elseif($row[1] == 2)
                    WAJIB
                    @elseif($row[1] == 3)
                    ARSIP
                    @endif
                    </td>
                    <td style="text-align:center;">{{$row[2]}}</td>
                    <td style="text-align:center;">{{$row[3]}}</td>
                    <td style="text-align:center;">{{$row[4]}}</td>
                    <td style="text-align:center;">{{$row[5]}}</td>
                </tr>
            @endforeach
            <tr>
            </tr>
    </table>

    <div class="col-md-12 mb-2">
        <button type="submit" class="btn btn-success btn-block">
            Import Data
        </button>
    </div>
</form>
<form class="form-horizontal" method="POST" action="{{ url('/batal_import')}}" enctype="multipart/form-data">
{{csrf_field()}}
    <div class="col-md-12">
        <button type="submit" class="btn btn-danger btn-block">
            Batal Import
        </button>
    </div>
</form>
</div>

@endsection