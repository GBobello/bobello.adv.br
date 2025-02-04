//Open close menu mobile
const nav = document.querySelector('#header nav')
const toggle = document.querySelectorAll('nav .toggle')

for (const element of toggle) {
    element.addEventListener('click', function() {
        nav.classList.toggle('show')
    })
}

//Close menu, click link
const links = document.querySelectorAll('nav ul li a')

for(const link of links) {
    link.addEventListener('click', function() {
        nav.classList.remove('show')
    })
}


//Scroll Reveal
const scrollReveal = ScrollReveal({
    origin: 'top',
    distance: '30px',
    duration: 700,
    reset: true
})

scrollReveal.reveal(
    `main img,.hero-text, #home, #about, #about, #atuation .card,
    #partners .partner-card, #contact, #footer`,
     {interval: 100})
      
//Back to top
const wppButtonApi = document.querySelector('.wpp-fixed')
function backToTop() {
    if(this.window.scrollY >= 200) {
        wppButtonApi.classList.add('show-button-wpp')
    } else {
        wppButtonApi.classList.remove('show-button-wpp')
    }
}

window.addEventListener('scroll', function() {
    backToTop()
})

