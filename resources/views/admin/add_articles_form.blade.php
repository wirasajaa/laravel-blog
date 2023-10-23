@extends('admin.partials.app')
@push('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Add New Articles</h5>
            <p class="mb-5">Add some new topics </p>
            @error('error')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="inputThumbnail" class="form-label">Thumbnail</label>
                                <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                    name="thumbnail" id="inputThumbnail" value="{{ old('thumbnail') }}">
                                @error('thumbnail')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="inputTitle" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="inputTitle" value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <h6 class="fw-normal">Your Slug Articles</h6>
                                <h5>example-slug</h5>
                            </div>
                            <div class="mb-3">
                                <label for="inputCategory" class="form-label">Category</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    id="inputCaegory">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ?? 'selected' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('images/07f9050ecfbd8cd4f8b97d0f353be30c.png') }}" alt="preview-image"
                                class="img-fluid rounded">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputContent" class="form-label">Content</label>
                    <textarea name="content" id="inputContent" class="form-control @error('content') is-invalid @enderror" cols="30"
                        rows="5">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-lg btn-primary">Post</button>
                </div>
            </form>
        </div>
    </div>
@endpush
