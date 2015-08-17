@extends( 'journal::layouts.dashboard' )

{{--@section( 'title', 'Create Post' )--}}

@section( 'page' )
  <?php
    $formOptions = [
      'action' => '\Molovo\Journal\Http\Controllers\PostsController@store',
      'class' => 'admin-form'
    ];
  ?>

  {!! Form::model( new \Molovo\Journal\Models\Post, $formOptions ) !!}

    <fieldset class="admin-form--title">
      {!! Form::label( 'name', 'Post Name' ) !!}
      {!! Form::text( 'name' ) !!}
    </fieldset>

    <fieldset class="admin-form--product-price">
      <div class="admin-form--field-third">
        {!! Form::label( 'net_price', 'Net Price' ) !!}
        {!! Form::number( 'net_price', null, [ 'step' => 0.01, 'class' => 'currency' ] ) !!}
      </div>

      <div class="admin-form--field-third">
        {!! Form::label( 'tax', 'Tax' ) !!}
        {!! Form::number( 'tax', null, [ 'step' => 0.01, 'class' => 'percentage' ] ) !!}
      </div>

      <div class="admin-form--field-third">
        {!! Form::label( 'gross_price', 'Gross Price' ) !!}
        {!! Form::number( 'gross_price', null, [ 'step' => 0.01, 'class' => 'currency' ] ) !!}
      </div>
    </fieldset>
  {!! Form::close() !!}
@stop