<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function usercreate()
    {
        return view('admin/pages/usercreate/index');
    }

    public function storeuser(Request $req)
    {

        $this->validate($req, [
            'name' => 'required',
            'email' => 'unique:users|required',
            'password' => 'required',
        ]);

        if ($req->password == $req->passwordreturn) {
            $useradd = new User;
            $useradd->name = $req->name;
            $useradd->email = $req->email;
            $useradd->phone = $req->phone;
            $useradd->designation = $req->designation;
            $useradd->status = 1;
            $useradd->type = 1;
            if ($req->hasFile('image')) {
                if ($req->file('image')->isValid()) {
                    $image_name = date('mdYHis') . uniqid() . $req->file('image')->getClientOriginalName();
                    $path = base_path() . '/public/images/';
                    $req->file('image')->move($path, $image_name);
                    $useradd->image = url('/') . '/images/' . $image_name;
                }
            }
            $useradd->password = Hash::make($req->password);
            $useradd->save();
            return back()->with('success', 'User Create successfully');
        } else {
            return back()->with('error', 'Password confirmation does not match');
        }

    }

    public function userlist(Admin $admin) {
        $users = DB::table('users')->where('type', 1)->get();
        return view('admin.pages.usercreate.userList', get_defined_vars());
    }

    public function profile()
    {
        $user_id = Auth::user()->id;
        $profile = User::find($user_id);
        return view('admin/pages/profile', get_defined_vars());
    }

    public function index(Request $passsecurity)
    {
        if ($passsecurity->pass == 'itwaybd') {
            return view('admin/include/login');
        } else {
            return redirect()->back();
        }
    }

    public function register(Request $req)
    {
        $this->validate($req, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        if ($req->password == $req->password_confirmation) {
            $register = new User();
            $register->type = 1;
            $register->name = $req->name;
            $register->username = $req->username;
            $register->email = $req->email;
            $register->password = Hash::make($req->password);
            $register->status = 1;
            $register->save();
            toast('User add successfuly', 'success');
            return back();
        } else {
            toast('password does not match', 'warning');
            return back();
        }
    }

    public function update(Request $req)
    {
        $this->validate($req, [
            'username' => 'required',
        ]);
        $update = User::find(Auth::user()->id);
        $update->name = $req->name;
        $update->email = $req->email;
        $update->username = $req->username;
        $update->phone = $req->phone;
        if (!empty($req->password) && !empty($req->repassword)) {
            if ($req->password == $req->repassword) {
                $update->password = Hash::make($req->password);
            }
        }
        if ($req->hasFile('image')) {
            if ($req->file('image')->isValid()) {
                $image_name = date('mdYHis') . uniqid() . $req->file('image')->getClientOriginalName();
                $path = base_path() . '/public/image';
                $req->file('image')->move($path, $image_name);
                $update->image = '/image/' . $image_name;
            }
        }
        $update->save();
        return back()->with('success', 'update successfully');
    }
    public function useraccess()
    {
        $userlist = User::all();
        return view('admin/pages/useraccess', get_defined_vars());
    }

    public function get_menu_list(Request $request)
    {
        $user_id = $request->user_id;
        $navigationList = DB::table('navigation')
            ->select('*')
            ->where('parent_id', 0)
            ->get();
        return view('admin/ajax/menuListShow', get_defined_vars());
    }

    public function insert_menu_accessList(Request $request)
    {
        $pid = array();
        $user_id = $request->user_id;

        $navigation = $request->navigation;
        DB::table('admin_role')->where('admin_id', $user_id)->delete();
        foreach ($navigation as $key => $value):
            $get_parent_id = DB::table('navigation')->where('navigation_id', $value)->first();
            DB::table('admin_role')->insert([
                'admin_id' => $user_id,
                'navigation_id' => $value,
                'parent_id' => $get_parent_id->parent_id,
            ]);

        endforeach;
        $request->session()->flash('success', 'Admin Data updated !');
        return back();
    }

    public function adminMenu()
    {
        $mainMenu = DB::table('navigation')->where('parent_id', 0)->get();
        return view('admin/pages/setup/menuadd', get_defined_vars());
    }

    public function storeMenu(Request $request)
    {
         

        if (empty($request->label) || $request->label == null) {
            return redirect('adminMenu')->with('label', 'label Can not be empty !');
        }
       
        if (!empty($request->parent_id)):
            $valueCheck = DB::table('navigation')->where('url', $request->url)->first();
            if (!empty($valueCheck)) {
                return redirect('adminMenu')->with('alert', 'This url already exist !');
            }

            DB::table('navigation')->insert(
                array(
                    'url' => $request->url,
                    'parent_id' => $request->parent_id,
                    'label' => $request->label,
                    'icon' => 'far fa-circle nav-icon',
                    'user_type' => 'administration',
                    'active' => 1,
                    'orderBy' => 1, // it can be dynamic       'object_class' =>'', // it can be dynamic
                    'object_class' => ' ', // it can be dynamic
                    'object_id' => ' ', // it can be dynamic
                    'extra_attribute' => ' ', // it can be dynamic
                    'target' => ' ', // it can be dynamic

                )
            );
        else:
            //dd($request->all());
            DB::table('navigation')->insert(
                array(
                    'url' => '',
                    'parent_id' => 0,
                    'label' => $request->label,
                    'icon' => 'fa fa-cog fa-spin',
                    'active' => 1,
                    'orderBy' => 1, // it can be dynamic
                    'object_class' => ' ', // it can be dynamic
                    'object_id' => ' ', // it can be dynamic
                    'extra_attribute' => ' ', // it can be dynamic
                    'target' => ' ', // it can be dynamic
                )
            );
        endif;

        return redirect('adminMenu');
    }

    public function user_create()
    {
        // dd('Hello');
        $userlist = User::where('type', 1)->get();
        return view('admin/pages/admincreate/adminlist', get_defined_vars());
    }

    public function status(Request $req)
    {
        $id = $req->id;
        $status = $req->status;
        $statusupdate['status'] = $status;
        DB::table('users')->where('id', $id)->update($statusupdate);

        $list = User::where('type', 1)->get();
        if ($status == 1) {
            toast('Active successfully', 'Success');
        } elseif ($status == 0) {
            toast('Block successfully', 'success');
        }

        return view('admin/pages/admincreate/ajaxreturn', get_defined_vars());
    }

    // change password 
        public function password_change() {

        $userlist = User::all();
        return view('admin/pages/password_change/password_admin',get_defined_vars());

    }
    public function update_password(Request $request) {
 
        // dd($request->all());
        if(!empty($request->newpassword && $request->confirmpassword)){
         if($request->newpassword == $request->confirmpassword){
            // dd('Hello World');
         $updatepassword['password'] =Hash::make($request->newpassword);
          User::where('id',$request->getUserId)->update($updatepassword);
         session()->flash('success','Password changed Successfully ,password:'.$request->newpassword);
         }else{
        session()->flash('Wrong','Password does not match');
         }
        }
        return back();

    }
}