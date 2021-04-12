jQuery(document).ready(function($){
    $('#menu-main-menu').slicknav({
       // appendTo:'.site-header' -gdzie umiejscawiamy menu
    });

    //run the bxslider on testimonials
    $('.testimonials-list').bxSlider({
        controls: false,
        mode:'fade'
    });

    //When the page is read add the fixed menu if positin is greater than 300px
    const headerScroll = document.querySelector('.navigation-bar');
    const rect = headerScroll.getBoundingClientRect();
    const topDistance = Math.abs(rect.top);
    fixedMenu(topDistance);

});

window.onscroll = () => {
    const scroll = window.scrollY;
    fixedMenu(scroll);
}

//Adds a fixed menu on top
function fixedMenu(scroll){
    const headerScroll = document.querySelector('.navigation-bar');
  

    if(scroll > 300){
    
        headerScroll.classList.add('fixed-top');

    } else{
        
        headerScroll.classList.remove('fixed-top');
    };
};