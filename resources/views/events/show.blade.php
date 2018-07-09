@extends('layouts.app')

@section('title', $event->name)

@section('content')
<article class="article" itemscope itemtype="http://schema.org/Event">
  <header class="article__header-container mdc-theme--primary-bg mdc-theme--on-primary">
    <div class="mdc-layout-grid">
      <div class="article__header">
        @if ($event->image)
        <img class="article__header-avatar" src="{{ $event->image }}" alt="{{ $event->name }}">
        @endif
        <div class="article__header-text">
          <h1 class="article__header-title mdc-typography--headline4" itemprop="name">{{ $event->name }}</h1>
          <div class="article__header-description" itemprop="description">{{ $event->description }}</div>
        </div>
      </div>
      <nav class="mdc-tab-bar">
        <a class="mdc-tab mdc-tab--active">Главная<span class="mdc-tab__indicator"></span></a>
      </nav>
    </div>
  </header>

  <mdc-layout-grid>
    <mdc-layout-cell desktop="8" tablet="5" phone="4">
      <aside>
        <h1>Информация</h1>
        <dl class="event__meta">
          <dt>Место проведения:</dt>
          <dd itemprop="organizer"><a class="link" href="{{ route('venues.show', $venue->id) }}">{{ $venue->name }}</a></dd>
          <dt>Адрес:</dt>
          <dd itemprop="location">
            <span class="addressLocality">Уфа</span>,
            <span class="streetAddress">{{ $venue->address }}</span>
          </dd>
          <dt>Дата проведения:</dt>
          <dd>
            <time class="js-moment" datetime="{{ $event->starts_at }}" itemprop="startDate">{{ $event->starts_at }}</time>
          </dd>
          @if ($event->artist_id)
          <dt>Выступает:</dt>
          <dd itemprop="performer">{{ $artist->id }}</dd>
          <dt>Жанр:</dt>
          <dd itemprop="genre">Рок</dd>
          @endif
        </dl>
      </aside>
    </mdc-layout-cell>
    <mdc-layout-cell desktop="4" tablet="3" phone="4">

    </mdc-layout-cell>
  </mdc-layout-grid>
</article>
@endsection
