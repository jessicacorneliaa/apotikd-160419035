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

<div>
  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Address</th>
        <th><a href="{{ route('suppliers.create') }}" class="btn btn-primary" >Tambah</a></th>
        <th><a href="#modalCreate" data-toggle="modal" class="btn btn-info" >+ Tambah dengan modal</a></th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
      <tr id="tr_{{$d->id}}">
        <td id="td_name_{{$d->id}}s">{{$d->name}}</td>
        <td ID="td_address_{{$d->id}}">{{$d->address}}</td> 
        <th>
          <a href="{{ url('suppliers/'.$d->id.'/edit')}}" class="btn btn-warning" >Edit</a>
          <form method="POST" action="{{url('suppliers/'.$d->id)}}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Hapus" class="btn btn-danger" onclick="if(!confirm('Apakah Anda yakin menghapus data {{$d->name}}')) return false;">
          </form>
        </th>
        <th>
          <a href="#modalEdit" data-toggle="modal" class="btn btn-warning" onclick="getEditForm({{$d->id}})">Edit dgn modal</a>
          <a href="#modalEdit" data-toggle="modal" class="btn btn-warning" onclick="getEditForm2({{$d->id}})">Edit dgn modal tanpa refresh</a>
          <a class="btn btn-danger" onclick="if(confirm('Apakah Anda yakin menghapus data {{$d->name}}')) deleteDataRemoveTR({{$d->id}});">Hapus dgn modal</a>
        </th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="modal fade" id="modalCreate" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" >
       <form method="POST" action="{{url('suppliers')}}">
       @csrf
          <div class="modal-header">
              <button type="button" class="close" 
                data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Add New Supplier</h4>
          </div>
          <div class="modal-body">           
              <div class="form-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" name="name" placeholder="Isikan nama supplier">
                      <span class="help-block">*tulis nama lengkap perusahaan</span>
                  </div>
                  <div class="form-group">
                      <label>Address</label>
                      <textarea class="form-control" name="address" rows="3"></textarea>
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
            <h4 class="modal-title">Edit Supplier</h4>
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
          url:'{{route("suppliers.getEditForm")}}',
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
          url:'{{route("suppliers.getEditForm2")}}',
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
          url:'{{route("suppliers.deleteData")}}',
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
          url:'{{route("suppliers.saveData")}}',
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