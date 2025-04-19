<div class="star-rating">
    @for($i = 1; $i <= 5; $i++)
        <form action="{{ route('posts.rate', $post) }}" method="POST" style="display: inline">
            @csrf
            <button type="submit" name="rating" value="{{ $i }}" class="star-btn">
                @if($i <= ($userRating ?? $post->userRating() ?? 0))
                    ★
                @else
                    ☆
                @endif
            </button>
        </form>
    @endfor
    <span>({{ number_format($post->averageRating(), 1) }})</span>
</div>

<style>
    .star-btn {
        background: none;
        border: none;
        color: gold;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
    }
    .star-rating {
        margin: 10px 0;
    }
</style>

<script>
    document.querySelectorAll('.star-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const rating = this.value;

            // Создаем FormData объект
            const formData = new FormData();
            formData.append('rating', rating);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if(data.success) {
                        // Обновляем отображение звезд без перезагрузки страницы
                        this.closest('.star-rating').querySelectorAll('.star-btn').forEach((star, index) => {
                            star.innerHTML = index < rating ? '★' : '☆';
                        });

                        // Обновляем средний рейтинг, если он есть
                        const avgRatingElement = this.closest('.star-rating').querySelector('.avg-rating');
                        if (avgRatingElement && data.average_rating) {
                            avgRatingElement.textContent = `(${data.average_rating.toFixed(1)})`;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>
