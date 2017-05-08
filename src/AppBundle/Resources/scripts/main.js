$(document).ready(function () {
    var source = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/search?tag=%QUERY',
            wildcard: '%QUERY'
        }
    });

    $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            source: source,
            limit:10
        });
});