export function setUpPagination( callback )
{
    callback()
    $('ul.pagination').hide();
    $('.scrolling-pagination').jscroll({
        autoTrigger: true,
        padding: 0,
        nextSelector: '.pagination li.active + li a',
        contentSelector: 'div.scrolling-pagination',
        loadingHtml: '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>',
        callback: function() {
            $('ul.pagination').remove();    
            callback()
        }
    });
}