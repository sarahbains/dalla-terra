const expanders = document.querySelectorAll('.expander');

expanders.forEach(expander => {
    const btn = expander.querySelector('.expand-btn');

    if (btn) {
        btn.addEventListener('click', () => {
            expander.classList.toggle('toggled');

            if (expander.classList.contains('toggled')) btn.innerHTML = 'Show Less'
            else btn.innerHTML = 'See More'
        });
    }
})