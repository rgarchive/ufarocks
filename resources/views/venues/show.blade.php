@extends('layouts.app')

@section('title', $venue->name)

@section('errors')
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
<article class="article" itemscope itemtype="http://schema.org/Place">
  <header class="article__header-container mdc-theme--primary-bg mdc-theme--on-primary">
    <div class="mdc-layout-grid">
      <div class="article__header">
        @if($venue->image)
        <img class="article__header-avatar" src="{{ $venue->image }}" alt="{{ $venue->name }}" itemprop="image">
        @endif
        <div class="article__header-text">
          <h1 class="article__header-title mdc-typography--headline4" itemprop="name">{{ $venue->name }}</h1>
          <div class="article__header-description" itemprop="description">{{ $venue->description }}</div>
        </div>
      </div>
      <nav class="mdc-tab-bar">
        <a class="mdc-tab mdc-tab--active" href="{{ route('venues.index', $venue->id) }}">Главная<span class="mdc-tab__indicator"></span></a>
      </nav>
    </div>
  </header>

  <mdc-layout-grid>
    <mdc-layout-cell desktop="8" tablet="5" phone="4">
      <h2 class="title">Расписание</h2>

      @if (count($events) > 0)
      <div class="mdc-list mdc-list--two-line mdc-list--avatar-list mdc-card">
        @foreach ($events as $event)
        <a class="mdc-list-item" href="{{ route('events.show', $event->id) }}">
          <i class="mdc-list-item__graphic date">
            <span class="date-day">22</span>
            <span class="date-month">июн</span>
          </i>
          <span class="mdc-list-item__text">
            {{ $event->name }}
            <time class="mdc-list-item__secondary-text js-moment" datetime="{{ $event->starts_at }}">{{ $event->starts_at }}</time>
          </span>
          <i class="mdc-list-item__meta material-icons">launch</i>
        </a>
        @endforeach
      </div>
      @else
      <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h3 style="margin-bottom: .5rem;">Событий пока нет.</h3>
        <p style="margin-bottom: 1.5rem;">Зарегистрированные пользователи могут добавлять события на сайт.</p>
        <button class="mdc-button mdc-button--raised mdc-theme--secondary-bg mdc-theme--on-secondary">Добавить событие</button>
      </div>
      @endif
    </mdc-layout-cell>

    <mdc-layout-cell desktop="4" tablet="3" phone="4">
      <aside>
        <h1 class="title">Информация</h1>
        <dl>
          <dt>Адрес:</dt>
          <dd itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
            <span itemprop="addressLocality">Уфа</span>,
            <span itemprop="streetAddress">{{ $venue->address }}</span>
          </dd>

          <dt>Сайт:</dt>
          <dd><a class="url link" href="{{ $venue->url }}" rel="me nofollow" target="_blank" itemprop="url">{{ $venue->url }}</a></dd>
        </dl>
        <button class="mdc-button mdc-button--outlined">Связаться</button>
      </aside>
    </mdc-layout-cell>
  </mdc-layout-grid>
</article>
@endsection
