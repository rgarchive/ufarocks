@extends('layouts.app')

@section('title', 'Места развлечений Уфы')
@section('description', 'Куда пойти в Уфе.')

@section('nav')
<nav class="mdc-tab-bar">
  <a class="mdc-tab mdc-tab--active">Все места<span class="mdc-tab__indicator"></span></a>
  <a class="mdc-tab">Клубы<span class="mdc-tab__indicator"></span></a>
  <a class="mdc-tab">Концертные залы<span class="mdc-tab__indicator"></span></a>
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
      <a class="mdc-tab mdc-tab--active" href="{{ route('venues.index') }}">Главная<span class="mdc-tab__indicator"></span></a>
    </nav>
  </div>
</header>

<mdc-layout-grid>
  <mdc-layout-cell desktop="8" tablet="5" phone="4">
    @foreach ($venues as $venue)
    <div class="app-card mdc-card">
      <!-- Venue info -->
      <a class="app-card__primary-action mdc-card__primary-action" href="{{ route('venues.show', $venue->id) }}" tabindex="0">
        <div class="app-card__text">
          <h2 class="app-card__title mdc-typography--headline6">{{ $venue->name }}</h2>
          <h3 class="app-card__subtitle mdc-typography--subtitle2 mdc-theme--text-secondary-on-background">{{ $venue->address }}</h3>
          <div class="app-card__description mdc-typography--body2">{{ $venue->description }}</div>
        </div>
        @if ($venue->image)
        <img class="app-card__media mdc-card__media mdc-card__media--16-9" src="{{ $venue->image }}" alt="{{ $venue->name }}">
        @else
        @endif
      </a>

      <!-- Venue actions -->
      <div class="mdc-card__actions">
        <div class="mdc-card__action-buttons">
          <a class="mdc-button mdc-card__action mdc-card__action--button" href="{{ route('venues.show', $venue->id) }}">Подробнее</a>
        </div>

        <div class="mdc-card__action-icons mdc-menu-anchor" id="menu">
          <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" title="Нравится" data-toggle-on-content="favorite" data-toggle-on-label="Remove from favorites" data-toggle-off-content="favorite_border" data-toggle-off-label="Нравится">favorite_border</button>
          <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" title="Поделиться" data-mdc-ripple-is-unbounded="true">share</button>

          <mdc-menu-anchor>
            <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" title="Больше опций" @click="isMenuOpen=true">more_vert</button>
            <mdc-menu v-model="isMenuOpen">
              <mdc-menu-item><a href="{{ route('venues.edit', $venue->id) }}">Редактировать</a></mdc-menu-item>
              <mdc-menu-item><a onclick="">Удалить</a></mdc-menu-item>
            </mdc-menu>
          </mdc-menu-anchor>

          <!--
          <button class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" id="menu-button" title="Больше опций">more_vert</button>

          <div class="mdc-menu" tabindex="-1" style="display: none;">
            <ul class="mdc-menu__items mdc-list" role="menu" aria-hidden="true">
              <li class="mdc-list-item" role="menuitem" tabindex="0">
                A Menu Item
              </li>
              <li class="mdc-list-item" role="menuitem" tabindex="0">
                Another Menu Item
              </li>
            </ul>
            <a class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" href="{{ route('venues.edit', $venue->id) }}">edit</a>
            <a class="mdc-icon-button material-icons mdc-card__action mdc-card__action--icon" onclick="">delete</a>

            <form method="POST" action="{{ route('venues.destroy', $venue->id) }}" style="display: none;">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="DELETE">
            </form>
          </div>
          -->
        </div>
      </div>
    </div>
    @endforeach

    <!-- Pagination -->
    {{ $venues->links() }}
  </mdc-layout-cell>

  <mdc-layout-cell desktop="4" tablet="3" phone="4">
    @auth
    <a class="mdc-button mdc-button--raised" href="{{ route('venues.create') }}">Добавить место</a>
    @endauth
  </mdc-layout-cell>
</mdc-layout-grid>
@endsection
