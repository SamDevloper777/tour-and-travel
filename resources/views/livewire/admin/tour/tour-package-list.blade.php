<div class="p-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0">Tour Packages</h2>
        <a href="{{ route('admin.tour.package.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 5v14" />
                <path d="M5 12h14" />
            </svg>
            Add Package
        </a>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 text-green-600">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search..." class="form-control" />
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($packages as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->title }}</td>
                            <td>{{ $p->slug }}</td>
                            <td>{{ $p->price }}</td>
                            <td>
                                <a href="{{ route('admin.tour.package.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <button wire:click="delete({{ $p->id }})" class="btn btn-sm btn-outline-danger ms-2">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No packages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $packages->links() }}</div>
</div>
