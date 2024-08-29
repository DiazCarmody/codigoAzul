document.addEventListener('DOMContentLoaded', ()=> {

    //DARK MODE SCRIPT

    const toggler = document.querySelector('.toggler');
    const root = document.documentElement;

    if (root.getAttribute('data-theme') === 'dark'){
        toggler.checked = true;
    }


    toggler.addEventListener('click', toggleTheme);

    function toggleTheme(){
        const setTheme = toggler.checked ? 'dark' : 'light';

        root.setAttribute('data-theme', setTheme);
        localStorage.setItem('theme', setTheme);
    }
    
    //ACCOUNT TOGGLER

        const account_toggler = document.querySelector('.account-toggler');

        const account_info = document.querySelector('.account-info');

        account_toggler.addEventListener('click', toggleAccount);
       
        function toggleAccount(){
            const setDisplay = account_toggler.checked ? 'block' : 'none';
        
            account_info.style.display = setDisplay;

            document.addEventListener('mouseup', function(e) {

                if (!account_info.contains(e.target)) {
                    account_toggler.checked = false;
                    account_info.style.display = 'none';
                }
            });
        }

})



