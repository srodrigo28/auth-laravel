@extends('layout')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen w-full bg-slate-900 text-slate-100 font-sans overflow-hidden">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity class="fixed inset-0 bg-black/80 z-40 md:hidden backdrop-blur-sm"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-800 border-r border-slate-700 transition-transform duration-300 ease-in-out md:static md:translate-x-0 flex flex-col shadow-2xl shrink-0">
        
        <div class="h-16 flex items-center px-6 border-b border-slate-700 bg-slate-800">
            <div class="flex items-center gap-3 font-bold text-xl tracking-tight">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center shadow-lg shadow-red-600/20">
                    <i data-lucide="layout-grid" class="text-white w-5 h-5"></i>
                </div>
                <span>Admin<span class="text-red-500">Panel</span></span>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto p-4 space-y-1">
            <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-2">Principal</p>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-slate-700 p-3 rounded-lg transition-colors group">
                <i data-lucide="home" class="w-5 h-5 text-slate-400 group-hover:text-red-400 transition-colors"></i>
                Dashboard
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.relatorios') }}" class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-slate-700 p-3 rounded-lg transition-colors group">
                <i data-lucide="bar-chart-2" class="w-5 h-5 text-slate-400 group-hover:text-red-400 transition-colors"></i>
                Relatórios
            </a>
            @endif
            
            <a href="#" class="flex items-center gap-3 text-slate-300 hover:text-white hover:bg-slate-700 p-3 rounded-lg transition-colors group">
                <i data-lucide="users" class="w-5 h-5 text-slate-400 group-hover:text-red-400 transition-colors"></i>
                Usuários
            </a>
        </nav>

        <div class="p-4 border-t border-slate-700">
            <form action="{{ route('logout') }}" method="POST">
                @csrf <button type="submit" class="flex items-center gap-3 text-sm font-medium text-slate-400 hover:text-white transition w-full p-2 hover:bg-slate-700 rounded-lg">
                    <i data-lucide="log-out" class="w-4 h-4"></i> Sair
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col w-full min-w-0">
        
        <header class="bg-slate-800 border-b border-slate-700 h-16 flex items-center justify-between px-4 w-full shrink-0">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-white md:hidden focus:outline-none">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <h1 class="text-lg font-bold text-white truncate">Visão Geral</h1>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="hidden md:block text-xs font-mono text-slate-500 bg-slate-900 px-2 py-1 rounded border border-slate-700">v2.4.0</span>
                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white border border-slate-600">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto bg-slate-900 w-full scroll-smooth">
            
            <div class="p-4 md:p-6 w-full space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                    <div class="bg-slate-800 p-5 rounded-lg border border-slate-700 shadow-sm hover:border-red-500/50 transition-colors w-full">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-400 text-xs font-bold uppercase">Total Usuários</p>
                                <h3 class="text-2xl font-bold text-white mt-1">{{ $totalUsers }}</h3>
                            </div>
                            <div class="p-2 bg-slate-700/50 rounded-lg">
                                <i data-lucide="users" class="w-5 h-5 text-blue-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 p-5 rounded-lg border border-slate-700 shadow-sm hover:border-red-500/50 transition-colors w-full">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-400 text-xs font-bold uppercase">Admins</p>
                                <h3 class="text-2xl font-bold text-white mt-1">{{ $totalAdmins }}</h3>
                            </div>
                            <div class="p-2 bg-slate-700/50 rounded-lg">
                                <i data-lucide="shield" class="w-5 h-5 text-red-400"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-800 p-5 rounded-lg border border-slate-700 shadow-sm hover:border-red-500/50 transition-colors w-full">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-slate-400 text-xs font-bold uppercase">Regulares</p>
                                <h3 class="text-2xl font-bold text-white mt-1">{{ $totalRegular }}</h3>
                            </div>
                            <div class="p-2 bg-slate-700/50 rounded-lg">
                                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-800 border border-slate-700 rounded-lg shadow-sm w-full overflow-hidden">
                    <div class="p-4 border-b border-slate-700 flex justify-between items-center w-full">
                        <h3 class="font-bold text-white flex items-center gap-2">
                            <i data-lucide="list" class="w-4 h-4 text-slate-400"></i> Base de Usuários
                        </h3>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Buscar..." class="bg-slate-900 border border-slate-600 text-xs rounded px-3 py-1.5 text-white focus:outline-none focus:border-red-500 hidden sm:block">
                            <button class="bg-red-600 hover:bg-red-500 text-white px-3 py-1.5 rounded text-xs font-bold transition">
                                + Novo
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto w-full">
                        <table class="w-full text-left text-sm text-slate-400">
                            <thead class="bg-slate-900/50 text-slate-200 uppercase text-xs">
                                <tr>
                                    <th class="p-4 w-20">ID</th>
                                    <th class="p-4">Usuário</th>
                                    <th class="p-4">Email</th>
                                    <th class="p-4">Telefone</th>
                                    <th class="p-4 text-center">Perfil</th>
                                    <th class="p-4 text-right">Data</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-700/30 transition">
                                    <td class="p-4 font-mono text-xs">#{{ $user->id }}</td>
                                    <td class="p-4 font-medium text-white">{{ $user->name }}</td>
                                    <td class="p-4">{{ $user->email }}</td>
                                    <td class="p-4 text-xs">{{ $user->telefone ?? '-' }}</td>
                                    <td class="p-4 text-center">
                                        @if($user->role === 'admin')
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20 uppercase">Admin</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 uppercase">User</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right text-xs font-mono">{{ $user->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if(method_exists($users, 'links'))
                    <div class="p-3 border-t border-slate-700 bg-slate-800/50 w-full">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>

            </div>
        </main>
    </div>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
@endsection