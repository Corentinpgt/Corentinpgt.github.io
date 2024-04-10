let menu = document.querySelector("nav");
let arrow = document.querySelector(".me__arrow");
let btn1 = document.querySelectorAll(".nav__btn")[0];
let btn2 = document.querySelectorAll(".nav__btn")[1];


function displayNone() {
    menu.classList.toggle("displaynone");
    btn2.classList.remove("js_bg_btn");

}

function displayNoneBG() {
    menu.classList.toggle("displaynone");
    btn1.classList.remove("js_bg_btn");
    btn2.classList.add("js_bg_btn");
}

btn1.addEventListener("click",displayNone);
arrow.addEventListener("click",displayNoneBG);



// Target BG


let btn = document.querySelectorAll(".nav__btn");

function bgChange(ev) {
    btn.forEach(elt => {
        elt.classList.remove("js_bg_btn");
    });
    ev.target.classList.add("js_bg_btn")


}

btn[0].addEventListener("click",bgChange);
btn[1].addEventListener("click",bgChange);
btn[2].addEventListener("click",bgChange);
btn[3].addEventListener("click",bgChange);



// Scroll

// function handlerScroll() {
//     menu.classList.remove("displaynone");
// }

// document.addEventListener("scrollend",handlerScroll());