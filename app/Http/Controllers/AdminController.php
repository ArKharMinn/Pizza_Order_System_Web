<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //account info

    public function account() {
        return view('admin.adminDetail.account');
    }

    public function editAccount() {
        return view('admin.adminDetail.edit');
    }

    //inbox
    public function inbox(){
        $inbox = Contact::when(request('search'),function($query){
            $query->orWhere('name','like','%'.request('search').'%')
            ->orWhere('email','like','%'.request('search').'%')
            ->orWhere('message','like','%'.request('search').'%');
        })->orderBy('created_at','desc')
        ->get();
        return view('admin.contact.contact',compact('inbox'));
    }

    //inbox message delete
    public function messageDelete(Request $request){
        Contact::where('contact_id',$request->contactId)->delete();
        $response = [
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    //inbox delete
    public function inboxDelete(Request $request){
        Contact::where('contact_id',$request->contact_id)->delete();
        $response = [
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    //inbox message
    public function message($id){
        $data = Contact::where('contact_id',$id)->first();
        return view('admin.contact.message',compact('data'));
    }

    //userLIst
    public function userList(){
        $user = User::when(request('search'),function($query){
            $query->orWhere('name','like','%'.request('search').'%')
            ->orWhere('email','like','%'.request('search').'%')
            ->orWhere('phone','like','%'.request('search').'%');
        })
        ->where('role','user')->get();
        return view('admin.userList.userList',compact('user'));
    }

    //user delete
    public function userDelete(Request $request){
        User::where('id',$request->user_id)->delete();
        $response = [
            'status' => 'success',
        ];
        return response()->json($response,200);
    }

    //user role change
    public function userRole(Request $request){
        User::where('id',$request->user_id)->update([
            'role' => $request->role,
        ]);
        $response = [
            'status' => 'success'
        ];
        return response()->json($response,200);
    }

    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
          $query->orWhere('name','like','%'.request('key').'%')
          ->orWhere('email','like','%'.request('key').'%')
          ->orWhere('phone','like','%'.request('key').'%')
          ->orWhere('address','like','%'.request('key').'%')
          ->orWhere('gender','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        $admin->appends(request()->all());
        return view('admin.adminDetail.adminList',compact('admin'));
    }

    //account change role
    public function changeRole(Request $request){
        User::where('id',$request->user_id)->update([
            'role' => $request->role,
        ]);
        $response = [
            'status' => 'success',
        ];
        return response()->json($response,200);
    }

    //account delete
    public function delete($id) {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'delete']);
    }

    //account update

    public function update($id, Request $request) {
        $data = $this->getUpdateData($request);

        //image upload

        if( $request->hasFile('image') ) {
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;


            if ( $dbImage != null ) {
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#account');
    }

    //data
    private function getUpdateData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }
}
