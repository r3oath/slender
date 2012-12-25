@layout('slender::master')
@section('title')
    Slender Dashboard
@endsection
@section('content')

    <div class="top-spacer"></div>

    <div class="container_12">
        <div class="grid_5">
            <div class="header">
                Slender CMS
            </div>
            <div class="sub-header" id="status-bar">
                <!-- Managed by Backbone -->
            </div>
        </div>
        <div class="grid_3 top-push">
            <!-- Menu will be placed here once tag searching is implemented -->
        </div>
        <div class="grid_4 top-push">
            <!-- <input type="text" id="search-bar" placeholder="Search Tags..."> -->
            <div class="menu-items">
                <i class="icon-tag tooltip" id="menu-filter-tags" data-tooltip="Filter By Type"></i>                    
                <i class="icon-arrows-cw tooltip" id="menu-reset-filters" data-tooltip="Reset Filters/Searches"></i>
                <i class="icon-pencil tooltip" id="menu-delete-tags" data-tooltip="Toggle Delete Tags"></i>
                <a href="logout"><i class="icon-logout tooltip" data-tooltip="Logout"></i></a>
            </div>
            <div id="filter-tags-list">
                <span id="filter-type-html" data-type="html"><i class="icon-tag"></i> HTML</span>
                <span id="filter-type-text" data-type="text"><i class="icon-tag"></i> TEXT</span>
                <span id="filter-type-css" data-type="css"><i class="icon-tag"></i> CSS</span>
                <span id="filter-type-js" data-type="js"><i class="icon-tag"></i> JS</span>
                <span id="filter-type-image" data-type="image"><i class="icon-tag"></i> IMAGE</span>
            </div>            
        </div>
    </div>

    <div class="spacer"></div>
    <div class="bar-top"></div>

    <div class="featured">
        <div class="container_12">
            <div class="grid_12">
                <div id="updated-tag-notice">
                    <i class="icon-upload-cloud"></i> Tag Updated! The associated content is now live.
                </div>
            </div>
        </div>
        <div class="container_12" id="tag-area">
            <!-- Managed by Backbone -->
        </div>
    </div>

    <div class="bar-bottom"></div>

    <div class="bottom-spacer"></div>

    @render('slender::templates')
    
@endsection
@section('scripts')
    
@endsection