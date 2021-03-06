@extends('app.master')

@section('content')
    <v-container grid-list-md text-xs-center>
        <v-layout row wrap>
            <v-flex xs12 class="text-xs-center">
                @{{ title }}
            </v-flex>
            <v-flex xs12>
                <h1 class="red--text">@{{ name }}</h1>
                <v-divider class="mt-2"></v-divider>
            </v-flex>
            <v-flex xs12>
                <img src="{{ url('/images/sparrow.png') }}" alt="">
            </v-flex>
        </v-layout>

    </v-container>
@endsection

@section('script')
    <script>
        new Vue({
            name: 'hello',
            el: '#app',
            data: {
                title: 'new framework',
                name: 'Sparrow',
            }
        });
    </script>
@endsection
