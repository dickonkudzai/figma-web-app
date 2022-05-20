<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomValidation;
use App\DateManager;
use DB;

class UserController extends Controller
{
    //
    public function createUser(Request $request){

        if(isset($request->all()['id']))
            return $this->update($request);

        $values = array(
            "name" => array(
                "value" => isset($request->all()['name'])?$request->all()['name']:0,
                "error" => "name required.Please try again",
                "invalid" => "Invalid name.Please try again",
                "required" => false,
                "pattern" => null),
            "email" => array(
                "value" => isset($request->all()['email'])?$request->all()['email']:0,
                "error" => "email required.Please try again",
                "invalid" => "Invalid email.Please try again",
                "required" => false,
                "pattern" => null),
            "password" => array(
                "value" => isset($request->all()['password'])?$request->all()['password']:1,
                "error" => "password required.Please try again",
                "invalid" => "Invalid password.Please try again",
                "required" => false,
                "pattern" => null),
            "street" => array(
                "value" => isset($request->all()['street'])?$request->all()['street']:0,
                "error" => "street required.Please try again",
                "invalid" => "Invalid street.Please try again",
                "required" => false,
                "pattern" => null),
            "suite" => array(
                "value" => isset($request->all()['suite'])?$request->all()['suite']:0,
                "error" => "suite required.Please try again",
                "invalid" => "Invalid suite.Please try again",
                "required" => false,
                "pattern" => null),
            "city" => array(
                "value" => isset($request->all()['city'])?$request->all()['city']:0,
                "error" => "city required.Please try again",
                "invalid" => "Invalid city.Please try again",
                "required" => false,
                "pattern" => null),
            "zipcode" => array(
                "value" => isset($request->all()['zipcode'])?$request->all()['zipcode']:0,
                "error" => "zipcode required.Please try again",
                "invalid" => "Invalid zipcode.Please try again",
                "required" => false,
                "pattern" => null),
            "lat" => array(
                "value" => isset($request->all()['lat'])?$request->all()['lat']:0,
                "error" => "lat required.Please try again",
                "invalid" => "Invalid lat.Please try again",
                "required" => false,
                "pattern" => null),
            "lng" => array(
                "value" => isset($request->all()['lng'])?$request->all()['lng']:0,
                "error" => "lng required.Please try again",
                "invalid" => "Invalid lng.Please try again",
                "required" => false,
                "pattern" => null),
            "phone" => array(
                "value" => isset($request->all()['phone'])?$request->all()['phone']:0,
                "error" => "phone required.Please try again",
                "invalid" => "Invalid phone.Please try again",
                "required" => false,
                "pattern" => null),
            "website" => array(
                "value" => isset($request->all()['website'])?$request->all()['website']:0,
                "error" => "website required.Please try again",
                "invalid" => "Invalid website.Please try again",
                "required" => false,
                "pattern" => null),
            "username" => array(
                "value" => isset($request->all()['username'])?$request->all()['username']:0,
                "error" => "username required.Please try again",
                "invalid" => "Invalid username.Please try again",
                "required" => false,
                "pattern" => null),
            "cname" => array(
                "value" => isset($request->all()['cname'])?$request->all()['cname']:0,
                "error" => "cname required.Please try again",
                "invalid" => "Invalid cname.Please try again",
                "required" => false,
                "pattern" => null),
            "catchPhrase" => array(
                "value" => isset($request->all()['catchPhrase'])?$request->all()['catchPhrase']:0,
                "error" => "catchPhrase required.Please try again",
                "invalid" => "Invalid catchPhrase.Please try again",
                "required" => false,
                "pattern" => null),
            "bs" => array(
                "value" => isset($request->all()['bs'])?$request->all()['bs']:0,
                "error" => "bs required.Please try again",
                "invalid" => "Invalid bs.Please try again",
                "required" => false,
                "pattern" => null)
        );


        $validation = new CustomValidation();

        foreach($values as $key => $variable)
        {
            if(!empty($variable['value'])) {
                if (!$validation->validate($variable['value'], $variable['pattern'])) {
                    return response()->json(['success' => false, 'message' => $variable['invalid']]);
                }
            }else if($variable['required']) {
                return response()->json(['success' => false, 'message' => $variable['error']]);
            }
        }

        $data_values = array();
        foreach ($values as $key => $value) {
            if($value==null || empty($value['value']))
                continue;
            $data_values[$key] = $value['value'];
        }

        $done = User::create($data_values)->id;
        
        return $done? response()->json(['success' => true, 'message' => 'Done']): response()->json(['success' => false, 'message' => 'Failed to add data']);

    }

    public function update(Request $request){



        $values = array(
            "name" => array(
                "value" => isset($request->all()['name'])?$request->all()['name']:0,
                "error" => "name required.Please try again",
                "invalid" => "Invalid name.Please try again",
                "required" => false,
                "pattern" => null),
            "email" => array(
                "value" => isset($request->all()['email'])?$request->all()['email']:0,
                "error" => "email required.Please try again",
                "invalid" => "Invalid email.Please try again",
                "required" => false,
                "pattern" => null),
            "password" => array(
                "value" => isset($request->all()['password'])?$request->all()['password']:1,
                "error" => "password required.Please try again",
                "invalid" => "Invalid password.Please try again",
                "required" => false,
                "pattern" => null),
            "street" => array(
                "value" => isset($request->all()['street'])?$request->all()['street']:0,
                "error" => "street required.Please try again",
                "invalid" => "Invalid street.Please try again",
                "required" => false,
                "pattern" => null),
            "suite" => array(
                "value" => isset($request->all()['suite'])?$request->all()['suite']:0,
                "error" => "suite required.Please try again",
                "invalid" => "Invalid suite.Please try again",
                "required" => false,
                "pattern" => null),
            "city" => array(
                "value" => isset($request->all()['city'])?$request->all()['city']:0,
                "error" => "city required.Please try again",
                "invalid" => "Invalid city.Please try again",
                "required" => false,
                "pattern" => null),
            "zipcode" => array(
                "value" => isset($request->all()['zipcode'])?$request->all()['zipcode']:0,
                "error" => "zipcode required.Please try again",
                "invalid" => "Invalid zipcode.Please try again",
                "required" => false,
                "pattern" => null),
            "lat" => array(
                "value" => isset($request->all()['lat'])?$request->all()['lat']:0,
                "error" => "lat required.Please try again",
                "invalid" => "Invalid lat.Please try again",
                "required" => false,
                "pattern" => null),
            "lng" => array(
                "value" => isset($request->all()['lng'])?$request->all()['lng']:0,
                "error" => "lng required.Please try again",
                "invalid" => "Invalid lng.Please try again",
                "required" => false,
                "pattern" => null),
            "phone" => array(
                "value" => isset($request->all()['phone'])?$request->all()['phone']:0,
                "error" => "phone required.Please try again",
                "invalid" => "Invalid phone.Please try again",
                "required" => false,
                "pattern" => null),
            "website" => array(
                "value" => isset($request->all()['website'])?$request->all()['website']:0,
                "error" => "website required.Please try again",
                "invalid" => "Invalid website.Please try again",
                "required" => false,
                "pattern" => null),
            "username" => array(
                "value" => isset($request->all()['username'])?$request->all()['username']:0,
                "error" => "username required.Please try again",
                "invalid" => "Invalid username.Please try again",
                "required" => false,
                "pattern" => null),
            "cname" => array(
                "value" => isset($request->all()['cname'])?$request->all()['cname']:0,
                "error" => "cname required.Please try again",
                "invalid" => "Invalid cname.Please try again",
                "required" => false,
                "pattern" => null),
            "catchPhrase" => array(
                "value" => isset($request->all()['catchPhrase'])?$request->all()['catchPhrase']:0,
                "error" => "catchPhrase required.Please try again",
                "invalid" => "Invalid catchPhrase.Please try again",
                "required" => false,
                "pattern" => null),
            "bs" => array(
                "value" => isset($request->all()['bs'])?$request->all()['bs']:0,
                "error" => "bs required.Please try again",
                "invalid" => "Invalid bs.Please try again",
                "required" => false,
                "pattern" => null),
            "id" => array(
                "value" => isset($request->all()['id'])?$request->all()['id']:0,
                "error" => "id required.Please try again",
                "invalid" => "Invalid id.Please try again",
                "required" => false,
                "pattern" => null)
        );

        $validation = new CustomValidation();

        foreach($values as $key => $variable)
        {
            if(!empty($variable['value'])) {
                if (!$validation->validate($variable['value'], $variable['pattern'])) {
                    return response()->json(['success' => false, 'message' => $variable['invalid']]);
                }
            }else if($variable['required']) {
                return response()->json(['success' => false, 'message' => $variable['error']]);
            }
        }

        $data_values = array();

        foreach ($values as $key => $value) {
            if($value==null || empty($value['value']))
                continue;

            $data_values[$key] = $value['value'];
        }

        $data_values['updated_at'] = DateManager::getCurrentDateString();

        $done = User::where('id', $data_values['id'])->update($data_values);
        return $done? response()->json(['success' => true, 'message' => 'Done']): response()->json(['success' => false, 'message' => 'Failed to update data']);

    }  



    public function deleteUser(Request $request){

        $values = array(
            "id" => array(
                "value" => isset($request->all()['id'])?$request->all()['id']:-1,
                "error" => "id required.Please try again",
                "invalid" => "Invalid id.Please try again",
                "required" => true,
                "pattern" => "/^[0-9]{1,}$/")
        );

        $validation = new CustomValidation();

        foreach($values as $key => $variable)
        {
            if(!empty($variable['value'])) {
                if (!$validation->validate($variable['value'], $variable['pattern'])) {
                    return response()->json(['success' => false, 'message' => $variable['invalid']]);
                }
            }else if($variable['required']) {
                return response()->json(['success' => false, 'message' => $variable['error']]);
            }
        }

        $data_values = array();
        foreach ($values as $key => $value) {
            if($value==null || empty($value['value']))
                continue;

            $data_values[$key] = $value['value'];
        }
        
        $done = User::where('id', $data_values['id'])->delete();
        return $done? response()->json(['success' => true, 'message' => 'Done']): response()->json(['success' => false, 'message' => 'Failed to update data']);

    }



    public function get(Request $request)
    {
        if(isset($request->all()['id']))
        {
            return $this->getSingle($request);
        }else
            return $this->getAll($request);

    }

    private function getSingle(Request $request)
    {
        $values = array(
            "id" => array(
                "value" => isset($request->all()['id'])?$request->all()['id']:"",
                "error" => "id required.Please try again",
                "invalid" => "Invalid id.Please try again",
                "required" => true,
                "pattern" => "/^[0-9]{1,}$/")
        );

        $validation = new CustomValidation();

        foreach($values as $key => $variable)
        {
            if(!empty($variable['value'])) {
                if (!$validation->validate($variable['value'], $variable['pattern'])) {
                    return response()->json(['success' => false, 'message' => $variable['invalid']]);
                }
            }else if($variable['required']) {
                return response()->json(['success' => false, 'message' => $variable['error']]);
            }
        }

        $data = User::Where('id', $values['id']['value']);
        if($data==null)
            return response()->json(['success'=> false, 'message'=> 'Not Found']);

        return response()->json(['success'=> true, 'message'=> 'Done', 'data'=> $data]);
    }
    private function getAll(Request $request)
    {

        $data = User::all();

        if($data==null)
            return response()->json(['success'=> false, 'message'=> 'Not Found']);


        // return response()->json(['success'=> true, 'message'=> 'Done', 'data'=> $data]);
        return response()->json($data);
    }
}
