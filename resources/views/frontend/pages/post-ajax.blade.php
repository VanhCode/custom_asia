@foreach ($posts as $post)
    <div class="clm" style="--w-md: 6; --w-xs: 12;">
        <div class="blog-card">
            <a href="{{ $post->slug }}" class="d-block p-relative">
                <img class="d-block" src="{{ asset($post->avatar_path) }}" alt="{{ $post->name }}">
                <div class="blog-categories p-absolute">
                    {{ $post->category->name }}
                </div>
            </a>
            <div class="blog-card-text">
                <h2>
                    <a href="{{ $post->slug }}">{{ $post->name }}</a>
                </h2>
                <div class="date js-center d-flex ai-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                            d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l80 0 0 56-80 0 0-56zm0 104l80 0 0 64-80 0 0-64zm128 0l96 0 0 64-96 0 0-64zm144 0l80 0 0 64-80 0 0-64zm80-48l-80 0 0-56 80 0 0 56zm0 160l0 40c0 8.8-7.2 16-16 16l-64 0 0-56 80 0zm-128 0l0 56-96 0 0-56 96 0zm-144 0l0 56-64 0c-8.8 0-16-7.2-16-16l0-40 80 0zM272 248l-96 0 0-56 96 0 0 56z" />
                    </svg>
                    {{ $post->created_at->format('F d, Y') }}
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="clm" style="--w-lg: 12; --w-sm: 12; --w-xs: 12;">
    {{ $posts->appends(request()->input())->links() }}
</div>

<script>
    var pageLinks = document.querySelectorAll('.page-item .page-link');
    console.log(pageLinks);
    pageLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            $.ajax({
                url: link.getAttribute('href'),
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#postAjax').html(response.html);
                }
                
            });
        })
    });
</script>