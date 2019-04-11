<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDO;

class AuthController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }
    
    public function postLogin(Request $request){

        \DB::beginTransaction();

        $this->validate($request, [
            'p_user_field'    => 'required',
            'p_user_password' => 'required'
        ]);

        try {
            $p_user_field    = $request->get('p_user_field');
            $p_user_password = $request->get('p_user_password');
            $p_ipv4          = $request->get('p_ipv4');

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL user_login_pc(@o_status, @o_message, @o_access_token, @o_user_id, @o_company_id, @o_first_flag, @o_company_logo, @o_company_name, @o_user_photo, @o_organization_name, @o_register_type, :p_user_field, :p_user_password, :p_ipv4)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_user_field', $p_user_field, PDO::PARAM_STR);
            $stmt->bindParam(':p_user_password', $p_user_password, PDO::PARAM_STR);
            $stmt->bindParam(':p_ipv4', $p_ipv4, PDO::PARAM_STR);

            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();

            // execute the second query to get output
            $result = $pdo->query("SELECT @o_status as o_status, @o_message as o_message, @o_access_token as o_access_token, @o_user_id as o_user_id, @o_company_id as o_company_id, @o_first_flag as o_first_flag, @o_company_logo as o_company_logo, @o_company_name as o_company_name, @o_user_photo as o_user_photo, @o_organization_name as o_organization_name, @o_register_type as o_register_type")->fetch(PDO::FETCH_ASSOC);  


        } catch (Exception $e) {
            \DB::rollback();
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e]);
        }

        if($result['o_status'] == -1){
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $result['o_message']]);
        }
        
        \DB::commit();
        \Session::put('user', $result);

        return redirect('/dashboard');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
}