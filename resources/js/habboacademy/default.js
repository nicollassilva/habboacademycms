const HabboAcademy = {
    init() {
        this.initEssentials();
        
        this.paginations();
    },

    initEssentials() {
        $(document).tooltip({
            selector: '[data-toggle="tooltip"]',
            html: true,
            boundary: "window"
        });

        this.sliders();
        this.toggleSearchInSections();
        this.fixedMenuOnTop();
        this.selectTopicsCategories();
        this.initBBCode();
        this.profileImage();
    },

    paginations() {
        
    },

    sliders() {
        var indexSlider = new Swiper(".indexSlider", {
            slidesPerView: 1,
            mousewheel: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            loop: true,
            effect: "flip",
            pagination: {
              el: ".swiper-pagination",
              dynamicBullets: true,
              clickable: true
            }
        });

        var newsSlider = new Swiper(".newsSlider", {
            slidesPerView: 3,
            spaceBetween: 35,
            slidesPerGroup: 1,
            mousewheel: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            }
        });
    },

    toggleSearchInSections() {
        let button = $("section .content-title .action-buttons .search i:not(.mirror)");

        button.off("click").on("click", event => {
            let inputSearch = $(event.target).parent().find("input");

            if(inputSearch.length < 1) return;

            inputSearch.toggleClass("opened");
            $(event.target).toggleClass("mirror fa-flip-horizontal");
        });
    },

    fixedMenuOnTop() {
        $(window).on("scroll", function() {
            let scrollTop = $(this).scrollTop(),
                menu = $("nav.menu:first-of-type");

            if(scrollTop > 500) {
                menu.addClass("position-fixed").attr("style", "top: 0; z-index: 1000");
                $("header").attr("style", "margin-top: 70px");
            } else {
                menu.removeClass("position-fixed").removeAttr("style");
                $("header").removeAttr("style");
            }
        })
    },

    selectTopicsCategories() {
        let boxCategorias = $(".box-content.box-postar .content form .form-group .categorias"),
            span =  boxCategorias.find("span"),
            items = boxCategorias.find("ul li"),
            input = $('.box-content.box-postar .content form input[type="hidden"][name="category"]');

        items.on("click", function() {
            input.val($(this).attr("id"))
            span.html($(this).html()).addClass("selected")
        })
    },

    initBBCode() {
        $("[data-bbcode]").on("click", function(t) {
            $("[data-bbcode]").removeClass("active");
            var a = $(this),
                e = a.attr("data-bbcode-before"),
                i = a.attr("data-bbcode-after"),
                o = a.attr("data-bbcode-el");
            if (void 0 !== (t = a.attr("data-type"))) $("." + o).not("." + o + "#" + t).slideUp("slow"), $("." + o + "#" + t).slideToggle("slow");
            else {
                var n = $(o),
                    s = n.val().length,
                    r = n[0].selectionStart,
                    c = n[0].selectionEnd,
                    l = e + n.val().substring(r, c) + i;
                n.val(n.val().substring(0, r) + l + n.val().substring(c, s)).focus()
            }
        });
    },
    
    profileImage() {
        $('input[type="file"][imageAvatar]').on("change", function() {
            if(this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("label[avatarImage]").css("background-image", 'url("' + e.target.result + '")').fadeIn();
                }
                reader.readAsDataURL(this.files[0]);
            }
        })
    },
}

export default HabboAcademy