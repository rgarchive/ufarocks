@extends('layouts.app')

@section('title', 'Концерты и мероприятия Уфы')
@section('description', 'Культурно-развлекательные события Уфы.')

@section('nav')
<nav class="mdc-tab-bar">
  <a class="mdc-tab mdc-tab--active">Все события<span class="mdc-tab__indicator"></span></a>
  <a class="mdc-tab">На этой неделе<span class="mdc-tab__indicator"></span></a>
  <a class="mdc-tab">В этом месяце<span class="mdc-tab__indicator"></span></a>
</nav>
@endsection

@section('content')
<header class="article__header-container mdc-theme--primary-bg mdc-theme--on-primary">
  <div class="mdc-layout-grid">
    <div class="article__header">
      <div class="article__header-text">
        <h1 class="article__header-title mdc-typography--headline4" itemprop="name">@yield('title')</h1>
        <div class="article__header-description" itemprop="description">@yield('description')</div>
      </div>
    </div>

    <nav class="mdc-tab-bar">
      <a class="mdc-tab mdc-tab--active" href="{{ route('events.index') }}">Главная<span class="mdc-tab__indicator"></span></a>
    </nav>
  </div>
</header>

<mdc-layout-grid>
  <mdc-layout-cell desktop="8" tablet="5" phone="4">

    @foreach ($events as $event)
    <div class="app-card mdc-card">
      <!-- Event info -->
      <a class="app-card__primary-action mdc-card__primary-action" href="{{ route('events.show', $event->id) }}" tabindex="0">
        <div class="app-card__text">
          <h2 class="app-card__title mdc-typography--headline6">{{ $event->name }}</h2>
          <h3 class="app-card__subtitle mdc-typography--subtitle2 mdc-theme--text-secondary-on-background">
            <time class="js-moment" datetime="{{ $event->starts_at }}">{{ $event->starts_at }}</time>
          </h3>
          <div class="app-card__description mdc-typography--body2">{{ $event->description }}</div>
        </div>

        @if ($event->image)
        <img class="app-card__media mdc-card__media mdc-card__media--16-9" src="{{ $event->image }}" alt="{{ $event->name }}">
        @endif
      </a>

      <!-- Event actions -->
      <div class="mdc-card__actions">
        <div class="mdc-card__action-buttons">
          <a class="mdc-button mdc-card__action mdc-card__action--button" href="{{ route('events.show', $event->id) }}">Подробнее</a>
        </div>
        <div class="mdc-card__action-icons">
          <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" title="Нравится" data-toggle-on-content="favorite" data-toggle-on-label="Remove from favorites" data-toggle-off-content="favorite_border" data-toggle-off-label="Нравится">favorite_border</button>
          <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" title="Поделиться">share</button>

          <mdc-menu-anchor>
            <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" title="Больше опций" @click="isMenuOpen=true">more_vert</button>
            <mdc-menu v-model="isMenuOpen">
              <mdc-menu-item><a href="{{ route('events.edit', $event->id) }}">Редактировать</a></mdc-menu-item>
              <mdc-menu-item><a onclick="">Удалить</a></mdc-menu-item>
            </mdc-menu>
          </mdc-menu-anchor>

          <form method="POST" action="{{ route('events.destroy', $event->id) }}" style="display: none;">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
          </form>
        </div>
      </div>
    </div>
    @endforeach

    <!-- Pagination -->
    {{ $events->links() }}
  </mdc-layout-cell>
</mdc-layout-grid>
@endsection

<!--
@auth
<a class="mdc-button mdc-button--raised" href="{{ route('events.create') }}">Создать событие</a>
@endauth
-->
