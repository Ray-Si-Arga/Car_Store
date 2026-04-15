@push('styles')
    <style>
        /* --- Filter Bar (Compact View) --- */
        .filter-bar {
            background: #ffffff;
            border-radius: 20px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid #eaf0f8;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .filter-bar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-grow: 1;
        }

        .btn-filter-toggle {
            background: #1a3c6e;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.7rem 1.2rem;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 10px rgba(26, 60, 110, 0.2);
        }

        .btn-filter-toggle:hover {
            background: #0f2a4f;
            transform: translateY(-1px);
        }

        /* --- Filter Modal --- */
        .filter-modal-overlay {
            display: none;
            position: fixed;
            z-index: 10001;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.7);
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            padding: 20px;
        }

        .filter-modal-content {
            background: #ffffff;
            border-radius: 24px;
            width: 100%;
            max-width: 550px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: filterModalShow 0.3s ease-out;
            border: 1px solid #eaf0f8;
            overflow: hidden;
        }

        @keyframes filterModalShow {
            from { opacity: 0; transform: scale(0.95) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .filter-modal-header {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .filter-modal-header h3 {
            font-weight: 700;
            font-size: 1.25rem;
            color: #0b1e3a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-modal-header h3 i { color: #1a3c6e; }

        .btn-close-filter {
            background: #f1f5f9;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s;
        }

        .btn-close-filter:hover {
            background: #e2e8f0;
            color: #0f172a;
        }

        .filter-modal-body {
            padding: 2rem;
        }

        .filter-form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .modal-filter-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .modal-filter-group label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
        }

        .modal-filter-group select {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            color: #1e293b;
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%2364748b" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
        }

        .filter-modal-footer {
            padding: 1.5rem 2rem;
            background: #fbfcfe;
            border-top: 1px solid #f0f4f8;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-reset-filter {
            background: white;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reset-filter:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-apply-filter {
            background: #1a3c6e;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-apply-filter:hover {
            background: #0f2a4f;
        }

        /* --- Tags --- */
        .bar-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .filter-tag-pill {
            background: #f0f6ff;
            border-radius: 30px;
            padding: 0.4rem 0.8rem 0.4rem 1rem;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid #cbdded;
            color: #1e3a6b;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .filter-tag-pill i {
            font-size: 0.9rem;
            cursor: pointer;
            color: #5f7d9c;
            border-radius: 50%;
            padding: 2px;
        }

        .filter-tag-pill i:hover {
            background: #ffffff;
            color: #c00;
        }

        @media (max-width: 600px) {
            .filter-bar {
                flex-direction: column;
                align-items: flex-start;
            }
            .btn-filter-toggle {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

<!-- Filter Bar (Permanent UI) -->
<div class="filter-bar">
    <div class="filter-bar-left">
        <button type="button" class="btn-filter-toggle" id="openFilterModal">
            <i class="bx bx-slider-alt"></i>
            Filter Mobil
        </button>
        
        <div class="bar-tags" id="barActiveTags">
            <!-- Active tags will appear here -->
        </div>
    </div>
    
    @if(request()->hasAny(['kasta', 'transmisi', 'harga']))
        <button type="button" class="btn-reset-filter" onclick="window.location.href='{{ url()->current() }}'" style="padding: 0.5rem 1rem; font-size: 0.8rem;">
            Reset Semua
        </button>
    @endif
</div>

<!-- Filter Modal (Hidden by Default) -->
<div class="filter-modal-overlay" id="filterModalOverlay">
    <div class="filter-modal-content">
        <div class="filter-modal-header">
            <h3>
                <i class="bx bx-filter-alt"></i>
                Filter Pencarian
            </h3>
            <button type="button" class="btn-close-filter" id="closeFilterModal">
                <i class="bx bx-x fs-4"></i>
            </button>
        </div>

        <form id="modalFilterForm" action="{{ url()->current() }}" method="GET">
            <div class="filter-modal-body">
                <div class="filter-form-grid">
                    <div class="modal-filter-group">
                        <label for="kasta">Kasta Mobil</label>
                        <select name="kasta" id="kasta">
                            <option value="">Semua Kasta</option>
                            <option value="Economy" {{ request('kasta') == 'Economy' ? 'selected' : '' }}>Economy</option>
                            <option value="Family" {{ request('kasta') == 'Family' ? 'selected' : '' }}>Family</option>
                            <option value="Luxury" {{ request('kasta') == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                        </select>
                    </div>

                    <div class="modal-filter-group">
                        <label for="transmisi">Transmisi</label>
                        <select name="transmisi" id="transmisi">
                            <option value="">Semua Transmisi</option>
                            <option value="Manual" {{ request('transmisi') == 'Manual' ? 'selected' : '' }}>Manual</option>
                            <option value="Automatic" {{ request('transmisi') == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                        </select>
                    </div>

                    <div class="modal-filter-group">
                        <label for="harga">Urutkan Harga</label>
                        <select name="harga" id="harga">
                            <option value="">Default</option>
                            <option value="low" {{ request('harga') == 'low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="high" {{ request('harga') == 'high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="filter-modal-footer">
                <button type="button" class="btn-reset-filter" id="modalResetBtn">Reset</button>
                <button type="submit" class="btn-apply-filter">Terapkan Filter</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        (function () {
            const overlay = document.getElementById('filterModalOverlay');
            const openBtn = document.getElementById('openFilterModal');
            const closeBtn = document.getElementById('closeFilterModal');
            const form = document.getElementById('modalFilterForm');
            const barTags = document.getElementById('barActiveTags');
            
            // Modal Logic
            openBtn.addEventListener('click', () => {
                overlay.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });

            closeBtn.addEventListener('click', () => {
                overlay.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            overlay.addEventListener('click', (e) => {
                if (e.target === overlay) closeBtn.click();
            });

            // Reset Logic in Modal
            document.getElementById('modalResetBtn').addEventListener('click', () => {
                window.location.href = window.location.pathname;
            });

            // Active Tags UI on Bar
            function renderActiveTags() {
                const params = new URLSearchParams(window.location.search);
                const tags = [];

                if (params.get('kasta')) tags.push({ name: 'kasta', label: `Kasta: ${params.get('kasta')}` });
                if (params.get('transmisi')) tags.push({ name: 'transmisi', label: params.get('transmisi') });
                if (params.get('harga')) {
                    const h = params.get('harga') === 'low' ? 'Termurah' : 'Termahal';
                    tags.push({ name: 'harga', label: h });
                }

                if (tags.length === 0) {
                    barTags.innerHTML = '<span style="color: #94a3b8; font-size: 0.8rem; font-style: italic;">Tidak ada filter aktif</span>';
                    return;
                }

                barTags.innerHTML = '';
                tags.forEach(t => {
                    const tag = document.createElement('span');
                    tag.className = 'filter-tag-pill';
                    tag.innerHTML = `${t.label} <i class="bx bx-x" onclick="clearSpecificFilter('${t.name}')"></i>`;
                    barTags.appendChild(tag);
                });
            }

            window.clearSpecificFilter = function(name) {
                const url = new URL(window.location.href);
                url.searchParams.delete(name);
                window.location.href = url.toString();
            };

            renderActiveTags();
        })();
    </script>
@endpush