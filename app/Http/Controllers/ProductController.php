<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Session;
use App\Company;
use App\Activity;
use Image;
use App\SellerOffice;
use App\Product;
use PHPExcel_IOFactory;
use Excel;
use App\Promoter;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=product::get();
       
        $company =company::lists('name', 'id');

        return view('product.index',compact('product','company'));   
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
        
         $frontimg = Input::file('frontimg');
         $backimg = Input::file('backimg');

       

        $cement_name=Input::get('cement_name');
        $weight=Input::get('weight');
        $rank=Input::get('rank');
        $company_id=Input::get('company');
        $specifications=Input::get('specifications');
        $guidlines=Input::get('guidlines');
        $security=Input::get('security');
        $others=Input::get('others');
        $producation_date=Input::get('producation_date');
        $packing_date=Input::get('packing_date');



     $res=activity::select('*')
      ->where('goverment',$goverment)
      ->where('city',$city)
      ->where('start_date',$start_date)
      ->where('company_id',$company_id)
      ->where('duration',$duration)
      ->where('activity_type',$activity_type)
      ->where('description',$description)
      ->get();


if(count($res) <=0)
{
         $product = new product;
                $activity->goverment=Input::get('goverment');
                $activity->city=Input::get('city');
                $activity->start_date=Input::get('start_date');
                $activity->company_id=Input::get('company');
                $activity->duration=Input::get('duration');
                $activity->activity_type=Input::get('activity_type');
                $activity->description=Input::get('description');

 if($file!==null)
 {

        $img = Image::make($file)->resize(200,200);
         Response::make($img->encode('jpeg'));
         $activity->img=$img;
 }
        
        
                $activity->save();
                return redirect('/activity');
}

else
{
        
                   Session::flash('error', 'This activity aready exit'); 
                   return redirect('/activity');

}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    try
        { 
            $product = product::find($id);
            $product->delete();
             return redirect('/product');
    }
    catch(Exception $e)
    {
            return redirect('/product');

    }
        
    }

    public function convertXLStoCSV($infile,$outfile)
    {
        $fileType = PHPExcel_IOFactory::identify($infile);
        $objReader = PHPExcel_IOFactory::createReader($fileType);

        $objReader->setReadDataOnly(false);   
        $objPHPExcel = $objReader->load($infile);    

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
        $objWriter->save($outfile);
    }

    public function ValidateProduct($data, $i){
        $GLOBALS['product_valid']=0;        
        if(!isset($GLOBALS['product'])) { $GLOBALS['product']= array(); } 
        if(!isset($ProductErr)) { $ProductErr = 'البيانات غير صحيحة للمنتج: '; } 

        if(!isset($GLOBALS['Emptyproduct'])) { 
            $GLOBALS['Emptyproduct']= array(); 
        } 
        if(!isset($EmptyProductErr)) { 
            $EmptyProductErr = 'اسم المنتج غير موجود للصف رقم: '; 
        }  

        if ($data['cement_name'] == " ") {
            $data['cement_name']= null;
        }
        $name_regex = preg_match('/^[\pL\s]+$/u' , $data['cement_name']);
        $weight_regex = preg_match('/^[-+]?[0-9]*\.?[0-9]*$/' , $data['weight']);
        $rank_regex = preg_match('/^[-+]?[0-9]*\.?[0-9]*$/' , $data['rank']);
        $specifications_regex = preg_match('/^[\pL\s]+$/u' , $data['specifications']);
        $producation_regex = preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/' , $data['production_date']);
        $packing_regex = preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/' , $data['packing_date']);
        $guidlines_regex = preg_match('/^[\pL\s]+$/u' , $data['guidelines']);
        $security_regex = preg_match('/^[\pL\s]+$/u' , $data['first_aid']);
        $others_regex = preg_match('/^[\pL\s]+$/u' , $data['others']);


    if (isset($data['cement_name'])) {
        if ($name_regex == 1 || !isset($data['cement_name'])) { // true name 
            if ($weight_regex == 1 && isset($data['weight'])) { // true weight 
                if ($rank_regex == 1 && isset($data['rank'])) { // true rank 
                    if ($specifications_regex == 1 || !isset($data['specifications'])) { 
                        if ($producation_regex == 1 && isset($data['production_date'])) { 
                            if ($packing_regex == 1 || !isset($data['packing_date'])) { 
                                if ($guidlines_regex == 1 || !isset($data['guidelines']) ) {
                                    if ($security_regex == 1 || !isset($data['first_aid'])) {
                                        if ($others_regex == 1 || !isset($data['others'])) { 

                        $product = new Product();
                        $product->cement_name = $data['cement_name'];
                        $product->weight = $data['weight']; 
                        $product->rank = $data['rank'];
                        $product->specifications = $data['specifications'];
                        $product->producation_date = $data['production_date']; 
                        $product->packing_date = $data['packing_date'];
                        $product->guidlines = $data['guidelines']; 
                        $product->security = $data['first_aid'];
                        $product->others = $data['others'];
                        $product->frontimg = $data['front_image']; 
                        $product->backimg = $data['back_image'];

    if(isset($data['company_name'])){
        $comp_id= Company::where('name',$data['company_name'])->pluck('id')->first();
    }       
                        $product->company_id = $comp_id;
                        
                    try{
                        $product->save(); // save product
                        $GLOBALS['product_valid']=1;
                    }   
                    catch (\Exception $e) { //update product
                        $repeted = $comp_id."-".$data['cement_name'];
                        $exist_string= "Duplicate entry '".$repeted."' for key 'product_company_id_cement_name_unique'";
                        if ($exist_string == $e->errorInfo[2]) {  // product exist 
                            
                            $product_id= DB::table('product')
                                        ->where('cement_name',$data['cement_name'])
                                        ->where('company_id',$comp_id)
                                        ->pluck('id');
                            $updated_product = Product::find($product_id[0]);                  
                            $updated_product->cement_name = $data['cement_name'];
                            $updated_product->weight = $data['weight']; 
                            $updated_product->rank = $data['rank'];
                            $updated_product->specifications = $data['specifications'];
                            $updated_product->producation_date = $data['production_date']; 
                            $updated_product->packing_date = $data['packing_date'];
                            $updated_product->guidlines = $data['guidelines']; 
                            $updated_product->security = $data['first_aid'];
                            $updated_product->others = $data['others'];
                            $updated_product->frontimg = $data['front_image']; 
                            $updated_product->backimg = $data['back_image'];                  
                            $updated_product->save();

                            $GLOBALS['product_valid']=1;

                        }
                    }  // end catch

                                        }

                                        else {
                                            array_push($GLOBALS['product'],$data['cement_name']); 
                                        }                                        
                                    }
                                    else {
                                        array_push($GLOBALS['product'],$data['cement_name']);
                                    }                                
                                }
                                else {
                                    array_push($GLOBALS['product'],$data['cement_name']); 
                                }          
                            }
                            else {
                                array_push($GLOBALS['product'],$data['cement_name']); 
                            }                        
                        }
                        else {
                            array_push($GLOBALS['product'],$data['cement_name']); 
                        }                 
                    }
                    else {
                        array_push($GLOBALS['product'],$data['cement_name']); 
                    } 
                }
                else {
                    array_push($GLOBALS['product'],$data['cement_name']); 
                }           
            }
            else {
                array_push($GLOBALS['product'],$data['cement_name']); 
            }    
        }
        else {
            array_push($GLOBALS['product'],$data['cement_name']); 
        }
    }
    else {
         array_push($GLOBALS['Emptyproduct'],$i); 
    }

    if ( !empty ($GLOBALS['Emptyproduct'] )) {
            $GLOBALS['Emptyproduct'] = array_unique($GLOBALS['Emptyproduct']);
            $EmptyProductErr= $EmptyProductErr.implode(" \n ",$GLOBALS['Emptyproduct']);
            $EmptyProductErr = nl2br($EmptyProductErr);  
            $cookie_name = 'EmptyProductErr';
            $cookie_value = $EmptyProductErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }
        if ( !empty ($GLOBALS['product'] )) {
            $GLOBALS['product'] = array_unique($GLOBALS['product']);
            $ProductErr = $ProductErr.implode(" \n ",$GLOBALS['product']);
            $ProductErr = nl2br($ProductErr);  
            $cookie_name = 'ProductErr';
            $cookie_value = $ProductErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }


}

    public function importproduct() {
        if(!Input::file('file')){  //if no file selected  
                $errFile = "الرجاء اختيار الملف الملطلوب تحميلة";                
                $cookie_name = 'FileError';
                $cookie_value = $errFile;
                setcookie($cookie_name, $cookie_value, time() + (60), "/"); 
                return redirect('/product');
            } 
        unset ($_COOKIE['FileError']);
        $importbtn= Request::get('submit'); 
        if(isset($importbtn))
        {   
            $filename = Input::file('file')->getClientOriginalName();            
            $Dpath = base_path();
            $upload_success =Input::file('file')->move( $Dpath, $filename); 

            // xls to csv conversion
            $nameOnly = explode(".",$filename);
            $newCSV =$nameOnly[0]."."."csv";
            $PathnewCSV= $Dpath."/".$newCSV ;
            $myfile = fopen($PathnewCSV, "w");
            
        app('App\Http\Controllers\ProductController')->convertXLStoCSV($upload_success, $PathnewCSV);

        Excel::filter('chunk')->selectSheetsByIndex(0)->load($PathnewCSV)->chunk(150, function($results){ 
                    $data = $results->toArray();
                    $i=0;
                foreach($data as $data) {
                    $i+=1;
                    //validate company
                    app('App\Http\Controllers\CompanyController')->ValidateCompany($data,$i);
                   
                    if ($GLOBALS['company_valid'] == 1 ) {
                        //validate office
                        app('App\Http\Controllers\SellerOfficeController')->ValidateOffice($data,$i);
                         //validate product
                        if ($GLOBALS['office_valid'] == 1) {
                            app('App\Http\Controllers\ProductController')->ValidateProduct($data,$i);
                            //validate promoter
                            if ($GLOBALS['product_valid'] == 1) {
                                app('App\Http\Controllers\PromoterController')->ValidatePromoter($data,$i);

                            }
                        }
                    }                       

                    } // end foreach data
            });
            //remove temperorary csv file
            unlink($PathnewCSV);   
        } 
        return redirect('/product');  

    }


}
