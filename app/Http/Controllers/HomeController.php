<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function index()
    {
        return view('home');
    }
    public function contacts($id)
    {
        return view('contacts')->with(compact('id'));;
    }
    public function income($id)
    {
        return view('income')->with(compact('id'));;
    }
    public function expense($id)
    {
        return view('expense')->with(compact('id'));
    }
    
    public function user($id)
    {
        return view('user')->with(compact('id'));
    }
    public function useredit($id)
    {
        return view('user-edit')->with(compact('id'));
    }
    public function expenseedit($userid, $expenseid)
    {
        return view('expense-edit')->with(compact('userid'))->with(compact('expenseid'));
    }
    public function expenseview($userid, $expenseid)
    {
        return view('expense-view')->with(compact('userid'))->with(compact('expenseid'));
    }
    
    public function contactedit($userid, $contactid)
    {
        return view('contact-edit')->with(compact('userid'))->with(compact('contactid'));
    }
    public function contactview($userid, $contactid)
    {
        return view('contact-view')->with(compact('userid'))->with(compact('contactid'));
    }
    
    public function incomeedit($userid, $incomeid)
    {
        return view('income-edit')->with(compact('userid'))->with(compact('incomeid'));
    }
    public function incomeview($userid, $incomeid)
    {
        return view('income-view')->with(compact('userid'))->with(compact('incomeid'));
    }
    
}
