export default function printActionFunctions() {
    const form = $('#check_submited');
    const reduction_create = Routing.generate('reduction_url_encode');

    upateCount();

    form.on('submit', () => {
        let urlUrl = $('#url_url');
        const data = {'url': urlUrl.val()};
        $.ajax({
            url: reduction_create,
            type: 'POST',
            data,
            success: (event, request, settings) => {
                if ($('.row').find('.col-md-4').last().length) {
                    $('.row').find('.col-md-4').last().after(event);
                } else {
                    $( "#main_content" ).append(event);
                }
                urlUrl.val('');
            },
            error: ( event, jqxhr, settings, thrownError ) => {
                alert(event.responseJSON.msg);
            },
            complete: () => {
                $( "li.redirect_url" ).last().mouseup((event) => {
                    addEventOnClik(event);
                })
            }
        });
        return false;
    });

    function upateCount() {
        $(".redirect_url").each((index, elem) => {
            let itelem = $(elem);
            itelem.mouseup((event) => {
                addEventOnClik(event);
            })
        });
    }

    function addEventOnClik(event) {
        let clickEventRequestingNewTab = isClickEventRequestingNewTab(event);
        if (clickEventRequestingNewTab) {
            processCount(event);
        } else {
            switch (event.which) {
                case 1:
                    processCount(event);
                    break;
                case 2:
                    processCount(event);
                    break;
                case 3:
                    break;
                default:

            }
        }
    }

    function isClickEventRequestingNewTab(clickEvent) {
        return clickEvent.metaKey || clickEvent.ctrlKey || clickEvent.which === 2;
    }

    function processCount(event) {
        let currentCountEl = $(event.target).closest('ul').find("#count");
        const count = parseInt(currentCountEl.text()) + 1;
        currentCountEl.text(count);
    }
}
