<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
        }
    </style>

    <main class="flex-1 px-6 py-8 md:px-12 lg:px-20 bg-slate-50 min-h-screen">
        <div class="mb-8 flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-slate-900">Manage Users</h1>
                <p class="text-slate-500">View and manage all users in the system.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="rounded-xl border border-slate-200 bg-white px-4 py-2 shadow-sm flex items-center gap-3">
                    <div class="h-10 w-10 overflow-hidden rounded-full ring-2 ring-emerald-500 ring-offset-2">
                        <img class="h-full w-full object-cover" src="{{ auth()->user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=7F9CF5&background=EBF4FF' }}" />
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Your Reputation</p>
                        <div class="flex items-center gap-1 text-amber-500">
                            <span class="material-symbols-outlined text-[18px] fill-1">star</span>
                            <span class="text-lg font-black text-slate-900">{{ auth()->user()->reputation }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-4 py-2 text-sm font-semibold shadow-sm hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">dashboard</span>
                    Back to Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-100 p-4 text-emerald-700 flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-xl bg-rose-50 border border-rose-100 p-4 text-rose-700 flex items-center gap-3">
                <span class="material-symbols-outlined">error</span>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="rounded-2xl bg-white border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">All Users</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-[11px] uppercase tracking-wider text-slate-500">
                            <th class="px-6 py-3 font-bold">User</th>
                            <th class="px-6 py-3 font-bold">Role</th>
                            <th class="px-6 py-3 font-bold">Status</th>
                            <th class="px-6 py-3 font-bold">Reputation</th>
                            <th class="px-6 py-3 font-bold">Joined</th>
                            <th class="px-6 py-3 font-bold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($user->profile_image)
                                            <img src="{{ Storage::url($user->profile_image) }}" class="h-10 w-10 rounded-full object-cover border-2 border-slate-100" />
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $user->name }}</p>
                                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-slate-100 text-slate-700' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->is_banned)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-rose-100 px-2.5 py-0.5 text-xs font-semibold text-rose-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                                            Banned
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-600">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                                            Active
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1 text-slate-600">
                                        <span class="material-symbols-outlined text-[18px] text-amber-500">star</span>
                                        <span class="text-sm font-medium">{{ $user->reputation }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @php
                                            $ownedColocations = $user->ownedColocations->where('status', 'active');
                                        @endphp
                                        
                                        @if($ownedColocations->isNotEmpty())
                                            <button onclick="openTransferModal({{ $user->id }}, {{ json_encode($ownedColocations->values()) }})" class="inline-flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-3 py-1.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-200 transition-all" title="Transfer Ownership">
                                                <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
                                                Transfer
                                            </button>
                                        @endif

                                        <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @if($user->is_banned)
                                                <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-3 py-1.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-all">
                                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                                    Unban
                                                </button>
                                            @else
                                                <button type="submit" onclick="return confirm('Are you sure you want to ban this user?')" class="inline-flex items-center gap-2 rounded-lg bg-white border border-slate-200 px-3 py-1.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-rose-50 hover:text-rose-700 hover:border-rose-200 transition-all">
                                                    <span class="material-symbols-outlined text-[18px]">block</span>
                                                    Ban User
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Transfer Ownership Modal -->
        <div id="transferModal" class="fixed inset-0 z-50 hidden">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeTransferModal()"></div>
            <div class="absolute left-1/2 top-1/2 w-full max-w-lg -translate-x-1/2 -translate-y-1/2 p-4">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center justify-between border-b border-slate-100 p-6 dark:border-slate-800">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Transfer Colocation Ownership</h3>
                        <button onclick="closeTransferModal()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>

                    <div class="p-6">
                        <p class="mb-6 text-sm text-slate-500">To ban this user, you must first transfer ownership of their active colocations to another member.</p>
                        
                        <div id="colocationsContainer" class="flex flex-col gap-6">
                            <!-- Colocations will be injected here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function openTransferModal(userId, colocations) {
                const modal = document.getElementById('transferModal');
                const container = document.getElementById('colocationsContainer');
                container.innerHTML = '';

                colocations.forEach(colocation => {
                    const colocationDiv = document.createElement('div');
                    colocationDiv.className = 'rounded-xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-800/50';
                    
                    const membersOptions = colocation.members
                        .filter(m => m.id !== userId)
                        .map(m => `<option value="${m.id}">${m.name}</option>`)
                        .join('');

                    if (membersOptions === '') {
                        colocationDiv.innerHTML = `
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">${colocation.name}</h4>
                            <p class="text-xs text-rose-500 font-medium">No other active members available to take ownership. The colocation must be cancelled or more members invited.</p>
                        `;
                    } else {
                        colocationDiv.innerHTML = `
                            <h4 class="font-bold text-slate-900 dark:text-white mb-3">${colocation.name}</h4>
                            <form action="/colocations/${colocation.id}/transfer-ownership-auto" method="POST" id="transfer-form-${colocation.id}">
                                @csrf
                                <div class="flex flex-col gap-3">
                                    <label class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Select New Owner</label>
                                    <div class="flex gap-2">
                                        <select name="new_owner_id" class="block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 dark:border-slate-800 dark:bg-slate-800 dark:text-white">
                                            ${membersOptions}
                                        </select>
                                        <button type="button" onclick="submitTransfer(${colocation.id})" class="rounded-lg bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary/90 transition-all active:scale-95 shadow-sm">
                                            Transfer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        `;
                    }
                    container.appendChild(colocationDiv);
                });

                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeTransferModal() {
                const modal = document.getElementById('transferModal');
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            async function submitTransfer(colocationId) {
                const form = document.getElementById(`transfer-form-${colocationId}`);
                const newOwnerId = form.querySelector('select[name="new_owner_id"]').value;
                
                if (!confirm('Are you sure you want to transfer ownership? This action cannot be undone.')) return;

                try {
                    const response = await fetch(`/colocations/${colocationId}/transfer-ownership/${newOwnerId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    if (response.ok) {
                        window.location.reload();
                    } else {
                        const data = await response.json();
                        alert(data.message || 'Failed to transfer ownership');
                    }
                } catch (error) {
                    alert('Network error. Please try again.');
                }
            }
        </script>
    </main>
</x-app-layout>
