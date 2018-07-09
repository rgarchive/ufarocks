@extends('layouts.app')

@section('title', 'Редактировать "' . $venue->name . '"')

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
    <h1 class="article__header-title">{{ 'Редактировать "' . $venue->name . '"' }}</h1>

    <form method="POST" action="{{ route('venues.update', $venue->id) }}">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PATCH">

      <div class="mdc-text-field mdc-text-field--outlined width-100">
        <label class="mdc-floating-label" for="name">Название</label>
        <input class="mdc-text-field__input" id="name" name="name" value="{{ $venue->name }}" type="text" maxlength="255" required>
        <div class="mdc-notched-outline"><svg><path class="mdc-notched-outline__path"/></svg></div>
        <div class="mdc-notched-outline__idle"></div>
      </div>

      <div class="mdc-text-field mdc-text-field--outlined width-100">
        <label class="mdc-floating-label" for="address">Адрес</label>
        <input class="mdc-text-field__input" id="address" name="address" value="{{ $venue->address }}" type="text" required>
        <div class="mdc-notched-outline"><svg><path class="mdc-notched-outline__path"/></svg></div>
        <div class="mdc-notched-outline__idle"></div>
      </div>

      <div class="mdc-text-field mdc-text-field--outlined width-100">
        <label class="mdc-floating-label" for="vk_id">VK ID</label>
        <input class="mdc-text-field__input" id="vk_id" name="vk_id" value="{{ $venue->vk_id }}" type="number" min="0" step="1" required>
        <div class="mdc-notched-outline"><svg><path class="mdc-notched-outline__path"/></svg></div>
        <div class="mdc-notched-outline__idle"></div>
      </div>

      <div class="mdc-text-field mdc-text-field--textarea width-100">
        <label class="mdc-floating-label" for="description">Описание</label>
        <textarea class="mdc-text-field__input" id="description" name="description" maxlength="255" required>{{ $venue->description }}</textarea>
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
