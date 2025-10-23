<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use SoftDeletes, HasTranslations;

    protected $table = 'governorates';
    protected $fillable = ['name', 'status', 'country_id'];
    // public $timestamps = false;
    public array $translatable = ['name'];

    // relation
    // country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    // cities
    public function cities()
    {
        return $this->hasMany(City::class, 'governorate_id');
    }

    // fromFlightTicket
    public function fromFlightTicket()
    {
        return $this->hasMany(FlightTicket::class, 'from_governorate_id');
    }

    // toFlightTicket
    public function toFlightTicket()
    {
        return $this->hasMany(FlightTicket::class, 'to_governorate_id');
    }

    // tours
    public function tours()
    {
        return $this->hasMany(Tour::class, 'governorate_id');
    }

    // flights
    public function flights()
    {
        return $this->hasMany(Flight::class, 'governorate_id');
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    // accsessores
    public function getStatusAttribute($status)
    {
        return $status == 1 ? 'on' : '';
    }
}
