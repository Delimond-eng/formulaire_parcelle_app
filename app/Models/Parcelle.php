<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Parcelle extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parcelles';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip_parcelle',
        'adresse',
        'forme_geometrique',
        'dimensions',
        'etage',
        'nbre_etages',
        'nbre_maisons_location',
        'type_titre',
        'numero_titre',
        'description',
        'province_id',
        'ville_id',
        'commune_id',
        'quartier_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at'=>'datetime:d/m/Y H:i',
        'updated_at'=>'datetime:d/m/Y H:i',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Summary of generateUniqueCode
     * @return string
     */
    public static function generateUniqueCode($communeCode, $numQuartier)
    {
       do {
            $letters = strtoupper(Str::random(2));
            $digits = rand(1000, 9999);
            $code ="KN-"."PC-".$communeCode."-".$numQuartier."-".$digits."-".$letters;
        } while (self::where('nip_parcelle', $code)->exists());
        return $code;
    }
}