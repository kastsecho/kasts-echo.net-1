<x-layouts.admin>
    <div class="container">
        {{-- Start Header/CTA --}}
        <div class="mb-3 d-flex align-items-center justify-content-between" id="header">
            <p class="mb-0 h3">{{ __('Posts') }}</p>

            <a class="btn btn-info" href="{{ route('admin.posts.create') }}">{{ __('Create Post') }}</a>
        </div>
        {{-- End Header/CTA --}}

        <div class="px-0 py-2 card card-body shadow-sm">
            {{-- Start Table --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Active') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr class="align-middle">
                            <th>{{ $post->id }}</th>
                            <td>{{ $post->title }}</td>
                            <td>
                                @if($post->trashed())
                                    <span class="badge bg-danger">{{ __('Inactive') }}</span>
                                @else
                                    <span class="badge bg-success">{{ __('Active') }}</span>
                                @endif
                            </td>
                            <td class="text-end" id="actions">
                                @if($post->trashed())
                                    <a class="link-dark text-decoration-none h6 me-2" href="#"
                                       data-coreui-toggle="modal" data-coreui-target="#restoreModal"
                                       data-coreui-model="{{ $post->id }}"
                                    >
                                        <span class="bi-recycle"></span>
                                        <span class="visually-hidden">{{ __('Restore Post') }}</span>
                                    </a>
                                @else
                                    <a class="link-dark text-decoration-none h6 me-2" href="{{ route('admin.posts.show', $post) }}">
                                        <span class="bi-eye"></span>
                                        <span class="visually-hidden">{{ __('View Post') }}</span>
                                    </a>
                                    <a class="link-dark text-decoration-none h6 me-2" href="{{ route('admin.posts.edit', $post) }}">
                                        <span class="bi-pencil-square"></span>
                                        <span class="visually-hidden">{{ __('Edit Post') }}</span>
                                    </a>
                                    <a class="link-dark text-decoration-none h6 me-2" href="#"
                                       data-coreui-toggle="modal" data-coreui-target="#deleteModal"
                                       data-coreui-model="{{ $post->id }}"
                                    >
                                        <span class="bi-trash"></span>
                                        <span class="visually-hidden">{{ __('Delete Post') }}</span>
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- End Table --}}
        </div>
    </div>

    @push('modals')
        <div class="modal modal-alert" tabindex="-1" role="dialog" id="deleteModal">
            <form action="{{ url('/admin/posts/id') }}" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="p-4 modal-body text-center">
                            <h5 class="mb-0">{{ __('Delete Post') }}</h5>
                            <p class="mb-0">{{ __('Are you sure you want to delete this resource?') }}</p>
                        </div>
                        <div class="p-0 modal-footer flex-nowrap">
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

        <div class="modal modal-alert" tabindex="-1" role="dialog" id="restoreModal">
            <form action="{{ url('/admin/posts/id/restore') }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-dialog" role="document">
                    <div class="modal-content rounded-4 shadow">
                        <div class="p-4 modal-body text-center">
                            <h5 class="mb-0">{{ __('Restore Post') }}</h5>
                            <p class="mb-0">{{ __('Are you sure you want to restore this resource?') }}</p>
                        </div>
                        <div class="p-0 modal-footer flex-nowrap">
                            <button class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-end" type="button" data-coreui-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" type="submit">
                                <strong>{{ __('Restore Post') }}</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endpush
</x-layouts.admin>
