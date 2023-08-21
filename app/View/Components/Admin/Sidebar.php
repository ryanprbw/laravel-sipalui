<?php

namespace App\View\Components\Admin;

use App\Models\Menu;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function render()
    {
        try {
            $user = auth()->user();
                $permissions = Menu::join('menus_role', 'menus.menu_id', '=', 'menus_role.menu_id')
                    ->where('level_id', $user['level_id'])
                    ->orderBy('sort')
                    ->get();
            return view('layouts.admin.partials.sidebar', compact('permissions'));
        } catch (\Exception $exception) {
//            return view('errors.error-landing', ['message' => $exception->getMessage()]);
//            if (auth()->hasUser()) {
//                return abort(404);
//            } else {
//            }
        }
    }
}
