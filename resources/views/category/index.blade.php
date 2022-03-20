@extends('layout.conquer')

@section('content')
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">
			Daftar Kategori Obat
  </h3>
  <!-- END PAGE HEADER-->
<!-- <div class="container "> -->
 
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Obat-obat</th>
      </tr>
    </thead>
    <tbody>
      @foreach($result as $c)
      <tr>
        <td>{{$c->category_name}}</td>
        <td>{{$c->description}}</td> 
      </tr>
      <tr>
        <td colspan="2">
          <!-- @foreach($c->medicines as $m)
            {{$m->generic_name}} ({{$m->form}}) <br>
          @endforeach -->
          <div class="row">
            @foreach($c->medicines as $m)
            <div class="col-md-3" style="text-align:center; border:1px solid #999; margin:10px; padding:10px; border-radius:10px;">
                <img src="{{asset('images/'.$m->image)}}" height="120px"><br>
                <b>{{$m->generic_name}}</b><br>
                {{$m->form}}
            </div>
            @endforeach
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
