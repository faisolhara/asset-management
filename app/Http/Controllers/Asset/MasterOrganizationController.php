<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDO;

class MasterOrganizationController extends Controller
{
    const URL = '/asset/master-organization';

    public function index(Request $request){
        // dd(\Session::get('user'));

        $models = \DB::select(\DB::raw(
        			'select  *, organization_id, organization_name, remarks,
                    created_by, creation_date, last_updated_by, last_update_date
                    from    organization_list_v
                    where   company_id = '.\Session::get('user')['o_company_id'].'
                    order by organization_name
					'));

        return view('asset.master-organization.index',[
            'url'       => self::URL,
            'models'    => $models,
            ]);    
    }

    public function add(Request $request){

        return view('asset.master-organization.edit',[
            'url'       => self::URL,
            'title'     => 'Add',
            'model'     => [],
            ]);    
    }

    public function edit(Request $request, $id){

        $model = \DB::select(\DB::raw(
                    'select  organization_id, organization_name, remarks,
                    created_by, creation_date, last_updated_by, last_update_date
                    from    organization_list_v
                    where   company_id = '.\Session::get('user')['o_company_id'].'
                    and organization_id = '.$id.'
                    order by organization_name
                    '));
        
        return view('asset.master-organization.edit',[
            'url'       => self::URL,
        	'title'	    => 'Update',
            'model'     => array_first($model),
            ]);    
    }
   
    public function save(Request $request){

        $validatedData = $request->validate([
            'p_organization_name' => 'required',
        ]);

        try {
            $p_access_token         = \Session::get('user')['o_access_token'];
            $p_user_id              = \Session::get('user')['o_user_id'];
            $p_company_id           = \Session::get('user')['o_company_id'];
            $p_organization_id      = $request->get('p_organization_id');
            $p_organization_name    = $request->get('p_organization_name');
            $p_remarks              = $request->get('p_remarks');

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL organization_save_pc(@o_status, @o_message, @o_organization_id, :p_access_token, :p_user_id, :p_company_id, :p_organization_id, :p_organization_name, :p_remarks)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
            $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_organization_id', $p_organization_id, PDO::PARAM_INT);
            $stmt->bindParam(':p_organization_name', $p_organization_name, PDO::PARAM_STR);
            $stmt->bindParam(':p_remarks', $p_remarks, PDO::PARAM_STR);

            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();

            // execute the second query to get output
            $result = $pdo->query("SELECT @o_status as o_status, @o_message as o_message, @o_message as o_organization_id")->fetch(PDO::FETCH_ASSOC);  

        } catch (Exception $e) {
            \DB::rollback();
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e]);
        }
        \DB::commit();


        \Session::flash('message', 'Organization ' .$request->get('p_organization_name').' successfully saved!'); 
        \Session::flash('alert-class', 'success'); 

        if(empty($p_organization_id)){
            return redirect(self::URL.'/add');
        }else{
            return redirect(self::URL);
        }
    }

    public function delete(Request $request){

        $validatedData = $request->validate([
            'p_organization_id' => 'required',
        ]);

        try {
            $p_access_token         = \Session::get('user')['o_access_token'];
            $p_user_id              = \Session::get('user')['o_user_id'];
            $p_company_id           = \Session::get('user')['o_company_id'];
            $p_organization_id      = $request->get('p_organization_id');

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL organization_del_pc(@o_status, @o_message, :p_access_token, :p_user_id, :p_company_id, :p_organization_id)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
            $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_organization_id', $p_organization_id, PDO::PARAM_INT);

            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();

            // execute the second query to get output
            $result = $pdo->query("SELECT @o_status as o_status, @o_message as o_message")->fetch(PDO::FETCH_ASSOC);  

        } catch (Exception $e) {
            \DB::rollback();
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e]);
        }

        \DB::commit();

        \Session::flash('message', 'Organization ' .$request->get('p_organization_name').' successfully deleted!'); 
        \Session::flash('alert-class', 'success'); 

            return redirect(self::URL);
    }
}
