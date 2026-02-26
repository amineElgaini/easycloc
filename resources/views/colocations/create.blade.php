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
        #drop-zone.dragover {
            border-color: #2563eb;
            background-color: #eff6ff;
        }
    </style>

    <div class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8 flex items-center gap-4">
                <a href="{{ route('colocations.index') }}"
                   class="flex items-center justify-center h-9 w-9 rounded-lg bg-white border border-slate-200 text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-all shadow-sm">
                    <span class="material-symbols-outlined" style="font-size:20px">arrow_back</span>
                </a>
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">Create Colocation</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Set up a new shared living space.</p>
                </div>
            </div>

            {{-- ── ALREADY IN COLOCATION ERROR BANNER ──────────────────────── --}}
            @error('colocation')
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-4">
                    <div class="flex-shrink-0 flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-red-500">
                        <span class="material-symbols-outlined" style="font-size:20px">warning</span>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-700">Cannot create colocation</p>
                        <p class="text-sm text-red-600 mt-0.5">{{ $message }}</p>
                        <a href="{{ route('colocations.index') }}"
                           class="mt-2 inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-800 underline underline-offset-2">
                            <span class="material-symbols-outlined" style="font-size:14px">arrow_back</span>
                            View my current colocation
                        </a>
                    </div>
                </div>
            @enderror

            {{-- ── SUCCESS FLASH ────────────────────────────────────────────── --}}
            @if(session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
                    <span class="material-symbols-outlined text-emerald-500" style="font-size:20px">check_circle</span>
                    <p class="text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
                </div>
            @endif

            {{-- ── FORM ─────────────────────────────────────────────────────── --}}
            <form method="POST"
                  action="{{ route('colocations.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    {{-- Basic Info --}}
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Basic Information</h2>
                    </div>

                    <div class="px-6 py-6 space-y-5">

                        {{-- Name --}}
                        <div class="space-y-1.5">
                            <label for="name" class="block text-sm font-semibold text-slate-700">
                                Colocation Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:18px">home_work</span>
                                </div>
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="e.g. Sunset Loft, The Penthouse..."
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm @error('name') border-red-400 bg-red-50 @enderror"
                                />
                            </div>
                            @error('name')
                                <p class="text-xs text-red-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size:14px">error</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="space-y-1.5">
                            <label for="location" class="block text-sm font-semibold text-slate-700">
                                Location <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <span class="material-symbols-outlined" style="font-size:18px">location_on</span>
                                </div>
                                <input
                                    id="location"
                                    type="text"
                                    name="location"
                                    value="{{ old('location') }}"
                                    required
                                    placeholder="e.g. Paris, France"
                                    class="block w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-lg text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all text-sm @error('location') border-red-400 bg-red-50 @enderror"
                                />
                            </div>
                            @error('location')
                                <p class="text-xs text-red-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size:14px">error</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Image Upload --}}
                    <div class="px-6 py-5 border-t border-b border-slate-100">
                        <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Cover Image</h2>
                    </div>

                    <div class="px-6 py-6">
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-slate-700">
                                Photo <span class="text-red-500">*</span>
                            </label>

                            <div id="drop-zone"
                                 class="relative border-2 border-dashed border-slate-200 rounded-xl p-6 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50/30 transition-all @error('image') border-red-300 bg-red-50/30 @enderror"
                                 onclick="document.getElementById('image').click()">

                                <div id="upload-placeholder">
                                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <span class="material-symbols-outlined" style="font-size:24px">add_photo_alternate</span>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-700">Click to upload or drag and drop</p>
                                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP up to 2MB</p>
                                </div>

                                <div id="image-preview" style="display:none">
                                    <img id="preview-img" src="" alt="Preview" class="mx-auto max-h-48 rounded-lg object-cover shadow-sm"/>
                                    <p class="mt-3 text-xs text-slate-500">Click to change image</p>
                                </div>

                                <input
                                    id="image"
                                    type="file"
                                    name="image"
                                    accept="image/*"
                                    required
                                    class="hidden"
                                    onchange="previewImage(event)"
                                />
                            </div>

                            @error('image')
                                <p class="text-xs text-red-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined" style="font-size:14px">error</span>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between gap-3 pb-8">
                    <a href="{{ route('colocations.index') }}"
                       class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold text-slate-600 bg-white border border-slate-200 hover:bg-slate-50 shadow-sm transition-all">
                        <span class="material-symbols-outlined" style="font-size:18px">close</span>
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all">
                        <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                        Create Colocation
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('upload-placeholder').style.display = 'none';
                document.getElementById('image-preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        const dropZone = document.getElementById('drop-zone');
        dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('dragover'); });
        dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('dragover'); });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('image').files = dt.files;
                previewImage({ target: { files: [file] } });
            }
        });
    </script>

</x-app-layout>