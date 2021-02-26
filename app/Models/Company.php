<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name', 'email', 'activity', 'website', 'logo'
    ];

    
    public static function allCompanies() {
        return Cache::remember('all_companies', 500, function() {
            return static::latest()->get();
        });
    }

    public function employees() {
    	return $this->hasMany(Employee::class);
    }


    //If logo is URL simply return the URL , if not return the url with the logo name on the company logos public folder
    public function getImageSourceAttribute() {
    	return filter_var($this->logo, FILTER_VALIDATE_URL) ? $this->logo : ( url('/') . "/company_logos/" . $this->logo );
    }
}
