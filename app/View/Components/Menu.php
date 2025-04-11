<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
  
    public $active;

    public function __construct($active)
    {
        //
        
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = $this->list();
        return view('components.menu', ['list' => $list, 
                                        'active' => $this->active]);
    }
    public function list()
    {
        $user = Auth::user();
        $menu = [
            [
                'label' => 'Dashboard',
                'route' => 'dashboard',
                'icon'  => 'fa-solid fa-house-chimney'
            ],
            [
                'label' => 'Student',
                'route' => 'dashboard.student',
                'icon'  => 'fas fa-user-graduate'
            ],
            [
                'label' => 'Users',
                'route' => 'dashboard.users',
                'icon'  => 'fas fa-user'
            ]
         ];

          // Logika untuk menyembunyikan menu berdasarkan level pengguna
        if ($user && $user->level == '1') {
            // Misalnya, jika level pengguna adalah level1, maka sembunyikan menu Manajemen Buku
            //Jika ingin menampilkan semua menu kosongkan saja
            
        }
        elseif ($user->level == '2') {
            unset($menu[3]);
        }
        elseif ($user->level == '3') {
	          unset($menu[1]);
            unset($menu[3]);
        }

        return $menu;
    }
    public function isActive($label){
        return $label === $this->active;
    }
}