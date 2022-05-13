<x-layouts.admin>
    <div class="container">
        {{-- Start Header/CTA --}}
        <div class="mb-3 d-flex align-items-center justify-content-between" id="header">
            <p class="mb-0 h3">{{ __('Create Category') }}</p>
        </div>
        {{-- End Header/CTA --}}

        {{-- Start Create Form --}}
        <form action="#" method="post">
            <div class="py-4 card card-body shadow-sm">
                <div class="mb-3 pb-3 row border-bottom">
                    <label class="col-sm-2 fw-bold" for="name">{{ __('Name') }}</label>

                    <div class="col-sm-10">
                        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 fw-bold" for="slug">{{ __('Slug') }}</label>

                    <div class="col-sm-10">
                        <input class="form-control" id="slug" name="naslugme" type="text" value="{{ old('slug') }}">
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex align-items-center justify-content-end">
                <a class="fw-bold link-dark text-decoration-none me-5" href="{{ route('admin.categories.index')  }}">{{ __('Cancel') }}</a>

                <button class="btn btn-info" type="submit">{{ __('Create Category') }}</button>
            </div>
        </form>
        {{-- End Create Form --}}
    </div>
</x-layouts.admin>
