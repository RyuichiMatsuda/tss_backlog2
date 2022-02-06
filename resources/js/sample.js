$(function () {
    console.log('run jquery');

    $('.sample_ajax_button').on('click', function () {

        // $('.change_card').children('.card').remove();
        $ajax_id = $(this).attr('ajax_id');

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.get({
            url: "incidents/detail/" + $ajax_id,
            method: 'POST',
            dataType: 'json'
        })
            .done(function (data) {
                $testt = data;
                console.log(data);
                // console.log($testt.data.length);
                $('.change_card').children('.card').remove();
                if (Array.isArray($testt)) {
                    for (var i = 0; i < $testt.data.length; i++) {

                        var card_li = $('<div id="copy_card" class="card"><div class="card-header">名前</div><div class="card-body"> 要件 </div> </div>');
                        // const commentClone = $('#copy_card').clone(true).removeAttr('style');
                        // console.log(commentClone);
                        card_li.children('.card-header').append($testt.data[i].title);
                        card_li.children('.card-body').append($testt.data[i].body);
                        $('#change_card').append(card_li);
                    }
                } else {
                    var card_li = $('<div id="copy_card" class="card"><div class="card-header">名前</div><div class="card-body"> 要件 </div> </div>');
                    // const commentClone = $('#copy_card').clone(true).removeAttr('style');
                    // console.log(commentClone);
                    card_li.children('.card-header').append($testt.title);
                    card_li.children('.card-body').append($testt.body);
                    $('#change_card').append(card_li);
                }

            })
            .fail(function () {
            })

    });

})