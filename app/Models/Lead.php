<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cnpj',
        'razao_social',
        'nome_fantasia',
        'cep',
        'logradouro',
        'id_estado',
        'id_cidade',
        'ponto_referencia',
        'email',
        'telefone',
        'representante',
    ];
    /**
     * Define a relação "pertence a" entre este modelo e o modelo User.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    /**
     * Define a relação "tem muitos" entre este modelo e o modelo Comentario.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_lead');
    }
}
