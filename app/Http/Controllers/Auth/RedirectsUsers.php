<?php

namespace App\Http\Controllers\Auth;

use Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {   
        if(Auth::check()){
            switch (Auth::user()->role_id) {
                case '1':
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/admin';
                    break;
                
                case '2':
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/docente';
                    break;

                case '3':
                    return property_exists($this, 'redirectTo') ? $this->redirectTo : '/estudiante';
                    break;
            }
        }
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
