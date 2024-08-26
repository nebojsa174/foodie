// LIST OF VARIABLES ===================================>

    const phoneIcon = document.querySelector('.phoneIcon')
    const phoneCard = document.querySelector('.phoneCard')
    const locationIcon = document.querySelector('.locationIcon')
    const closeList = document.querySelector('.closeList')
    const messageConatainer = document.querySelector('.messageConatainer')
    const messageConatainerHome = document.querySelector('.messageConatainerHome')
    
    const navBar = document.getElementById ('navBar'),
          toggleBtn = document.getElementById('toggler'),
          closeBtn = document.getElementById('closeBtn');
    
    toggleBtn.addEventListener('click', ()=>{
        navBar.classList.add('show')
        phoneCard.style.display ='none';
    
    })      
    closeBtn.addEventListener('click', ()=>{
        navBar.classList.remove('show')
    })  
    
    // REMOVE NAVBAR BY EACH LINK ONCLICK
    const navLinks = document.querySelectorAll('.navLink')
    
    function removeNavBar (){
        navBar.classList.remove('show')
    }
    navLinks.forEach( navLink =>{
         navLink.addEventListener('click', removeNavBar)
    })
    
    
    // CHANGING HEADER BACKGROUND COLOR AFTER 20PX ON SCROLL Y AXIS
    const headerChange = document.getElementById('header');
    function headerShadow (){
    
       if(this.scrollY >= 20)
           headerChange.classList.add('headerBG')
       else
       headerChange.classList.remove('headerBG')
    }
    window.addEventListener('scroll', headerShadow)
    
    
    // DISPLAY HEADER PHONE NUMBER 
    phoneIcon.addEventListener('click', ()=>{
        phoneCard.style.display = 'flex';
        navBar.classList.remove('show')
        locationsList.style.display = 'none';
        setTimeout(()=>{
            phoneCard.style.display ='none';
        }, 5000)
    })
    
    
    //DISPLAY ITEM ADDED TO CART MESSAGE
    function removeMessage(){
      setTimeout(()=> messageConatainer.style.display = 'none',3000)
    }
    removeMessage()
    
    //DISPLAY ORDER MESSAGE
    function removeMessageHome(){
      setTimeout(()=> messageConatainerHome.style.display = 'none',3000)
    }
    removeMessageHome()
    
    
    
    // SWIPER FOR THE POPULAR ITEMS
    var swiper = new Swiper(".content", {
        spaceBetween: 30,
        autoplay: false,
        grabCursor: true,
        loop:true,
        // centeredSlides: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        keyboard: true,
        mausehold: true,
    
        breakpoints: {
          600: {
            slidesPerView: 2,
            spaceBetween: 30,
          },
          960: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
          1240: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
         
          
        }
    });
    
    // SWIPER FOR THE OTHER ITEMS (DETAILS PAGE)
    var swiper = new Swiper(".secContainer", {
        spaceBetween: 30,
        autoplay: false,
        grabCursor: true,
        loop:true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
    
        breakpoints: {
            600: {
              slidesPerView: 2,
              spaceBetween: 30,
            },
            960: {
              slidesPerView: 3,
              spaceBetween: 30,
            },
          }
    });
    
    
    // CATEGORIES FILTER.
    
    const categories = document.querySelectorAll('.option')
    const itemWrapper = document.querySelectorAll('.categoryWrapper')
    for(let i=0; i<categories.length; i++){
        categories[i].addEventListener('click', function(){
            for(let a=0; a<categories.length; a++){
                categories[a].classList.remove('categoryActive')
            }
            this.classList.add('categoryActive')
    
            let itemFilter = this.getAttribute('data-filter')
            for(let f=0; f<itemWrapper.length; f++){
             itemWrapper[f].classList.add('hide')
             itemWrapper[f].classList.remove('live')
             if(itemWrapper[f].getAttribute('data-target') == itemFilter || itemFilter == "all"){
                 itemWrapper[f].classList.remove('hide')
                 itemWrapper[f].classList.add('live')
             }
            }
        })
    }
    
    
    
    
    