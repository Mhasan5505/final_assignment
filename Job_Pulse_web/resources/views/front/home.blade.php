@extends('front.layouts.app')

@section('main')
<section class="section-0 lazy d-flex bg-image-style dark align-items-center "   class="" data-bg="{{ asset('assets/images/banner5.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Find your dream job</h1>
                <p>Thounsands of jobs available.</p>
                <div class="banner-btn mt-5"><a href="jobs.html" class="btn btn-primary mb-4 mb-sm-0">Explore Now</a></div>
            </div>
        </div>
    </div>
</section>

<section class="section-1 py-5 "> 
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('jobs') }}" method="Get">
                <div class="row">
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Keywords">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Location">
                    </div>
                    <div class="col-md-3 mb-3 mb-sm-3 mb-lg-0">
                        <select name="category" id="category" class="form-control">
                            <option value="">Select a Category</option>
                            if ($newCategories->isNotEmpty()) {
                                @foreach ($newCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            }
                        </select>
                    </div>
                    
                    <div class=" col-md-3 mb-xs-3 mb-sm-3 mb-lg-0">
                        <div class="d-grid gap-2">
                            {{-- <a href="jobs.html" class="btn btn-primary btn-block">Search</a> --}}
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </div>
                        
                    </div>
                </div>   
            </form>         
        </div>
    </div>
</section>



<!-- top companies start -->
<section>
    <h1 class="container top-c">Top Companies</h1>
    <div class="companies">
      <div class="container">
        <div class="slider-wrapper">
          <button id="prev-slide" class="slide-button material-symbols-rounded"><i class="fa-solid fa-chevron-left"></i></button>
          <div class="image-list">
            <a href="#"><img src="assets/images/1.jpg" alt="img-1" class="image-item"></a>
            <a href="#"><img src="assets/images/2.png" alt="img-2" class="image-item"></a>
            <a href="#"><img src="assets/images/3.png" alt="img-3" class="image-item"></a>
            <a href="#"><img src="assets/images/4.png" alt="img-4" class="image-item"></a>
            <a href="#"><img src="assets/images/5.png" alt="img-5" class="image-item"></a>
            <a href="#"><img src="assets/images/6.jpg" alt="img-6" class="image-item"></a>
            <a href="#"><img src="assets/images/7.jpg" alt="img-7" class="image-item"></a>
            <a href="#"><img src="assets/images/3.png" alt="img-3" class="image-item"></a>
            <a href="#"><img src="assets/images/2.png" alt="img-2" class="image-item"></a>
            <a href="#"><img src="assets/images/11.jpg" alt="img-2" class="image-item"></a>
          </div>
          <button id="next-slide" class="slide-button material-symbols-rounded"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        <div class="slider-scrollbar">
          <div class="scrollbar-track">
            <div class="scrollbar-thumb"></div>
          </div>
        </div>
      </div>      
    </div>
</section>
            <!-- top companies end  -->

            <!-- Popular categories are here start  -->
<section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Popular Categories</h2>
        <div class="row pt-5">

            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-xl-3 col-md-6">
                        <div class="single_catagory">
                            <a href="{{ route('jobs')."?category=".$category->id }}" style="text-decoration: none; color: #000"><h4 class="pb-2">{{ $category->name }}</h4></a>
                            <p class="mb-0"><span>0</span> Avaiable Position</p>
                        </div>
                    </div>
                @endforeach
            @endif
            

        </div>
    </div>
</section>
            
            <!-- latest jobs start here  -->

<section class="section-3 bg-2 py-5">
    <div class="container">
        <h2>Latest Jobs</h2>
        <div class="row pt-5">
            <div class="job_listing_area">                    
                <div class="job_lists">
                    <div class="row">
                        @if ($latestJobs->isNotEmpty())
                        @foreach ($latestJobs as $latestJob)
                            <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="border-0 fs-5 pb-2 mb-0">{{ $latestJob->title }}</h3>

                                    <p>{{ Str::words($latestJob->description, 10) }}</p>
                                    
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{ $latestJob->location }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{ $latestJob->jobType->name }}</span>
                                        </p>
                                        @if (!is_null($latestJob->salary))
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                <span class="ps-1">{{ $latestJob->salary }}</span>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="d-grid mt-3">
                                        <a href="{{ route('jobDetail',$latestJob->id) }}" class="btn btn-primary btn-lg">Details</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    @endif                         
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection