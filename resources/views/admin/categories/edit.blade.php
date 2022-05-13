<x-layouts.admin>
    <div class="container">
        {{-- Start Header/CTA --}}
        <div class="mb-3 d-flex align-items-center justify-content-between" id="header">
            <p class="mb-0 h3">{{ __('Update Category') }}</p>
        </div>
        {{-- End Header/CTA --}}

        {{-- Start Update Form --}}
        <form action="{{ route('admin.categories.update', $category) }}" method="post">
            @csrf
            @method('PUT')
            <div class="py-4 card card-body shadow-sm">
                <div class="mb-3 pb-3 row border-bottom">
                    <label class="col-sm-2 fw-bold" for="name">{{ __('Name') }}</label>

                    <div class="col-sm-10">
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name', $category) }}">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 fw-bold" for="slug">{{ __('Slug') }}</label>

                    <div class="col-sm-10">
                        <input class="form-control" id="slug" name="naslugme" type="text" value="{{ old('slug', $category) }}">
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex align-items-center justify-content-end">
                <a class="fw-bold link-dark text-decoration-none me-5" href="{{ route('admin.categories.show', $category) }}">{{ __('Cancel') }}</a>

                <button class="btn btn-info" type="submit">{{ __('Update Category') }}</button>
            </div>
        </form>
        {{-- End Update Form --}}
    </div>
</x-layouts.admin>
