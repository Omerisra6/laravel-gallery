export function createFilePond( inputElement )
{
    const pond = FilePond.create( inputElement );
    console.log( pond );
    pond.setOptions({
    server:{

        url : '/api/upload',
        headers : {
            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
        },

        remove: (source, load, error) => {
            // Should somehow send `source` to server so server can remove the file with this source
            const remove = fetch ( `/api/remove/${ source }` ,{
                method: 'GET',
                headers: {                
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    },
                })


                // Should call the load method when done, no parameters required
                load();
            },
        }
    });
}