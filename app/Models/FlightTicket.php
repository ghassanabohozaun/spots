<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class FlightTicket extends Model
{
    use SoftDeletes, HasTranslations;
    protected $table = 'flight_tickets';
    protected $fillable = ['id', 'title', 'details', 'price', 'from_country_id', 'from_governorate_id', 'to_country_id', 'to_governorate_id', 'status', 'photo'];

    public array $translatable = ['title', 'details'];

    // relations
    public function formCountry()
    {
        return $this->belongsTo(Country::class, 'from_country_id');
    }

    public function toCountry()
    {
        return $this->belongsTo(Country::class, 'to_country_id');
    }

    public function formGovernorate()
    {
        return $this->belongsTo(Governorate::class, 'from_governorate_id');
    }

    public function toGovernorate()
    {
        return $this->belongsTo(Governorate::class, 'to_governorate_id');
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
    // accessories
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y h:i A');
    }
}
