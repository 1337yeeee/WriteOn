@extends('base')

@section('title', $author->name)

@section('style')
<link href="/style/products.css" rel="stylesheet" type="text/css">
<link href="/style/author.css" rel="stylesheet" type="text/css">
@endsection

@section('content')

	<div class="author">
		<div class="row">
			<div class="author-img">
				<img src="/{{ $author->image }}"/>
			</div>

			<div class="author-info">
				<h1 class="author-name">{{ $author->name }}</h1>
				<p class="author-genre"></p>
				<p class="author-description">{{ $author->description}}</p>
			</div>
		</div>

		<div class="content products">
			@foreach($author->books as $book)
	            <div class="book-card">
	                <div class="card-image">
	                    <img src="/{{ $book->product[0]->image }}" alt="{{ $book->product[0]->name }}">
	                </div>
	                <div class="card-details">
	                    @if ($book->product[0]->oldprice)<p class="old-price">${{ $book->product[0]->oldprice }}</p>
	                    @else
	                    <p class="old-price" style="color: #fff; text-decoration: none;">&nbsp;</p>
	                    @endif
	                    <p class="price">${{ $book->product[0]->price }}</p>
	                    <h2 class="product-name">{{ $book->product[0]->name }}</h2>
	                    <a class="btn-product" href="/product/{{ $book->product[0]->id }}">Look up!</a>
	                </div>
	            </div>
	        @endforeach
	    </div>
	</div>

@endsection