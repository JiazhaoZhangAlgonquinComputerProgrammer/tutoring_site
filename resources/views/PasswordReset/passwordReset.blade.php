@extends('Layouts.main_layout')
<style type="text/css">
    #content-wrapper{
        background-color: wheat;
        position: fixed;
        width: 150vh;
        height: 80vh;
        top: 15%;
        left: 50%;
        transform: translateX(-50%)
    }

    #content-wrapper .left{
        width: 60vh;
        /* background-color: blue; */
        background: url({{url('images/use-laptop.jpg')}});
        background-size: contain;
    }

    #content-wrapper .right{
        width: 90vh;

    }
</style>
@section('content')

    <div id="content-wrapper" class="d-flex flex-row">
        <div class="left">

        </div>
        <div class="right">
            <h4>RESET PASSWORD</h4>
        </div>
    </div>

@endsection
