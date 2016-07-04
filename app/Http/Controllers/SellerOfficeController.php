<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\SellerOffice;
use App\Company;
use App\Product;

use Input;
use Validator;
use DB;

class SellerOfficeController extends Controller
{
   	public function index(Request $request)
	{
    try {
     $selleroffice = selleroffice::all();

     $company =company::lists('name', 'id');
       $cement =product::lists('cement_name', 'id');

            return view('selleroffice/index',compact('selleroffice','company','cement'));
}
	catch(Exception $e)	
	{
		return redirect('/');
	}
	}
	public function telephone()
	{ 
		$telephone=Input::get('telephone');
		 $res = DB::table('selleroffice')
            ->select('telephone')
            ->where('telephone','=',$telephone)
            ->get(); 

   if (count($res)<= 0)

     return \Response::json(true);
   else
  return \Response::json( false);
}
	public function destroy($id)
	{
		try
		{ $selleroffice = selleroffice::find($id);
		$selleroffice->delete();
		return redirect('/selleroffice');
	}
	catch(Exception $e)
	{
			return redirect('/selleroffice');

	}
		
	}
		 	public function create()
	{
		return view('selleroffice.create');
	}
public function store()
 {     


        $selleroffice= new selleroffice;
        $cement=Input::get('cement');
         // dd($cement);
		$selleroffice->goverment =Input::get('goverment');
		$selleroffice->city =Input::get('city');
		$selleroffice->telephone =Input::get('telephone');
		$selleroffice->street =Input::get('adress');
	      

				       
	              
	        
		$selleroffice->company_id =Input::get('company');
		$selleroffice->save();
		
	    $selleroffice->getsellerofficeproduct()->attach($cement);

   

     return redirect('/selleroffice'); 
		
	
}

		public  function fupdate()
	{
			$selleroffice = Input::get('pk');	
        $column_name = Input::get('name');
        $column_value = Input::get('value');
    
        $userData = selleroffice::whereId($selleroffice)->first();

       $userData-> $column_name=$column_value;


        if($userData->save()) 
        return \Response::json(array('status'=>1));
    else 
        return \Response::json(array('status'=>0));
 
	}
 
	
	public function ValidateOffice($data, $i){
		$GLOBALS['office_valid']=0;
		if(!isset($GLOBALS['office'])) { $GLOBALS['office']= array(); } 
        if(!isset($OfficeErr)) { 
        	$OfficeErr = 'البيانات غير صحيحة لمكتب البيع صاحب رقم التليفون: '; 
        }      

        if(!isset($GLOBALS['Emptyoffice'])) { 
            $GLOBALS['Emptyoffice']= array(); 
        } 
        if(!isset($EmptyOfficeErr)) { 
            $EmptyOfficeErr = 'رقم تليفون مكتب البيع غير موجود للصف رقم: '; 
        }   

		$gov_regex = preg_match('/^[\pL\s]+$/u' , $data['office_gov']);
        $city_regex = preg_match('/^[\pL\s]+$/u' , $data['office_city']);
        $phone_regex = preg_match('/^[0-9]{10,11}$/' , $data['phone']);

        if ($data['phone'] == " ") {
            $data['phone']= null;
        }

    if (isset($data['phone'])) {
        if ($gov_regex == 1 && isset($data['office_gov'])) { // true government 
        	if ($city_regex == 1 && isset($data['office_city'])) { // true city 
        		if ($phone_regex == 1){				// true phone 
        			$office = new SellerOffice();
			        $office->goverment = $data['office_gov'];
			        $office->city = $data['office_city']; 
			        $office->telephone = $data['phone'];
			    	if(isset($data['company_name'])){
			        	$comp_id= Company::where('name',$data['company_name'])
			        						->pluck('id')->first();
			    	}       
			        $office->company_id = $comp_id;
			        try{
			        	$office->save();
			        	$GLOBALS['office_valid']=1;
			        }
			        catch (\Exception $e){
			        	$exist_string= "Duplicate entry '".$data['phone']."' for key 'selleroffice_telephone_unique'";
                        if ($exist_string == $e->errorInfo[2]) {  // company exist 
                            $office_id= SellerOffice::where('telephone',$data['phone'])
                                        ->pluck('id')->first();
                            $updated_office = SellerOffice::find($office_id);
                            $updated_office->goverment =  $data['office_gov'];
                            $updated_office->city = $data['office_city'];
                            $updated_office->telephone = $data['phone'];
                            $updated_office->save();
                            $GLOBALS['office_valid']=1;
                        }
			        }
        		}
        		else {
        			array_push($GLOBALS['office'],$data['phone']); 
        		}
        	}
        	else {
        		array_push($GLOBALS['office'],$data['phone']); 
        	}

        }
        else {
        	array_push($GLOBALS['office'],$data['phone']); 
        }

	} // if isset phone
	else {
		array_push($GLOBALS['Emptyoffice'],$i); 
	}

	if ( !empty ($GLOBALS['Emptyoffice'] )) {
            $GLOBALS['Emptyoffice'] = array_unique($GLOBALS['Emptyoffice']);
            $EmptyOfficeErr= $EmptyOfficeErr.implode(" \n ",$GLOBALS['Emptyoffice']);
            $EmptyOfficeErr = nl2br($EmptyOfficeErr);  
            $cookie_name = 'EmptyOfficeErr';
            $cookie_value = $EmptyOfficeErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }
        if ( !empty ($GLOBALS['office'] )) {
            $GLOBALS['office'] = array_unique($GLOBALS['office']);
            $OfficeErr = $OfficeErr.implode(" \n ",$GLOBALS['office']);
            $OfficeErr = nl2br($OfficeErr);  
            $cookie_name = 'OfficeErr';
            $cookie_value = $OfficeErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }

}	//function end


}
