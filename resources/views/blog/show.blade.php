@php
    $post_category = random_int(1, 8);
    $categories = range(1, 8);
    $months = range(1, 12);
    $comments = range(1, random_int(2, 8));
@endphp
<x-layouts.app>
    <div class="container">
        <h3 class="fw-bold">{{ __('Post Title') }}</h3>

        <div class="row justify-content-between">
            <!-- Sidebar -->
            <div class="order-lg-1 col-lg-3">
                <div class="row d-lg-block row-cols-md-3 row-cols-lg-1">
                    <!-- Search -->
                    <div class="mb-3" id="post_search">
                        <div class="input-group">
                            <input class="form-control" id="search" name="search" type="search" placeholder="Search&hellip;" aria-label="Search">

                            <button class="btn btn-outline-secondary">
                                <span class="bi bi-search"></span>
                                <span class="visually-hidden">Search</span>
                            </button>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-3" id="post_categories">
                        <h3 class="d-none d-lg-block">{{ __('Categories') }}</h3>

                        <!-- Mobile Categories -->
                        <div class="d-lg-n one input-group">
                            <select class="form-select" name="category" id="category" aria-label="Category Filter">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" @selected($post_category === $category)>Category {{ $category }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary">
                                <span class="bi bi-filter"></span>
                                <span class="visually-hidden">Filter</span>
                            </button>
                        </div>

                        <!-- Desktop Categories -->
                        <div class="d-none d-lg-block card card-body">
                            <nav class="row row-cols-2 text-truncate">
                                @foreach(range(1, 8) as $category)
                                    <a href="#">Category {{ $category }}</a>
                                @endforeach
                            </nav>
                        </div>
                    </div>

                    <!-- Archives -->
                    <div class="mb-3" id="post_archive">
                        <h3 class="d-none d-lg-block">{{ __('Archives') }}</h3>

                        <!-- Mobile Archive -->
                        <div class="d-lg-none input-group">
                            <select class="form-select" name="published" id="published" aria-label="Published Filter">
                                <option value="">All Posts</option>
                                @foreach($months as $month)
                                    <option value="{{ $month }}">{{ \Carbon\Carbon::createFromDate(month: $month)->format('M Y') }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-secondary">
                                <span class="bi bi-filter"></span>
                                <span class="visually-hidden">Filter</span>
                            </button>
                        </div>

                        <!-- Desktop Archive -->
                        <div class="d-none d-lg-block mb-3 card card-body">
                            <nav class="row row-cols-2">
                                @foreach($months as $month)
                                    <a href="#">{{ \Carbon\Carbon::createFromDate(month: $month)->format('M Y') }}</a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post -->
            <div class="order-lg-0 col-lg-8">
                <div class="border-bottom pb-2 mb-3">
                    <h4>
                        Category {{ $post_category }}
                    </h4>
                </div>

                <h6 class="text-dark fw-bold">
                    Published
                    <time class="small text-muted" datetime="{{ now()->format('Y-m-d H:i') }}">{{ now()->format('M d, Y') }}</time>
                </h6>
                @foreach(range(1,5) as $paragraph)
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Animi facere inventore nemo perferendis rem. At autem, beatae
                        dicta dolor, hic id ipsum molestiae nemo nostrum repellat
                        suscipit tempore ullam. Consequatur dolores laborum maiores
                        minus officiis, quis quod soluta! Ullam, vero!
                    </p>
                @endforeach

                <!-- Post Tags / Comments Count -->
                <div class="mt-auto d-flex justify-content-between border-bottom pb-3 mb-3">
                    <div>
                        @foreach(range(1, 2) as $tag)
                            <div class="badge bg-secondary">Tag {{ $tag }}</div>
                        @endforeach
                    </div>

                    <div class="d-flex align-items-center">
                        <span class="bi bi-chat-quote"></span>
                        <span class="ms-2">{{ count($comments) }}</span>
                    </div>
                </div>

                <!-- Comments -->
                @foreach($comments as $comment)
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <img class="rounded-3 shadow-sm" src="//via.placeholder.com/60x60" alt="Avatar">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <strong>
                                User &mdash;
                                <time class="small text-muted" datetime="{{ now()->format('Y-m-d H:i') }}">{{ now()->format('M d, Y') }}</time>
                            </strong>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, veniam!
                            </p>
                            <nav class="nav pt-0">
                                <a class="ps-0 nav-link" href="#">Edit</a>
                                <a class="nav-link" href="#">Delete</a>
                            </nav>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
