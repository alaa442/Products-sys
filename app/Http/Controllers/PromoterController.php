<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Promoter;
use Request;
use Excel;
use Input;
use File;
use Validator;
use DB;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Datatables;
use Illuminate\View\Middleware\ErrorBinder;
use Exception;


class PromoterController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
 	{  

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($Pormoter_Id)
	{  

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)

	{  
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($Pormoter_Id)

	{ 
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
	}

	public function ValidatePromoter($data, $i){
		$GLOBALS['promoter_valid']=0;        
        if(!isset($GLOBALS['promoter'])) { $GLOBALS['promoter']= array(); }     
        if(!isset($PromoterErr)) { $PromoterErr = 'البيانات غير صحيحة للمندوب: '; }      
         
        if(!isset($GLOBALS['EmptyPromoter'])) { 
            $GLOBALS['EmptyPromoter']= array(); 
        } 
        if(!isset($EmptyPromoterErr)) { 
            $EmptyPromoterErr = 'اسم المندوب غير موجود للصف رقم: '; 
        }   

        $name_regex = preg_match('/^[\pL\s]+$/u' , $data['promoter_name']);
        $gov_regex = preg_match('/^[\pL\s]+$/u' , $data['promoter_gov']);
        $city_regex = preg_match('/^[\pL\s]+$/u' , $data['promoter_city']);

    if(isset($data['promoter_name'])){
        if ($name_regex == 1) { // true name
        	if ($gov_regex == 1) { // true gov
        		if ($city_regex == 1) { // true city
        			$promoter = new Promoter();
        			$promoter->Pormoter_Name = $data['promoter_name'];
                    $promoter->Government = $data['promoter_gov'];
                    $promoter->City = $data['promoter_city']; 
                    try{
                    	$promoter->save();  
                    	}
                    catch (\Exception $e) {
                    	// dd($e);
                    	$exist_string= "Duplicate entry '".$data['promoter_name']."' for key 'promoter_pormoter_name_unique'";
                        if ($exist_string == $e->errorInfo[2]) {  // promoter exist 
                        	$pro_id= Promoter::where('Pormoter_Name',$data['promoter_name'])
                                        ->pluck('id')->first();
	                        $updated_pro = Promoter::find($pro_id);
	                        $updated_pro->Pormoter_Name =  $data['promoter_name'];
	                        $updated_pro->Government = $data['promoter_gov'];
	                        $updated_pro->City = $data['promoter_city'];
	                        $updated_pro->save();
                        }
                    }     
		        }
		        else {
		        	array_push($GLOBALS['promoter'],$data['promoter_name']); 
		        }          	
	        }
	        else {
	        	array_push($GLOBALS['promoter'],$data['promoter_name']); 
	        }        
        }
        else {
        	array_push($GLOBALS['promoter'],$data['promoter_name']); 
        } 
    }
    else {
    	array_push($GLOBALS['EmptyPromoter'],$i); 
    }

    if ( !empty ($GLOBALS['EmptyPromoter'] )) {
            $GLOBALS['EmptyPromoter'] = array_unique($GLOBALS['EmptyPromoter']);
            $EmptyPromoterErr= $EmptyPromoterErr.implode(" \n ",$GLOBALS['EmptyPromoter']);
            $EmptyPromoterErr = nl2br($EmptyPromoterErr);  
            $cookie_name = 'EmptyPromoterErr';
            $cookie_value = $EmptyPromoterErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }
        if ( !empty ($GLOBALS['promoter'] )) {
            $GLOBALS['promoter'] = array_unique($GLOBALS['promoter']);
            $PromoterErr = $PromoterErr.implode(" \n ",$GLOBALS['promoter']);
            $PromoterErr = nl2br($PromoterErr);  
            $cookie_name = 'PromoterErr';
            $cookie_value = $PromoterErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }

} // function end

	
 
   
}

?>