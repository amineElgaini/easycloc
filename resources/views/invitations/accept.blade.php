<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-12 flex items-center justify-center -mt-16">
        <div class="max-w-md w-full px-4">
            
            @if(isset($error))
                <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl p-8 text-center">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-red-50 text-red-500">
                        <span class="material-symbols-outlined" style="font-size:40px">error_outline</span>
                    </div>
                    <h1 class="text-2xl font-black text-slate-900 mb-2">Invitation Error</h1>
                    <p class="text-slate-500 mb-8">{{ $error }}</p>
                    <a href="{{ route('colocations.index') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-4 text-sm font-bold text-white hover:bg-slate-800 transition-all shadow-lg active:scale-95">
                        <span class="material-symbols-outlined">home</span>
                        Back to Home
                    </a>
                </div>
            @else
                <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden">
                    <div class="h-40 bg-primary relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <span class="mb-1 inline-block rounded-full bg-white/20 backdrop-blur-md px-3 py-1 text-[10px] font-bold uppercase tracking-widest">Colocation Invitation</span>
                            <h1 class="text-2xl font-black">{{ $invitation->colocation->name }}</h1>
                        </div>
                        <div class="absolute -bottom-8 right-8">
                            <div class="h-16 w-16 bg-white rounded-2xl shadow-xl flex items-center justify-center border border-slate-100">
                                <span class="material-symbols-outlined text-3xl text-primary">group</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-8 pb-10 mt-4">
                        <div class="flex items-center gap-4 mb-8 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full ring-2 ring-white shadow-sm">
                                <img src="{{ $invitation->colocation->owner->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($invitation->colocation->owner->name).'&color=7F9CF5&background=EBF4FF' }}" class="h-full w-full object-cover">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $invitation->colocation->owner->name }}</p>
                                <p class="text-xs text-slate-500">Is inviting you to join the flatshare</p>
                            </div>
                        </div>

                        <p class="text-sm text-slate-600 leading-relaxed mb-8">
                            Joining this colocation will allow you to track expenses, manage bills, and share costs with other members.
                        </p>

                        <div class="flex flex-col gap-3">
                            <form method="POST" action="{{ route('invitations.accept.process', $invitation->token) }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-primary px-6 py-4 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-95">
                                    <span class="material-symbols-outlined">check_circle</span>
                                    Accept Invitation
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('invitations.refuse', $invitation->token) }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-xl bg-white border border-slate-200 px-6 py-4 text-sm font-bold text-slate-500 hover:text-red-500 hover:border-red-100 hover:bg-red-50 transition-all active:scale-95">
                                    <span class="material-symbols-outlined">cancel</span>
                                    Decline
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
