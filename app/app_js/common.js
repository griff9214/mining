$('form button').click(function (event) {
    var valid = true;
    if (valid) {
        formData = $(this).closest('form').serialize();
        $.ajax({
            type: 'POST',
            url: 'mailer.php', //возможно нужно подправить путь при размещении на сервере
            context: this,
            data: formData,
            beforeSend: function () {
                $(this).closest(".modal").modal('hide');
                $("#ResultModal").remove();
            },
            success: function (data) {
                $("body").append(data);
                $("#ResultModal").modal();
            },
            error: function (xhr, str) {
                alert('error: ' + xhr.responseCode);
            }
        });
    }

    event.preventDefault();
});


var $menu = $("#my-menu").mmenu({
        "extensions": [
        "pagedim-black",
        "position-right",
        "border-none"
    ],
    navbar: {
        title: "МЕНЮ"
    },
    "navbars":[
        {
            position: "top",
            content: ["prev", "title"]
        },
        {
            "position": "bottom",
            "content": [
                        '<div class="social-icons"><a href="https://www.instagram.com/crypto_invest_spb/" class="social-icons__icon social-icons__icon_im"></a><a href="https://t.me/crypto_invest_spb" class="social-icons__icon social-icons__icon_tm"></a><a href="https://vk.com/crypto_invest_spb" class="social-icons__icon social-icons__icon_vk"></a></div>'
            ]
        }
        ]
},{
    clone: true,
});
var API = $menu.data("mmenu");
var $icon = $("button.hamburger");

$icon.on( "click", function() {
    API.open();
});

API.bind( "open:finish", function() {
    setTimeout(function() {
        $icon.addClass( "is-active" );
    }, 50);
});
API.bind( "close:finish", function() {
    setTimeout(function() {
        $icon.removeClass( "is-active" );
    }, 50);
});

//smooth scroll
// all links with hashes
function scrollTotarget(target) {
    $('html, body').animate({
        scrollTop: target.offset().top
    }, 1000, function () {
        // Callback after animation
        // Must change focus!
        var $target = $(target);
        $target.focus();
        if ($target.is(":focus")) { // Checking if the target was focused
            return false;
        } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
        }
        ;
    });
}
$('a[href*="#"]')
// Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .click(function (event) {
        // On-page links
        if (
            location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
            &&
            location.hostname == this.hostname
        ) {
            // Figure out element to scroll to
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                if ($(this).closest('.mm-listview').is('.mm-listview')) {
                    API.close();
                    setTimeout(function () {
                        scrollTotarget(target);
                    }, 200)
                } else {
                    scrollTotarget(target);
                }

            }
        }
    });
