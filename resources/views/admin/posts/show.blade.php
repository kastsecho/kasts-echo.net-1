<x-layouts.admin>
    <div class="container">
        {{-- Start Header/CTA --}}
        <div class="mb-3 d-flex align-items-center justify-content-between" id="header">
            <p class="mb-0 h3">{{ __('Post Details') }}</p>

            <div class="d-flex align-items-center justify-content-end">
                <a class="fw-bold link-danger text-decoration-none me-5" href="#"
                    data-coreui-toggle="modal" data-coreui-target="#deleteModal"
                >{{ __('Delete Post') }}</a>

                <a class="btn btn-info" href="{{ route('admin.posts.edit', $post) }}">{{ __('Edit Post') }}</a>
            </div>
        </div>
        {{-- End Header/CTA --}}

        {{-- Start Details Card --}}
        <div class="py-4 card card-body shadow-sm">
            <div class="mb-3 pb-3 row border-bottom">
                <label class="col-sm-2 fw-bold" for="id">{{ __('ID') }}</label>

                <div class="col-sm-10">
                    <input class="form-control" id="id" name="id" type="text" value="{{ $post->id }}" disabled>
                </div>
            </div>

            <div class="mb-3 pb-3 row border-bottom">
                <label class="col-sm-2 fw-bold" for="title">{{ __('Title') }}</label>

                <div class="col-sm-10">
                    <input class="form-control" id="title" name="title" type="text" value="{{ $post->title }}" disabled>
                </div>
            </div>

            <div class="mb-3 pb-3 row border-bottom">
                <label class="col-sm-2 fw-bold" for="body">{{ __('Body') }}</label>

                <div class="col-sm-10">
                    <textarea class="form-control" id="body" name="body" rows="5" disabled>{{ $post->body }}</textarea>
                </div>
            </div>

            <div class="row">
                <label class="col-sm-2 fw-bold" for="created">{{ __('Created') }}</label>

                <div class="col-sm-10">
                    <input class="form-control" id="created" name="created" type="date" value="{{ $post->created_at->format('Y-m-d') }}" disabled>
                </div>
            </div>
        </div>
        {{-- End Details Card --}}
    </div>

    @push('modals')
        <div class="modal modal-alert" tabindex="-1" role="dialog" id="deleteModal">
            <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="p-4 modal-body text-center">
                            <h5 class="mb-0">{{ __('Delete Post') }}</h5>
                            <p class="mb-0">{{ __('Are you sure you want to delete this resource?') }}</p>
                        </div>
                        <div class="modal-footer flex-nowrap p-0">
                            <button class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" type="button" data-coreui-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" type="submit">
                                <strong>{{ __('Delete Post') }}</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endpush
</x-layouts.admin>
