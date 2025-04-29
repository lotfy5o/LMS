@extends('frontend.master')
@section('content')
    <!--======================================
                                                                        START CATEGORY AREA
                                                                ======================================-->
    <section class="category-area section--padding">
        <div class="container">
            <div class="category-wrapper">
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-lg-4 responsive-column-half">
                            <div class="category-item">
                                <img class="cat__img lazy"
                                    src=" {{ $category->getFirstMediaUrl('categories') }} "
                                    data-src="{{ $category->getFirstMediaUrl('categories') }}"
                                    alt="Category image">
                                <div class="category-content">
                                    <div class="category-inner">
                                        <h3 class="cat__title"><a
                                                href=" # ">{{ $category->name }}</a>
                                        </h3>
                                        <p class="cat__meta">{{ $category->subCategories->count() }}
                                            subcategories</p>
                                        <p class="cat__meta">{{ $category->courses->count() }}
                                            courses</p>
                                        <a href="{{ route('frontend.categoryDetails', ['category' => $category]) }}"
                                            class="btn theme-btn theme-btn-sm theme-btn-white">Explore<i
                                                class="la la-arrow-right icon ml-1"></i></a>
                                    </div>
                                </div><!-- end category-content -->
                            </div><!-- end category-item -->
                        </div><!-- end col-lg-4 -->
                    @endforeach
                </div><!-- end row -->
            </div><!-- end category-wrapper -->
        </div><!-- end container -->
    </section><!-- end category-area -->
    <!--======================================
                                                                        END CATEGORY AREA
                                                                ======================================-->
@endsection
