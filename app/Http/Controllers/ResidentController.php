<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();

        if (!$request->has('sort_by')) {
            $query->orderBy('name');
        }
        if ($request->has('sort_by')) {
            $sortColumn = $request->get('sort_by');
            $sortDirection = $request->get('sort_dir', 'asc');
            $query->orderBy($sortColumn, $sortDirection);
        }
        if ($request->filled('filter')) {
            $filterValue = $request->get('filter');

            $query->where(function ($query) use ($filterValue) {
                $query->where('name', 'like', '%' . $filterValue . '%')
                    ->orWhere('identity_number', 'like', '%' . $filterValue . '%')
                    ->orWhere('email', 'like', '%' . $filterValue . '%');
            });
        }

        $perPage = $request->get('per_page', 10);
        $residents = $query->paginate($perPage);

        return view('resident.index', compact('residents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:residents',
            'address' => 'required|string',
            'identity_number' => 'required|numeric|digits:16|unique:residents',
        ]);

        $resident = new Resident();
        $resident->name = $request->name;
        $resident->email = $request->email;
        $resident->address = $request->address;
        $resident->identity_number = $request->identity_number;

        $resident->save();

        return redirect()->back()->with('success', 'Resident created successfully.');
    }

    public function retrieve()
    {
        $residents = Resident::all();

        return response()->json($residents);
    }
}
