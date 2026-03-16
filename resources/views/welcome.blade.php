<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Bootstrap JS (якщо потрібні tooltip, modal, dropdown тощо) -->

<body>


    <section class="py-5 bg-light">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0">Popular products</h2>
                <a href="{{ route('cart') }}">
                    <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <i class="bi bi-cart"></i> {{ array_sum(array_column(session('cart', []), 'quantity')) }}
                    </span>
                </a>
            </div>

            <form method="GET" action="{{ route('products.filter') }}" class="row g-3 mb-4">

                <!-- Search -->
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Min price -->
                <div class="col-md-3">
                    <input type="number" name="min_price" class="form-control" placeholder="Min price"
                        value="{{ request('min_price') }}">
                </div>

                <!-- Max price -->
                <div class="col-md-3">
                    <input type="number" name="max_price" class="form-control" placeholder="Max price"
                        value="{{ request('max_price') }}">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark w-100">
                        Filter
                    </button>
                </div>

            </form>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 g-md-4">

                @foreach ($products as $product)
                    <!-- Просто копіюй картки стільки разів, скільки потрібно -->
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm product-card position-relative">
                            <span class="position-absolute top-0 start-0 badge bg-success m-2">NEW</span>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="card-img-top" alt="Товар 1" style="object-fit: cover; height: 220px;">
                            @endif
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title mb-2 fw-bold text-truncate">{{ $product->name }}</h6>
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="fs-5 fw-bold">${{ $product->price }}</span>
                                    </div>

                                    <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                            <i class="bi bi-cart-plus me-1"></i> add
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12 d-flex justify-content-center mt-4">
            {{ $products->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer>
    </script>

</body>

</html>
