$('a[method="DELETE"]').on('click', function(e){
    if(confirm($(this).attr('data-confirm')))
    {
        $('#delete-form').attr('action', $(this).attr('href'));
        $('#delete-form').submit();
    }
    return false;
});

$('a[method="POST"]').on('click', function(e){
    if(confirm($(this).attr('data-confirm')))
    {
        $('#post-form').attr('action', $(this).attr('href'));
        $('#post-form').submit();
    }
    return false;
});