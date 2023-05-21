export function createFilePond( inputElement )
{
    const pond = FilePond.create( inputElement );
    pond.setOptions({
        server:{
            process : '/api/temp',
            revert: '/api/temp',
            headers : {
                'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
        }
    });
}