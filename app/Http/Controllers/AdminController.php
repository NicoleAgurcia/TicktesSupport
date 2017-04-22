<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mailers\AppMailer;
use App\User;
use App\Category;
use App\Role;
use Illuminate\Support\Facades\Auth;



class AdminController extends Controller{
  public function create_user(){  
  	$roles = Role::all();
		return view('admin.create_user',compact('roles'));
	}
	
	public function store(Request $request, AppMailer $mailer){
    $this->validate($request, [
     	'name'     => 'required|max:255',
      'email'    => 'required|email|max:255|unique:users',
      'rol'      => 'required|max:10',
      'password' => 'required|min:6|confirmed',
    ]);

    $user = new User([
    	'name'     => $request['name'],
      'email'    => $request['email'],
      'rol'      => $request['rol'],
      'password' => bcrypt($request['password']),
    ]);

    $user->save();

    return redirect()->back()->with("status", "A user with name: $user->name has been created.");
	}

  public function create_category(){  
    $category = Category::all();
    return view('admin.create_category',compact('category'));
  }
  
  public function store_category(Request $request, AppMailer $mailer){
    $this->validate($request, [
      'category' => 'required|max:255'
    ]);
    $category = new Category([
      'name' => $request['category'],
    ]);
    $category->save();
    return redirect()->back()->with("status", "A category with name: $category->name has been created.");
  }

}
