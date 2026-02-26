<x-app-layout>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
            display: inline-block;
            line-height: 1;
            vertical-align: middle;
        }
    </style>

    <div class="bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            {{-- Page Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-slate-900">Colocations</h1>
                    <p class="mt-1 text-base text-slate-500">Manage your shared living spaces and roommates efficiently.</p>
                </div>
                <a href="{{ route('colocations.create') }}"
                   class="flex-shrink-0 inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                    <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                    Create Colocation
                </a>
            </div>

            {{-- ── ACTIVE COLOCATIONS ──────────────────────────────────────── --}}
            @if($current->isNotEmpty())
            <section class="mb-10">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-blue-600" style="font-size:20px">sensors</span>
                    <h2 class="text-lg font-bold text-slate-900">
                        Current Colocation{{ $current->count() > 1 ? 's' : '' }}
                    </h2>
                </div>

                <div class="space-y-4">
                    @foreach($current as $colocation)
                    <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
                        <div class="flex flex-col lg:flex-row">

                            {{-- Image --}}
                            <div class="lg:w-80 xl:w-96 h-56 lg:h-auto flex-shrink-0">
                                @if($colocation->image)
                                    <img src="{{ asset('storage/' . $colocation->image) }}"
                                         alt="{{ $colocation->name }}"
                                         class="w-full h-full object-cover"/>
                                @else
                                    <div class="w-full h-full min-h-56 flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100">
                                        <span class="material-symbols-outlined text-blue-200" style="font-size:72px">home_work</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="flex flex-col flex-1 p-6 sm:p-8">
                                <div class="flex-1">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 mb-3">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                        Active Now
                                    </span>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-5">{{ $colocation->name }}</h3>

                                    <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                                        <div class="flex items-center gap-2.5">
                                            <span class="material-symbols-outlined text-blue-400" style="font-size:20px">person</span>
                                            <div>
                                                <p class="text-xs text-slate-400 font-medium">Owner</p>
                                                <p class="text-sm font-bold text-slate-900">{{ $colocation->owner->name ?? '—' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <span class="material-symbols-outlined text-blue-400" style="font-size:20px">group</span>
                                            <div>
                                                <p class="text-xs text-slate-400 font-medium">Members</p>
                                                <p class="text-sm font-bold text-slate-900">{{ $colocation->members_count }} active</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <span class="material-symbols-outlined text-blue-400" style="font-size:20px">location_on</span>
                                            <div>
                                                <p class="text-xs text-slate-400 font-medium">Location</p>
                                                <p class="text-sm font-bold text-slate-900">{{ $colocation->location ?? '—' }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <span class="material-symbols-outlined text-blue-400" style="font-size:20px">calendar_today</span>
                                            <div>
                                                <p class="text-xs text-slate-400 font-medium">Joined</p>
                                                <p class="text-sm font-bold text-slate-900">{{ $colocation->created_at->format('M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                                    <a href="{{ route('colocations.show', $colocation) }}"
                                       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-bold text-white hover:bg-blue-700 transition-all">
                                        View Details
                                        <span class="material-symbols-outlined" style="font-size:16px">arrow_forward</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- ── PREVIOUS COLOCATIONS ───────────────────────────────────── --}}
            @if($previous->isNotEmpty())
            <section class="mb-10">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-slate-400" style="font-size:20px">history</span>
                    <h2 class="text-lg font-bold text-slate-900">Previous Colocations</h2>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach($previous as $colocation)
                    <div class="group rounded-xl bg-white border border-slate-200 overflow-hidden shadow-sm hover:border-blue-300 hover:shadow-md transition-all">
                        <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                            @if($colocation->image)
                                <img src="{{ asset('storage/' . $colocation->image) }}"
                                     alt="{{ $colocation->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"/>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 transition-transform duration-500 group-hover:scale-105">
                                    <span class="material-symbols-outlined text-slate-300" style="font-size:48px">home_work</span>
                                </div>
                            @endif
                            <div class="absolute right-2 top-2 rounded-lg bg-slate-900/60 px-2.5 py-1 text-[10px] font-bold text-white backdrop-blur-sm">
                                {{ $colocation->created_at->format('Y') }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="text-base font-bold text-slate-900 mb-3">{{ $colocation->name }}</h4>
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <span class="material-symbols-outlined" style="font-size:14px">person</span>
                                    <span>Owner: {{ $colocation->owner->name ?? '—' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <span class="material-symbols-outlined" style="font-size:14px">group</span>
                                    <span>{{ $colocation->members_count }} Former Roommates</span>
                                </div>
                            </div>
                            <a href="{{ route('colocations.show', $colocation) }}"
                               class="mt-4 block w-full rounded-lg border border-slate-200 py-2 text-center text-xs font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                                View History
                            </a>
                        </div>
                    </div>
                    @endforeach

                    {{-- Add Past Residence CTA --}}
                    <div class="flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 p-8 text-center hover:border-blue-300 hover:bg-blue-50/30 transition-colors cursor-pointer min-h-48">
                        <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <span class="material-symbols-outlined" style="font-size:24px">add</span>
                        </div>
                        <p class="text-sm font-bold text-slate-900">Add Past Residence</p>
                        <p class="mt-1 text-xs text-slate-500">Keep track of your housing history</p>
                    </div>

                </div>
            </section>
            @endif

            {{-- ── EMPTY STATE ────────────────────────────────────────────── --}}
            @if($current->isEmpty() && $previous->isEmpty())
            <div class="flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-white py-24 text-center">
                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-50">
                    <span class="material-symbols-outlined text-blue-300" style="font-size:36px">home_work</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">No Colocations Yet</h3>
                <p class="text-slate-500 mb-6 text-sm">You haven't joined or created any colocations.</p>
                <a href="{{ route('colocations.create') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                    <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                    Create Your First Colocation
                </a>
            </div>
            @endif

        </div>
    </div>

</x-app-layout>