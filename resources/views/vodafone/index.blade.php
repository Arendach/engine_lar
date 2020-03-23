@extends('layout')

@section('content')

    <form action="@uri('vodafone/merge')" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>file</label>
            <input type="file" class="form-control" multiple name="kmls[]">
        </div>
        <div class="form-group">

        </div>
        <div class="form-group">
            <button class="btn btn-primary">upload</button>
        </div>
    </form>

@endsection