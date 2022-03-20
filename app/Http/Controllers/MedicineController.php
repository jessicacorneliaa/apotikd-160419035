<?php

namespace App\Http\Controllers;

use App\Category;
use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // raw query
        // $result= DB::select(DB::raw("SELECT * from medicines"));
        
        // query bulder
        // $result= DB::table("medicines")->get();

        // eloquent model
        $result= Medicine::all();
        // dd($result);

        // return view('medicine.index', compact('result'));
        return view('medicine.index', ["data"=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        $data= $medicine;
        return view("medicine.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function coba1(){
        // Query builder Filter
        $result= DB::table('medicines')
                ->where('price','>','20000')
                ->get();
                
        $result= DB::table('medicines')
                ->where('generic_name','like','%fen')
                ->get();

        // Query builder GroupBy
        $result= DB::table('medicines')
                ->select('generic_name')
                ->groupBy('generic_name')
                ->get();
                
        // Query builder Aggregate
        $result= DB::table('medicines')->count();
        $result= DB::table('medicines')->max('price');

        // Query builder Filter + Aggregate
        $result= DB::table('medicines')
                ->where('generic_name', 'like', '%fen')
                ->avg('price');

        // Query builder Join
        $result= DB::table('medicines')
                ->join('categories', 'medicines.category_id', '=', 'categories.id')
                ->get();
        
        // Query builder OrderBy
        $result= DB::table('medicines')
                ->join('categories', 'medicines.category_id', '=', 'categories.id')
                ->orderBy('price', 'desc')
                ->get();

        // Eloquent
        $result= Medicine::where('price', '>', 20000)
                ->get();

        $result= Medicine::find(3);
        dd($result);
    }

    public function coba2(Medicine $medicine){
        // query 1 Table
        // 1.
        $result= Category::all();
        $result= DB::table('categories')->get();
        // 2.
        $result= DB::table('medicines')
                ->select('generic_name', 'form', 'price')
                ->get();
        $result=Medicine::all('generic_name', 'form', 'price');

        // query inner join 2 tables
        // 1.
        $result=DB::table('medicines')
                    ->select('generic_name', 'form', 'categories.category_name')
                    ->join('categories', 'medicines.category_id', '=', 'categories.id')
                    ->get();
        $result= $medicine;

        // there is an aggregation of sum, count with 2 tables
        // 1.
        $result= DB::table('medicines')
                    ->distinct('category_id')
                    ->count('category_id');
                    
        $result2= Medicine::distinct('category_id')->count('category_id');
        // 2.
        $result= DB::table('categories')
                    ->whereNotExists(function($query){
                        $query->select('medicines.category_id')
                        ->from('medicines')
                        ->where('categories.id', '=', 'medicines.category_id');
                    })
                    ->get('category_name');

        $result= Category::whereNotExists(function($query){
                $query->select('medicines.category_id')
                    ->from('medicines')
                    ->where('categories.id', '=', 'medicines.category_id');
                })
                ->get('category_name');
        // 3.
        // select C.id, ifnull(M.average, 0) 
        // from (SELECT categories.id FROM categories) C 
        // LEFT JOIN (select medicines.category_id, avg(medicines.price) as average from medicines group by medicines.category_id) M
        // ON C.id = M.category_id;      
        $result= DB::query()->fromSub(function ($query) {
                    $query->select('categories.id')
                            ->from('categories'); }, 'C')
                    ->leftJoin(DB::raw("(select medicines.category_id, avg(medicines.price) as average from medicines group by medicines.category_id) as M"),function($join){
                        $join->on('C.id', '=', 'M.category_id');
                    })
                    ->get(DB::raw('ifnull(M.average,0) as average'));
        $result= Category::query()->fromSub(function ($query) {
                    $query->select('categories.id')
                            ->from('categories'); }, 'C')
                    ->leftJoin(DB::raw("(select medicines.category_id, avg(medicines.price) as average from medicines group by medicines.category_id) as M"),function($join){
                        $join->on('C.id', '=', 'M.category_id');
                    })
                    ->get(DB::raw('ifnull(M.average,0) as average'));

        // 4.
        $result= DB::table('categories')
                    ->join('medicines','categories.id','=','medicines.category_id')
                    ->groupBy('categories.id')
                    ->having(DB::raw('count(medicines.category_id)'),'=','1')
                    ->get('categories.category_name');

        $result= Category:: join('medicines','categories.id','=','medicines.category_id')
                    ->groupBy('categories.id')
                    ->having(DB::raw('count(medicines.category_id)'),'=','1')
                    ->get('categories.category_name');
        // 5.
        // select generic_name from medicines 
        // GROUP by generic_name
        // having count(generic_name) =1;
        $result= DB::table('medicines')
                    ->groupBy('generic_name')
                    ->having(DB::raw('count(generic_name)'),'=','1')
                    ->get('generic_name');

        $result= Medicine::groupBy('generic_name')
                    ->having(DB::raw('count(generic_name)'),'=','1')
                    ->get('generic_name'); 
        //  6.
        // select categories.category_name, medicines.generic_name, max(medicines.price) as max_price
        // from medicines INNER JOIN categories on categories.id=medicines.category_id
        // GROUP BY categories.category_name
        // order by max_price desc
        // limit 1;
        $result= DB::table('medicines')
                    ->select('categories.category_name', 'medicines.generic_name', DB::raw('max(medicines.price) as max'))
                    ->join('categories','categories.id','=','medicines.category_id')
                    ->groupBy('categories.category_name')
                    ->orderBy(DB::raw('max(medicines.price)'),'desc')
                    ->limit(1)
                    ->get();
        $result= Medicine::join('categories','categories.id','=','medicines.category_id')
                    ->groupBy('categories.category_name')
                    ->orderBy(DB::raw('max(medicines.price)'),'desc')
                    ->limit(1)
                    ->get('categories.category_name', 'medicines.generic_name', DB::raw('max(medicines.price)'));

        $result= DB::table('medicines')
                ->select('categories.category_name', 'medicines.generic_name', DB::raw('max(medicines.price) as max'))
                ->join('categories','categories.id','=','medicines.category_id')
                ->groupBy('categories.category_name')
                ->orderBy('max','desc')
                ->get();

        $result= Medicine:: select('categories.category_name', 'medicines.generic_name', DB::raw('max(medicines.price) as max'))
                ->join('categories', 'medicines.category_id', '=', 'categories.id')
                ->groupBy('categories.category_name')
                ->orderBy('max','desc')
                ->get();
        return view("medicine.highest_drug_price", compact('result'));
    }

    public function showlist($id_category){
        $data= Category::find($id_category);
        $namecategory= $data->category_name;
        $result= $data->medicines;

        if($result) $get_total_data= $result->count();
            else $get_total_data= 0;
        
        return view('report.list_medicines_by_category', compact('id_category', 'namecategory', 'result', 'get_total_data'));
    }
}
