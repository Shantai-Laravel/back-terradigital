

if(screen.width > 767) {
  $("#lang-button").removeAttr("data-toggle");
  $(".title").attr("data-toggle", "collapse").on("click", function() {
    $(".cke-content-accordion").css("width", "50%");
  if($(this).next().hasClass("show")) {
    $(this).parent().css("width", "50%");
  } else {
    $(this).parent().css("width", "100%");
  }
  })
}
const images = document.querySelectorAll('.image-zagl img');

for (let i = 0; i<=images.length; i++) {

  if(($(images[i]).css('height') === "1px" || $(images[i]).css('height') === "0px") && $('main').hasClass('home-content')) {
    $(images[i]).attr('src', '/new-zagl.jpg')
  }
}


const cke = document.getElementById('ckePage');

if(cke) {
  const links = document.querySelectorAll('a');


  links.forEach((item, i) => {
    const result = item.getAttribute('name');
    const navStatic = document.getElementById('navStatic');


    if(result) {
      const node = document.createElement("a");                 // Create a <a> node
      const textnode = document.createTextNode(result);
      node.appendChild(textnode);
      node.setAttribute('href', `#${result}`);

      navStatic.appendChild(node);
    }

  });


}

!(function (e) {
    var o = {};
    function t(n) {
      if (o[n]) return o[n].exports;
      var i = (o[n] = { i: n, l: !1, exports: {} });
      return e[n].call(i.exports, i, i.exports, t), (i.l = !0), i.exports;
    }
    (t.m = e),
      (t.c = o),
      (t.d = function (e, o, n) {
        t.o(e, o) || Object.defineProperty(e, o, { enumerable: !0, get: n });
      }),
      (t.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
      }),
      (t.t = function (e, o) {
        if ((1 & o && (e = t(e)), 8 & o)) return e;
        if (4 & o && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if ((t.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: e }), 2 & o && "string" != typeof e))
          for (var i in e)
            t.d(
              n,
              i,
              function (o) {
                return e[o];
              }.bind(null, i)
            );
        return n;
      }),
      (t.n = function (e) {
        var o =
          e && e.__esModule
            ? function () {
                return e.default;
              }
            : function () {
                return e;
              };
        return t.d(o, "a", o), o;
      }),
      (t.o = function (e, o) {
        return Object.prototype.hasOwnProperty.call(e, o);
      }),
      (t.p = ""),
      t((t.s = 0));
  })([
    function (e, o, t) {
      t(1), (e.exports = t(2));
    },
    function (e, o) {
      screen.width < 992 &&
        (console.log("mobile"),
        $(document).ready(function () {
          const e = $("#menu-list");
          $("#burger").click(function () {
            console.log("bb"), $(this).toggleClass("burgerOpen"), $("body").toggleClass("header-open");
          }),
            $(document).on("click", e, function (e) {
              $(e.target).children("span") && $(e.target).next("ul").toggleClass("open");
            }),
            $("footer")
              .find(".title")
              .click(function () {
                $(this).parent().toggleClass("open");
              })
        })),
        $(document).ready(function () {
          const e = {
            slidesToScroll: 1,
            slidesToShow: 4,
            infinite: !0,
            autoplay: !0,
            autoplaySpeed: 3e3,
            centerMode: !0,
            arrows: !0,
            dots: !1,
            speed: 500,
            responsive: [
              { breakpoint: 1100, settings: { slidesToShow: 2 } },
              { breakpoint: 767, settings: { slidesToShow: 1, variableWidth: !1 } },
            ],
          };
          $(".slider-fixed-width").slick(e), $(".slider-standard-film").slick({ ...e, variableWidth: !0, centerMode: true}), $(".slider-blog").slick({...e, slidesToShow: 2}), $(".slider-events").slick({...e, slidesToShow: 2}), $(".slider-professional").slick({...e, slidesToShow: 3});
          $("#zoomModal").on("show.bs.modal", function (o) {
            $(".zoomSlider").slick({
              ...e,
              initialSlide: parseInt(1),
              slidesToShow: 1,
              responsive: [
                { breakpoint: 1100, settings: { slidesToShow: 1 } },
                { breakpoint: 767, settings: { slidesToShow: 1, variableWidth: !1 } },
              ],
            });
          }),
            $("#zoomModal").on("hidden.bs.modal", function (e) {
              $(".zoomSlider").slick("unslick");
            }),
            $(".modalContainer").click(function (e) {
              $(this) === $(e.target) && $("#zoomModal").modal("hide");
            });
        }),
        $("#toggleForm").on("click", (e) => {
          $("#formQuestions").toggle();
        })
    }
  ]);
  //# sourceMappingURL=bundle.js.map
