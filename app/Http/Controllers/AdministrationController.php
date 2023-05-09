<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AdministrationController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user) {
            if ($user->hasPermission('admin')) {
                return view('admin.index', compact('user'));
            }
        }
        return view('admin.auth');
    }

    public function orders_index() {
        $orders = Order::all();

        return view('admin.orders', ['orders' => $orders]);
    }

    public function products_index() {
        dd('products_index');
    }

    public function import_index() {
        return view('admin.import');
    }

    public function import_process(Request $request) {
        $importType = $request->input('importType');
        $file = $request->file('importFile');

        if (!$file) {
            $errors = ['Файл не был получен'];
        } else if ($importType == 'authors') {
            $errors = AddingController::addAuthors($file->getRealPath());
        } else if ($importType == 'book_product') {
            $errors = AddingController::addBookProduct($file->getRealPath());
        } else {
            $errors = ['Выбранная форма не поддерживается'];
        }

        if($errors == []) {$success = true;}
        else {$success = false;}

        return redirect()->back()->with(['errors' => $errors, 'success' => $success]);
    }

    public function auth(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($validatedData)) {
            if (Auth::user()->hasPermission('admin')) {
                return redirect('/admin');
            } else {
                Auth::logout();
                return redirect('/admin')->with('error', 'You do not have permission to access the admin panel.');
            }
        } else {
            return redirect('/admin')->with('error', 'Invalid credentials. Please try again.');
        }
    }

}
