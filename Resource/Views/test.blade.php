@extends('app.master')

@section('content')
    <h1>test view template</h1>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

        //        const axios = require('axios');
        axios.post('/test', {
            firstName: 'Fred',
            lastName: 'Flintstone',
            csrf:'4c151dab8622e099b12c32dd2b29f4c47fcc6f932e6dd33333e42a7ed2ecf150ccf6a767142a2d6953900f40abb9366587b4-10901'

        }, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(function (response) {
                console.log(response.data[0].name);
            })
            .catch(function (error) {
                console.log(error);
            });

        //        fetch("/test",
        //            {
        //                headers: {
        //                    'Accept': 'application/json',
        //                    'Content-Type': 'application/json',
        //                    foo:'bar'
        //                },
        //                method: "POST",
        //                body: JSON.stringify({
        //                    a: 1,
        //                    b: 2,
        //                    csrf:'78de0140711bceac1af724f293e5dac2777b4e0fbfab8eb44d6b9db52a920c4c41b93a62e9d4c4bb3c7406d2651b9c2b0237-10027'
        //                })
        //            })
        //            .then(function (res) {
        //                console.log(res);
        //            })
        //            .catch(function (res) {
        //                console.log('error');
        //                console.log(res);
        //            })

    </script>
@endsection
