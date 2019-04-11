<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Transaction\ProjectController;
use Illuminate\Http\Request;
use PDO;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    const URL       = '/setting/company';

    public function index(Request $request){
        $model = \DB::select(\DB::raw(
                    'select  book_name, company_name, country_code, country_name, province_code, province_name,
                            city_code, city_name, postal_code, address_detail, phone1, phone2, fax1, fax2,
                            email_address, logo, created_by, creation_date, last_updated_by, last_update_date
                    from    company_v
                    where   company_id = '.\Session::get('user')['o_company_id']
                    ));

        $country = \DB::select(\DB::raw(
        			'select  country_code, country_name
					from    country_list_v
					order by country_name
					'));

        return view('setting.company.edit',[
        	'url'	    => self::URL,
            'model'     => array_first($model),
        	'country'	=> $country,
        	]);    
    }

    public function save(Request $request){
        \DB::beginTransaction();

        $validatedData = $request->validate([
            'p_company_name' => 'required',
            'p_country_code' => 'required',
        ]);

        

        try {
            $p_access_token     = \Session::get('user')['o_access_token'];
            $p_user_id          = \Session::get('user')['o_user_id'];
            $p_company_id       = \Session::get('user')['o_company_id'];
            $p_book_name        = $request->get('p_book_name');
            $p_company_name     = $request->get('p_company_name');
            $p_country_code     = $request->get('p_country_code');
            $p_province_code    = $request->get('p_province_code');
            $p_city_code        = $request->get('p_city_code');
            $p_postal_code      = $request->get('p_postal_code');
            $p_address_detail   = $request->get('p_address_detail');
            $p_phone1           = $request->get('p_phone1');
            $p_phone2           = $request->get('p_phone2');
            $p_fax1             = $request->get('p_fax1');
            $p_fax2             = $request->get('p_fax2');
            $p_email_address    = $request->get('p_email_address');
            $p_logo             = $request->file('p_logo');
            $now = new \DateTime();
            $imageName          = md5($now->format('dmY_His')).'.'.$p_logo->getClientOriginalExtension();

            $pdo = \DB::connection()->getPdo();
            // calling stored procedure command
            $sql = 'CALL company_save_pc(@o_status, @o_message, :p_access_token, :p_user_id, :p_company_id, :p_book_name, :p_company_name, :p_country_code, :p_province_code, :p_city_code, :p_postal_code, :p_address_detail, :p_phone1, :p_phone2, :p_fax1, :p_fax2, :p_email_address, :p_logo)';

            // prepare for execution of the stored procedure
            $stmt = $pdo->prepare($sql);

            // pass value to the command
            $stmt->bindParam(':p_access_token', $p_access_token , PDO::PARAM_STR);
            $stmt->bindParam(':p_user_id', $p_user_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_company_id', $p_company_id , PDO::PARAM_INT);
            $stmt->bindParam(':p_book_name', $p_book_name, PDO::PARAM_STR);
            $stmt->bindParam(':p_company_name', $p_company_name, PDO::PARAM_STR);
            $stmt->bindParam(':p_country_code', $p_country_code, PDO::PARAM_STR);
            $stmt->bindParam(':p_province_code', $p_province_code, PDO::PARAM_STR);
            $stmt->bindParam(':p_city_code', $p_city_code, PDO::PARAM_STR);
            $stmt->bindParam(':p_postal_code', $p_postal_code, PDO::PARAM_STR);
            $stmt->bindParam(':p_address_detail', $p_address_detail, PDO::PARAM_STR);
            $stmt->bindParam(':p_phone1', $p_phone1, PDO::PARAM_STR);
            $stmt->bindParam(':p_phone2', $p_phone2, PDO::PARAM_STR);
            $stmt->bindParam(':p_fax1', $p_fax1, PDO::PARAM_STR);
            $stmt->bindParam(':p_fax2', $p_fax2, PDO::PARAM_STR);
            $stmt->bindParam(':p_email_address', $p_email_address, PDO::PARAM_STR);
            $stmt->bindParam(':p_logo', $imageName, PDO::PARAM_STR);

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

        

        $originalPath   = 'upload\images\logo\original\\';
        $thumbnailPath  = 'upload\images\logo\thumbnail\\';

        list($width, $height) = getimagesize($request->file('p_logo'));

        if($width > $height){
            $p_logo_original = Image::make($p_logo->getRealPath())->resize(300, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save(public_path($originalPath).$imageName);
            $p_logo_thumbnail = Image::make($p_logo->getRealPath())->resize(100, null, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save(public_path($thumbnailPath).$imageName);
        }else{
            $p_logo_original = Image::make($p_logo->getRealPath())->resize(null, 300, function ($constraint) {
                                    $constraint->aspectRatio();
                                })->save(public_path($originalPath).$imageName);

            $p_logo_thumbnail = Image::make($p_logo->getRealPath())->resize(null, 100, function ($constraint) {
                                        $constraint->aspectRatio();
                                    })->save(public_path($thumbnailPath).$imageName);
        }

        \Session::flash('message', 'Company ' .$request->get('p_company_name').' successfully saved!'); 
        \Session::flash('alert-class', 'alert-success'); 

        return redirect(self::URL);
    }

    public function getJsonProvince(Request $request){
    	$p_country_code = $request->get('p_country_code');

        $province = \DB::select(\DB::raw(
        			'select  province_code, province_name
					from    province_list_v
					where   country_code = "'.$p_country_code.'"
					order by province_name
					'));

        return response()->json($province);
    }

    public function getJsonCity(Request $request){
        $p_province_code = $request->get('p_province_code');

        $city = \DB::select(\DB::raw(
                    'select  city_code, city_name
                    from    city_list_v
                    where   province_code = "'.$p_province_code.'"
                    order by city_name
                    '));

        return response()->json($city);
    }

   
}
