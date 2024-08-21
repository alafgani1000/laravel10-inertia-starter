<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $permissions = collect();
        if (isset($request->user()->roles)) {
            $request->user()->roles()->each(function ($role, $key) use($permissions) {
                $permissions->push($role->permissions->pluck('name'));
            });
        }
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'role' => isset($request->user()->roles) ? $request->user()->roles->pluck('name') : "",
                'permission' => $permissions
            ],
        ];
    }
}
