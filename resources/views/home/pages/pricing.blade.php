@extends('layouts.home.app')

@section('title')
  <title>KORFILM</title>
@endsection

@section('content')
<div class="media-container">
    <section class="site-section site-section-light site-section-top">
        <div class="container text-center">
            <h1 class="animation-slideDown"><strong>PRICING</strong></h1>
        </div>

    </section>
    <img src="/home/img/placeholders/photos/photo33.jpg" class="media-image animation-pulseSlow" />
</div>

<section class="site-content site-section">
    <div class="container">
        <h2 class="site-heading">PRICING</h2>
    </div>
</section>

<section class="site-content">
    <div class="container">
    @foreach(App\Plan::site()->get() as $plan)
        <div class="widget-section">
            <h2>{{ $plan->name }}</h2>
            <div>
                {{ $plan->description }}
            </div>

            <div>
                ${{ $plan->price_cents / 100 }} per {{ $plan->period_days }} days
            </div>
            @if (Auth::check())
                <div>
                    <a href="{{ $plan->signup_url . '?user_id=' . Auth::user()->id }}" class="btn btn-primary">Subscribe</a>
                </div>
            @else
                <div>
                    <a href="{{ route('user.register') . '?plan_id=' . $plan->id }}" class="btn btn-primary">Subscribe</a>
                </div>
            @endif

        </div>
    @endforeach
    </div>
</section>

@endsection
