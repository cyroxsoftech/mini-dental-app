<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoleSelector extends Component
{
    public $name;
    public $role;

    public $guards = [
        'user' => 'web',
        'dentist' => 'dentist',
    ];

    public $roles = [
        'web' => 'User',
        'dentist' => 'Dentist',
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = 'role', $selectedRole = null)
    {
        $this->name = $name;
        if (array_key_exists($selectedRole, $this->guards))
            $this->role = $this->guards[$selectedRole];
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.role-selector');
    }
}
