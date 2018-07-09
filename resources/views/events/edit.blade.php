@extends('layouts.app')

@section('title', 'Редактировать "' . $event->name . '"')

@section('errors')
<!-- Error messages -->
@if(count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whooops!! </strong> There were some problems with your input.<br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
@endsection

@section('content')
<mdc-layout-grid>
  <mdc-layout-cell desktop="12" tablet="8" phone="4">
    <h1 class="article__header-title">{{ 'Редактировать "' . $event->name . '"' }}</h1>

    <form method="POST" action="{{ route('events.update', $event->id) }}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PATCH">

      <div class="mdc-text-field mdc-text-field--outlined width-100">
        <label class="mdc-floating-label" for="name">Название</label>
        <input class="mdc-text-field__input" id="name" name="name" value="{{ $event->name }}" type="text" maxlength="255" required>
        <div class="mdc-notched-outline"><svg><path class="mdc-notched-outline__path"/></svg></div>
        <div class="mdc-notched-outline__idle"></div>
      </div>

      <div class="mdc-text-field mdc-text-field--outlined width-100">
        <label class="mdc-floating-label" for="starts_at">Начало</label>
        <input class="mdc-text-field__input" id="starts_at" name="starts_at" value="{{ $event->starts_at }}" type="text" required>
        <div class="mdc-notched-outline"><svg><path class="mdc-notched-outline__path"/></svg></div>
        <div class="mdc-notched-outline__idle"></div>
      </div>

      <div class="mdc-text-field mdc-text-field--outlined width-100">
        <label class="mdc-floating-label" for="venue_id">Место проведения</label>
        <input class="mdc-text-field__input" id="venue_id" name="venue_id" value="{{ $event->venue_id }}" type="number" min="0" step="1" required>
        <div class="mdc-notched-outline"><svg><path class="mdc-notched-outline__path"/></svg></div>
        <div class="mdc-notched-outline__idle"></div>
      </div>

      <div class="mdc-text-field mdc-text-field--textarea width-100">
        <label class="mdc-floating-label" for="description">Описание</label>
        <textarea class="mdc-text-field__input" id="description" name="description" maxlength="255" required>{{ $event->description }}</textarea>
        <div class="mdc-line-ripple"></div>
      </div>

      <div class="mdc-form-field">
        <input class="mdc-button mdc-button--raised" type="submit" value="Сохранить">
        <a class="mdc-button" href="{{ url()->previous() }}">Отменить</a>
      </div>
    </form>
  </mdc-layout-cell>
</mdc-layout-grid>
@endsection
