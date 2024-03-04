<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Team;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Franchise;

class GlobalDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     view()->composer('*', function ($view) {
    //         if(Session::get('user')){
    //             $globalTeamAccess = Employee::find(Session::get('user')->id);
    //             $globalTeamAccess = Franchise::find(Session::get('user')->id);
    //             $globalTeamAccess = Team::find(Session::get('user')->id);
    //         } else {
    //             $globalTeamAccess = Team::all()->first();
    //         }
    //         $view->with('globalTeamAccess', $globalTeamAccess);
    //     });
    // }
    // public function boot()
    // {
    //     view()->composer('*', function ($view) {
    //         $globalTeamAccess = null;
    //         if(Session::get('user')){
    //             $user = Employee::find(Session::get('user')->id);
    //             if ($user && $user->role == 'employee') {
    //                 $globalTeamAccess = $user;
    //             } else {
    //                 $franchise = Franchise::find(Session::get('user')->id);
    //                 if ($franchise && $franchise->role == 'franchies') {
    //                     $globalTeamAccess = $franchise;
    //                 } else {
    //                     $team = Team::find(Session::get('user')->id);
    //                 }
    //             }
    //         } else {
    //             $globalTeamAccess = Team::all()->first();
    //         }
            
    //         $view->with('globalTeamAccess', $globalTeamAccess);
    //     });
    // }
    
//     public function boot()
// {
//     view()->composer('*', function ($view) {
//         $globalTeamAccess = null;

//         if (Session::has('user')) {
//             $user = Employee::find(Session::get('user')->id);
//             if ($user->role == 'employee') {
//                 $globalTeamAccess = Employee::find($user->id);
//             }else{
//                 $franchise = Franchise::find(Session::get('user')->id);
//                 if ($user->role == 'franchise') {
//                     $globalTeamAccess = Franchise::find($user->id);
//                 } else{
//                     $globalTeamAccess = Team::find($user->id);
//                 }
//             }
//         } else {
//             $globalTeamAccess = Team::all()->first();
//         }

//         $view->with('globalTeamAccess', $globalTeamAccess);
//     });
public function boot()
    {
        view()->composer('*', function ($view) {
            $globalTeamAccess = null;
            if(Session::get('user')){
                $user = Employee::find(Session::get('user')->id);
                if ($user && $user->role == 'employee') {
                    $globalTeamAccess = $user;
                } else {
                    $franchise = Franchise::find(Session::get('user')->id);
                    if ($franchise && $franchise->role == 'franchies') {
                        $globalTeamAccess = $franchise;
                    } else {
                        $globalTeamAccess = Team::find(Session::get('user')->id);
                    }
                }
            } else {
                $globalTeamAccess = Team::all()->first();
            }
            
            $view->with('globalTeamAccess', $globalTeamAccess);
        });
    }

// public function boot()
// {
//     view()->composer('*', function ($view) {
//         $globalTeamAccess = null;

//         if (Session::has('user')) {
//             $user = Employee::find(Session::get('user')->id);
//             if ($user) {
//                 if ($user->role == 'employee') {
//                     $globalTeamAccess = $user;
//                 } else {
//                     $franchise = Franchise::find(Session::get('user')->id);
//                     if ($franchise && $franchise->role == 'franchise') {
//                         $globalTeamAccess = $franchise;
//                     } else {
//                         $globalTeamAccess = Team::find($user->id);
//                     }
//                 }
//             }
//         } else {
//             $globalTeamAccess = Team::first();
//         }

//         $view->with('globalTeamAccess', $globalTeamAccess);
//     });
// }


}
