@extends('admin.partials.app')
@push('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Articles</h5>
            <p class="mb-5">This is a sample page </p>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @error('error')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Author</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Uploaded</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $key => $item)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{ $key + 1 }}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{ substr_replace($item->title, '...', 30) }}</h6>
                                    <span class="badge bg-secondary">{{ $item->category->name }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $item->user->name }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-semibold">{{ date_format($item->created_at, 'd M Y') }}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0 d-flex gap-2">
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('articles.show', ['blog' => $item->slug]) }}">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <form action="{{ route('articles.delete', ['blog' => $item->slug]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endpush
