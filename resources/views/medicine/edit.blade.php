@extends('layout.conquer')

@section('content')
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">
			Form Ubah Obat
  </h3>
  <!-- END PAGE HEADER-->
<!-- <div class="container "> -->
 
<div class="portlet">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder"></i> Ubah data obat
        </div>
        <div class="tools">
            <a href="" class="collapse"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <form method="POST" action="{{url('medicines/'.$data->id)}}">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group">
                    <label>Generic name</label>
                    <input type="text" class="form-control" name="generic_name" placeholder="Isikan generic name" value="{{$data->generic_name}}">
                </div>
                <div class="form-group">
                    <label>Form</label>
                    <input type="text" class="form-control" name="form" placeholder="Isikan form" value="{{$data->form}}">
                </div>
                <div class="form-group">
                    <label>Restriction formula</label>
                    <input type="text" class="form-control" name="restriction_formula" placeholder="Isikan restriction formula" value="{{$data->restriction_formula}}">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Isikan harga" value="{{$data->price}}">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3">{{$data->description}}</textarea>
                </div>
                <div class="form-group">
                    <label >Faskes</label>
                    <div class="checkbox-list">
                        <label class="checkbox-inline">
                        <input type="checkbox" id="faskes1" name="faskes1" value="1" {{ ($data->faskes1 == 1 ? ' checked' : '')}}> Faskes 1 </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="faskes2" name="faskes2" value="1" {{ ($data->faskes2 == 1 ? ' checked' : '')}}> Faskes 2 </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="faskes3" name="faskes3" value="1" {{ ($data->faskes3 == 1 ? ' checked' : '')}}> Faskes 3 </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        <option value="{{$data->category_id}}">{{$kategori->category_name}}</option>
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
