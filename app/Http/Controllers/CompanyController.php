<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Company;
use Input;
use Request;
use Excel;
use Validator;
use PHPExcel_IOFactory;
use Redirect;
use DB;
use App\SellerOffice;
use App\Product;

class CompanyController extends Controller
{
    public  function fupdate()
    {
        $comp_id = Input::get('pk');  
        $column_name = Input::get('name');
        $column_value = Input::get('value');    
        $compData = Company::whereId($comp_id)->first();  
        $compData-> $column_name=$column_value;
    
        if($compData->save()) 
            return \Response::json(array('status'=>1));
        else 
            return \Response::json(array('status'=>0));
    }

    public function index()
    	{
    		$companies =  Company::all();
            return view('company.index', compact('companies'));
        }

    public function create()
    	{
            return view('company.create');        
    	}

    public function store()
    	{
            $rules = array(
                'name' => array('required','regex:/^[\pL\s]+$/u'),
                'gov' => array('required','regex:/^[\pL\s]+$/u'),
                'city' => array('required','regex:/^[\pL\s]+$/u'),
            );

            $messages = array(
                'required' => 'برجاء ادخال البيانات',
                'unique'=> 'هذه القيم مكررة',
                'name.regex'    =>'الرجاء ادخال الاسم صحيح',
                'gov.regex' =>'الرجاء ادخال المحافظة صحيح',
                'city.regex'    =>'الرجاء ادخال المركز صحيح',
            );

            $validator = Validator::make(Input::all(),$rules,$messages);
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator);     
		    }

		    else {
	            $company = new Company;
	            $company->name = Request::get('name');
	            $company->goverment = Request::get('gov');
	            $company->city = Request::get('city');
	            $company->save();
	            return redirect('/company'); 
	        }            
    	}

    public function destroy($id)
    	{
        	$company = Company::find($id);
        	$company->delete();
        	return redirect('/company');
    	}
   	public function edit($id)
    	{ 
            $company = Company::find($id);
            return view('company.edit',compact('company'));
        
    	}
    public function update($id)
    	{ 
        	$company = Company::find($id);
            $company->name = Request::get('name');
            $company->goverment = Request::get('gov');
            $company->city = Request::get('city');
            $company->save();
            return redirect('/company'); 
        
    	}
    public function show($id)
    {
            $company = Company::findOrFail($id);
            return view('company.show',compact('company'));      
    }

    public function ValidateCompany($data, $i){ 
        $GLOBALS['company_valid']=0;        
        if(!isset($GLOBALS['company'])) { $GLOBALS['company']= array(); } 
        if(!isset($GLOBALS['Emptycompany'])) { 
            $GLOBALS['Emptycompany']= array(); 
        } 
        if(!isset($CompanyErr)) { $CompanyErr = 'البيانات غير صحيحة للشركة: '; }      
        if(!isset($EmptyCompanyErr)) { 
            $EmptyCompanyErr = 'اسم الشركة غير موجود للصف رقم: '; 
        }   

        $name_regex = preg_match('/^[\pL\s]+$/u' , $data['company_name']);
        $gov_regex = preg_match('/^[\pL\s]+$/u' , $data['company_gov']);
        $city_regex = preg_match('/^[\pL\s]+$/u' , $data['company_city']);
    
        if ($data['company_name'] == " ") {
            $data['company_name']= null;
        }

    if ($data['company_name'] != null) { // company has name
        if ($name_regex == 1) { // true name 
        	if ($gov_regex == 1 && isset($data['company_gov'])) { // true government 
        		if ($city_regex == 1 && isset($data['company_city'])) { // true city 
        			$company =new Company();
			        $company->name = $data['company_name'];
			        $company->goverment = $data['company_gov'];
			        $company->city = $data['company_city']; 
                    try{   // true company
                        $company->save(); // true company
                        $GLOBALS['company_valid']=1;
                    }  
                    catch (\Exception $e) { // update company
                        $exist_string= "Duplicate entry '".$data['company_name']."' for key 'company_name_unique'";
                        if ($exist_string == $e->errorInfo[2]) {  // company exist 
                            $Comp_Id= Company::where('name',$data['company_name'])
                                        ->pluck('id')->first();
                            $updated_comp = Company::find($Comp_Id);
                            $updated_comp->name =  $data['company_name'];
                            $updated_comp->goverment = $data['company_gov'];
                            $updated_comp->city = $data['company_city'];
                            $updated_comp->save();
                            $GLOBALS['company_valid']=1;
                        }
                    }
        		}
        		else {
        			array_push($GLOBALS['company'],$data['company_name']); 
        		}
        	}
        	else {
        			array_push($GLOBALS['company'],$data['company_name']); 
        		}
        }
        else {
        		array_push($GLOBALS['company'],$data['company_name']); 
        	}   
    }
    else {
            array_push($GLOBALS['Emptycompany'],$i); 
        } 

    if ( !empty ($GLOBALS['Emptycompany'] )) {
            $GLOBALS['Emptycompany'] = array_unique($GLOBALS['Emptycompany']);
            $EmptyCompanyErr= $EmptyCompanyErr.implode(" \n ",$GLOBALS['Emptycompany']);
            $EmptyCompanyErr = nl2br($EmptyCompanyErr);  
            $cookie_name = 'EmptyCompanyErr';
            $cookie_value = $EmptyCompanyErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }
        if ( !empty ($GLOBALS['company'] )) {
            $GLOBALS['company'] = array_unique($GLOBALS['company']);
            $CompanyErr = $CompanyErr.implode(" \n ",$GLOBALS['company']);
            $CompanyErr = nl2br($CompanyErr);  
            $cookie_name = 'CompanyErr';
            $cookie_value = $CompanyErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
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

    public function importcompany()
    {    
    	ini_set('max_execution_time', 300);
		$GLOBALS['company']= array();   
 		
 		if(!Input::file('file')){  //if no file selected  
                $errFile = "الرجاء اختيار الملف الملطلوب تحميلة";                
                $cookie_name = 'FileError';
                $cookie_value = $errFile;
                setcookie($cookie_name, $cookie_value, time() + (60), "/"); 
                return redirect('/company');
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
            
        app('App\Http\Controllers\CompanyController')->convertXLStoCSV($upload_success, $PathnewCSV);

        Excel::filter('chunk')->selectSheetsByIndex(0)->load($PathnewCSV)->chunk(150, function($results){ 
                    $i=0;
                    $data = $results->toArray();
                    foreach($data as $data) {
                        $i+=1;
                        app('App\Http\Controllers\CompanyController')->ValidateCompany($data,$i);
                    }
            });
            //remove temperorary csv file
            unlink($PathnewCSV);   
        } 
        return redirect('/company');            
    } 

    public function exportcompany()
    {
        $exportbtn=Request::get('export');
        if(isset($exportbtn))
        {             
        	Excel::create('companies file', function($excel)
        	{
            	$excel->sheet('sheetname',function($sheet)
            	{        
      			$sheet->appendRow(1, array('اسم الشركة','المحافظة','المركز','مركز البيع','منتجات الشركة','الانشطة لتسويقية للشركة'));
                $data=[];
                $companies=Company::all();
                
                $Comp_office ="";
                $Comp_product ="";
                $Comp_activity ="";
          		foreach ($companies as $company)
           		{   
                    foreach($company->selleroffice as $office) {
                       $Comp_office =$Comp_office."  ".$office->city."-".$office->goverment;
                    }
                    foreach($company->product as $product) {
                        $Comp_product=$Comp_product."  ".$product->cement_name;
                    } 
                    foreach($company->activity as $activity) {
                        $Comp_activity=$Comp_activity."  ".$activity->activity_type;
                    }  
		            array_push($data,array(
		                $company->name,
		                $company->goverment,
		                $company->city,
                        $Comp_office,
                        $Comp_product,
                        $Comp_activity                    
		            ));        
        		}  
    			$sheet->fromArray($data, null, 'A2', false, false);
    			}); 
            })->download('xls');
    
   		}
	}

}
