<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index($author_id) {
        $author = Author::find($author_id);
        return view('author', ['author' => $author]);
    }
}
