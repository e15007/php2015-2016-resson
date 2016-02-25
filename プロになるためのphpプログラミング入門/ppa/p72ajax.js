/*	AjaxとPHPを組み合わせるサンプル	*/
/*	市区町村データを取得			*/
function getCityData()
{
	var	sels = $('select#addr2');

	$('option', sels).remove();
	$('#towns li').remove();

	var p = $('#addr1').val();
	if(p == 0){
		return;
	}

	var	opts = sels.attr('options');

	$.getJSON('/ppa/p72ajax.php', {pref:p}, function(dtcity) {
		sels.append($('<option>')
						.attr('value', '0')
						.text('選択してください'));

		$.each(dtcity, function(index, array) {
			sels.append($('<option>')
						.attr('value', array['d'])
						.text(array['c']));
		});
	})
	.error(function() { alert("error"); });
}

/*	町域データを取得			*/
function getTownData()
{
	var	c = $('select#addr2').val();

	$('ul#towns li').remove();

	if(c == 0){
		return;
	}

	$.getJSON('/ppa/p72ajax.php', {pref:$('select#addr1').val(), city:c}, function(dttown) {
		$.each(dttown, function(index, array) {
			$('ul#towns').append($('<li>')
						.addClass('r' + array['r'])
						.text(array['t']));
		});
	})
	.error(function() { alert("error"); });
}

$(function() {
	$('select#addr1').change(function() {
		getCityData();
	});
	$('select#addr2').change(function() {
		getTownData();
	});
});
