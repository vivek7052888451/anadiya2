<?php

namespace App\Http\Controllers;

use App\Models\Module;
// use App\MarkAttendance;
use App\Models\ModulesHasPermissions;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\User;
class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        $module = Module::all();
        $permission = Permission::all();
        $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->orderBy('module_id')->get();
        return view('settingPages.modules-permissions')->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))->with(compact('permission'));
    }
    public function selectedModule(Request $request){
      $selectedModulePermission = ModulesHasPermissions::where('module_id',$request->module_id)->pluck('permission_id')->toArray();
      $permission_name = Permission::whereIn('id',$selectedModulePermission)->pluck('name')->toArray();
      
       if(!empty($permission_name))
        {
           return [
                'data' =>$permission_name,
                'type' => 'success',
                'class' => 'alert-success',
                ];
                }
            else{
            return [
            'type' => 'error',
            'msg' => 'Something went Wrong',
            'class' => 'alert-danger',
            ];
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $role = $request->input('role');
      Role::create(['name'=> $role]);
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'module'=>'required|unique:modules,name'
       ]);
       $module = $request->input('module');
       Module::create(['name' => $module]);
       return redirect()->back()->with('success', 'Module Name added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $role = Role::all();
        $module = Module::all();
        $permission = Permission::all();
        // $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->groupBy('module_id')->get();
        
        return view('settingPages.rolesAndPermissions')->with(compact('role'))->with(compact('module'))->with(compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // dd($module);
        $role = Role::all();
        $module = Module::all();
        $permission = Permission::all();
        $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->get();
        $update = Module::where('id', $id)->first();
        if($request->isMethod('post')){
            $request->validate([
                'module'=>'required|unique:modules,name'
           ]);
           $data = $request->all();
           unset($data['_token']);
           Module::where('id', $id)->update(['name'=> $data['module']]);
           return  redirect()->route('modules.index')->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))->with(compact('permission'));
        }
        
        return view('settingPages.modules-permissions')->with(compact('update'))->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))->with(compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::all();
        $module = Module::all();
        $permission = Permission::all();
        $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->get();
        $updatePermission = Permission::where('id', $id)->first();
        
        if($request->isMethod('post')){
            $request->validate([
                'permission'=>'required|unique:modules,name'
           ]);
           $data = $request->all();
           unset($data['_token']);
           Permission::where('id', $id)->update(['name'=> $data['permission']]);
           return  redirect()->route('modules.index')->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))->with(compact('permission'));
        }
        
        return view('settingPages.modules-permissions')->with(compact('updatePermission'))->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))
        ->with(compact('permission'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $res = ModulesHasPermissions::where('module_id' , $id)->count();
        if($res != 0){
            return redirect()->back()->with('error',"You can't delete the module!");
        }else{
            Module::where('id', $id)->delete();
            return redirect()->back()->with('success',"Successfully Deleted!");
        }
    }
    public function addPermission(Request $request){
        $request->validate([
            'permission'=>'required|unique:permissions,name'
       ]);
       $permission = $request->input('permission');
       Permission::create(['name'=> $permission]);
       return redirect()->back()->with('success', 'Permission Name added successfully!');
    }
    public function assignPermissionToModule(Request $request)
     {
        $request->validate([
            'module_id'=> 'required',
            'permission_id'=>'required'
       ]);
       ModulesHasPermissions::create($request->all());
       return redirect()->back()->with('success', 'Permission assigned successfully!');
     }
     public function deletePermission(Request $request, $id)
     {
        $res = ModulesHasPermissions::where('permission_id' , $id)->count();
        if($res != 0){
            return redirect()->back()->with('error',"You can't delete the permission!");
        }else{
            Permission::where('id', $id)->delete();
            return redirect()->back()->with('success',"Successfully Deleted!");
        }
     }
     public function updateModuleHasPermission(Request $request, $id)
     {
        $role = Role::all();
        $module = Module::all();
        $permission = Permission::all();
        $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->get();
        $updateMP = ModulesHasPermissions::with(['module','permission'])->where('id', $id)->first();
        if($request->isMethod('post')){
            $request->validate([
                'module_id'=> 'required',
                'permission_id'=>'required'
           ]);
           $data = $request->all();
           unset($data['_token']);
           ModulesHasPermissions::where('id', $id)->update($data);
           return  redirect()->route('modules.index')->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))->with(compact('permission'));
        }
        
        return view('settingPages.modules-permissions')->with(compact('updateMP'))->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))
        ->with(compact('permission'));
     }
     public function deleteModulePermission(Request $request, $id)
     {
            ModulesHasPermissions::where('id', $id)->delete();
            return redirect()->back()->with('success',"Successfully Deleted!");
     }
     public function assignPermissionToRole(Request $request)
     {
       $role = Role::findByName($request->input('role'));
       $role->givePermissionTo($request->input('permission'));
       $user = User::role($role)->get();
       $count = $user->count();
       for($i = 1; $i < $count; $i++){
        $user[$i]->givePermissionTo($request->input('permission'));
       }

       return 'Successfully Updated';
     }
     public function UserPermission(Request $request)
     {
         $roles = Role::all();
         $admins = User::role($roles)->get();
         $permission = Permission::all();
         $module = Module::all();

         // $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->groupBy('module_id')->get();
         // dd($modulehaspermission);
            
         return view('settingPages.user_permissions')->with(compact('roles'))->with(compact('admins'))->with(compact('permission'))->with(compact('module'));
     }
     public function updateUserPermission(Request $request)
     {
         $id = $request->input('id');
         $permissions = $request->input('permissions');
         if($id){
            $exists = User::where([
                 'id' => $id,
             ])->exists();
                if($exists){

                 $new_user = User::where([
                     'id' => $id,
                 ])->first();
            $isOk = $new_user->syncPermissions($permissions);
                 if($isOk){

                     return [
                         'msg' => 'User permissions changed successfully.',
                         'type' => 'success'
                     ];

                 }else{
                     return [
                         'msg' => 'Sorry! Unable to update permissions try again.',
                         'type' => 'error'
                     ];
                 }

             }else{
                 return [
                     'msg' => 'Sorry! This user does not exists in our database.',
                     'type' => 'error'
                 ];
             }

         }else{
             return [
                 'msg' => 'Sorry! Unable to find user in database.',
                 'type' => 'error'
             ];
         }
     }

     public function getModule(Request $request)
     {
         $id = $request->input('id');
         $role = Role::all();
         $module = Module::all();

         $permission = Permission::all();         
         $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->groupBy('module_id')->get();
         $rolehaspermission = DB::select("SELECT * FROM `role_has_permissions` where `role_id` = $id");
         $latest_markatts = MarkAttendance::where('emp_id' , auth()->user()->emp_id)->orderBy('created_at', 'desc')->TAKE(1)->get();
         return view('settingPages.getModule')->with(compact('role'))->with(compact('modulehaspermission'))->with(compact('module'))->with(compact('permission'))
         ->with(compact('rolehaspermission'))->with(compact('latest_markatts'));
     }

     public function getUserPermission(Request $request)
     {
         $id = $request->input('id');
         $roles = Role::all();
         $admins = User::role($roles)->where('id' , $id)->get();
         $permission = Permission::all();
         $module = Module::all();
         $modulehaspermission = ModulesHasPermissions::with(['module','permission'])->groupBy('module_id')->get();
         $rolehaspermission = DB::select("SELECT * FROM `model_has_permissions` where `model_id` = $id");

         $latest_markatts = MarkAttendance::where('emp_id' , auth()->user()->emp_id)->orderBy('created_at', 'desc')->TAKE(1)->get();
         return view('settingPages.getUserPermissions')->with(compact('roles'))->with(compact('admins'))->with(compact('permission'))->with(compact('module'))
         ->with(compact('latest_markatts'))->with(compact('modulehaspermission'))->with(compact('rolehaspermission'));
     }

    public function searchUser($id)
    {

        $roles = Role::all();
         $users = User::where('emp_id', 'LIKE', '%'.$id.'%')->where('emp_status','Active')->role($roles)->get();
     
        if(count($users) > 0){
            return [
                     'msg' => 'User find successfully.',
                     'type' => 'success',
                     'data'=>$users
                 ];
        }
        else{
            return [
                     'msg' => 'Sorry! User Not found ! try again.',
                     'type' => 'error'
                 ];
        }
    }
}
