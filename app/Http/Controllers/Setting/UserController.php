<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    const URL = '/setting/user';

    public function index(Request $request){
        // dd(\Session::get('user'));

        $models = \DB::select(\DB::raw(
        			'select  user_id, user_name, email_address, employee_name, start_date, end_date, status,
                            created_by, creation_date, last_updated_by, last_update_date
                    from    user_list_v
                    where   company_id = '.\Session::get('user')['o_company_id'].'
                    order by user_name
					'));
        
        return view('setting.user.index',[
        	'url'	    => self::URL,
        	'models'	=> $models,
        	]);    
    }

    public function edit(Request $request, $id){

        $model = \DB::select(\DB::raw(
                    'select  user_id, user_name, email_address, employee_name, start_date, end_date, status,
                            created_by, creation_date, last_updated_by, last_update_date
                    from    user_list_v
                    where   company_id = '.\Session::get('user')['o_company_id'].'
                    and user_id = '.$id.'
                    order by user_name
                    '));
        
        return view('setting.user.edit',[
            'url'       => self::URL,
            'model'     => array_first($model),
            ]);    
    }
   
    public function save(Request $request){

        $validatedData = $request->validate([
            'p_user_name' => 'required',
            'body'        => 'required',
        ]);

        
    }
}
