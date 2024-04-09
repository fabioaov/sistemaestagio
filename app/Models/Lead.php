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
    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'id_lead');
    }
}
