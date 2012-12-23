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
                <i class="icon-tag tooltip" data-tooltip="Filter Tags"></i>
                <i class="icon-arrows-cw tooltip" id="menu-reset-filters" data-tooltip="Reset Filters/Searches"></i>
                <i class="icon-pencil tooltip" id="menu-delete-tags" data-tooltip="Toggle Delete Tags"></i>
                <i class="icon-cog tooltip" data-tooltip="No Options Available"></i>
            </div>
        </div>
    </div>

    <div class="spacer"></div>
    <div class="bar-top"></div>

    <div class="featured">
        <div class="container_12">
            <div class="grid_12">
                <div id="updated-tag-notice">
                    The tag was updated and its contents now live!
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