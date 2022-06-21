@extends('layout.conquer')

@section('content')

  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">
			Daftar Obat
  </h3>
  <!-- END PAGE HEADER-->
  <!-- <div class="container "> -->
    <br>
@if (session('status'))
  <div class="alert alert-success">
      {{session('status')}}
  </div>
@endif
<div>
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Bentuk</th>
        <th>Formula</th>
        <th>Kategori</th>
        <th>Foto</th>
        <th>Harga</th>
        @can('add -permission')
        <th><a href="{{ route('medicines.create') }}" class="btn btn-primary" >Tambah</a></th>
        <th><a href="#modalCreate" data-toggle="modal" class="btn btn-info" >+ Tambah dengan modal</a></th>
        @endcan
      </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
      <tr>
        <td>{{$d->generic_name}}</td>
        <td>{{$d->form}}</td>
        <td>{{$d->restriction_formula}}</td>
        <td>{{$d->category->category_name}}</td>
        <td>
          <img src="{{asset('images/'.$d->image)}}" height="100px">
        </td>
        <td>Rp {{$d->price}}</td>
        <th>
          @can('edit-permission')
          <a href="{{ url('medicines/'.$d->id.'/edit')}}" class="btn btn-warning" >Edit</a>
          @endcan
          
          <form method="POST" action="{{url('medicines/'.$d->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Hapus" class="btn btn-danger" onclick="if(!confirm('Apakah Anda yakin menghapus data {{$d->generic_name}} ?')) return false;">
          </form>
          
        </th>
        <th>
          @can('edit-permission')
          <a href="#modalEdit" data-toggle="modal" class="btn btn-warning" onclick="getEditForm({{$d->id}})">Edit dgn modal</a>
          <a href="#modalEdit" data-toggle="modal" class="btn btn-warning" onclick="getEditForm2({{$d->id}})">Edit dgn modal tanpa refresh</a>
          @endcan
          
          <a class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin menghapus data {{$d->name}}')) deleteDataRemoveTR({{$d->id}});">Hapus dgn modal</a>
        </th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<!-- Daftar Obat dengan Grid Style -->
<div class="container">
  <h2>Daftar Obat</h2>
  <div class="row">
    @foreach($data as $d)
    <div class="col-md-3" style="text-align:center; border:1px solid #999; margin:10px; padding:10px; border-radius:10px;">
        <img src="{{asset('images/'.$d->image)}}" height="200px"><br>
        <a href="/medicines/{{$d->id}}" target="_blank">
          <b>{{$d->generic_name}}</b><br>
          {{$d->form}}
        </a>
    </div>
    @endforeach
</div>
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
       <form method="POST" action="{{url('medicines.create')}}">
       @csrf
          <div class="modal-header">
              <button type="button" class="close" 
                data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Add New Medicine</h4>
          </div>
          <div class="modal-body">           
          <div class="form-body">
                <div class="form-group">
                    <label>Generic name</label>
                    <input type="text" class="form-control" name="generic_name" placeholder="Isikan generic name">
                </div>
                <div class="form-group">
                    <label>Form</label>
                    <input type="text" class="form-control" name="form" placeholder="Isikan form">
                </div>
                <div class="form-group">
                    <label>Restriction formula</label>
                    <input type="text" class="form-control" name="restriction_formula" placeholder="Isikan restriction formula">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Isikan harga">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label >Faskes</label>
                    <div class="checkbox-list">
                        <label class="checkbox-inline">
                        <input type="checkbox" id="faskes1" name="faskes1" value="1"> Faskes 1 </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="faskes2" name="faskes2" value="1"> Faskes 2 </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="faskes3" name="faskes3" value="1"> Faskes 3 </label>
                    </div>
                </div>
                
            </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-info">Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContent">
    <div class="modal-header">
            <button type="button" class="close" 
              data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Edit Medicines</h4>
          </div>
          <div class="modal-body">   
            <div class="d-flex justify-content-center">
              <img src="{{asset('images/preloader.gif')}}" width="200px" class="d-flex justify-content-center">         
            </div> 
            
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-info">Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
    </div>
  </div>
</div>
@endsection

@section('javascript')
<script>

    function getEditForm(id) {
      $.ajax({
          type:'POST',
          url:'{{route("medicines.getEditForm")}}',
          data:{
            '_token': '<?php echo csrf_token() ?>',
            'id': id
          },
          success:function(data) {
              $("#modalContent").html(data.msg);
          }
      });
    }
    
    // edit data dengan modal tanpa refresh page 
    function getEditForm2(id) {
      $.ajax({
          type:'POST',
          url:'{{route("medicines.getEditForm2")}}',
          data:{
            '_token': '<?php echo csrf_token() ?>',
            'id': id
          },
          success:function(data) {
              $("#modalContent").html(data.msg);
          }
      });
    }

    function deleteDataRemoveTR(id) {
      $.ajax({
          type:'POST',
          url:'{{route("medicines.deleteData")}}',
          data:{
            '_token': '<?php echo csrf_token() ?>',
            'id': id
          },
          success:function(data) {
              if(data.status=='OK'){
                alert(data.msg);
                $('#tr_'+id).remove();
              }
              else{
                alert(data.msg);
              }
          }
      });
    }

    function saveDataUpdateTD(id) {
      var eName= $('#eName').val();
      var eAddress= $('#eAddress').val();
      $.ajax({
          type:'POST',
          url:'{{route("medicines.saveData")}}',
          data:{
            '_token': '<?php echo csrf_token() ?>',
            'id': id,
            'name':eName,
            'address':eAddress
          },
          success:function(data) {
              if(data.status=='OK'){
                alert(data.msg);
                $('#td_name_'+id).html(eName);
                $('#td_address_'+id).html(eAddress);
              }
              else{
                alert(data.msg);
              }
          }
      });
    }
</script>
@endsection
