@extends('layout.conquer')

@section('content')

<div class="container">
  <h2>Detail Obat</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Data</th>
        <th>Isi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Nama</td>
        <td>{{$data->generic_name}}</td>
      </tr>
      <tr>
        <td>Bentuk</td>
        <td>{{$data->form}}</td>
      </tr>
      <tr>
          <td>Formula</td>
          <td>{{$data->restriction_formula}}</td>
      </tr>
      <tr>
          <td>Kategori</td>
          <td>{{$data->category->category_name}}</td>
      </tr>
      <tr>
          <td>Foto </td>
          <td><img src="{{asset('images/'.$data->image)}}"></td>
      </tr>
      <tr>
          <td>Harga</td>
          <td>Rp {{$data->price}}</td>
      </tr>      
    </tbody>
  </table>
</div>
@endsection
