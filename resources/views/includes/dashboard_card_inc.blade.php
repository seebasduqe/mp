<div class="col-md-6 @if (isset($class_css)) {{ $class_css }} @endif">
    <div class="app-page-title bg-secondary text-white m-2 mt-4 mb-0">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="{{ $main_icon }} icon-gradient bg-primary">
                    </i>
                </div>
                <a class="text-white" href="{{ $url_list }}">
                    <div>{{ $main_title }}
                        <div class="page-title-subheading">{{ $secondary_title }}
                        </div>
                    </div>
                </a>
            </div>
            <div class="page-title-actions text-white">
                @if ($url_create != null)
                    <a href="{{ $url_create }}" class="m-2 btn btn-primary"><i
                            class="{{ $create_icon }} mr-2"></i>{{ $create_name }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
