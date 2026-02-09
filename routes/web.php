<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User; // <--- Importante para contar os usuários

/*
|--------------------------------------------------------------------------
| 1. ROTAS PÚBLICAS (Visitantes)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { 
    return redirect()->route('login'); 
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| 2. ROTAS PROTEGIDAS (Usuários Logados)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // --- ROTA DASHBOARD (CORRIGIDA) ---
    Route::get('/dashboard', function () {
        
        // 1. Cálculos para os Cards (O que estava faltando!)
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        // Se não tiver coluna 'role', use User::count() para tudo ou crie a lógica
        $totalRegular = $totalUsers - $totalAdmins; 

        // 2. Buscar últimos 5 usuários para a tabela de "Atividades Recentes"
        $users = User::orderBy('id', 'desc')->take(5)->get();

        // 3. Envia os dados para a view dashboard.blade.php
        return view('dashboard', compact('totalUsers', 'totalAdmins', 'totalRegular', 'users'));
        
    })->name('dashboard'); 

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| 3. ÁREA ADMINISTRATIVA (Apenas Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin']) 
    ->prefix('admin') 
    ->group(function () {
        
        // Rota de Relatórios Completa
        Route::get('/relatorios', function () {
            
            // Cálculos mais detalhados para o Admin
            $totalUsers = User::count();
            $totalAdmins = User::where('role', 'admin')->count();
            $totalRegular = User::where('role', 'user')->count();

            // Lista com paginação para a tabela do admin
            $users = User::orderBy('id', 'desc')->paginate(10);

            // Retorna a view específica de admin (crie o arquivo admin/reports.blade.php se não tiver)
            // Se não tiver a view 'admin.reports', mude abaixo para 'dashboard' temporariamente
            return view('admin.reports', compact('totalUsers', 'totalAdmins', 'totalRegular', 'users')); 

        })->name('admin.relatorios');

    });