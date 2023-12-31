<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;


class WebController extends Controller
{
    public $notifications = [];
    public function __construct()
    {
        $user = User::find(2);
        $this->notifications = $user->notifications ?? [];
    }

    public function index()
    {
        $produsts = Product::all();
        return view('web.index', ['products' => $produsts, 'notifications' => $this->notifications]);
    }

    public function contactUs()
    {
        return view('web.contact_us', ['notifications' => $this->notifications]);
    }

    public function readNotification(Request $request)
    {
        $id = $request->all()['id'];
        DatabaseNotification::find($id)->markAsRead();
        
        return response(['result' => true]);
    }
}
