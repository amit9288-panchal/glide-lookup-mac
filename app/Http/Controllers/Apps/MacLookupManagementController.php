<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use App\Models\OUI;
use Illuminate\Http\Request;


class MacLookupManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $query = OUI::query();
        $macPrefix = (!empty($search)) ? getMacPrefix($search) : null;
        if ($search) {
            $query->where('assignment', 'like', "%{$macPrefix}%");
        }
        $macs = $query->paginate(10)->withQueryString();
        return view('macs.index', compact('macs', 'search'));
    }

}
