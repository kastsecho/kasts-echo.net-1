@php
    $categories = range(1, 8);
    $months = range(1, 12);
@endphp
<x-layouts.app>
    <div class="container">
        <h3 class="fw-bold">{{ __('Blog') }}</h3>

        <div class="row">
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
                        <div class="d-lg-none input-group">
                            <select class="form-select" name="category" id="category" aria-label="Category Filter">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">Category {{ $category }}</option>
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
                                @foreach($categories as $category)
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

            <!-- Posts -->
            <div class="order-lg-0 col-lg-9">
                <div class="row align-items-stretch row-cols-md-2 row-cols-xl-3">
                    @foreach($posts as $post)
                        <div class="mb-3">
                            <div class="card shadow-sm h-100">
                                <!-- Post Meta / Excerpt -->
                                <div class="d-flex flex-column card-body">
                                    <h6>
                                        <a class="link-dark" href="#">Category {{ random_int(1, 8) }}</a>
                                        <small>&mdash;</small>
                                        <time class="small text-muted" datetime="{{ $post->created_at->format('Y-m-d H:i') }}">{{ $post->created_at->format('M d, Y') }}</time>
                                    </h6>

                                    <h5 class="text-truncate card-title">{{ $post->title }}</h5>
                                    <p>
                                        {{ str($post->body)->limit(90) }}
                                    </p>
                                    <div class="mt-auto">
                                        @foreach(range(1, 2) as $tag)
                                            <div class="badge bg-secondary">Tag {{ $tag }}</div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Post CTA / Comments Count -->
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a href="{{ route('blog.show', $post) }}">{!! __('Read More &raquo;') !!}</a>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="bi bi-chat-quote"></span>
                                        <span class="ms-2">{{ random_int(1, 10) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
