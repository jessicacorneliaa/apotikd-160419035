@extends('layout.conquer')

@section('content')
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">
			Daftar Obat Termahal <small>per Kategori</small>
  </h3>
  <!-- END PAGE HEADER-->
<!-- <div class="container "> -->
<div class="portlet">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Kategori</th>
        <th>Nama Obat</th>
        <th>Harga</th>
      </tr>
    </thead>
    <tbody>
      @foreach($result as $c)
      <tr>
        <td>{{$c->category_name}}</td>  
        <td>{{$c->generic_name}}</td>
        <td>Rp {{$c->max}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

