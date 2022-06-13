<script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
</script>
<script>
    var themeToggleDarkIcon = document.querySelectorAll('.theme-toggle-dark-icon');
    var themeToggleLightIcon = document.querySelectorAll('.theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        for (let i = 0; i < themeToggleLightIcon.length; i++) {
            themeToggleLightIcon[i].classList.remove('hidden');
        }
        // themeToggleLightIcon.classList.remove('hidden');
    } else {
        for (let i = 0; i < themeToggleDarkIcon.length; i++) {
            themeToggleDarkIcon[i].classList.remove('hidden');
        }
        // themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtns = document.querySelectorAll('.theme-toggle');

    themeToggleBtns.forEach(themeToggleBtn => {
        themeToggleBtn.addEventListener('click', function () {

            // toggle icons inside button
            for (let i = 0; i < themeToggleDarkIcon.length; i++) {
                // themeToggleDarkIcon[i].classList.toggle('hidden');
                // themeToggleLightIcon[i].classList.toggle('hidden');

                if (document.documentElement.classList.contains('dark')) {
                    themeToggleDarkIcon[i].classList.remove('hidden');
                    themeToggleLightIcon[i].classList.add('hidden');
                }else{
                    themeToggleLightIcon[i].classList.remove('hidden');
                    themeToggleDarkIcon[i].classList.add('hidden');
                }
            }
            // themeToggleDarkIcon.classList.toggle('hidden');
            // themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    });

</script>
