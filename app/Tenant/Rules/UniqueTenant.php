<?php

namespace App\Tenant\Rules;

use App\Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueTenant implements Rule
{
    protected $table;
    /**
     * Create a new rule instance.
     *
     * @param string $table //tabela onde o atributo será único por tenant
     * 
     * @return void
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //app() cria uma instancia da classe, permitindo acessar seus métodos
        //getTenantIdentify() retorna o id do tenant do usuário autenticado
        $tenantId = app(ManagerTenant::class)->getTenantIdentify();
        
        //verifica se o registro já existe na tabela
        $register = DB::table($this->table)
                        ->where($attribute, $value)
                        ->where('tenant_id',$tenantId)
                        ->first();
        
        return is_null($register);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor para :attribute já está em uso!';
    }
}
