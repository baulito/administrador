@if (isset($pagination) && isset($pagination['current_page']))
    <div class="text-center mt-3 mb-3">
        <nav>
            <ul class="pagination justify-content-center">
                @if (isset($pagination['previous']))
                    <li class="page-item">
                        <a class="page-link" href="{{ $pagination['url']."&page=".$pagination['previous'] }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif
                
                @foreach ($pagination['pages'] as $page)
                    @if ($pagination['current_page'] == $page )
                        <li class="page-item active"><a class="page-link" >{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $pagination['url']."&page=".$page }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                @if (isset($pagination['next']))
                    <li class="page-item">
                        <a class="page-link" href="{{ $pagination['url']."&page=".$pagination['next'] }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif
                
            </ul>
        </nav>
    </div>
@endif