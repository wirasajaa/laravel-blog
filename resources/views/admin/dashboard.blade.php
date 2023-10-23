@extends('admin.partials.app')
@push('content')
    <div class="row">
        <div class="col-lg-7 d-flex align-items-stretch">
            <!-- Monthly Earnings -->
            <div class="card w-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Monthly Uploaded </h5>
                            <h4 class="fw-semibold mb-3">{{ $trackUpload->sum('total') ?? '0' }} Articles in
                                {{ date_format(now(), 'Y') }}</h4>
                            {{-- <div class="d-flex align-items-center pb-1">
                                <span
                                    class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-arrow-down-right text-danger"></i>
                                </span>
                                <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                <p class="fs-3 mb-0">last year</p>
                            </div> --}}
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-article fs-6"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="earning"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Yearly Breakup -->
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-9 fw-semibold">Popular Category</h5>
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h4 class="fw-semibold mb-3">
                                        {{ $mostCategory->first()->label ?? '-' }}
                                    </h4>
                                    <div class="d-flex align-items-center mb-3">
                                        <p class="fs-3 mb-0">{{ $mostCategory->first()->total ?? 0 }} Articles
                                        </p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @php
                                            $class = ['bg-danger', 'bg-primary', 'bg-danger-subtle'];
                                        @endphp
                                        @foreach ($mostCategory as $key => $category)
                                            <div class="me-4">
                                                <span
                                                    class="round-8 {{ $class[$key] }} rounded-circle me-2 d-inline-block"></span>
                                                <span class="fs-2">{{ $category->label }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-center">
                                        <div id="breakup"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Uploaded Articles</h5>
                                </div>
                                {{-- <div>
                                <select class="form-select">
                                    <option value="1">March 2023</option>
                                    <option value="2">April 2023</option>
                                    <option value="3">May 2023</option>
                                    <option value="4">June 2023</option>
                                </select>
                            </div> --}}
                            </div>
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('script')
    <script src="{{ asset('admin/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>

    <script>
        // =====================================
        // Upload Articles
        // =====================================
        const articlesTotal = {!! json_encode(json_decode($articleByYear->pluck('total'))) !!};
        const articlesLable = {!! json_encode(json_decode($articleByYear->pluck('year'))) !!};
        const articlesMax = {{ $articleByYear->pluck('total')->max() + 5 ?? 0 }};

        const bestCategoryTotal = {!! json_encode(json_decode($mostCategory->pluck('total'))) !!}
        const bestCategoryLabel = {!! json_encode(json_decode($mostCategory->pluck('label'))) !!}

        // =====================================
        // Monthly Upload
        // =====================================
        const uploadTotal = {!! json_encode(json_decode($trackUpload->pluck('total'))) !!}
        const uploadCategory = {!! json_encode(json_decode($trackUpload->pluck('name'))) !!}
        const uploadMax = {{ $trackUpload->pluck('total')->max() + 2 ?? 0 }};
    </script>
@endpush
