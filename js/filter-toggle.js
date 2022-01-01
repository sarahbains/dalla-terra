( function() {

    const mediaQ = window.matchMedia('(min-width: 75em)');

    const closeBtn = document.getElementById('close-filter');
    const openBtn = document.getElementById('open-filters');
    const filters = document.getElementById('secondary');

    mediaQ.addEventListener('change', (e) => {
        if (e.matches) {
            filters?.classList.remove('opened');
            filters?.classList.remove('closed');
            document.body.style.overflow = '';
        }
    })

    closeBtn?.addEventListener('click', () => {
        filters?.classList.remove('opened');
        filters?.classList.add('closed');
    });

    openBtn?.addEventListener('click', () => {
        filters?.classList.add('opened');
        filters?.classList.remove('closed');
        document.body.style.overflow = 'hidden';
    });

    filters?.addEventListener('transitionend', () => {
        if (filters.classList.contains('closed')) {
            document.body.style.overflow = '';
        }
    })

}());
