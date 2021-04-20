<div class="space-y-4">
    <h2 class="font-semibold text-lg hover:text-blue-500">
        <a href="{{ route('article.show', ['slug' => $article->slug]) }}">{{ $article->title }}</a>
    </h2>
    <div class="space-y-2">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut, architecto?</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi iste minima laudantium nostrum ut quaerat consequuntur architecto molestiae asperiores a?</p>
    </div>
</div>