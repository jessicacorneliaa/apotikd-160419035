@extends('layout.conquer')

@section('content')
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">
			Daftar Supplier
  </h3>
  <!-- END PAGE HEADER-->
<!-- <div class="container "> -->
 
@if (session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Address</th>
        <th><a href="{{ route('suppliers.create') }}" class="btn btn-primary" >Tambah</a></th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
      <tr>
        <td>{{$d->name}}</td>
        <td>{{$d->address}}</td> 
        <th>
          <a href="{{ url('suppliers/'.$d->id.'/edit')}}" class="btn btn-warning" >Edit</a>
          <form method="POST" action="{{url('suppliers/'.$d->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Hapus" class="btn btn-danger" onclick="if(!confirm('Apakah Anda yakin menghapus data {{$d->name}}')) return false;">
          </form>
        </th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
