@extends('user.layouts.play')

@section('title')
    <title>Film User</title>
@endsection
       
@section('content')

	<?php $playable_type = snake_case(str_after($product->productable_type, 'App\\')); ?>
		
    {!! view('user.products.play-' . $playable_type, [ $playable_type => $product->productable()->first() ]) !!}
		
	
@endsection