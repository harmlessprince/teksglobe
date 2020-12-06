@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="section-block text-center" id="image-card">
                <h3 class="section-title">
                    Pick the best investment plan for you
                </h3>
                <p>Higher Plan, Higher Investment, Higher Interest at No Risk and Premium Support on each package. You can
                    also withdraw your money for emergency before the end of the investment periods.</p>
            </div>
        </div>

        @if (count($plans) > 0)
            @foreach ($plans as $plan)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-2">{{ $plan->style->name }}</h3>
                        </div>
                        <img class="img-fluid" src="../assets/images/card-img.jpg" alt="Card image cap">
                        <div class="card-body  alert alert-primary" style="margin-bottom: 0">
                            <h3 class="card-title"> <strong class="text-secondary">XAF {{ $plan->minimum }} - XAF {{ $plan->maximum }} </strong></h3>
                            
                            <p class="card-text ">



                                This Plan has the following Benefits. You will get Return <strong class="text-secondary">{{ $plan->percentage }}% </strong>  money on
                                every investment. This is <strong class="text-secondary"> {{ $plan->style->name }} </strong> Plan. It's means when you invest under
                                this plan you will get interest <strong class="text-secondary"> {{ $plan->repeat }} </strong> times in total investment periods. You
                                will get interests calculated <strong class="text-secondary"> {{ $plan->start_duration }} </strong> hours later for fraud check.
                                after investment placed.
                            </p>
                            <a href="#" class="btn btn-primary btn-lg">Invest Now</a>
                            {{-- <a href="#" class="card-link"></a> --}}
                        </div>
                    </div>
                </div>
            @endforeach

        @else

        @endif

    </div>
    {{-- <h2>Available Packages</h2>
    @foreach ($packages as $package)
        <h4>{{ $package->name }}</h4>
        <h6>{{ $package->amount }}</h6>
        <h6>{{ $package->interest }}</h6>
        <form action="{{ route('investments.store', $package->id) }}" method="post">
            @csrf
            <button>Invest</button>
        </form>
    @endforeach --}}
@endsection
