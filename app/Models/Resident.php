<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Resident extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'identity_number',
    ];

    protected $appends = ['gender', 'birthdate']; // Add these for automatic retrieval

    public function getGenderAttribute()
    {
        return $this->extractInfoFromKtp()['gender']; // Call the method from controller
    }

    public function getBirthdateAttribute()
    {
        return $this->extractInfoFromKtp()['birthdate']; // Call the method from controller
    }

    // Method to extract gender and birthdate from KTP number (implementation details based on reference)
    private function extractInfoFromKtp($ktpNumber)
    {
        // Implement logic to extract gender and birthdate based on https://dukcapil.kalbarprov.go.id/post/arti-16-digit-nomor-induk-kependudukan
        // This might involve parsing the first 6 digits and potentially checking for a specific digit for gender

        return [
            'gender' => '...', // Replace with extracted gender
            'birthdate' => '...', // Replace with extracted birthdate
        ];
    }
}
