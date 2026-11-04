<?php

namespace App\Http\Controllers;

use App\Models\Figurine;
use Illuminate\Http\Request;

class ModaleController extends Controller
{
    public function showAjax(int $id)
    {
        return view("figurines._show", [
            "figurine" => Figurine::findOrFail($id),
        ]);
    }
}
