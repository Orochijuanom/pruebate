<?php

namespace App\Observers;
use App\Log;
class LogObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created($table)
    {
        //Registrando la transacción
        Log::create([
            'user_id' => \Auth::user()->id,
            'tabla' => $table->table,
            'operacion' => 'AGREGAR',
            'descripcion' => $table->attributes
        ]);  
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted($table)
    {
        //Registrando la transacción
        Log::create([
            'user_id' => \Auth::user()->id,
            'tabla' => $table->table,
            'operacion' => 'ELIMINAR',
            'descripcion' => $table->attributes
        ]);
    }

    public function updated($table)
    {
        //Registrando la transacción
        Log::create([
            'user_id' => \Auth::user()->id,
            'tabla' => $table->table,
            'operacion' => 'ACTUALIZAR',
            'descripcion' => $table->attributes
        ]);  
    }
}