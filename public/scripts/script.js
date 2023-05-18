const carousel = document.querySelector('#blockInfo .carusel');
const carouselSlides = document.querySelectorAll('#blockInfo .carusel img');

// Duplicate slides to fill up to 30 blocks
// for (let i = 0; i < 40; i++) {
//     const newSlide = carouselSlides[i % carouselSlides.length].cloneNode(true);
//     carousel.appendChild(newSlide);
// }



/*welcom */
const texts = ["строительных компаний", "частных риелторов", "агентств недвижимости"];
let index = 0;
let letterIndex = 0;
let isDeleting = false;

function type() {
    const text = texts[index];
    const typingSpeed = 100;

    if (isDeleting) {

        letterIndex--;

        if (letterIndex == 0) {
            isDeleting = false;
        }
    } else {
        document.getElementById("text").innerHTML = "Evon - универсальная площадка для " + text.substring(0, letterIndex + 1);
        letterIndex++;

        if (letterIndex == text.length) {
            isDeleting = true;
            setTimeout(() => {
                index++;
                if (index == texts.length) {
                    index = 0;
                }
            }, 1000);
        }
    }

    setTimeout(type, typingSpeed);
}

type();




const contant = document.querySelector('#welcom .welcom-cont .right .contant');
const contantBtn = document.querySelector('#welcom .welcom-cont .right .contant .btn');

// Duplicate slides to fill up to 79 blocks
for (let i = 0; i < 79; i++) {
    const newSlide = contantBtn.cloneNode(true);
    contant.appendChild(newSlide);
}


const contantHelp = document.querySelector('#help .help-cont .right .contant');
const contantHelpBtn = document.querySelector('#help .help-cont .right .contant .btn');

if (contantHelpBtn) {
    for (let i = 0; i < 79; i++) {
        const newSlide = contantHelpBtn.cloneNode(true);
        contantHelp.appendChild(newSlide);
    }
}



document.querySelectorAll('#welcom .welcom-cont .right .contant .btn').forEach(btn => {
    btn.addEventListener('mouseenter', () => {
        btn.classList.add('hide');
    });

    btn.addEventListener('mouseleave', () => {
        setTimeout(() => {
            btn.classList.remove('hide');
        }, 3000);
    });
});



document.querySelectorAll('#help .help-cont .right .contant .btn').forEach(btn => {
    btn.addEventListener('mouseenter', () => {
        btn.classList.add('hide');
    });

    btn.addEventListener('mouseleave', () => {
        setTimeout(() => {
            btn.classList.remove('hide');
        }, 3000);
    });
});




document.querySelectorAll("#ForBuilders .left ul li").forEach((element, index) => {
    element.addEventListener("click", () => {
        document.querySelectorAll("#ForBuilders .left ul li").forEach(el => el.classList.remove('active'));
        element.classList.add('active');
        document.querySelectorAll("#ForBuilders .right img").forEach(img => img.classList.remove('active'));
        document.querySelectorAll("#ForBuilders .right img")[index].classList.add('active');
    });
});





document.querySelector("header button.login").addEventListener("click", function () {
    document.querySelector("header .logIn  ").classList.add('active');
})

document.querySelectorAll("header .logIn button:not(.login)").forEach(element => {
    element.addEventListener("click", function () {
        document.querySelector("header .modal").classList.add('active');
        document.querySelector("body").classList.add('fix');
        document.querySelector("header .logIn  ").classList.remove('active');
    })
});

const modalBg = document.querySelector(".modal-bg");
const close_modal = document.querySelector("header .close");
if (modalBg) {
    modalBg.addEventListener("click", function () {
        document.querySelector("header .modal").classList.remove('active');
        document.querySelector("body").classList.remove('fix');
        document.querySelector("header .logIn  ").classList.remove('active');
    });
    close_modal.addEventListener("click", function () {
        document.querySelector("header .modal").classList.remove('active');
        document.querySelector("body").classList.remove('fix');
        document.querySelector("header .logIn  ").classList.remove('active');
    });
}






const cont = document.querySelector('.cont');
let isMouseDown = false;
let startX;
let scrollLeft;
let step = 0;
cont.addEventListener('mousedown', (e) => {
    isMouseDown = true;
    startX = e.pageX - cont.offsetLeft;
    scrollLeft = cont.scrollLeft;
});
cont.addEventListener('mouseleave', () => {
    isMouseDown = false;
});
cont.addEventListener('mouseup', (e) => {
    isMouseDown = false;
    if (Math.abs(e.pageX - startX) >= 200) {
        animtionChange()
    }
});
cont.addEventListener('mousemove', (e) => {
    if (!isMouseDown) return;
    e.preventDefault();
    const x = e.pageX - cont.offsetLeft;
    const walk = (x - startX) * 3;
    cont.scrollLeft = scrollLeft - walk;
});

function animtionChange() {
    step++;
    if (step>5) {
        step=1
    }
    document.querySelectorAll("#ForRealtors .cont  .slide").forEach(element => {
        element.classList.remove("active")
        if (element.classList.contains(`slide${step}`)) {
            element.classList.add("active")
        }

    });
}




document.querySelector("header ul li.user").addEventListener("click",function () {
    document.querySelector(".modal.lodinn-btns").classList.add('active');
    document.querySelector("body").classList.add('fix');
})



document.querySelector(".modal.lodinn-btns button:first-child").addEventListener("click",function () {
    document.querySelectorAll("header .enter").forEach(element => {
        element.classList.add("active")
    });

    document.querySelectorAll("header .modal-contant button:not(.active)").forEach(element => {
        element.classList.add("hiden")
    });
})


document.querySelector("header .modal-contant .back").addEventListener("click",function () {
    document.querySelectorAll("header .enter").forEach(element => {
        element.classList.remove("active")
    });

    document.querySelectorAll("header .modal-contant button").forEach(element => {
        element.classList.remove("hiden")
    });
})
