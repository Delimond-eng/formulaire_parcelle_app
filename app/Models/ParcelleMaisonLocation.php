<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParcelleMaisonLocation extends Model
{
    use HasFactory;



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maison_locations';

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
        'type_usage',
        'description_activite',
        'caracteristiques',
        'montant_loyer',
        'montant_loyer_devise',
        'contrat_bail',
        'duree_occupation',
        'duree_occupation_unite',
        'parcelle_id',
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
     * Summary of parcelle
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parcelle():BelongsTo{
        return $this->belongsTo(Parcelle::class, foreignKey:'parcelle_id');
    }
}
