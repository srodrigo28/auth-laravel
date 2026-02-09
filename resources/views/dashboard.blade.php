<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | LaravelAuth</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-slate-900 text-slate-200 flex h-screen overflow-hidden font-sans" x-data="{ sidebarOpen: false }">

    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50 z-20 md:hidden"></div>

    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-800 border-r border-slate-700 transition-transform duration-300 ease-in-out md:translate-x-0 md:static flex flex-col justify-between p-4">
        
        <div>
            <div class="flex items-center justify-between mb-8 px-2">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center font-bold text-slate-900">L</div>
                    <h1 class="text-xl font-bold text-white">LaravelAuth</h1>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-white">
                    ✕
                </button>
            </div>

            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 bg-slate-700/50 text-white px-3 py-2 rounded-lg border border-slate-600">
                    <span>🏠</span>
                    <span class="font-medium">Início</span>
                </a>
                
                @if(auth()->user()->role === 'admin')
                    <div class="mt-4 mb-2 text-xs text-slate-500 uppercase tracking-widest px-3 font-bold">
                        Administração
                    </div>
                    <a href="{{ route('admin.relatorios') }}" class="flex items-center gap-3 text-red-400 hover:text-white hover:bg-red-900/20 px-3 py-2 rounded-lg transition border border-transparent hover:border-red-900/30">
                        <span>📊</span>
                        <span class="font-medium">Relatórios</span>
                    </a>
                @endif

                <div class="mt-4 mb-2 text-xs text-slate-500 uppercase tracking-widest px-3 font-bold">
                    Conta
                </div>
                <a href="#" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-lg transition">
                    <span>👤</span>
                    <span class="font-medium">Meu Perfil</span>
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-700/50 px-3 py-2 rounded-lg transition">
                    <span>⚙️</span>
                    <span class="font-medium">Configurações</span>
                </a>
            </nav>
        </div>
        
        <div class="border-t border-slate-700 pt-4">
            <div class="flex items-center gap-3 px-2 mb-4">
                <div class="w-10 h-10 rounded-full bg-slate-600 flex items-center justify-center text-lg font-bold text-white border-2 border-slate-500">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 text-red-400 hover:bg-red-500/10 border border-transparent hover:border-red-500/20 p-2 rounded-lg transition text-sm font-bold">
                    <span>🚪</span> Sair
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <header class="md:hidden bg-slate-800 border-b border-slate-700 p-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center font-bold text-slate-900">L</div>
                <h1 class="text-lg font-bold text-white">Dashboard</h1>
            </div>
            <button @click="sidebarOpen = true" class="text-slate-200 p-2 rounded hover:bg-slate-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-4 md:p-8 scroll-smooth">
            <header class="mb-8 hidden md:block">
                <h2 class="text-3xl font-bold text-white">Visão Geral</h2>
                <p class="text-slate-400">Bem-vindo ao seu painel administrativo.</p>
            </header>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 shadow-lg">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-slate-400 text-xs uppercase font-bold tracking-wider">Vendas Totais</h3>
                        <span class="bg-emerald-500/10 text-emerald-400 text-xs px-2 py-1 rounded">+12%</span>
                    </div>
                    <p class="text-3xl font-bold text-white">R$ 12.450</p>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 shadow-lg">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-slate-400 text-xs uppercase font-bold tracking-wider">Novos Usuários</h3>
                        <span class="bg-blue-500/10 text-blue-400 text-xs px-2 py-1 rounded">+5%</span>
                    </div>
                    <p class="text-3xl font-bold text-white">1,234</p>
                </div>

                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 shadow-lg">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-slate-400 text-xs uppercase font-bold tracking-wider">Pendências</h3>
                        <span class="bg-amber-500/10 text-amber-400 text-xs px-2 py-1 rounded">Atenção</span>
                    </div>
                    <p class="text-3xl font-bold text-white">12</p>
                </div>
            </div>

            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-lg">
                <div class="p-6 border-b border-slate-700 flex justify-between items-center">
                    <h3 class="font-bold text-white">Últimas Atividades</h3>
                    <button class="text-xs text-slate-400 hover:text-white">Ver tudo</button>
                </div>
                <div class="p-12 text-slate-500 text-center flex flex-col items-center justify-center">
                    <div class="mb-4 text-4xl opacity-20">📂</div>
                    <p>Nenhuma atividade recente encontrada.</p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>