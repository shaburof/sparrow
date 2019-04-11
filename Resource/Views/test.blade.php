@extends('app.master')

@section('content')
    <h1>test view template</h1>
    <script>

        axios.post('/test', {
            // firstName: 'Fred',
            // lastName: 'Flintstone',

        })
            .then(function (response) {
                console.log(response);
            })
            .catch(function (error) {
                console.log(error.response);
            });


    </script>
@endsection
