<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <--- OBRIGATÓRIO: Importar o Model User

class AdminController extends Controller
{
    // Método responsável pela página de relatórios
    public function relatorios()
    {
        // 1. Buscar totais (contagem)
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegular = User::where('role', 'user')->count();

        // 2. Buscar a lista de usuários com paginação (10 por página)
        // Usamos 'paginate' para o {{ $users->links() }} funcionar na View
        $users = User::orderBy('id', 'desc')->paginate(10);

        // 3. Enviar tudo para a View 'admin.reports'
        return view('admin.reports', compact('totalUsers', 'totalAdmins', 'totalRegular', 'users'));
    }
}