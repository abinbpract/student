<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function address()
    {
        return $this->hasOne(Address::class);
    }
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
    public function hobbies()
    {
        return $this->belongsToMany(Hobbie::class,'entertainments');
    }
    protected function name(): Attribute
    {
        return Attribute :: make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }
    protected function email():Attribute
    {
        return Attribute :: make(
            set: fn ($value) =>strtolower($value),
        );
    }
    protected function dateOfBirth(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => Carbon::parse($value)->format('d/m/Y'),
        ); 
    }
}
