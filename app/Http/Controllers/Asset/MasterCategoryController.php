<?php

namespace App\Http\Controllers\Asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDO;

class MasterCategoryController extends Controller
{
    const URL = '/asset/master-category';

    public function index(Request $request){

        $models = \DB::select(\DB::raw(
        			'select  category_id, category_name, remarks,
                            created_by, creation_date, last_updated_by, last_update_date
                    from    asset_category_list_v
                    where   company_id = '.\Session::get('user')['o_company_id'].'
                    order by category_name
					'));

        return view('asset.master-category.index',[
            'url'       => self::URL,
            'models'    => $models,
            ]);    
    }

    public function add(Request $request){

        return view('asset.master-category.edit',[
            'url'       => self::URL,
            'title'     => 'Add',
            'model'     => [],
            ]);
    }

    public function edit(Request $request, $id){

        $model = \DB::select(\DB::raw(
                    'select  category_id, category_name, remarks,
                            created_by, creation_date, last_updated_by, last_update_date
                    from    asset_category_list_v
                    where   company_id = '.\Session::get('user')['o_company_id'].'
                    and category_id = '.$id.'
                    order by category_name
                    '));

        $flexfield = \DB::select(\DB::raw(
                    'select  category_id, attribute1, label1, group1, attribute2, label2, group2,
                            attribute3, label3, group3, attribute4, label4, group4, attribute5, label5, group5,
                            attribute6, label6, group6, attribute7, label7, group7, attribute8, label8, group8,
                            attribute9, label9, group9, attribute10, label10, group10, attribute11, label11, group11,
                            attribute12, label12, group12, attribute13, label13, group13, attribute14, label14, group14,
                            attribute15, label15, group15, attribute16, label16, group16, attribute17, label17, group17,
                            attribute18, label18, group18, attribute19, label19, group19, attribute20, label20, group20,
                            created_by, creation_date, last_updated_by, last_update_date
                    from    asset_flex_fields_v
                    where   category_id = '.$id
                    ));

        return view('asset.master-category.edit',[
            'url'       => self::URL,
        	'title'	    => 'Update',
            'model'     => array_first($model),
            'flexfield' => array_first($flexfield),
            ]);    
    }
   
    public function save(Request $request){
// dd($request->all());
        $validatedData = $request->validate([
            'p_category_name' => 'required',
        ]);

        try {
            $p_access_token  = \Session::get('user')['o_access_token'];
            $p_user_id       = \Session::get('user')['o_user_id'];
            $p_company_id    = \Session::get('user')['o_company_id'];
            $p_category_id   = $request->get('p_category_id');
            $p_category_name = $request->get('p_category_name');
            $p_remarks       = $request->get('p_remarks');

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL asset_category_save_pc(@o_status, @o_message, @o_category_id, :p_access_token, :p_user_id, :p_company_id, :p_category_id, :p_category_name, :p_remarks)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
            $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_category_id', $p_category_id, PDO::PARAM_INT);
            $stmt->bindParam(':p_category_name', $p_category_name, PDO::PARAM_STR);
            $stmt->bindParam(':p_remarks', $p_remarks, PDO::PARAM_STR);

            // execute the stored procedure
            $stmt->execute();
            $stmt->closeCursor();

            // execute the second query to get output
            $result = $pdo->query("SELECT @o_status as o_status, @o_message as o_message, @o_category_id as o_category_id")->fetch(PDO::FETCH_ASSOC);

            if($result['o_status'] == 1){
                $p_access_token  = \Session::get('user')['o_access_token'];
                $p_user_id       = \Session::get('user')['o_user_id'];
                $p_company_id    = \Session::get('user')['o_company_id'];
                if(empty($request->get('p_category_id'))){
                    $p_category_id = $result['o_category_id'];
                }
                $p_attribute1    = $request->get('p_attribute1');
                $p_label1        = $request->get('p_label1');
                $p_group1        = $request->get('p_group1');
                $p_attribute2    = $request->get('p_attribute2');
                $p_label2        = $request->get('p_label2');
                $p_group2        = $request->get('p_group2');
                $p_attribute3    = $request->get('p_attribute3');
                $p_label3        = $request->get('p_label3');
                $p_group3        = $request->get('p_group3');
                $p_attribute4    = $request->get('p_attribute4');
                $p_label4        = $request->get('p_label4');
                $p_group4        = $request->get('p_group4');
                $p_attribute5    = $request->get('p_attribute5');
                $p_label5        = $request->get('p_label5');
                $p_group5        = $request->get('p_group5');
                $p_attribute6    = $request->get('p_attribute6');
                $p_label6        = $request->get('p_label6');
                $p_group6        = $request->get('p_group6');
                $p_attribute7    = $request->get('p_attribute7');
                $p_label7        = $request->get('p_label7');
                $p_group7        = $request->get('p_group7');
                $p_attribute8    = $request->get('p_attribute8');
                $p_label8        = $request->get('p_label8');
                $p_group8        = $request->get('p_group8');
                $p_attribute9    = $request->get('p_attribute9');
                $p_label9        = $request->get('p_label9');
                $p_group9        = $request->get('p_group9');
                $p_attribute10   = $request->get('p_attribute10');
                $p_label10       = $request->get('p_label10');
                $p_group10       = $request->get('p_group10');
                $p_attribute11   = $request->get('p_attribute11');
                $p_label11       = $request->get('p_label11');
                $p_group11       = $request->get('p_group11');
                $p_attribute12   = $request->get('p_attribute12');
                $p_label12       = $request->get('p_label12');
                $p_group12       = $request->get('p_group12');
                $p_attribute13   = $request->get('p_attribute13');
                $p_label13       = $request->get('p_label13');
                $p_group13       = $request->get('p_group13');
                $p_attribute14   = $request->get('p_attribute14');
                $p_label14       = $request->get('p_label14');
                $p_group14       = $request->get('p_group14');
                $p_attribute15   = $request->get('p_attribute15');
                $p_label15       = $request->get('p_label15');
                $p_group15       = $request->get('p_group15');
                $p_attribute16   = $request->get('p_attribute16');
                $p_label16       = $request->get('p_label16');
                $p_group16       = $request->get('p_group16');
                $p_attribute17   = $request->get('p_attribute17');
                $p_label17       = $request->get('p_label17');
                $p_group17       = $request->get('p_group17');
                $p_attribute18   = $request->get('p_attribute18');
                $p_label18       = $request->get('p_label18');
                $p_group18       = $request->get('p_group18');
                $p_attribute19   = $request->get('p_attribute19');
                $p_label19       = $request->get('p_label19');
                $p_group19       = $request->get('p_group19');
                $p_attribute20   = $request->get('p_attribute20');
                $p_label20       = $request->get('p_label20');
                $p_group20       = $request->get('p_group20');


                $pdo = \DB::connection()->getPdo();
                // calling stored procedure command
                $sql = 'CALL asset_flex_save_pc(@o_status, @o_message, :p_access_token, :p_user_id, :p_company_id, :p_category_id, :p_attribute1, :p_label1, :p_group1, :p_attribute2, :p_label2, :p_group2, :p_attribute3, :p_label3, :p_group3, :p_attribute4, :p_label4, :p_group4, :p_attribute5, :p_label5, :p_group5, :p_attribute6, :p_label6, :p_group6, :p_attribute7, :p_label7, :p_group7, :p_attribute8, :p_label8, :p_group8, :p_attribute9, :p_label9, :p_group9, :p_attribute10, :p_label10, :p_group10, :p_attribute11, :p_label11, :p_group11, :p_attribute12, :p_label12, :p_group12, :p_attribute13, :p_label13, :p_group13, :p_attribute14, :p_label14, :p_group14, :p_attribute15, :p_label15, :p_group15, :p_attribute16, :p_label16, :p_group16, :p_attribute17, :p_label17, :p_group17, :p_attribute18, :p_label18, :p_group18, :p_attribute19, :p_label19, :p_group19, :p_attribute20, :p_label20, :p_group20)';

                // prepare for execution of the stored procedure
                $stmt = $pdo->prepare($sql);

                // pass value to the command
                $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
                $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
                $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
                $stmt->bindParam(':p_category_id', $p_category_id, PDO::PARAM_INT);
                $stmt->bindParam(':p_attribute1', $p_attribute1, PDO::PARAM_STR);
                $stmt->bindParam(':p_label1', $p_label1, PDO::PARAM_STR);
                $stmt->bindParam(':p_group1', $p_group1, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute2', $p_attribute2, PDO::PARAM_STR);
                $stmt->bindParam(':p_label2', $p_label2, PDO::PARAM_STR);
                $stmt->bindParam(':p_group2', $p_group2, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute3', $p_attribute3, PDO::PARAM_STR);
                $stmt->bindParam(':p_label3', $p_label3, PDO::PARAM_STR);
                $stmt->bindParam(':p_group3', $p_group3, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute4', $p_attribute4, PDO::PARAM_STR);
                $stmt->bindParam(':p_label4', $p_label4, PDO::PARAM_STR);
                $stmt->bindParam(':p_group4', $p_group4, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute5', $p_attribute5, PDO::PARAM_STR);
                $stmt->bindParam(':p_label5', $p_label5, PDO::PARAM_STR);
                $stmt->bindParam(':p_group5', $p_group5, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute6', $p_attribute6, PDO::PARAM_STR);
                $stmt->bindParam(':p_label6', $p_label6, PDO::PARAM_STR);
                $stmt->bindParam(':p_group6', $p_group6, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute7', $p_attribute7, PDO::PARAM_STR);
                $stmt->bindParam(':p_label7', $p_label7, PDO::PARAM_STR);
                $stmt->bindParam(':p_group7', $p_group7, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute8', $p_attribute8, PDO::PARAM_STR);
                $stmt->bindParam(':p_label8', $p_label8, PDO::PARAM_STR);
                $stmt->bindParam(':p_group8', $p_group8, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute9', $p_attribute9, PDO::PARAM_STR);
                $stmt->bindParam(':p_label9', $p_label9, PDO::PARAM_STR);
                $stmt->bindParam(':p_group9', $p_group9, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute10', $p_attribute10, PDO::PARAM_STR);
                $stmt->bindParam(':p_label10', $p_label10, PDO::PARAM_STR);
                $stmt->bindParam(':p_group10', $p_group10, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute11', $p_attribute11, PDO::PARAM_STR);
                $stmt->bindParam(':p_label11', $p_label11, PDO::PARAM_STR);
                $stmt->bindParam(':p_group11', $p_group11, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute12', $p_attribute12, PDO::PARAM_STR);
                $stmt->bindParam(':p_label12', $p_label12, PDO::PARAM_STR);
                $stmt->bindParam(':p_group12', $p_group12, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute13', $p_attribute13, PDO::PARAM_STR);
                $stmt->bindParam(':p_label13', $p_label13, PDO::PARAM_STR);
                $stmt->bindParam(':p_group13', $p_group13, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute14', $p_attribute14, PDO::PARAM_STR);
                $stmt->bindParam(':p_label14', $p_label14, PDO::PARAM_STR);
                $stmt->bindParam(':p_group14', $p_group14, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute15', $p_attribute15, PDO::PARAM_STR);
                $stmt->bindParam(':p_label15', $p_label15, PDO::PARAM_STR);
                $stmt->bindParam(':p_group15', $p_group15, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute16', $p_attribute16, PDO::PARAM_STR);
                $stmt->bindParam(':p_label16', $p_label16, PDO::PARAM_STR);
                $stmt->bindParam(':p_group16', $p_group16, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute17', $p_attribute17, PDO::PARAM_STR);
                $stmt->bindParam(':p_label17', $p_label17, PDO::PARAM_STR);
                $stmt->bindParam(':p_group17', $p_group17, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute18', $p_attribute18, PDO::PARAM_STR);
                $stmt->bindParam(':p_label18', $p_label18, PDO::PARAM_STR);
                $stmt->bindParam(':p_group18', $p_group18, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute19', $p_attribute19, PDO::PARAM_STR);
                $stmt->bindParam(':p_label19', $p_label19, PDO::PARAM_STR);
                $stmt->bindParam(':p_group19', $p_group19, PDO::PARAM_STR);
                $stmt->bindParam(':p_attribute20', $p_attribute20, PDO::PARAM_STR);
                $stmt->bindParam(':p_label20', $p_label20, PDO::PARAM_STR);
                $stmt->bindParam(':p_group20', $p_group20, PDO::PARAM_STR);

                // execute the stored procedure
                $stmt->execute();
                $stmt->closeCursor();

                // execute the second query to get output
                $result = $pdo->query("SELECT @o_status as o_status, @o_message as o_message")->fetch(PDO::FETCH_ASSOC);
            }  

        } catch (Exception $e) {
            \DB::rollback();
            return redirect(\URL::previous())->withInput($request->all())->withErrors(['errorMessage' => $e]);
        }
        \DB::commit();


        \Session::flash('message', 'Organization ' .$request->get('p_category_name').' successfully saved!'); 
        \Session::flash('alert-class', 'success'); 

        if(empty($p_category_id)){
            return redirect(self::URL.'/add');
        }else{
            return redirect(self::URL);
        }
    }

    public function delete(Request $request){

        $validatedData = $request->validate([
            'p_category_id' => 'required',
        ]);

        try {
            $p_access_token  = \Session::get('user')['o_access_token'];
            $p_user_id       = \Session::get('user')['o_user_id'];
            $p_company_id    = \Session::get('user')['o_company_id'];
            $p_category_id   = $request->get('p_category_id');

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL asset_category_del_pc(@o_status, @o_message, :p_access_token, :p_user_id, :p_company_id, :p_category_id)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
            $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_category_id', $p_category_id, PDO::PARAM_INT);

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

        \Session::flash('message', 'Organization ' .$request->get('p_category_name').' successfully deleted!'); 
        \Session::flash('alert-class', 'success'); 

            return redirect(self::URL);
    }

    public function getJsonFlexfield(Request $request){
        $p_category_id    = $request->get('p_category_id');
        $p_attribute_name = $request->get('p_attribute_name');

        $flexfield = \DB::select(\DB::raw(
                    'select  flex_value,  created_by, creation_date, last_updated_by, last_update_date
                    from    asset_flex_values_v
                    where   category_id = '.$p_category_id.'
                            and attribute_name = "'.$p_attribute_name.'"
                    order by flex_value        
                    '));

        return response()->json($flexfield);
    }

    public function postOprFlexfield(Request $request){
        try {
            $p_access_token   = \Session::get('user')['o_access_token'];
            $p_user_id        = \Session::get('user')['o_user_id'];
            $p_company_id     = \Session::get('user')['o_company_id'];
            $p_category_id    = $request->get('p_category_id');
            $p_attribute_name = $request->get('p_attribute_name');
            $p_flex_value     = $request->get('p_flex_value');
            $p_enabled_flag   = $request->get('p_enabled_flag');

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL asset_flex_value_save_pc(@o_status, @o_message, :p_access_token, :p_user_id, :p_company_id, :p_category_id, :p_attribute_name, :p_flex_value, :p_enabled_flag)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
            $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_category_id', $p_category_id, PDO::PARAM_INT);
            $stmt->bindParam(':p_attribute_name', $p_attribute_name , PDO::PARAM_STR);
            $stmt->bindParam(':p_flex_value', $p_flex_value , PDO::PARAM_STR);
            $stmt->bindParam(':p_enabled_flag', $p_enabled_flag , PDO::PARAM_STR);

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
        
        return response()->json($result);
    }
}
