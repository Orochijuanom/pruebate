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
        $string = $this->getString($table['attributes']);
        //Registrando la transacción
        Log::create([
            'user_id' => \Auth::user()->id,
            'tabla' => $table['table'],
            'operacion' => 'AGREGAR',
            'descripcion' => $string
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
        $string = $this->getString($table['attributes']);
        Log::create([
            'user_id' => \Auth::user()->id,
            'tabla' => $table['table'],
            'operacion' => 'ELIMINAR',
            'descripcion' => $string
        ]);
    }

    public function updated($table)
    {
        $string = $this->getString($table['attributes']);
        //Registrando la transacción
        Log::create([
            'user_id' => \Auth::user()->id,
            'tabla' => $table['table'],
            'operacion' => 'ACTUALIZAR',
            'descripcion' => $string
        ]);  
    }

    /**
    * crea un string con el array
    **/
    private function getString($array)
    {
        $string = '';
        foreach($array as $key => $value){
            $string .= $key . ' - ' .  $value .', ';
        }
        return $string;
    }
}