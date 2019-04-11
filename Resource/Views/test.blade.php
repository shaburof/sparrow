@extends('app.master')

@section('content')
    <h1>test view template</h1>
    <script>

        axios.post('/test', {
            firstName: 'Fred',
            lastName: 'Flintstone',
            // csrf:'ac9e5d5c6ec927c98893bad118ae05981093448701490adbee9c26afcf1a4fc738bb8200226c5a7a124d05d31f9c146607cd-9391'

        }, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });


    </script>
@endsection
