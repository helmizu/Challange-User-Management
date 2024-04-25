<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\Resident;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();
        $limit = 10;
        if ($request->filled('limit')) {
            $limit = $request->get('limit');
        }
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

        $perPage = $request->get('per_page', $limit);
        $residents = $query->paginate($perPage);

        return view('resident.index', compact('residents'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:residents',
                'address' => 'required|string',
                'identity_number' => 'required|numeric|digits:16|unique:residents',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
        
        $resident = new Resident();
        $resident->name = $request->name;
        $resident->email = $request->email;
        $resident->address = $request->address;
        $resident->identity_number = $request->identity_number;

        $resident->save();

        return redirect()->back()->with('success', 'Resident created successfully.');
    }

    public function ajax()
    {
        return view('resident.ajax');
    }

    public function http(Request $request)
    {
        $params = $request->all();
        $request = Request::create('/api/residents', 'GET', $params);
        $response = Route::dispatch($request);
        $residents = $response->getOriginalContent();

        // this should using Http client, but cant do internal request due to the laravel issue.
        // $residents = Http::get('api/residents', $params);

        return view('resident.http', compact('residents'));
    }
}
