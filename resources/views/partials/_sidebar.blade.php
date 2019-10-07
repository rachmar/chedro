<section class="sidebar">

  <div class="user-panel">
    <div class="pull-left image">
      <img src="https://raw.githubusercontent.com/Infernus101/ProfileUI/0690f5e61a9f7af02c30342d4d6414a630de47fc/icon.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{ Auth::user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

<!--   <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
    </div>
  </form> -->

  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">Options</li>

    <!-- <li class="{{ Request::is('home') ? 'active' : '' }}">
      <a href="{{ url('home') }}">
        <i class="fa fa-home"></i>
          <span>Home</span>
      </a>
    </li> -->

    <!-- Start Admin -->
    @if (Auth::user()->isPACD())

      <li class="{{ Request::segment(2) === 'transaction' ? 'active' : '' }}">
        <a href="{{ url('admin/transaction')}}">
          <i class="fa  fa-building-o" aria-hidden="true"></i>
            <span>Generate Route</span>
        </a>
      </li>

      <li class="{{ Request::segment(2) === 'search' ? 'active' : '' }}">
        <a href="{{ url('admin/search')}}">
          <i class="fa  fa-building-o" aria-hidden="true"></i>
            <span>Track Control Num</span>
        </a>
      </li>

    @endif

    @if (Auth::user()->isSECT() || Auth::user()->isCAO() || Auth::user()->isCEPS())

      <li class="{{ Request::segment(2) === 'track' ? 'active' : '' }}">
        <a href="{{ url('admin/track')}}">
          <i class="fa  fa-building-o" aria-hidden="true"></i>
            <span>Track</span>
        </a>
      </li>

    @endif


  </ul>

</section>