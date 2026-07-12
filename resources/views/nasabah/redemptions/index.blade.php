@extends('layouts.nasabah')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/nasabah/redemptions/index.css') }}">
@endpush
@section('content')




<div class="container py-4">

    {{-- ============ HERO ============ --}}
    <div class="card border-0 shadow rounded-4 tp-hero text-white mb-4">
        <div class="card-body">

            <h2 class="fw-bold mb-2">
                <i class="bi bi-gift-fill me-2"></i>
                Tukar Poin
            </h2>

            <p class="mb-3">
                Gunakan poin Anda untuk menukar item.
            </p>

            <h1 class="fw-bold mb-0" id="tpUserPoint" data-point="{{ Auth::user()->current_point }}">
                {{ number_format(Auth::user()->current_point) }}
                <small>pts</small>
            </h1>

        </div>
    </div>

    {{-- ============ SEARCH BAR ============ --}}
    <div class="tp-search-wrap mb-3">
        <i class="bi bi-search"></i>
        <label for="tpSearchInput" class="visually-hidden">Cari hadiah atau sembako</label>
        <input
            type="text"
            id="tpSearchInput"
            name="search"
            class="form-control tp-search-input"
            placeholder="Cari hadiah / sembako...">
    </div>

    {{-- ============ CATEGORY CHIPS ============ --}}
    @php
        $categories = ($groceries ?? collect())->pluck('category')->filter()->unique()->values();
    @endphp

    @if($categories->count())
    <div class="tp-cat-scroll mb-4">
        <button type="button" class="tp-cat-chip is-active" data-category="all">
            Semua
        </button>
        @foreach($categories as $category)
        <button type="button" class="tp-cat-chip" data-category="{{ $category }}">
            {{ $category }}
        </button>
        @endforeach
    </div>
    @endif

    {{-- ============ SERING DITUKAR ============ --}}
    @php
        $popularGroceries = $popularGroceries ?? ($groceries ?? collect())->sortBy('stock')->take(6);
    @endphp

    @if($popularGroceries->count())
    <div class="mb-4">
        <h5 class="fw-bold mb-2">
            <i class="bi bi-fire tp-popular-fire me-1"></i>
            Sering Ditukar
        </h5>

        <div class="tp-popular-scroll">
            @foreach($popularGroceries as $popular)
            <a href="#grocery-{{ $popular->id }}" class="tp-popular-card">
                <img
                    src="{{ $popular->image ? asset('storage/'.$popular->image) : 'https://placehold.co/300x200?text=Sembako' }}"
                    alt="{{ $popular->name }}">
                <div class="tp-popular-body">
                    <div class="tp-popular-name">{{ $popular->name }}</div>
                    <span class="badge bg-success">{{ number_format($popular->point_price) }} Poin</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ============ KATALOG ============ --}}
    <h5 class="fw-bold mb-3">
        <i class="bi bi-grid-fill me-1"></i>
        Semua Item
    </h5>

    <div class="row" id="tpGroceryGrid">

        @forelse($groceries as $grocery)

        <div class="col-6 col-md-6 col-lg-4 mb-4 tp-grocery-item"
             id="grocery-{{ $grocery->id }}"
             data-name="{{ strtolower($grocery->name) }}"
             data-category="{{ $grocery->category ?? '' }}">

            <div class="card border-0 shadow-sm rounded-4 h-100 tp-grocery-card">

                @php
                    $groceryImage = $grocery->image ? asset('storage/'.$grocery->image) : 'https://placehold.co/600x400?text=Sembako';
                @endphp

                <img src="{{ $groceryImage }}" class="card-img-top" style="object-fit:cover;">

                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold card-title">
                        {{ $grocery->name }}
                    </h5>

                    <p class="text-muted small flex-grow-1">
                        {{ $grocery->description }}
                    </p>

                    <div class="mb-2">
                        <span class="badge bg-success fs-6">
                            {{ number_format($grocery->point_price) }} Poin
                        </span>
                    </div>

                    <p class="mb-3">
                        <i class="bi bi-box-seam"></i>
                        Stok :
                        <strong>{{ $grocery->stock }}</strong>
                    </p>

                    @if($grocery->stock > 0)

                        {{-- Stepper jumlah --}}
                        <div class="tp-qty-stepper mb-2 mx-auto" style="width:fit-content;">
                            <button type="button" class="tp-qty-btn tp-qty-minus" aria-label="Kurangi jumlah">−</button>
                            <label for="qty-{{ $grocery->id }}" class="visually-hidden">Jumlah {{ $grocery->name }}</label>
                            <input
                                type="number"
                                id="qty-{{ $grocery->id }}"
                                name="quantity"
                                class="tp-qty-input tp-qty-value"
                                value="1"
                                min="1"
                                max="{{ $grocery->stock }}"
                                readonly>
                            <button type="button" class="tp-qty-btn tp-qty-plus" aria-label="Tambah jumlah">+</button>
                        </div>

                        <div class="d-flex gap-2">

                            <button
                                type="button"
                                id="add-cart-{{ $grocery->id }}"
                                class="btn tp-add-cart-btn btn-sm flex-fill tp-add-cart"
                                data-id="{{ $grocery->id }}"
                                data-name="{{ $grocery->name }}"
                                data-price="{{ $grocery->point_price }}"
                                data-stock="{{ $grocery->stock }}"
                                data-image="{{ $groceryImage }}">
                                <i class="bi bi-cart-plus"></i> Keranjang
                            </button>

                            @if(Auth::user()->current_point >= $grocery->point_price)
                                <form action="{{ route('nasabah.tukar-poin.store') }}" method="POST" class="flex-fill" id="buy-form-{{ $grocery->id }}">
                                    @csrf
                                    <input type="hidden" id="grocery-id-{{ $grocery->id }}" name="grocery_id" value="{{ $grocery->id }}">
                                    <input type="hidden" id="grocery-qty-{{ $grocery->id }}" name="quantity" value="1">
                                    <button type="submit" class="btn btn-success btn-sm w-100">
                                        <i class="bi bi-lightning-fill"></i> Tukar Instant
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm flex-fill" disabled>
                                    Poin Kurang
                                </button>
                            @endif

                        </div>

                    @else

                        <button class="btn btn-secondary w-100" disabled>
                            Stok Habis
                        </button>

                    @endif

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-warning">
                Belum ada sembako tersedia.
            </div>
        </div>

        @endforelse

    </div>

    <div class="col-12 tp-empty-search">
        <div class="alert alert-warning">
            Ga ada item yang cocok sama pencarian kamu.
        </div>
    </div>

</div>

{{-- ============ MODAL KONFIRMASI BELI ============ --}}
<div class="modal fade" id="tpConfirmBuyModal" tabindex="-1" aria-labelledby="tpConfirmBuyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-body text-center p-4">
                <i class="bi bi-question-circle-fill text-warning" style="font-size:2.5rem;"></i>
                <h5 class="fw-bold mt-3 mb-1" id="tpConfirmBuyModalLabel">
                    Konfirmasi Pembelian
                </h5>
                <p class="text-muted mb-0">
                    Apakah Anda yakin ingin menukar item ini?
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary flex-fill" data-bs-dismiss="modal">
                    Tidak
                </button>
                <button type="button" class="btn btn-success flex-fill" id="tpConfirmBuyYesBtn">
                    Ya, Tukar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ============ FLOATING CART BUTTON ============ --}}
<button type="button" class="tp-cart-fab" data-bs-toggle="offcanvas" data-bs-target="#tpCartOffcanvas" aria-label="Buka keranjang">
    <i class="bi bi-cart-fill"></i>
    <span class="tp-cart-badge d-none" id="tpCartBadge">0</span>
</button>

{{-- ============ CART OFFCANVAS ============ --}}
<div class="offcanvas offcanvas-end tp-cart-offcanvas" tabindex="-1" id="tpCartOffcanvas">

    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold">
            <i class="bi bi-cart-fill me-2"></i> Keranjang
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup keranjang"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column">

        <div id="tpCartEmpty" class="tp-cart-empty">
            <i class="bi bi-cart-x display-4 d-block mb-2"></i>
            Keranjang kamu masih kosong.
        </div>

        <div id="tpCartList" class="flex-grow-1" style="overflow-y:auto;"></div>

        <div id="tpCartFooter" class="tp-cart-footer d-none">
            <div class="d-flex justify-content-between mb-1">
                <span class="text-muted">Total Poin</span>
                <strong id="tpCartTotal">0</strong>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Poin Kamu</span>
                <strong id="tpCartUserPoint">0</strong>
            </div>
            <form action="{{ route('nasabah.tukar-poin.checkout') }}" method="POST" id="tpCheckoutForm">
                @csrf
                <div id="tpCheckoutInputs"></div>
                <button type="submit" class="btn btn-success w-100" id="tpCheckoutBtn">
                    <i class="bi bi-bag-check-fill"></i> Tukar Semua
                </button>
            </form>
        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const CART_KEY = 'bsl_cart_items';
    const userPoint = parseInt(document.getElementById('tpUserPoint').dataset.point || '0', 10);

    @if(session('success'))
        // Checkout/pembelian barusan berhasil (server konfirmasi lewat flash session) -> kosongkan keranjang
        localStorage.removeItem(CART_KEY);
    @endif

    function getCart(){
        try {
            return JSON.parse(localStorage.getItem(CART_KEY)) || [];
        } catch(e){
            return [];
        }
    }

    function saveCart(cart){
        localStorage.setItem(CART_KEY, JSON.stringify(cart));
        renderCart();
    }

    function addToCart(item){
        const cart = getCart();
        const existing = cart.find(c => c.id === item.id);

        if (existing) {
            existing.qty = Math.min(existing.qty + item.qty, item.stock);
        } else {
            cart.push(item);
        }

        saveCart(cart);
    }

    function removeFromCart(id){
        let cart = getCart().filter(c => c.id !== id);
        saveCart(cart);
    }

    function updateQty(id, qty){
        const cart = getCart();
        const item = cart.find(c => c.id === id);
        if (item) {
            item.qty = Math.max(1, Math.min(qty, item.stock));
        }
        saveCart(cart);
    }

    function renderCart(){
        const cart = getCart();
        const badge = document.getElementById('tpCartBadge');
        const listEl = document.getElementById('tpCartList');
        const emptyEl = document.getElementById('tpCartEmpty');
        const footerEl = document.getElementById('tpCartFooter');
        const totalEl = document.getElementById('tpCartTotal');
        const userPointEl = document.getElementById('tpCartUserPoint');
        const checkoutInputs = document.getElementById('tpCheckoutInputs');
        const checkoutBtn = document.getElementById('tpCheckoutBtn');

        const totalItems = cart.reduce((sum, c) => sum + c.qty, 0);
        const totalPoint = cart.reduce((sum, c) => sum + (c.qty * c.price), 0);

        if (totalItems > 0) {
            badge.textContent = totalItems;
            badge.classList.remove('d-none');
        } else {
            badge.classList.add('d-none');
        }

        if (cart.length === 0) {
            emptyEl.classList.remove('d-none');
            listEl.innerHTML = '';
            footerEl.classList.add('d-none');
            return;
        }

        emptyEl.classList.add('d-none');
        footerEl.classList.remove('d-none');

        listEl.innerHTML = cart.map(function (item) {
            return `
                <div class="tp-cart-item">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="flex-grow-1">
                        <div class="tp-cart-item-name">${item.name}</div>
                        <div class="tp-cart-item-price">${item.price.toLocaleString('id-ID')} Poin</div>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <div class="tp-qty-stepper" style="height:30px;">
                                <button type="button" class="tp-qty-btn" onclick="window.tpCartDecrease('${item.id}')" aria-label="Kurangi jumlah ${item.name}">−</button>
                                <label for="cart-qty-${item.id}" class="visually-hidden">Jumlah ${item.name}</label>
                                <input type="number" id="cart-qty-${item.id}" name="cart_quantity" class="tp-qty-input" value="${item.qty}" readonly style="width:34px;">
                                <button type="button" class="tp-qty-btn" onclick="window.tpCartIncrease('${item.id}')" aria-label="Tambah jumlah ${item.name}">+</button>
                            </div>
                            <button type="button" class="tp-cart-remove" onclick="window.tpCartRemove('${item.id}')" aria-label="Hapus ${item.name}">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');

        totalEl.textContent = totalPoint.toLocaleString('id-ID') + ' pts';
        userPointEl.textContent = userPoint.toLocaleString('id-ID') + ' pts';

        checkoutInputs.innerHTML = cart.map(function (item, index) {
            return `
                <input type="hidden" id="checkout-grocery-id-${index}" name="items[${index}][grocery_id]" value="${item.id}">
                <input type="hidden" id="checkout-quantity-${index}" name="items[${index}][quantity]" value="${item.qty}">
            `;
        }).join('');

        if (totalPoint > userPoint) {
            checkoutBtn.disabled = true;
            checkoutBtn.innerHTML = '<i class="bi bi-exclamation-triangle-fill"></i> Poin Tidak Cukup';
        } else {
            checkoutBtn.disabled = false;
            checkoutBtn.innerHTML = '<i class="bi bi-bag-check-fill"></i> Tukar Semua';
        }
    }

    window.tpCartIncrease = function (id) {
        const cart = getCart();
        const item = cart.find(c => c.id === id);
        if (item) updateQty(id, item.qty + 1);
    };

    window.tpCartDecrease = function (id) {
        const cart = getCart();
        const item = cart.find(c => c.id === id);
        if (item && item.qty > 1) updateQty(id, item.qty - 1);
        else if (item && item.qty === 1) removeFromCart(id);
    };

    window.tpCartRemove = function (id) {
        removeFromCart(id);
    };

    document.querySelectorAll('.tp-grocery-card').forEach(function (card) {
        const minusBtn = card.querySelector('.tp-qty-minus');
        const plusBtn = card.querySelector('.tp-qty-plus');
        const input = card.querySelector('.tp-qty-value');

        if (!input) return;

        const max = parseInt(input.max || '1', 10);

        minusBtn?.addEventListener('click', function () {
            let val = parseInt(input.value, 10) || 1;
            if (val > 1) input.value = val - 1;
        });

        plusBtn?.addEventListener('click', function () {
            let val = parseInt(input.value, 10) || 1;
            if (val < max) input.value = val + 1;
        });
    });

    // ---------- Konfirmasi Beli (modal Ya/Tidak) ----------
    const confirmBuyModalEl = document.getElementById('tpConfirmBuyModal');
    const confirmBuyModal = confirmBuyModalEl ? new bootstrap.Modal(confirmBuyModalEl) : null;
    const confirmBuyYesBtn = document.getElementById('tpConfirmBuyYesBtn');
    let pendingBuyForm = null;

    document.querySelectorAll('.tp-grocery-card form[id^="buy-form-"]').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Sinkronkan jumlah dari stepper ke hidden input sebelum benar-benar submit
            const card = form.closest('.tp-grocery-card');
            const qtyInput = card.querySelector('.tp-qty-value');
            const hiddenQtyInput = form.querySelector('input[name="quantity"]');
            if (qtyInput && hiddenQtyInput) {
                hiddenQtyInput.value = qtyInput.value;
            }

            pendingBuyForm = form;

            if (confirmBuyModal) {
                confirmBuyModal.show();
            } else {
                // fallback kalau bootstrap JS belum termuat
                form.submit();
            }
        });
    });

    if (confirmBuyYesBtn) {
        confirmBuyYesBtn.addEventListener('click', function () {
            if (pendingBuyForm) {
                confirmBuyModal.hide();
                pendingBuyForm.submit();
                pendingBuyForm = null;
            }
        });
    }

    document.querySelectorAll('.tp-add-cart').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const card = btn.closest('.tp-grocery-card');
            const qtyInput = card.querySelector('.tp-qty-value');
            const qty = parseInt(qtyInput?.value || '1', 10);

            addToCart({
                id: btn.dataset.id,
                name: btn.dataset.name,
                price: parseInt(btn.dataset.price, 10),
                stock: parseInt(btn.dataset.stock, 10),
                image: btn.dataset.image,
                qty: qty
            });

            btn.innerHTML = '<i class="bi bi-check2"></i> Ditambahkan';
            setTimeout(function () {
                btn.innerHTML = '<i class="bi bi-cart-plus"></i> Keranjang';
            }, 1000);
        });
    });

    const searchInput = document.getElementById('tpSearchInput');
    const grid = document.getElementById('tpGroceryGrid');
    const items = grid ? grid.querySelectorAll('.tp-grocery-item') : [];
    const emptyState = document.querySelector('.tp-empty-search');
    const chips = document.querySelectorAll('.tp-cat-chip');
    let activeCategory = 'all';

    function applyFilter(){
        const keyword = (searchInput?.value || '').toLowerCase().trim();
        let visibleCount = 0;

        items.forEach(function (item) {
            const matchesName = item.dataset.name.includes(keyword);
            const matchesCategory = activeCategory === 'all' || item.dataset.category === activeCategory;

            if (matchesName && matchesCategory) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }

    if (searchInput) searchInput.addEventListener('input', applyFilter);

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            chips.forEach(c => c.classList.remove('is-active'));
            chip.classList.add('is-active');
            activeCategory = chip.dataset.category;
            applyFilter();
        });
    });

    renderCart();

});
</script>
@endpush