$(document).ready(function () {
	/* Fair Game */
	
	$(document).on('click', '#fair-check', function() {
        var roundHash = $('#roundHash1').val();
		var roundNumber = $('#roundNumber1').val();
		var roundPrice = $('#roundPrice1').val();
        $.ajax({
            url: '/fairgame',
            type: 'GET',
            dataType: 'json',
			data: { roundHash: roundHash, roundNumber: roundNumber, roundPrice: roundPrice},
            success: function(data) {
                showmsg(data.type, data.message);
            },
            error: function() {
                showmsg('error', 'Попробуйте еще раз.');
            }
        });
    });
	
	/* Fair Game */
});