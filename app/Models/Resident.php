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
        return $this->extractInfoFromKtp($this->identity_number)['gender']; // Call the method from controller
    }

    public function getBirthdateAttribute()
    {
        return $this->extractInfoFromKtp($this->identity_number)['birthdate']; // Call the method from controller
    }

    // Method to extract gender and birthdate from KTP number (implementation details based on reference)
    private function extractInfoFromKtp($identity_number)
    {
      $gender = '';
      $birthdate = '';
      if (strlen($identity_number) === 16) {
          $shortBirthdate = substr($identity_number, 6, 6);
          $day = substr($shortBirthdate, 0, 2);
          $month = substr($shortBirthdate, 2, 2);
          $year = substr($shortBirthdate, 4, 2);
          $currentYear = date('Y');
          $actualYear = +('20' . $year) - $currentYear > 0  ? '19' . $year : '20' . $year;
          $actualDay = ($day < 40) ? $day : $day - 40;
          
          $birthdate = $actualYear . '-' . $month . '-' . str_pad($actualDay, 2, '0', STR_PAD_LEFT);
          $gender = ($day < 40) ? 'Male' : 'Female';
      } 

        return [
            'gender' => $gender, // Replace with extracted gender
            'birthdate' => $birthdate, // Replace with extracted birthdate
        ];
    }
}
