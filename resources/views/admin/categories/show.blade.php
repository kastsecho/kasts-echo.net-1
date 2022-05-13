<x-layouts.admin>
    <div class="container">
        {{-- Start Header/CTA --}}
        <div class="mb-3 d-flex align-items-center justify-content-between" id="header">
            <p class="mb-0 h3">{{ __('Category Details') }}</p>

            <div class="d-flex align-items-center justify-content-end">
                <a class="fw-bold link-danger text-decoration-none me-5" href="#"
                    data-coreui-toggle="modal" data-coreui-target="#deleteModal"
                >{{ __('Delete Category') }}</a>

                <a class="btn btn-info" href="{{ route('admin.categories.edit', $category) }}">{{ __('Edit Category') }}</a>
            </div>
        </div>
        {{-- End Header/CTA --}}

        {{-- Start Details Card --}}
        <div class="py-4 card card-body shadow-sm">
            <div class="mb-3 pb-3 row border-bottom">
                <label class="col-sm-2 fw-bold" for="id">{{ __('ID') }}</label>

                <div class="col-sm-10">
                    <input class="form-control" id="id" name="id" type="text" value="{{ $category->id }}" disabled>
                </div>
            </div>

            <div class="mb-3 pb-3 row border-bottom">
                <label class="col-sm-2 fw-bold" for="name">{{ __('Name') }}</label>

                <div class="col-sm-10">
                    <input class="form-control" id="name" name="name" type="text" value="{{ $category->name }}" disabled>
                </div>
            </div>

            <div class="mb-3 pb-3 row border-bottom">
                <label class="col-sm-2 fw-bold" for="slug">{{ __('Slug') }}</label>

                <div class="col-sm-10">
                    <input class="form-control" id="slug" name="slug" type="text" value="{{ $category->slug }}" disabled>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 fw-bold" for="created">Created</label>

                <div class="col-sm-10">
                    <input class="form-control" id="created" name="created" type="date" value="{{ $category->created_at->format('Y-m-d') }}" disabled>
                </div>
            </div>
        </div>
        {{-- End Details Card --}}
    </div>

    @push('modals')
        <div class="modal modal-alert" tabindex="-1" role="dialog" id="deleteModal">
            <form action="#" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="p-4 modal-body text-center">
                            <h5 class="mb-0">{{ __('Delete Category') }}</h5>
                            <p class="mb-0">{{ __('Are you sure you want to delete this resource?') }}</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" type="button" data-coreui-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" type="submit">
                                <strong>{{ __('Delete Category') }}</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endpush
</x-layouts.admin>
