@extends('layout')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-900 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-slate-800 via-slate-900 to-slate-950 p-4">

    <div class="w-full max-w-md bg-slate-800 border border-slate-700 rounded-2xl shadow-2xl overflow-hidden relative group">
        
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-red-500 to-transparent opacity-50 group-hover:opacity-100 transition duration-500"></div>

        <div class="p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-red-500/10 text-red-500 mb-4 ring-1 ring-red-500/20 shadow-lg shadow-red-500/10">
                    <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
                </div>
                <h2 class="text-2xl font-bold text-white tracking-tight">Bem-vindo de volta!</h2>
                <p class="text-slate-400 text-sm mt-1">Acesse o painel administrativo.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-3 mb-6 flex items-center gap-3 text-red-400 text-sm animate-pulse">
                    <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                
                <div class="space-y-1">
                    <label class="text-xs font-medium text-slate-400 uppercase tracking-wider ml-1">E-mail</label>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-slate-500 group-focus-within/input:text-red-400 transition-colors"></i>
                        </div>
                        <input type="email" name="email" placeholder="seu@email.com" 
                               class="w-full bg-slate-900/50 border border-slate-700 text-white text-sm rounded-lg block pl-10 p-3 placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all duration-200 hover:border-slate-600">
                    </div>
                </div>

                <div class="space-y-1">
                    <div class="flex justify-between items-center ml-1">
                        <label class="text-xs font-medium text-slate-400 uppercase tracking-wider">Senha</label>
                        <a href="#" class="text-xs text-red-400 hover:text-red-300 transition">Esqueceu?</a>
                    </div>
                    <div class="relative group/input">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-slate-500 group-focus-within/input:text-red-400 transition-colors"></i>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" 
                               class="w-full bg-slate-900/50 border border-slate-700 text-white text-sm rounded-lg block pl-10 p-3 placeholder-slate-600 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all duration-200 hover:border-slate-600">
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white p-3 rounded-lg font-bold shadow-lg shadow-red-600/20 hover:shadow-red-600/40 transform active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2">
                    <span>Entrar no Sistema</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        <div class="bg-slate-900/50 p-4 border-t border-slate-700 text-center">
            <p class="text-slate-400 text-sm">
                Não tem uma conta? 
                <a href="{{ route('register') }}" class="text-white font-medium hover:underline hover:text-red-400 transition">Criar conta</a>
            </p>
        </div>
    </div>
    
    <div class="absolute bottom-6 text-slate-600 text-xs">
        &copy; {{ date('Y') }} AdminPanel Inc.
    </div>

</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection