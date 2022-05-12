<x-layouts.admin>
    <div class="py-5 container">
        {{-- Start Header/CTA --}}
        <div class="mb-3 d-flex align-items-center justify-content-between" id="header">
            <p class="mb-0 h3">{{ __('Create Post') }}</p>
        </div>
        {{-- End Header/CTA --}}

        {{-- Start Create Form --}}
        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            <div class="py-4 card card-body shadow-sm">
                <div class="mb-3 pb-3 row border-bottom">
                    <label class="col-sm-2 fw-bold" for="title">{{ __('Title') }}</label>

                    <div class="col-sm-10">
                        <input class="form-control" id="title" name="title" type="text" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-2 fw-bold" for="body">{{ __('Body') }}</label>

                    <div class="col-sm-10">
                        <textarea class="form-control" id="body" name="body" rows="5">{{ old('body') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex align-items-center justify-content-end">
                <a class="fw-bold link-secondary text-decoration-none me-5" href="{{ route('admin.posts.index') }}">{{ __('Cancel') }}</a>

                <button class="btn btn-primary" type="submit">{{ __('Create Post') }}</button>
            </div>
        </form>
        {{-- End Create Form --}}
    </div>
</x-layouts.admin>
