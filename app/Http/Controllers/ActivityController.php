<?php

namespace App\Http\Controllers;
use Request;
use Excel;
// use Illuminate\Http\Request;
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
use DB;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
           {
                $activity=Activity::get();
            $company =company::lists('name', 'id');

                return view('activity.index',compact('activity','company'));
            }   
                catch (Exception $e)
            {
                return redirect('/');
                
            }
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



         $file = Input::file('pic');
       

        $goverment=Input::get('goverment');
        $city=Input::get('city');
        $start_date=Input::get('start_date');
        $company_id=Input::get('company');
        $duration=Input::get('duration');
        $activity_type=Input::get('activity_type');
        $description=Input::get('description');

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
         $activity = new activity;
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
        $activity = activity::findOrFail($id);
        $pic = Image::make($activity->img);
        $response = Response::make($pic->encode('jpeg'));

        //setting content-type
        $response->header('Content-Type', 'image/jpeg');

        return $response;
    
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






    public  function ACupdate()
    {
            $Activity = Input::get('pk');   
        $column_name = Input::get('name');
        $column_value = Input::get('value');
    
        $activityData = Activity::whereId($Activity)->first();

       $activityData-> $column_name=$column_value;


        if($activityData->save()) 
        return \Response::json(array('status'=>1));
    else 
        return \Response::json(array('status'=>0));
 
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
            $activity = activity::find($id);
            $activity->delete();
            return redirect('/activity');
        }
    catch(Exception $e)
        {
            return redirect('/activity');
        }
        
    }

    public function ValidateActivity($data, $i){ 
        if(!isset($GLOBALS['activity'])) { $GLOBALS['activity']= array(); } 
        if(!isset($ActivityErr)) { $ActivityErr = 'البيانات غير صحيحة لنشاط شركة: '; } 

        if(!isset($GLOBALS['Emptyactivity'])) { 
            $GLOBALS['Emptyactivity']= array(); 
        } 
        if(!isset($EmptyActivityErr)) { 
            $EmptyActivityErr = 'لا يوجد اسم شركة للنشاط التسويقي للصف رقم: '; 
        }     

        $name_regex = preg_match('/^[\pL\s]+$/u' , $data['promoter_name']);
        $gov_regex = preg_match('/^[\pL\s]+$/u' , $data['government']);
        $city_regex = preg_match('/^[\pL\s]+$/u' , $data['city']);
        $activity_type_regex = preg_match('/^[\pL\s]+$/u' , $data['activity_type']);
        $desc_regex = preg_match('/^[\pL\s]+$/u' , $data['description']);
        $duration_regex = preg_match('/^[0-9]*$/' , $data['duration']);
        $start_date_regex = preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/' , $data['start_date']);

                

    $comp_id= (Company::where('name',$data['company_name'])->pluck('id')->first())? Company::       where('name',$data['company_name'])->pluck('id')->first():null;
        
    if($comp_id != null){
        if ($gov_regex == 1 && isset($data['government'])) {
            if ($city_regex == 1 && isset($data['city'])) {
                if ($activity_type_regex == 1 && isset($data['activity_type'])) {
                    if ($desc_regex == 1 ) {
                            if ($start_date_regex == 1 && isset($data['start_date'])) {
                                if (isset($data['duration'])) {
                                    if ($name_regex == 1) {

                         $activity = new Activity();
                                    $activity->goverment = $data['government'];
                                    $activity->city = $data['city']; 
                                    $activity->activity_type = $data['activity_type'];
                                    $activity->description = $data['description'];
                                    $activity->duration = $data['duration']; 
                                    $activity->start_date = $data['start_date'];
                    if(isset($data['company_name'])){
                                $comp_id= Company::where('name',$data['company_name'])
                                        ->pluck('id')->first();
                    }                   
                                    $activity->company_id = $comp_id;

                                    try{
                                        $activity->save();
                                    }
                                    catch (\Exception $e) {
                                $repeted = $data['government']."-".$data['city']."-".$data['activity_type']."-".$data['duration'];
      
                                $exist_string= "Duplicate entry '".$repeted."' for key 'activity_goverment_city_activity_type_duration_unique'";
                        if ($exist_string == $e->errorInfo[2]) {  // activity exist 
                            $activity_id= DB::table('activity')
                                        ->where('duration',$data['duration'])
                                        ->where('goverment',$data['government'])
                                        ->where('city',$data['city'])
                                        ->where('activity_type',$data['activity_type'])
                                        ->pluck('id');                            
                            $updated_activity = Activity::find($activity_id[0]);            
                            $updated_activity->goverment = $data['government'];
                            $updated_activity->city = $data['city']; 
                            $updated_activity->activity_type = $data['activity_type'];
                            $updated_activity->description = $data['description'];
                            $updated_activity->duration = $data['duration']; 
                            $updated_activity->start_date = $data['start_date'];
                            $updated_activity->save();
                        } 

                            } // enf catch
                            

                                    }
                                    else {
                                        array_push($GLOBALS['activity'],$data['company_name']); 
                                    } 
                                }
                                else {
                                    array_push($GLOBALS['activity'],$data['company_name']); 
                                }                                
                            }
                            else {
                                array_push($GLOBALS['activity'],$data['company_name']); 
                            }
                        }
                        else {
                             array_push($GLOBALS['activity'],$data['company_name']); 
                        }
                    }
                    else {
                         array_push($GLOBALS['activity'],$data['company_name']); 
                    }
                
            }
            else {
                 array_push($GLOBALS['activity'],$data['company_name']); 
            }
        }
        else {
            array_push($GLOBALS['activity'],$data['company_name']); 
        }
    }
    else { // no company name
        array_push($GLOBALS['Emptyactivity'],$i); 
    }

    if ( !empty ($GLOBALS['Emptyactivity'] )) {
            $GLOBALS['Emptyactivity'] = array_unique($GLOBALS['Emptyactivity']);
            $EmptyActivityErr= $EmptyActivityErr.implode(" \n ",$GLOBALS['Emptyactivity']);
            $EmptyActivityErr = nl2br($EmptyActivityErr);  
            $cookie_name = 'EmptyActivityErr';
            $cookie_value = $EmptyActivityErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }
        if ( !empty ($GLOBALS['activity'] )) {
            $GLOBALS['activity'] = array_unique($GLOBALS['activity']);
            $ActivityErr = $ActivityErr.implode(" \n ",$GLOBALS['activity']);
            $ActivityErr = nl2br($ActivityErr);  
            $cookie_name = 'ActivityErr';
            $cookie_value = $ActivityErr;
            setcookie($cookie_name, $cookie_value, time() + (60), "/");
        }


    }

    public function importactivity(){
        if(!Input::file('file')){  //if no file selected  
                $errFile = "الرجاء اختيار الملف الملطلوب تحميلة";                
                $cookie_name = 'FileError';
                $cookie_value = $errFile;
                setcookie($cookie_name, $cookie_value, time() + (60), "/"); 
                return redirect('/activity');
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
                        app('App\Http\Controllers\ActivityController')->ValidateActivity($data, $i);
                    } // end foreach data
            });
            //remove temperorary csv file
            unlink($PathnewCSV);   
        } 
        return redirect('/activity');  



    }

}
