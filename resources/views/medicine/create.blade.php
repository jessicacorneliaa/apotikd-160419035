@extends('layout.conquer')

@section('content')
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">
			Form Tambah Obat
  </h3>
  <!-- END PAGE HEADER-->
<!-- <div class="container "> -->
 
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Isikan data obat
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{url('medicines')}}">
            @csrf
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
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option>---- Pilih ----</option>
                        @foreach($result as $c)
                        <option value="{{$c->id}}">{{$c->category_name}}</option>
                        @endforeach
                       
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-info">Submit</button>
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endsection
