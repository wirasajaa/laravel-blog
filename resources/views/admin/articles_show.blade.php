@extends('admin.partials.app')
@push('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Detail Article</h3>
            <span class="fw-normal">Looks detail of article</span>
            <div class="content mt-4">
                <img src="{{ $article->thumbnail }}" alt="thumbnail-article" class="img-fluid mb-3"
                    style="
                    width: 100vw;
                    max-height: 70vh;
                    object-fit: cover;
                    background-position: center;
                    ">
                <h2 class="mb-2">{{ $article->title }}</h2>
                <div class="d-flex gap-2 mb-3 align-items-center">
                    <h2><span class="badge bg-secondary">{{ $article->category->name }}</span></h2>
                    <span class="fw-normal">{{ $article->created_at->diffForHumans() }}</span>
                </div>

                <p class="fw-normal">{{ $article->content }}</p>
                <div class="d-flex justify-content-end">
                    <form action="{{ route('articles.delete', ['blog' => $article->slug]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-lg">Delete <i class="ti ti-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
