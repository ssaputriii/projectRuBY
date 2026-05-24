@extends('layouts.app')

@section('title', 'Frequently Asked Questions (FAQ)')

@section('content')
<section class="py-5 bg-light min-vh-100">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-3">Frequently Asked Questions</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Temukan jawaban atas pertanyaan umum mengenai pendaftaran anggota dan program Rumah BUMN Yogyakarta.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Search FAQ -->
                <div class="mb-4 position-relative">
                    <input type="text" id="faqSearch" class="form-control border-0 shadow-sm p-3 rounded-4" placeholder="Cari pertanyaan Anda...">
                    <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 text-muted"></i>
                </div>

                <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border-0" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                    <div class="accordion-item border-0 faq-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed py-3 px-4 fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $index }}" aria-expanded="false">
                                <i class="bi bi-question-circle me-3 text-primary"></i>
                                {{ $faq['question'] }}
                            </button>
                        </h2>
                        <div id="faq-{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-4 py-3 text-muted lh-lg">
                                {{ $faq['answer'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="text-center py-5 d-none">
                    <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                    <p class="text-muted">Maaf, pertanyaan tidak ditemukan.</p>
                </div>

                <div class="text-center mt-5">
                    <p class="text-muted mb-3">Masih punya pertanyaan lain?</p>
                    <a href="{{ route('kontak') }}" class="btn btn-primary rounded-pill px-4 py-2">
                        <i class="bi bi-envelope me-2"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('faqSearch');
    const faqItems = document.querySelectorAll('.faq-item');
    const noResults = document.getElementById('noResults');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let hasResults = false;

        faqItems.forEach(item => {
            const question = item.querySelector('.accordion-button').textContent.toLowerCase();
            const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.classList.remove('d-none');
                hasResults = true;
            } else {
                item.classList.add('d-none');
            }
        });

        if (hasResults) {
            noResults.classList.add('d-none');
        } else {
            noResults.classList.remove('d-none');
        }
    });
});
</script>
@endpush
@endsection
