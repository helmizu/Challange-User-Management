<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function index()
    {
        return view('resident.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:residents,email',
            'address' => 'required|string',
            'identity_number' => 'required|string|unique:residents,identity_number|min:16|max:16',
        ]);

        $resident = new Resident;
        $resident->name = $request->name;
        $resident->email = $request->email;
        $resident->address = $request->address;
        $resident->identity_number = $request->identity_number;
        $resident->save();

        return response()->json(['message' => 'Resident created successfully!']);
    }

    public function getResidents(Request $request)
    {
        $residents = Resident::orderBy('name', 'asc');

        // Apply filters if provided
        if ($request->has('name')) {
            $residents->where('name', 'like', "%{$request->name}%");
        }
        if ($request->has('email')) {
            $residents->where('email', 'like', "%{$request->email}%");
        }
        if ($request->has('identity_number')) {
            $residents->where('identity_number', 'like', "%{$request->identity_number}%");
        }

        // Sorting based on resident selection (implement logic based on request)
        $sortColumn = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        $residents->orderBy($sortColumn, $sortOrder);

        // Pagination (implement logic for pagination using a package like laravel-pagination)
        $perPage = 10; // Adjust per page limit as needed
        $residents = $residents->paginate($perPage);

        return response()->json($residents);
    }
}
