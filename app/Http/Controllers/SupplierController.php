<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data= Supplier::all();
        return view('supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data= new Supplier();
        $data->name= $request->get('name');
        $data->address= $request->get('address');
        $data->save();
        // redirect()->action('SupplierController@index');
        return redirect()->route('suppliers.index')->with('status', 'Data baru berhasil tersimpan');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        // dd($supplier);
        $data= $supplier;
        return view('supplier.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        // dd($request);
        $supplier->name= $request->get('name');
        $supplier->address= $request->get('address');
        $supplier->save();
        return redirect()->route('suppliers.index')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $this->authorize('delete-permission');
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('status', 'Data berhasil dihapus');
    }

    public function getEditForm(Request $request)
    {
        $id= $request->get('id');
        $data= Supplier::find($id);
        return response()->json(array(
            'status'=>'OK',
            'msg'=>view('supplier.getEditForm', compact('data'))->render()
        ), 200);
    }

    // edit data dengan modal tanpa refresh
    public function getEditForm2(Request $request)
    {
        $id= $request->get('id');
        $data= Supplier::find($id);
        return response()->json(array(
            'status'=>'OK',
            'msg'=>view('supplier.getEditForm2', compact('data'))->render()
        ), 200);
    }

    public function deleteData(Request $request)
    {
        $id= $request->get('id');
        $data= Supplier::find($id);
        $data->delete();
        return response()->json(array(
            'status'=>'OK',
            'msg'=>'Berhasil menghapus data '.$data->name
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id= $request->get('id');
        $data= Supplier::find($id);
        $data->name= $request->get('name');
        $data->address= $request->get('address');
        $data->save();
        return response()->json(array(
            'status'=>'OK',
            'msg'=>'Data '.$data->name.' berhasil diubah'
        ), 200);
    }
}
