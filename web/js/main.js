$('#check-url-btn').on('click', function () {
    var url = $('#url-input').val().trim();
    if (!url) {
        $('#result').html('<div class="alert alert-warning">Пожалуйста, введите URL</div>');
        return;
    }

    $.ajax({
        url: 'link/shorten',
        type: 'POST',
        data: {url: url},
        success: function(data) {
            if (data.error) {
                $('#result').html('<div class="alert alert-danger">' + data.error + '</div>');
            } else {
                var shortUrl = data.short_url;
                var html = '<div class="alert alert-success">Короткая ссылка: <a href="' + shortUrl + '" target="_blank">' + shortUrl + '</a></div>';
                html += '<div id="qr-code"></div>';
                $('#result').html(html);

                // Создаем QR код
                if (typeof QRCode !== 'undefined') {
                    var qrContainer = document.getElementById('qr-code');
                    qrContainer.innerHTML = '';
                    new QRCode(qrContainer, {
                        text: shortUrl,
                        width: 160,
                        height: 160
                    });
                }
            }
        },
        error: function() {
            $('#result').html('<div class="alert alert-danger">Произошла ошибка при запросе</div>');
        }
    });
});

$('#check-url-btn').on('click', function () {
    var url = $('#url-input').val().trim();
    if (!url) {
        $('#result').html('<div class="alert alert-warning">Пожалуйста, введите URL</div>');
        return;
    }
});