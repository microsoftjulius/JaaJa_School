<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getDashboardBlade()
    {
        $all_users = User::where('id','!=',auth()->user()->id)->get();
        $number_of_students = $this->countnumberOfStudents();
        $number_of_parents = $this->countNumberOfParents();
        $number_of_offline_users = $this->countOfflineMembers();
        $number_of_online_users  = $this->countOnlineMembers();
        return view('admin.index',compact('all_users','number_of_parents','number_of_students','number_of_offline_users','number_of_online_users'));
    }

    protected function logout(){
        User::where('id',auth()->user()->id)->update(array( 'user_online' => 'false' ));
        Auth::logout();
        return redirect('/');
    }

    /**
     * This function counts the number of parents
     */
    private function countNumberOfParents(){
        return DB::table('parent_information')->count();
    }

    /**
     * This function counts the number of students
     */
    private function countnumberOfStudents(){
        return DB::table('students')->count();
    }

    /**
     * This function counts the number of offline members
     */
    private function countOfflineMembers(){
        return User::where('user_online','false')->count();
    }

    /**
     * This function counts the number of online members
     */
    private function countOnlineMembers(){
        return User::where('user_online','true')->count();
    }
}
